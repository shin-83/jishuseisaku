<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        // $items = Item::all();

        $query = Item::query();
        $items = $query->get();

        // 結果が空の場合は空の配列を渡す
        if ($items->isEmpty()) {
            $items = [];
        }
       // ページネーションを適用
           $perPage = 8; // 1ページに表示するアイテム数を設定
            $items = $query->paginate($perPage);

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'image_name' => $request->image_name,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
                'price' => $request->price,
                
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    // 商品削除
    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();

        return redirect('/items');
    }

    public function searchlist(Request $request)                       // 今後削除するかも？？？
    {
        $query = Item::query();
        $items = $query->get();

        // 結果が空の場合は空の配列を渡す
        if ($items->isEmpty()) {
            $items = [];
        }
       // ページネーションを適用
           $perPage = 10; // 1ページに表示するアイテム数を設定
            $items = $query->paginate($perPage);

       // すべてのリクエストに対して同じビューを返す
        return view('search.Search_list', compact('searchList'));

    }
}
