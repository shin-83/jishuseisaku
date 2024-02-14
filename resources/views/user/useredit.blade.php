@extends('adminlte::page')

@section('title', 'ユーザー情報更新')

@section('content_header')
    <b>ユーザー情報更新</b>
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
            <form action="/userupdate" method="post">
                @csrf
                <div class="card-body">
                    <input type="hidden" id="id" name="id" value="{{ $users->id }}">
                    <div class="form-group">
                        <label for="name">名前<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                        <input type="text" class="form-control text-center" id="name" name="name" value="{{ $users->name }}" placeholder="名前:{{ $users->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                        <input type="text" class="form-control text-center" id="email" name="email" value="{{ $users->email }}" placeholder="メールアドレス:{{ $users->email }}">
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
    <link rel="stylesheet" href="/css/useredit.css">
@stop

@section('js')
@stop
