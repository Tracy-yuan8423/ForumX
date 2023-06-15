@extends('commons.fresns')

@section('title', fs_db_config('menu_search'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('search.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 列表 --}}
                <article class="card clearfix">
                </article>
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
