@extends('adminlte::page')

@section('title', 'ホーム画面')

@section('content_header')
    <b>ようこそ、お惣菜屋へ！</b>
@stop

@section('content')
        <img src="{{ asset('img/home.jpeg') }}" alt="ロゴ">
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .content-header {
            font-size:40px;
            padding: 150px 0 50px;
            text-align:center;
        }


        .content {
            text-align:center;
        }

        img {
            border-radius:50%;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
