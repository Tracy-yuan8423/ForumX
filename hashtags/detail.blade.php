@extends('commons.fresns')

@section('title', $items['title'] ?? $hashtag['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $hashtag['description'])

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('hashtags.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-3">
                    @component('components.hashtag.detail', compact('hashtag'))@endcomponent
                </div>

                {{-- 列表 --}}
                @switch($type)
                    {{-- 帖子列表 --}}
                    @case('posts')
                        <div class="card clearfix" id="fresns-list-container">
                            @foreach($posts as $post)
                                @component('components.post.list', compact('post'))@endcomponent

                                @if (! $loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>

                        {{-- 列表页码 --}}
                        <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                            {{ $posts->links() }}
                        </div>
                    @break

                    {{-- 评论列表 --}}
                    @case('comments')
                        <div class="card clearfix" id="fresns-list-container">
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
                        </div>

                        {{-- 列表页码 --}}
                        <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                            {{ $comments->links() }}
                        </div>
                    @break

                    @default
                        <div class="text-center my-5 text-muted fs-7">{{ fs_lang('listEmpty') }}</div>
                @endswitch
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
