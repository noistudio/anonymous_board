<?php


Route::get("/setting/index",[\App\Http\Controllers\admin\Setting::class,"index"])->name("admin.setting.index");
Route::get("/setting/edit/{prefix}",[\App\Http\Controllers\admin\Setting::class,"edit"])->name("admin.setting.edit");
Route::post("/setting/doupdate/{prefix}",[\App\Http\Controllers\admin\Setting::class,"doUpdate"])->name("admin.setting.doupdate");
Route::get("/languages/index",[\App\Http\Controllers\admin\Languages::class,"form"])->name("admin.languages.form");
Route::post("/languages/save",[\App\Http\Controllers\admin\Languages::class,"save"])->name("admin.languages.save");

Route::prefix("threads")->group(function(){
Route::get("/index",[\App\Http\Controllers\admin\ThreadsController::class,"index"])->name('admin.threads.list');
Route::get("/view/{alias}/{thread_id}",[\App\Http\Controllers\admin\ThreadsController::class,"view"])->name('admin.threads.view');
Route::get("/delete_message/{message_id}",[\App\Http\Controllers\admin\ThreadsController::class,"delete_message"])->name('admin.threads.delete_message');
Route::get("/delete_thread/{thread_id}",[\App\Http\Controllers\admin\ThreadsController::class,"delete_thread"])->name('admin.threads.delete_thread');
Route::get("/toogle_pinned/{thread_id}",[\App\Http\Controllers\admin\ThreadsController::class,"toogle_pinned"])->name('admin.threads.toogle_pinned');
Route::get("/toogle_close/{thread_id}",[\App\Http\Controllers\admin\ThreadsController::class,"toogle_close"])->name('admin.threads.toogle_close');
Route::post("/addban",[\App\Http\Controllers\admin\ThreadsController::class,"addban"])->name('admin.threads.addban');
});

Route::prefix("bans")->group(function(){
   Route::get("/index",[\App\Http\Controllers\admin\BansController::class,"index"])->name('admin.bans.list');
   Route::get("/remove/{id}",[\App\Http\Controllers\admin\BansController::class,"remove"])->name('admin.bans.remove');
});

        Route::prefix("boards")->group(function () {

Route::get("/index",[\App\Http\Controllers\admin\BoardsController::class,"index"])->name("admin.boards.index");
Route::get("/create",[\App\Http\Controllers\admin\BoardsController::class,"create"])->name("admin.boards.create");
Route::get("/delete_all",[\App\Http\Controllers\admin\BoardsController::class,"delete_all"])->name("admin.boards.delete_all");
Route::get("/show/{id}",[\App\Http\Controllers\admin\BoardsController::class,"show"])->name("admin.boards.show");
Route::post("/store",[\App\Http\Controllers\admin\BoardsController::class,"store"])->name("admin.boards.store");
Route::get("/edit/{id}",[\App\Http\Controllers\admin\BoardsController::class,"edit"])->name("admin.boards.edit");
Route::any("/update/{id}",[\App\Http\Controllers\admin\BoardsController::class,"update"])->name("admin.boards.update");
Route::any("/destroy/{id}",[\App\Http\Controllers\admin\BoardsController::class,"destroy"])->name("admin.boards.destroy");


Route::get("/change_pos/{id}",[\App\Http\Controllers\admin\BoardsController::class,"change_position"])->name("admin.boards.change");
Route::get("/clone/{id}",[\App\Http\Controllers\admin\BoardsController::class,"clone_object"])->name("admin.boards.clone");
Route::get("/toogle/{id}",[\App\Http\Controllers\admin\BoardsController::class,"toogle"])->name("admin.boards.toogle");

});





        //insert_dynamic_routes_heere//
