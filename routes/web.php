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

// ItemController関係
Route::prefix('items')->group(function () {
    // 商品一覧
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    // 商品登録画面を表示
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    // 商品登録
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    // 商品削除
    Route::post('/delete', [App\Http\Controllers\ItemController::class, 'delete']);
    // 商品編集画面を表示
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
    // 商品更新
    Route::post('/update', [App\Http\Controllers\ItemController::class, 'update']);
    // （user）商品一覧
    Route::get('/userindex', [App\Http\Controllers\ItemController::class, 'userindex']);
});

// ユーザー一覧画面
Route::get('user', [App\Http\Controllers\UserController::class, 'user']);
// ユーザー情報編集画面を表示
Route::get('useredit/{id}', [App\Http\Controllers\UserController::class, 'useredit']);
// ユーザー情報更新
Route::post('userupdate', [App\Http\Controllers\UserController::class, 'userupdate']);
// ユーザー情報削除
Route::post('userdelete', [App\Http\Controllers\UserController::class, 'userdelete']);
