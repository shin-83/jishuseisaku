@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <b>商品編集</b>
@stop

@section('content')
    <div class="d-flex justify-content-center align-items-center"> <!-- 元々はclass="row" -->
        <div class="col-md-6"> <!-- 元々はclass="col-md-10" -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form action="/items/update" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="item_id" id="item_id" value="{{ $items->id }}">
                        <div class="form-group">
                            <label for="image_name">画像</label>
                            <input type="file" class="form-control text-center" id="image_name" name="image_name" value="{{ $items->image_name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control text-center" id="name" name="name" value="{{ $items->name }}" placeholder="{{ $items->name }}">
                        </div>

                        <div class="form-group" role="group">
                            <label for="type">種別</label>
                            <button type="button" class="form-control text-center" id="type" name="type" placeholder="種別" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $items->type }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-value="肉">肉</a></li>
                                <li><a class="dropdown-item" href="#" data-value="魚">魚</a></li>
                                <li><a class="dropdown-item" href="#" data-value="野菜">野菜</a></li>
                                <li><a class="dropdown-item" href="#" data-value="その他">その他</a></li>
                            </ul>
                        </div>

                        <input type="hidden" name="type" id="type_name" value="{{ $items->type }}">

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control text-center" id="detail" name="detail" value="{{ $items->detail }}" placeholder="{{ $items->detail }}">
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="number" class="form-control text-center" id="price" name="price" value="{{ $items->price }}" placeholder="{{ $items->price }}">
                        </div>

                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/itemedit.css">
@stop

@section('js')
    <script>
        'use strict';
        document.addEventListener('DOMContentLoaded', function() {
            // ドロップダウンメニューのアイテムがクリックされた時のイベントリスナーを追加
            var dropdownItems = document.querySelectorAll('.dropdown-menu .dropdown-item');
            dropdownItems.forEach(function(item) {
                item.addEventListener('click', function(event) {
                    // クリックされたアイテムのdata-value属性の値を取得
                    var selectedValue = event.target.getAttribute('data-value');
                    // 選択された値を表示する要素をセット
                    document.getElementById('type').innerText = selectedValue;
                    document.getElementById('type_name').value = selectedValue;

                    // ここで選択された値に基づく他のアクションを実行できる
                });
            });
        });
    </script>
@stop
