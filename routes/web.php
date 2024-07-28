<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CameraController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('camera', function () {
    return view('camera');
});

Route::post('camera-upload', [CameraController::class, 'uploadImage'])->name('upload.camera.image');

