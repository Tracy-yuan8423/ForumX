@extends('commons.fresns')

@php
    $title = $location['poi'] ? $location['poi'].' - ' : '';
@endphp

@section('title', $title.fs_db_config('menu_location_comments'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('comments.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 位置信息 --}}
                <div class="alert alert-primary" role="alert">
                    <i class="bi bi-geo-alt-fill"></i> {{ $location['poi'] ?? $location['latitude'].' / '.$location['longitude'] }}
                </div>

                {{-- 评论列表 --}}
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
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
