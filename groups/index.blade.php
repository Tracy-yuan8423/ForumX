@extends('commons.fresns')

@section('title', fs_config('channel_group_seo')['title'] ?: fs_config('channel_group_name'))
@section('keywords', fs_config('channel_group_seo')['keywords'])
@section('description', fs_config('channel_group_seo')['description'])

@section('content')
    <main class="container">
        {{-- 导航 --}}
        <div class="d-flex justify-content-between fs-text-decoration fs-breadcrumb mt-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ fs_route(route('fresns.home')) }}"><i class="bi bi-house-door-fill"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ fs_route(route('fresns.group.index')) }}">{{ fs_config('channel_group_name') }}</a></li>
                </ol>
            </nav>
            <div class="pt-1">
                @if (fs_user()->check())
                    <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => fs_user('detail.uid')])) }}" class="fs-8">{{ fs_lang('userProfile') }}</a>
                @endif
            </div>
        </div>

        <div class="fs-groups">
            @if (fs_config('channel_group_type') == 'tree')
                {{-- 小组树结构列表 --}}
                @foreach($groupTree ?? [] as $tree)
                    <div class="card rounded-0 mb-4 @if (fs_config('forumx_group_index') < 2) pb-4 @endif">
                        <div class="card-header mb-4 fw-bolder" style="background-color: #E5EDF2;color: #369;">{{ $tree['name'] }}</div>
                        @if (fs_config('forumx_group_index') > 1)
                            @php
                                $colNumber = 6;
                                if (fs_config('forumx_group_index') == 3) {
                                    $colNumber = 4;
                                }
                            @endphp
                            <div class="row">
                                @foreach($tree['groups'] ?? [] as $group)
                                    @component('components.group.grid-list', [
                                        'group' => $group,
                                        'colNumber' => $colNumber,
                                    ])@endcomponent
                                @endforeach
                            </div>
                        @else
                            @foreach($tree['groups'] ?? [] as $group)
                                @component('components.group.list', compact('group'))@endcomponent
                                @if (! $loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach
            @else
                {{-- 小组列表 --}}
                <div class="card rounded-0 mb-4 pb-4">
                    @foreach($groups ?? [] as $group)
                        @component('components.group.list', compact('group'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </div>

                {{-- 列表页码 --}}
                @if (fs_config('channel_group_query_state') != 1)
                    <div class="py-3 mt-4 d-flex justify-content-center">
                        {{ $groups->links() }}
                    </div>
                @endif
            @endif
        </div>
    </main>
@endsection
