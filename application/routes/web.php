<?php

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

Route::get('/', [\App\Http\Controllers\web\HomeController::class,"index"])->name("site.index");
Route::get("/ajax/generateImg",[\App\Http\Controllers\web\AjaxController::class,"generateImg"])->name("ajax.captcha");
Route::get("/ajax/{alias}/{thread_id}/{message_id}",[\App\Http\Controllers\web\AjaxController::class,"newMessages"])->name("ajax.newMessages");
Route::get("/ajax/{alias}/{thread_id}/{message_id}/count",[\App\Http\Controllers\web\AjaxController::class,"newMessagesCount"])->name("ajax.newMessagesCount");
Route::middleware(\App\Http\Middleware\CheckBan::class)->group(function(){
    Route::get("/{alias}/open",[\App\Http\Controllers\web\BoardController::class,"open"])->name("site.board.open");
    Route::get("/editorjs/{alias}/parse_url",[\App\Http\Controllers\editorjs\LinkToolController::class, "index"])->name('site.editorjs.parse_url');
    Route::post("/editorjs/upload/{alias}/imagevideo",[\App\Http\Controllers\editorjs\UploadController::class, "imageVideo"])->name('site.editorjs.upload.image_video');
    Route::post('/ajax/{alias}/doopen',[\App\Http\Controllers\web\AjaxController::class,"open_thread"])->name('ajax.open_thread');
    Route::post('/{alias}/{thread_id}/reply',[\App\Http\Controllers\web\BoardController::class,"reply"])->name('site.board.reply');
});



Route::get("/{alias}",[\App\Http\Controllers\web\BoardController::class,"index"])->name("site.board");



Route::get("/{alias}/{thread_id}",[\App\Http\Controllers\web\BoardController::class,"openThread"])->name('site.board.thread');
Route::get("/message/{alias}/{id}",[\App\Http\Controllers\web\BoardController::class,"message"])->name("site.board.message");
Route::get("/ajax/message/{alias}/{id}",[\App\Http\Controllers\web\AjaxController::class,"message"]);
Route::get("/ajax/answers/{alias}/{id}",[\App\Http\Controllers\web\AjaxController::class,"answers"])->name('ajax.answers');

//Route::group(['prefix' =>LaravelLocalization::setLocale()], function()
//{
//    Route::get('/', function () {
//    return view('welcome');
//})->name("site.index");});
