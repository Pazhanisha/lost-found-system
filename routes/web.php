<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostItemController;
use App\Models\LostItem;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard', [
        'totalItems' => LostItem::count(),
        'lostItems' => LostItem::where('status', 'Lost')->count(),
        'foundItems' => LostItem::where('status', 'Found')->count(),
        'returnedItems' => LostItem::where('status', 'Returned')->count(),
    ]);

})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| USER ROUTES (VIEW ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/items', [LostItemController::class, 'index'])->name('items.index');

    Route::get('/my-reports', [LostItemController::class, 'myReports'])
        ->name('items.myreports');

    Route::get('/items-preview', function () {

        return redirect()->route('items.index');

    });
    Route::get('/report-item', [LostItemController::class, 'create'])
    ->name('items.report');
    Route::post('/report-item', [LostItemController::class, 'store'])
    ->name('items.report.store');

});





/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (FULL CONTROL)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {

    return view('admin.dashboard', [
        'totalItems' => LostItem::count(),
        'lostItems' => LostItem::where('status', 'Lost')->count(),
        'foundItems' => LostItem::where('status', 'Found')->count(),
        'returnedItems' => LostItem::where('status', 'Returned')->count(),
    ]);

});

    // CRUD
    Route::get('/items/create', [LostItemController::class, 'create'])->name('items.create');
    Route::post('/items', [LostItemController::class, 'store'])->name('items.store');

    Route::get('/items/edit/{id}', [LostItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/update/{id}', [LostItemController::class, 'update'])->name('items.update');

    Route::delete('/items/delete/{id}', [LostItemController::class, 'destroy'])->name('items.delete');

    // EXPORT FEATURES
    Route::get('/items/export', [LostItemController::class, 'export'])->name('items.export');
    Route::post('/items/import', [LostItemController::class, 'import'])->name('items.import');
    Route::get('/items/pdf', [LostItemController::class, 'pdf'])->name('items.pdf');
    Route::get('/items/screenshot', [LostItemController::class, 'screenshot'])->name('items.screenshot');

});

/*
|--------------------------------------------------------------------------
| TEST
|--------------------------------------------------------------------------
*/

Route::get('/test-simple', function () {
    return "OK WORKING";
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

});

require __DIR__.'/auth.php';