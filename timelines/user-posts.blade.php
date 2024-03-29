@extends('commons.fresns')

@section('title', fs_config('channel_timeline_user_posts_name'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('timelines.sidebar')
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
                <div class="my-3 table-responsive">
                    {{ $posts->links() }}
                </div>
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
