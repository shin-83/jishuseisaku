@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <div class="row">
        <div class="col-7 d-flex align-items-center">
            <b>商品一覧</b>
            <form action="/items/" method="get">
                <div class="d-flex">
                    <select name="sort" class="form-control">
                        <option value="">並び替え</option>
                        <option value="price-asc">価格: 安い順</option>
                        <option value="price-desc">価格: 高い順</option>
                        <option value="created-asc">登録日: 古い順</option>
                        <option value="created-desc">登録日: 新しい順</option>
                    </select>
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('content')

    <!-- 商品をカードで表示 -->
    <div class="container">
        <div class="row">
            @foreach($items as $item)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <!-- 商品画像 -->
                        <div class="col-md-6">
                            <div class="card-img-container">
                                <img src="{{ $item->image_name }}" class="card-img-top" alt="商品画像">
                            </div>
                        </div>
                        <!-- 商品情報 -->
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="card-body">
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <p class="card-text">種別: {{ $item->type }}</p>
                                    <p class="card-text">詳細: {{ $item->detail }}</p>
                                    <p class="card-text">価格(1人前): {{ $item->price }}円</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="page-link">
            <!-- ページネーションリンク -->
            <div class="row">
                <div class="col-6">
                    {{ $items->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/useritem.css">
@stop

@section('js')
@stop
