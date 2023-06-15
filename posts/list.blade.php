@extends('commons.fresns')

@section('title', fs_db_config('menu_post_list_title'))
@section('keywords', fs_db_config('menu_post_list_keywords'))
@section('description', fs_db_config('menu_post_list_description'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('posts.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 帖子列表 --}}
                <article class="card clearfix">
                    @foreach($posts as $post)
                        @component('components.post.list', compact('post'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- 列表页码 --}}
                @if (fs_db_config('menu_post_list_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
