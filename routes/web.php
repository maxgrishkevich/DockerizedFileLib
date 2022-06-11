<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\Captcha;
use App\Http\Controllers\Activation;
use App\Http\Controllers\Library;

Route::get('/upload', [FileUpload::class, 'createForm']);
Route::post('/upload', [FileUpload::class, 'fileUpload'])->name('fileUpload');

Route::get('/activation', [Activation::class, 'createForm']);
Route::post('/activation', [Activation::class, 'checkActivation'])->name('checkActivation');

Route::get('/library', [Library::class, 'index']);
Route::get('/library', [Library::class, 'getFiles']);
Route::get('/library/download/{file?}', [Library::class, 'fileDownload'])->name('download');

Route::post('/', [Captcha::class, 'captchaCheck'])->name('captchaCheck');
Route::get('/', [Captcha::class, 'createCaptcha']);
