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
use App\Models\UserStrengthRecord; // Ensure this model exists

class MemberController extends Controller
{


    public function science(): View
    {
        $articles = ScienceArticle::where('is_published', true)->get();
        return view('member.science.index', compact('articles'));
    }

    public function showArticle(ScienceArticle $article): View
    {
        if (!$article->is_published) {
            abort(404);
        }
        return view('member.science.show', compact('article'));
    }


    public function exercises(Request $request): View
    {
        $query = Exercise::query();

        if ($request->has('muscle')) {
            $query->where('muscle_group', $request->muscle);
        }

        $exercises = $query->paginate(12);
        return view('member.exercises.index', compact('exercises'));
    }

    public function nutrition(): View
    {
        $supplements = Nutrition::where('category', 'Supplement')->get();
        $foods = Nutrition::where('category', '!=', 'Supplement')->get();

        return view('member.nutrition.index', compact('supplements', 'foods'));
    }

    public function programs(): View
    {
        $programs = Program::all();
        return view('member.programs.index', compact('programs'));
    }

    public function showProgram(Program $program): View
    {
        $routine = is_string($program->routine_details)
            ? json_decode($program->routine_details, true)
            : $program->routine_details;

        return view('member.programs.show', compact('program', 'routine'));
    }

    public function tools(): View
    {
        $user = Auth::user();


        $lastResult = $user->metrics()->latest('recorded_at')->first();
        $history = $user->metrics()->orderBy('recorded_at', 'desc')->take(5)->get();

        $strengthRecords = $user->strengthRecords()->orderBy('recorded_at', 'desc')->get()->groupBy('exercise');

        $latestStrength = [
            'Bench Press' => $strengthRecords['Bench Press'][0] ?? null,
            'Squat' => $strengthRecords['Squat'][0] ?? null,
            'Deadlift' => $strengthRecords['Deadlift'][0] ?? null,
            'Overhead Press' => $strengthRecords['Overhead Press'][0] ?? null,
        ];

        return view('member.tools.index', compact('lastResult', 'history', 'latestStrength'));
    }

    public function storeTools(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'age' => 'required|integer|min:10|max:100',
            'gender' => 'required|in:male,female',
            'height' => 'required|numeric|min:100|max:250',
            'weight' => 'required|numeric|min:30|max:300',
            'activity_level' => 'required|in:sedentary,lightly_active,moderately_active,very_active,extra_active',
        ]);

        $heightInMeters = $validated['height'] / 100;
        $bmi = $validated['weight'] / ($heightInMeters * $heightInMeters);

        if ($validated['gender'] === 'male') {
            $bmr = (10 * $validated['weight']) + (6.25 * $validated['height']) - (5 * $validated['age']) + 5;
        } else {
            $bmr = (10 * $validated['weight']) + (6.25 * $validated['height']) - (5 * $validated['age']) - 161;
        }

        $multipliers = [
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extra_active' => 1.9,
        ];
        $tdee = $bmr * $multipliers[$validated['activity_level']];

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

        return redirect()->back()->with('success', 'BMI & TDEE Calculated!');
    }

    public function storeStrength(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'exercise' => 'required|in:Bench Press,Squat,Deadlift,Overhead Press',
            'weight_lifted' => 'required|numeric|min:1',
            'reps_performed' => 'required|integer|min:1|max:30',
            'bodyweight' => 'required|numeric|min:30',
        ]);


        $oneRepMax = $validated['weight_lifted'] * (1 + ($validated['reps_performed'] / 30));

        $ratio = $oneRepMax / $validated['bodyweight'];
        $level = 'Beginner';

        $standards = [
            'Bench Press' => ['Novice' => 0.75, 'Intermediate' => 1.25, 'Advanced' => 1.75, 'Elite' => 2.0],
            'Squat' => ['Novice' => 1.0, 'Intermediate' => 1.5, 'Advanced' => 2.0, 'Elite' => 2.5],
            'Deadlift' => ['Novice' => 1.25, 'Intermediate' => 1.75, 'Advanced' => 2.25, 'Elite' => 2.75],
            'Overhead Press' => ['Novice' => 0.5, 'Intermediate' => 0.8, 'Advanced' => 1.1, 'Elite' => 1.3],
        ];

        $exStandards = $standards[$validated['exercise']];

        if ($ratio >= $exStandards['Elite']) $level = 'Elite';
        elseif ($ratio >= $exStandards['Advanced']) $level = 'Advanced';
        elseif ($ratio >= $exStandards['Intermediate']) $level = 'Intermediate';
        elseif ($ratio >= $exStandards['Novice']) $level = 'Novice';

        UserStrengthRecord::create([
            'user_id' => Auth::id(),
            'exercise' => $validated['exercise'],
            'weight_lifted' => $validated['weight_lifted'],
            'reps_performed' => $validated['reps_performed'],
            'estimated_1rm' => round($oneRepMax, 1),
            'strength_level' => $level,
            'recorded_at' => now(),
        ]);

        return redirect()->back()->with('success', "1RM Calculated! Your estimated max is " . round($oneRepMax, 1) . "kg ($level).");
    }


    public function shop(): View
    {
        $products = Product::where('stock', '>', 0)->get();

        $transactions = Auth::user()->transactions()->latest()->get();
        return view('member.shop.index', compact('products', 'transactions'));
    }

    public function purchase(Request $request, Product $product): RedirectResponse
    {

        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Sorry, this item is out of stock.');
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_amount' => $product->price,
            'status' => 'pending',
        ]);

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        return redirect()->route('payment.show', $transaction);
    }
}
