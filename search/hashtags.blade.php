@extends('commons.fresns')

@section('title', fs_db_config('menu_search').': '.fs_db_config('hashtag_name'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('search.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 话题列表 --}}
                <article class="card clearfix">
                    @foreach($hashtags as $hashtag)
                        @component('components.hashtag.list', compact('hashtag'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- 列表页码 --}}
                <div class="my-3 table-responsive">
                    {{ $hashtags->links() }}
                </div>
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
