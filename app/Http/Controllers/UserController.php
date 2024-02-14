<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ユーザー一覧の表示
    public function user() {
        
        // // ユーザーのデータを全て引き出す
        // $users = User::all();

        // ページネーションを適用
        $perPage = 10; // 1ページに表示するアイテム数を設定
        $users = User::paginate($perPage);

        // ユーザー一覧画面へ
        return view('user.user', compact('users'));
    }

    // ユーザー編集画面の表示
    public function useredit(Request $request) {

        $users = User::where('id', '=', $request->id)->first();
        
        return view('user.useredit')->with([
            'users' => $users,
        ]);
    }

    // ユーザー更新
    public function userupdate(Request $request, User $user) {

        $user_id = $request['id'];

        $userupdate = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required','max:255','email',Rule::unique('users')->ignore($user_id),]
        ],
        [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は255字以内です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.max' => 'メールアドレスは255字以内です。',
            'email.email' => 'メールアドレスではありません。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
        ]);

        // 商品情報を更新
        $user->where('id', $user_id)->update($userupdate);

        return redirect('/user');
    }

    // ユーザー削除機能
    public function userdelete(Request $request) {

        $user = User::find($request->id);
        $user->delete();

        return redirect('/user');

    }
}
