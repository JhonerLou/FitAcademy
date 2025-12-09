<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Controllers\Auth\OtpController;


Route::get('lang/{locale}', [LocalizationController::class, 'switch'])->name('lang.switch');

Route::get('/', function () {
    $products = Product::where('stock', '>', 0)->inRandomOrder()->take(4)->get();
    return view('welcome', compact('products'));
})->name('home');
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('verify-otp', [OtpController::class, 'create'])->name('otp.verify');
    Route::post('verify-otp', [OtpController::class, 'store'])->name('otp.store');
    Route::get('resend-otp', [OtpController::class, 'resend'])->name('otp.resend');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/science', [MemberController::class, 'science'])->name('member.science');
    Route::get('/science/{article}', [MemberController::class, 'showArticle'])->name('member.science.show');

    Route::get('/exercises', [MemberController::class, 'exercises'])->name('member.exercises');
    Route::get('/nutrition', [MemberController::class, 'nutrition'])->name('member.nutrition');
    Route::get('/programs', [MemberController::class, 'programs'])->name('member.programs');
    Route::get('/programs/{program}', [MemberController::class, 'showProgram'])->name('member.programs.show');

    Route::get('/tools', [MemberController::class, 'tools'])->name('member.tools');
    Route::post('/tools/calculate', [MemberController::class, 'storeTools'])->name('member.tools.store');

    Route::get('/shop', [MemberController::class, 'shop'])->name('member.shop');
    Route::post('/shop/buy/{product}', [MemberController::class, 'purchase'])->name('member.shop.purchase');

    Route::get('/payment/{transaction}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{transaction}', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/success/{transaction}', [PaymentController::class, 'success'])->name('payment.success');

});
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/exercises', [AdminController::class, 'exercises'])->name('exercises');
    Route::get('/exercises/create', [AdminController::class, 'createExercise'])->name('exercises.create');
    Route::post('/exercises', [AdminController::class, 'storeExercise'])->name('exercises.store');
    Route::get('/exercises/{exercise}/edit', [AdminController::class, 'editExercise'])->name('exercises.edit');
    Route::put('/exercises/{exercise}', [AdminController::class, 'updateExercise'])->name('exercises.update');
    Route::delete('/exercises/{exercise}', [AdminController::class, 'destroyExercise'])->name('exercises.destroy');

    Route::get('/articles', [AdminController::class, 'articles'])->name('articles');
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('articles.create');
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminController::class, 'editArticle'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminController::class, 'updateArticle'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminController::class, 'destroyArticle'])->name('articles.destroy');

    Route::get('/nutrition', [AdminController::class, 'nutrition'])->name('nutrition');
    Route::get('/nutrition/create', [AdminController::class, 'createNutrition'])->name('nutrition.create');
    Route::post('/nutrition', [AdminController::class, 'storeNutrition'])->name('nutrition.store');
    Route::get('/nutrition/{nutrition}/edit', [AdminController::class, 'editNutrition'])->name('nutrition.edit');
    Route::put('/nutrition/{nutrition}', [AdminController::class, 'updateNutrition'])->name('nutrition.update');
    Route::delete('/nutrition/{nutrition}', [AdminController::class, 'destroyNutrition'])->name('nutrition.destroy');

    Route::get('/programs', [AdminController::class, 'programs'])->name('programs');
    Route::get('/programs/create', [AdminController::class, 'createProgram'])->name('programs.create');
    Route::post('/programs', [AdminController::class, 'storeProgram'])->name('programs.store');
    Route::get('/programs/{program}/edit', [AdminController::class, 'editProgram'])->name('programs.edit');
    Route::put('/programs/{program}', [AdminController::class, 'updateProgram'])->name('programs.update');
    Route::delete('/programs/{program}', [AdminController::class, 'destroyProgram'])->name('programs.destroy');

    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/{transaction}', [AdminController::class, 'showTransaction'])->name('transactions.show');
    Route::patch('/transactions/{transaction}', [AdminController::class, 'updateTransactionStatus'])->name('transactions.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
