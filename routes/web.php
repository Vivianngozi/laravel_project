<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

use App\Models\User;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CategoryController;

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


Route::get('/about', function() {
    echo "This is it";
})->middleware('age');

Route::get('/contact', [ContactController::class, 'index'])->name('new');

Route::get('/home', function() {

    echo "this is sweet";
});



// category controller
Route::get('/category/all',[CategoryController::class, 'AllCat'])->name('all.category');

Route::post('/category/add',[CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);

Route::post('/category/update/{id}', [CategoryController::class, 'Update']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        // Eloquent ORM Read Users Data
        // $users = User::all();

        // Query Builder Read Users Data
        $users = DB::table('users')->get();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});
