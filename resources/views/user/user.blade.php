@extends('adminlte::page')

@section('title', 'ユーザー管理')

@section('content_header')
    <b>ユーザー管理</b>
@stop

@section('content')
    <!-- ユーザー情報を一覧で表示 -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">名前</th>
                <th scope="col">メールアドレス</th>
                <th scope="col">ユーザー作成日時</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <!-- 編集ボタン -->
                <td>
                <a href="/useredit/{{ $user->id }}" class="btn btn-warning">編集</a>
                </td>
                <!-- 削除ボタン -->
                <td>
                    <form action="/userdelete" method="post" onsubmit="return confirm('本当に削除しても、よろしいですか？');">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="submit" value="削除" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-link">
        <!-- ページネーションリンク -->
        <div class="row">
            <div class="col-6">
                {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/user.css">
@stop

@section('js')
@stop
