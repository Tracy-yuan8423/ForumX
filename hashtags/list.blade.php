@extends('commons.fresns')

@section('title', fs_config('channel_hashtag_list_seo')['title'] ?: fs_config('channel_hashtag_list_name'))
@section('keywords', fs_config('channel_hashtag_list_seo')['keywords'])
@section('description', fs_config('channel_hashtag_list_seo')['description'])

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('hashtags.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 话题列表 --}}
                <article class="card clearfix py-4">
                    @foreach($hashtags as $hashtag)
                        @component('components.hashtag.list', compact('hashtag'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- 列表页码 --}}
                @if (fs_config('channel_hashtag_list_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $hashtags->links() }}
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
