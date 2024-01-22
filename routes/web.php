<?php

use App\Http\Controllers\FileController;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {

    return Inertia::render('Site/Home');
});

Route::get('/about', function () {
    return Inertia::render('Site/About');
});

Route::get('/posts', function () {
    $posts = Post::all();
    return Inertia::render('Site/Posts',compact('posts'));
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update', [PostController::class, 'update'])->name('post.update');
    Route::get('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');

    Route::get('/files', [FileController::class, 'index'])->name('files');
    Route::get('/file/create', [FileController::class, 'create'])->name('file.create');
    Route::post('/file/store', [FileController::class, 'store'])->name('file.store');
    Route::get('/file/edit/{id}', [FileController::class, 'edit'])->name('file.edit');
    Route::post('/file/update', [FileController::class, 'update'])->name('file.update');
    Route::get('/file/delete/{id}', [FileController::class, 'delete'])->name('file.delete');


});

require __DIR__.'/auth.php';
