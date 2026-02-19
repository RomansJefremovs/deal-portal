<?php
use App\Http\Controllers\DealController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HubspotWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/deals', [DealController::class, 'index'])->name('deals.index');
    Route::get('/deals/{id}', [DealController::class, 'show'])->name('deals.show');
});
Route::prefix('webhook')
    ->name('webhook.')
    ->group(function () {
        Route::post('/hubspot', [HubspotWebhookController::class, 'handle'])
            ->name('hubspot');
    });


require __DIR__.'/auth.php';
