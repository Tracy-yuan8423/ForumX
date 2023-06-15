@extends('commons.fresns')

@section('title', fs_db_config('menu_block_groups'))

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
                <div class="my-3 table-responsive">
                    {{ $groups->links() }}
                </div>
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
