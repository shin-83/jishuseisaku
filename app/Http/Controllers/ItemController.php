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
            // $requestのvalidate（データの確認）を行い、$itemlistsへ
            $itemlists = $request->validate([
                'name' => 'required|max:20',
                'type' => 'required',
                'detail' => 'required|max:30',
                'price' => 'required|integer',
            ]);
            
            // hasFileメソッドでアップロードファイルの存在を確認
            if($request->hasFile('image_name')) {

                $image_name = $request->file('image_name');

                // ファイル名を取得（ファイル名.拡張子）
                $fileName = $image_name->getClientOriginalName();

                // ファイル名から拡張子のみを取り出す
                $type_name = pathinfo($fileName, PATHINFO_EXTENSION);

                // ファイル名をbase64形式でデータのimage_nameに入れる
                $itemlists['image_name'] = 'data:image/' . $type_name . ';base64,' . base64_encode(file_get_contents($image_name->path()));
                
                // アップロードファイルの存在なし
                // no_image用の画像データ->config(定数);->$itemlists['image_name'];へ
            } else {
                $itemlists['image_name'] = config('noimage.no_image');
            }

            // 商品登録
            Item::create($itemlists);

            return redirect('/items/');
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
