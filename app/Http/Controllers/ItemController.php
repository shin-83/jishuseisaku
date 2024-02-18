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
    public function index(Request $request)
    {
        // 並び替えの基準となるパラネータを取得
        $sortParam = $request->input('sort');

        if (!empty($sortParam)) {
            list($sortField, $sortOrder) = explode('-', $sortParam);
            $order = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc';

            // ここで正しいカラム名に修正
            if  ($sortField == 'created') {
                $sortField = 'created_at';
            }
        } else {
            $sortField = null;
            $order = 'asc';
        }

        // 商品一覧取得
        $query = Item::query();

        // 並び替えの条件に応じてクエリを変更
        if ($sortField) {
            $query->orderBy($sortField, $order);
        }

        $items = $query->get();

        // 結果が空の場合は空の配列を渡す
        if ($items->isEmpty()) {
            $items = [];
        }
       // ページネーションを適用
           $perPage = 4; // 1ページに表示するアイテム数を設定
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
            ],
            [
                'name.required' => '名前は必須です。',
                'name.max' => '名前は20字以下です。',
                'type.required' => '種別は必須です。',
                'detail.required' => '詳細は必須です。',
                'detail.max' => '詳細は30字以下です。',
                'price.required' => '価格は必須です。',
                'price.integer' => '価格は数字にしてください。',
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

    // 商品編集画面を表示
    public function edit(Request $request)
    {
        // 一覧から指定されたIDと同じIDのレコードを取得
        $items = Item::where('id', '=', $request->id)->first();
        
        return view('item.edit')->with([
            'items' => $items,
        ]);
    }

    // 商品更新
    public function update(Request $request, Item $itemlists)
    {
        $item_id = $request['item_id'];

        // $requestのvalidate（データの確認）を行い、$itemlistsへ
        $itemupdate = $request->validate([
            'name' => 'required|max:20',
            'type' => 'required',
            'detail' => 'required|max:30',
            'price' => 'required|integer',
        ],
        [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は20字以下です。',
            'type.required' => '種別は必須です。',
            'detail.required' => '詳細は必須です。',
            'detail.max' => '詳細は30字以下です。',
            'price.required' => '価格は必須です。',
            'price.integer' => '価格は数字にしてください。',
        ]);

        // hasFileメソッドでアップロードファイルの存在を確認
        if ($request->hasFile('image_name')) {
        
            $image_name = $request->file('image_name');

            // ファイル名を取得（ファイル名.拡張子）
            $fileName = $image_name->getClientOriginalName();

            // ファイル名から拡張子のみを取り出す
            $type_name = pathinfo($fileName, PATHINFO_EXTENSION);

            // ファイル名をbase64形式でデータのimage_nameに入れる
            $itemupdate['image_name'] = 'data:image/' . $type_name . ';base64,' . base64_encode(file_get_contents($image_name->path()));

            // アップロードファイルの存在なし
        } else {
            $itemlists['image_name'] = config('noimage.no_image');
        }

        // 商品情報を更新
        $itemlists->where('id', $item_id)->update($itemupdate);

        // 商品一覧画面へ
        return redirect('/items/');
    }

        /**
     * (user)商品一覧
     */
    public function userindex(Request $request)
    {
        // 並び替えの基準となるパラネータを取得
        $sortParam = $request->input('sort');

        if (!empty($sortParam)) {
            list($sortField, $sortOrder) = explode('-', $sortParam);
            $order = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc';

            // ここで正しいカラム名に修正
            if  ($sortField == 'created') {
                $sortField = 'created_at';
            }
        } else {
            $sortField = null;
            $order = 'asc';
        }

        // 商品一覧取得
        $query = Item::query();

        // 並び替えの条件に応じてクエリを変更
        if ($sortField) {
            $query->orderBy($sortField, $order);
        }

        $items = $query->get();

        // 結果が空の場合は空の配列を渡す
        if ($items->isEmpty()) {
            $items = [];
        }
       // ページネーションを適用
           $perPage = 4; // 1ページに表示するアイテム数を設定
            $items = $query->paginate($perPage);

        return view('item.userindex', compact('items'));
    }

}
