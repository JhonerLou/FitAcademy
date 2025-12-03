<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Exercise;
use App\Models\Nutrition;
use App\Models\Program;
use App\Models\ScienceArticle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
class AdminController extends Controller
{

    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'exercises' => Exercise::count(),
            'nutrition_items' => Nutrition::count(),
            'programs' => Program::count(),
            'articles' => ScienceArticle::count(),
            'products' => Product::count(),
            'orders' => Transaction::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentOrders = Transaction::with('user')->latest()->take(5)->get();


        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentUsers'));
    }
       public function transactions(): View
    {

        $transactions = Transaction::with(['user', 'items.product'])->latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function showTransaction(Transaction $transaction): View
    {
        $transaction->load(['user', 'items.product']);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function updateTransactionStatus(Request $request, Transaction $transaction): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $transaction->update(['status' => $request->status]);


        return redirect()->back()->with('success', 'Order status updated to ' . ucfirst($request->status));
    }
    public function products(): View
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct(): View
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => ['required', Rule::in(['Supplements', 'Equipment', 'Machines', 'Clothing', 'Accessories', 'Program'])],
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_path' => 'nullable|url',
        ]);

        Product::create($validated);
        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }

    public function editProduct(Product $product): View
    {
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => ['required', Rule::in(['Supplements', 'Equipment', 'Machines', 'Clothing', 'Accessories', 'Program'])],
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_path' => 'nullable|url',
        ]);

        $product->update($validated);
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroyProduct(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }


    public function exercises(): View
    {
        $exercises = Exercise::latest()->paginate(10);
        return view('admin.exercises.index', compact('exercises'));
    }

    public function createExercise(): View
    {
        return view('admin.exercises.create');
    }

    public function storeExercise(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'muscle_group' => ['required', Rule::in(['Chest', 'Back', 'Shoulders', 'Biceps', 'Triceps', 'Quadriceps', 'Hamstrings', 'Glutes', 'Calves', 'Abs'])],
            'type' => ['required', Rule::in(['Compound', 'Isolation'])],
            'equipment' => ['required', Rule::in(['Barbell', 'Dumbbell', 'Machine', 'Cable', 'Bodyweight'])],
            'instructions' => 'required|string',
            'video_url' => 'nullable|url',
            'image_path' => 'nullable|url',
        ]);

        Exercise::create($validated);
        return redirect()->route('admin.exercises')->with('success', 'Exercise created successfully!');
    }

    public function editExercise(Exercise $exercise): View
    {
        return view('admin.exercises.edit', compact('exercise'));
    }

    public function updateExercise(Request $request, Exercise $exercise): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'muscle_group' => ['required', Rule::in(['Chest', 'Back', 'Shoulders', 'Biceps', 'Triceps', 'Quadriceps', 'Hamstrings', 'Glutes', 'Calves', 'Abs'])],
            'type' => ['required', Rule::in(['Compound', 'Isolation'])],
            'equipment' => ['required', Rule::in(['Barbell', 'Dumbbell', 'Machine', 'Cable', 'Bodyweight'])],
            'instructions' => 'required|string',
            'video_url' => 'nullable|url',
            'image_path' => 'nullable|url',
        ]);

        $exercise->update($validated);
        return redirect()->route('admin.exercises')->with('success', 'Exercise updated successfully!');
    }

    public function destroyExercise(Exercise $exercise): RedirectResponse
    {
        $exercise->delete();
        return redirect()->route('admin.exercises')->with('success', 'Exercise deleted successfully!');
    }



    public function articles(): View
    {
        $articles = ScienceArticle::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function createArticle(): View
    {
        return view('admin.articles.create');
    }

    public function storeArticle(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
        ]);

        // 2. Manually handle the checkbox
        $validated['is_published'] = $request->has('is_published');

        ScienceArticle::create($validated);
        return redirect()->route('admin.articles')->with('success', 'Article created successfully!');
    }

    public function editArticle(ScienceArticle $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function updateArticle(Request $request, ScienceArticle $article): RedirectResponse
    {
        $validated = $request->validate([
            // Ensure title is unique but ignore the current article's ID
            'title' => 'required|string|max:255|unique:science_articles,title,' . $article->id,
            'category' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $article->update($validated);
        return redirect()->route('admin.articles')->with('success', 'Article updated successfully!');
    }

    public function destroyArticle(ScienceArticle $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('admin.articles')->with('success', 'Article deleted successfully!');
    }



    public function nutrition(): View
    {
        $nutritionItems = Nutrition::latest()->paginate(10);
        return view('admin.nutrition.index', compact('nutritionItems'));
    }

    public function createNutrition(): View
    {
        return view('admin.nutrition.create');
    }

    public function storeNutrition(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => ['required', Rule::in(['Supplement', 'Food_Source', 'Macro_Info'])],
            'description' => 'required|string',
            'dosage' => 'nullable|string|max:255',
            'calories_per_serving' => 'nullable|integer|min:0',
        ]);

        Nutrition::create($validated);
        return redirect()->route('admin.nutrition')->with('success', 'Nutrition item added successfully!');
    }

    public function editNutrition(Nutrition $nutrition): View
    {
        return view('admin.nutrition.edit', compact('nutrition'));
    }

    public function updateNutrition(Request $request, Nutrition $nutrition): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => ['required', Rule::in(['Supplement', 'Food_Source', 'Macro_Info'])],
            'description' => 'required|string',
            'dosage' => 'nullable|string|max:255',
            'calories_per_serving' => 'nullable|integer|min:0',
        ]);

        $nutrition->update($validated);
        return redirect()->route('admin.nutrition')->with('success', 'Nutrition item updated successfully!');
    }

    public function destroyNutrition(Nutrition $nutrition): RedirectResponse
    {
        $nutrition->delete();
        return redirect()->route('admin.nutrition')->with('success', 'Nutrition item deleted successfully!');
    }


    public function programs(): View
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function createProgram(): View
    {
        return view('admin.programs.create');
    }

    public function storeProgram(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => ['required', Rule::in(['Beginner', 'Intermediate', 'Advanced'])],
            'days_per_week' => 'required|integer|min:1|max:7',
            'routine_details' => 'required',
        ]);


        Program::create($validated);
        return redirect()->route('admin.programs')->with('success', 'Program created successfully!');
    }

    public function editProgram(Program $program): View
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function updateProgram(Request $request, Program $program): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => ['required', Rule::in(['Beginner', 'Intermediate', 'Advanced'])],
            'days_per_week' => 'required|integer|min:1|max:7',
            'routine_details' => 'required',
        ]);

        $program->update($validated);
        return redirect()->route('admin.programs')->with('success', 'Program updated successfully!');
    }

    public function destroyProgram(Program $program): RedirectResponse
    {
        $program->delete();
        return redirect()->route('admin.programs')->with('success', 'Program deleted successfully!');
    }
}
