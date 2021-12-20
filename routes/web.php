<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});




Route::get('/time', function (){
    return view('index');
});

Route::get('/{timezone?}', function ($timezone = null) {
    if (!empty($timezone)) {

        // Khởi tạo giá trị giờ theo múi giờ UTC
        $time = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('UTC'));

        // Thay đổi về múi giờ được chọn
        $time->setTimezone(new DateTimeZone(str_replace('-', '/', $timezone)));

        // Hiển thị giờ theo định dạng mong muốn
        echo 'Múi giờ bạn chọn ' . $timezone . ' hiện tại đang là: ' . $time->format('d-m-Y H:i:s');
    }
    return view('index');
});



Route::prefix('customer')->group(function () {
    Route::get('/index2', [CustomerController::class,"index2"]);

    Route::get('/create',function (){

    });
    Route::post('/store', function () {

    });
    Route::get('/{id}/show', function () {

    });
    Route::get('/{id}/edit', function () {

    });
    Route::patch('/{id}/update', function () {

    });
    Route::delete('/{id}/delete', function () {

    });
});


Route::prefix('/tasks')->group(function () {
    Route::get('/index',[TaskController::class,"index"])->name("tasks.index");
    Route::get('/create',[TaskController::class,"create"])->name("tasks.create");
    Route::post('/create',[TaskController::class,"store"])->name("tasks.store");
    Route::get('/{id}/detail',[TaskController::class,"show"])->name("tasks.detail");
    Route::get('/{id}/edit',[TaskController::class,"edit"])->name("tasks.edit");
    Route::post('/{id}/update',[TaskController::class,"update"])->name("tasks.update");
    Route::get('/{id}/delete',[TaskController::class,"destroy"])->name("tasks.destroy");
});

Route::group(['prefix' => 'customers'], function () {
    Route::get('/index',[CustomerController::class, 'index'])->name('customers.index');
});
