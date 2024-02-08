<?php

use Illuminate\Support\Facades\Route;

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


// /login: ログイン画面を表示する
// /logout: ログアウトを行う
// /register: ユーザー登録画面を表示する
// /password/reset: パスワードリセット画面を表示する
Auth::routes();

// ホーム画面を表示
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    // 商品一覧
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    // 商品登録画面を表示
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    // 商品登録
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    // 商品削除
    Route::post('/delete', [App\Http\Controllers\ItemController::class, 'delete']);
    Route::get('/searchlist', [App\Http\Controllers\ItemController::class, 'searchlist']);

});
