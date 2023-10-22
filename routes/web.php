<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use App\Models\Survey;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
 return view('welcome');
});

Route::get('/dashboard', function () {

    $surveys = Survey::where('user_id', Auth::id())->get()->all();
    return Inertia::render('Dashboard', [ 'surveys' => $surveys]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/surveys/create/{survey}', [SurveyController::class, 'create'])->middleware(['auth', 'verified'])->name('surveys.create');

Route::get('/survey/{survey}', [SurveyController::class, 'show'])->name('surveys.show');

Route::get('/survey/analytics/{survey}', [SurveyController::class, 'visualize'])->middleware(['auth', 'verified'])->name('surveys.visualize');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
