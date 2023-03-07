<?php


use App\Http\Controllers\BringController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailCRUDController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\SearchController;



//หน้าแรก Admin
Route::resource('companies', CRUDController::class);
Route::delete('companies/{id}', 'CRUDController@destroy')->name('companies.destroy');
Route::get('companeisMember', [CRUDController::class, 'member'])->name('companies.member');


Route::delete('destroyImg/{id}', [CRUDController::class, 'destroyImg'])->name('destroyImg');



Route::get('pdfCompany', [CRUDController::class, 'pdf']);



//การค้นหาหน้า Admin
Route::get('/search', [SearchController::class, 'search'])->name('web.search');
Route::get('/find', [SearchController::class, 'find'])->name('web.find'); //หน้า Admin หลัก
Route::get('pdfSearch', [SearchController::class, 'pdf']);

//การค้นหาหน้า Member
Route::get('/finduser', [SearchController::class, 'finduser'])->name('web.finduser');
Route::get('/searchMember', [SearchController::class, 'searchMember'])->name('web.searchMember');




Route::resource('detail_companies', DetailCRUDController::class);
Route::resource('money', MoneyController::class);
Route::resource('member', MemberController::class);
Route::resource('user', ManageUserController::class);
Route::resource('bring', BringController::class);
Route::get('/bringMember', [BringController::class, 'member'])->name('bring.member');


Route::get('member', [BringController::class, 'member'])->name('member');

Route::post('createdetail/fetch', [MoneyController::class, 'fetch'])->name('dynamicdependent.fetch');
Route::get('/createdetail', [MoneyController::class, 'index']);




Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');