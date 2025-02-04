@extends('commons.fresns')

@section('title', fs_config('channel_user_seo')['title'] ?: fs_config('channel_user_name'))
@section('keywords', fs_config('channel_user_seo')['keywords'])
@section('description', fs_config('channel_user_seo')['description'])

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('users.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 用户列表 --}}
                <article class="card clearfix">
                    @foreach($users as $user)
                        @component('components.users.list', compact('user'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- 列表页码 --}}
                @if (fs_config('channel_user_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $users->links() }}
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
