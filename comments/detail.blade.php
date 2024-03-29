@extends('commons.fresns')

@section('title', $items['title'] ?? Str::limit(strip_tags($comment['content']), 40))
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? Str::limit(strip_tags($comment['content']), 140))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('comments.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-3">
                    @component('components.comment.detail', compact('comment'))@endcomponent
                </div>

                <article class="card clearfix">
                    <div class="card-header">
                        <h5 class="mb-0">{{ fs_config('comment_name') }}</h5>
                    </div>

                    @foreach($comments as $comment)
                        @component('components.comment.list', [
                            'comment' => $comment,
                            'detailLink' => false,
                            'sectionAuthorLiked' => true,
                        ])@endcomponent

                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                <div class="my-3 table-responsive">
                    {{ $comments->links() }}
                </div>
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
