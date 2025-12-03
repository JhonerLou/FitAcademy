<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\ScienceArticle;
use App\Models\Exercise;
use App\Models\Nutrition;
use App\Models\Program;
use App\Models\UserMetric;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem; 
class MemberController extends Controller
{
    public function shop(): View
    {
        $products = Product::where('stock', '>', 0)->get();
        // Fetch user's transaction history
        $transactions = Auth::user()->transactions()->latest()->get();
        return view('member.shop.index', compact('products', 'transactions'));
    }

    /**
     * Handle "Buy Now" -> Redirect to Payment
     */
    public function purchase(Request $request, Product $product): RedirectResponse
    {
        // 1. Check stock availability
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Sorry, this item is out of stock.');
        }

        // 2. Create Transaction (Status: PENDING)
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_amount' => $product->price,
            'status' => 'pending', // <--- Changed from 'completed'
        ]);

        // 3. Create Transaction Item
        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        // Note: We do NOT decrement stock yet. Stock is decremented upon payment success.

        // 4. Redirect to the Dummy Payment Gateway
        return redirect()->route('payment.show', $transaction);
    }
    public function science(): View
    {
        // Only show published articles
        $articles = ScienceArticle::where('is_published', true)->get();
        return view('member.science.index', compact('articles'));
    }

    /**
     * Display a specific article.
     */
    public function showArticle(ScienceArticle $article): View
    {
        if (!$article->is_published) {
            abort(404);
        }
        return view('member.science.show', compact('article'));
    }

    // ==========================================
    // GUIDE / LIBRARY SECTION
    // ==========================================

    /**
     * Display the Exercise Library.
     */
    public function exercises(Request $request): View
    {
        // We can add simple filtering here later if needed
        $query = Exercise::query();

        if ($request->has('muscle')) {
            $query->where('muscle_group', $request->muscle);
        }

        $exercises = $query->paginate(12); // Show 12 per page
        return view('member.exercises.index', compact('exercises'));
    }

    /**
     * Display Nutrition & Supplements.
     */
    public function nutrition(): View
    {
        // Separate Supplements from Food Sources for cleaner display
        $supplements = Nutrition::where('category', 'Supplement')->get();
        $foods = Nutrition::where('category', '!=', 'Supplement')->get();

        return view('member.nutrition.index', compact('supplements', 'foods'));
    }

    /**
     * Display Workout Programs.
     */
    public function programs(): View
    {
        $programs = Program::all();
        return view('member.programs.index', compact('programs'));
    }

    /**
     * Show details of a specific program.
     */
    public function showProgram(Program $program): View
    {
        // The routine_details is stored as JSON, Laravel usually casts it if defined in model,
        // but we ensure it's usable here.
        $routine = is_string($program->routine_details)
            ? json_decode($program->routine_details, true)
            : $program->routine_details;

        return view('member.programs.show', compact('program', 'routine'));
    }

    // ==========================================
    // TOOLS SECTION (BMI & TDEE)
    // ==========================================

    /**
     * Show the calculator page.
     */
    public function tools(): View
    {
        // Get the user's most recent result to display history
        $lastResult = Auth::user()->metrics()->latest('recorded_at')->first();

        // Get all history for a chart (optional)
        $history = Auth::user()->metrics()->orderBy('recorded_at', 'asc')->get();

        return view('member.tools.index', compact('lastResult', 'history'));
    }

    /**
     * Calculate and Store BMI/TDEE.
     */
    public function storeTools(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'age' => 'required|integer|min:10|max:100',
            'gender' => 'required|in:male,female',
            'height' => 'required|numeric|min:100|max:250', // cm
            'weight' => 'required|numeric|min:30|max:300', // kg
            'activity_level' => 'required|in:sedentary,lightly_active,moderately_active,very_active,extra_active',
        ]);

        // 1. Calculate BMI
        // Formula: weight (kg) / [height (m)]^2
        $heightInMeters = $validated['height'] / 100;
        $bmi = $validated['weight'] / ($heightInMeters * $heightInMeters);

        // 2. Calculate BMR (Basal Metabolic Rate) using Mifflin-St Jeor Equation
        if ($validated['gender'] === 'male') {
            $bmr = (10 * $validated['weight']) + (6.25 * $validated['height']) - (5 * $validated['age']) + 5;
        } else {
            $bmr = (10 * $validated['weight']) + (6.25 * $validated['height']) - (5 * $validated['age']) - 161;
        }

        // 3. Calculate TDEE based on Activity Level
        $multipliers = [
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extra_active' => 1.9,
        ];
        $tdee = $bmr * $multipliers[$validated['activity_level']];

        // 4. Save to Database
        UserMetric::create([
            'user_id' => Auth::id(),
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'bmi_result' => round($bmi, 1),
            'tdee_result' => round($tdee),
            'activity_level' => $validated['activity_level'],
            'recorded_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Results calculated! Your BMI is ' . round($bmi, 1) . ' and TDEE is ' . round($tdee) . ' kcal.');
    }
}
