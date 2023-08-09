<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [StudentController::class, 'index'])->name('student.home');
Route::post('/students', [StudentController::class, 'store'])->name('student.store');
Route::get('/fetch_students', [StudentController::class, 'fetch_students'])->name('student.fetch');
Route::get('edit_student/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::put('update_student/{id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('delete_stud/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
