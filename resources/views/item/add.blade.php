@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <b>商品登録</b>
@stop

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-6">
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
                <form action="/items/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image_name">画像</label>
                            <input type="file" class="form-control text-center" id="image_name" name="image_name">
                        </div>
                        <div class="form-group">
                            <label for="name">名前<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                            <input type="text" class="form-control text-center" id="name" name="name" value="{{ old('name') }}" placeholder="名前">
                        </div>

                        <div class="form-group">
                            <label for="type">種別<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                            <select class="form-control text-center" id="type" name="type">
                                <option value='' disabled selected style='display:none;'>種別を選択</option>
                                <option value="肉" @if( old('type') === '肉' ) selected @endif>肉</option>
                                <option value="魚" @if( old('type') === '魚' ) selected @endif>魚</option>
                                <option value="野菜" @if( old('type') === '野菜' ) selected @endif>野菜</option>
                                <option value="その他" @if( old('type') === 'その他' ) selected @endif>その他</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                            <input type="text" class="form-control text-center" id="detail" name="detail" value="{{ old('detail') }}" placeholder="詳細">
                        </div>

                        <div class="form-group">
                            <label for="price">価格(1人前)<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                            <input type="number" class="form-control text-center" id="price" name="price" value="{{ old('price') }}" placeholder="価格(1人前)">
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
    <link rel="stylesheet" href="/css/itemadd.css">
@stop

@section('js')
@stop
