<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LocalizationController;

Route::get('lang/{locale}', [LocalizationController::class, 'switch'])->name('lang.switch');
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Admin -> Go to CRUD Dashboard
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Member -> Go to Home (Landing Page)
    return redirect()->route('home');

})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {



    // Science
    Route::get('/science', [MemberController::class, 'science'])->name('member.science');
    Route::get('/science/{article}', [MemberController::class, 'showArticle'])->name('member.science.show');

    // Guide Dropdown Items
    Route::get('/exercises', [MemberController::class, 'exercises'])->name('member.exercises');
    Route::get('/nutrition', [MemberController::class, 'nutrition'])->name('member.nutrition');
    Route::get('/programs', [MemberController::class, 'programs'])->name('member.programs');
    Route::get('/programs/{program}', [MemberController::class, 'showProgram'])->name('member.programs.show');

    // Tools
    Route::get('/tools', [MemberController::class, 'tools'])->name('member.tools');
    Route::post('/tools/calculate', [MemberController::class, 'storeTools'])->name('member.tools.store');

});
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // 1. Exercise Management
    Route::get('/exercises', [AdminController::class, 'exercises'])->name('exercises');
    Route::get('/exercises/create', [AdminController::class, 'createExercise'])->name('exercises.create');
    Route::post('/exercises', [AdminController::class, 'storeExercise'])->name('exercises.store');
    Route::get('/exercises/{exercise}/edit', [AdminController::class, 'editExercise'])->name('exercises.edit');
    Route::put('/exercises/{exercise}', [AdminController::class, 'updateExercise'])->name('exercises.update');
    Route::delete('/exercises/{exercise}', [AdminController::class, 'destroyExercise'])->name('exercises.destroy');

    // 2. Science Article Management
    Route::get('/articles', [AdminController::class, 'articles'])->name('articles');
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('articles.create');
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminController::class, 'editArticle'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminController::class, 'updateArticle'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminController::class, 'destroyArticle'])->name('articles.destroy');

    // 3. Nutrition Management
    Route::get('/nutrition', [AdminController::class, 'nutrition'])->name('nutrition');
    Route::get('/nutrition/create', [AdminController::class, 'createNutrition'])->name('nutrition.create');
    Route::post('/nutrition', [AdminController::class, 'storeNutrition'])->name('nutrition.store');
    Route::get('/nutrition/{nutrition}/edit', [AdminController::class, 'editNutrition'])->name('nutrition.edit');
    Route::put('/nutrition/{nutrition}', [AdminController::class, 'updateNutrition'])->name('nutrition.update');
    Route::delete('/nutrition/{nutrition}', [AdminController::class, 'destroyNutrition'])->name('nutrition.destroy');

    // 4. Program Management
    Route::get('/programs', [AdminController::class, 'programs'])->name('programs');
    Route::get('/programs/create', [AdminController::class, 'createProgram'])->name('programs.create');
    Route::post('/programs', [AdminController::class, 'storeProgram'])->name('programs.store');
    Route::get('/programs/{program}/edit', [AdminController::class, 'editProgram'])->name('programs.edit');
    Route::put('/programs/{program}', [AdminController::class, 'updateProgram'])->name('programs.update');
    Route::delete('/programs/{program}', [AdminController::class, 'destroyProgram'])->name('programs.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
