@extends('commons.fresns')

@section('title', fs_config('channel_me_drafts_name'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('me.sidebar')
            </div>

            {{-- 草稿列表 --}}
            <div class="col-sm-6">
                <div class="card">
                    {{-- 菜单 --}}
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            {{-- posts --}}
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'post') active @endif" href="{{ route('fresns.me.drafts', ['type' => 'posts']) }}">
                                    {{ fs_config('post_name') }}

                                    @if (fs_user_overview('draftCount.posts') > 0)
                                        <span class="badge bg-danger">{{ fs_user_overview('draftCount.posts') }}</span>
                                    @endif
                                </a>
                            </li>
                            {{-- comments --}}
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'comment') active @endif" href="{{ route('fresns.me.drafts', ['type' => 'comments']) }}">
                                    {{ fs_config('comment_name') }}

                                    @if (fs_user_overview('draftCount.comments') > 0)
                                        <span class="badge bg-danger">{{ fs_user_overview('draftCount.comments') }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- 内容列表 --}}
                    <div class="card-body">
                        @component('components.editor.draft-list', [
                            'type' => $type,
                            'drafts' => $drafts,
                        ])@endcomponent
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
