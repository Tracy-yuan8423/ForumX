@extends('commons.fresns')

@section('title', fs_config('channel_comment_seo')['title'] ?: fs_config('channel_comment_name'))
@section('keywords', fs_config('channel_comment_seo')['keywords'])
@section('description', fs_config('channel_comment_seo')['description'])

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('comments.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 评论列表 --}}
                <article class="card clearfix">
                    @foreach($comments as $comment)
                        @component('components.comment.list', [
                            'comment' => $comment,
                            'detailLink' => true,
                            'sectionAuthorLiked' => false,
                        ])@endcomponent

                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- 列表页码 --}}
                @if (fs_config('channel_comment_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $comments->links() }}
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
