@extends('commons.fresns')

@section('title', fs_config('channel_group_list_seo')['title'] ?: fs_config('channel_group_list_name'))
@section('keywords', fs_config('channel_group_list_seo')['keywords'])
@section('description', fs_config('channel_group_list_seo')['description'])

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('groups.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 小组列表 --}}
                <article class="card clearfix py-4">
                    @foreach($groups as $group)
                        @component('components.group.list', compact('group'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- 列表页码 --}}
                @if (fs_config('channel_group_list_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $groups->links() }}
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
