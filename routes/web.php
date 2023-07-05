<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageManipulationController;
use App\Http\Controllers\AdminController;
use App\Models\Blog;




Route::get('/', function () {
    $blogs = Blog::paginate(3);;
    return view('site.home.home', compact('blogs'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/resizer', [ImageManipulationController:: class, 'resizer']);
Route::get('/compressor', [ImageManipulationController:: class, 'compressor']);
Route::get('/coverter', [ImageManipulationController:: class, 'coverter']);
// Route::post('/resize', [ImageManipulationController:: class, 'resizeImage']); 
Route::get('/userblog', [ImageManipulationController:: class, 'userblog']); 
Route::get('/blog_details/{id}', [ImageManipulationController:: class, 'blog_details']); 
Route::get('/base64', [ImageManipulationController:: class, 'base64']); 
Route::get('/editor', [ImageManipulationController:: class, 'editor']); 
Route::get('/crop', [ImageManipulationController:: class, 'crop']); 
Route::get('/rotet', [ImageManipulationController:: class, 'rotet']); 
Route::get('/filp', [ImageManipulationController:: class, 'filp']); 
Route::get('/gamma', [ImageManipulationController:: class, 'gamma']);
Route::get('/invert', [ImageManipulationController:: class, 'invert']); 
Route::get('/vibrance', [ImageManipulationController:: class, 'vibrance']); 




// Admin
Route::get('/redirect', [AdminController::class, 'redirect']);

Route::get('/blog', [AdminController::class, 'blog']);
Route::get('/addblogpage', [AdminController::class, 'addblogpage']);
Route::post('/addblog', [AdminController::class, 'addblog']);
Route::get('/delete_blog/{id}', [AdminController::class, 'delete_blog']);
Route::get('/update/{id}', [AdminController::class, 'update']);
Route::post('/update_blog/{id}', [AdminController::class, 'update_blog']);
Route::get('/settings', [AdminController::class, 'settings']);
Route::post('/addsettings', [AdminController::class, 'addsettings']);

Route::get('/updateset/{id}', [AdminController::class, 'updateset']);
Route::post('/updatesettings/{id}', [AdminController::class, 'updatesettings']);
