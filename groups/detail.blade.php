@extends('commons.fresns')

@section('title', $items['title'] ?? $group['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $group['description'])

@section('content')
    <main class="container">
        {{-- 导航 --}}
        <div class="d-flex justify-content-between fs-text-decoration fs-breadcrumb mt-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('fresns.home') }}"><i class="bi bi-house-door-fill"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('fresns.group.index') }}">{{ fs_config('channel_group_name') }}</a></li>
                    <li class="breadcrumb-item"><span class="fs-8">{{ $group['parentInfo']['name'] }}</span></li>
                    <li class="breadcrumb-item"><a href="{{ route('fresns.group.detail', ['gid' => $group['gid']]) }}">{{ $group['name'] }}</a></li>
                </ol>
            </nav>
            <div class="pt-1">
                @if (fs_user()->check())
                    <a href="{{ route('fresns.profile.index', ['uidOrUsername' => fs_user('detail.uid')]) }}" class="fs-8">{{ fs_lang('userProfile') }}</a>
                @endif
            </div>
        </div>

        {{-- 小组详情 --}}
        <div class="card rounded-0 mt-2 mb-3">
            @component('components.groups.detail', compact('group'))@endcomponent
        </div>

        {{-- 小组扩展 --}}
        <div class="clearfix">
            @foreach($items['extensions'] as $extension)
                <div class="float-start mb-3" style="width:20%">
                    <a class="text-decoration-none" data-bs-toggle="modal" href="#fresnsModal"
                        data-title="{{ $extension['name'] }}"
                        data-url="{{ $extension['appUrl'] }}"
                        data-post-message-key="fresnsGroupExtension">
                        <div class="position-relative mx-auto" style="width:52px">
                            <img src="{{ $extension['icon'] }}" loading="lazy" class="rounded" height="52">
                            @if ($extension['badgeType'])
                                <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                    {{ $extension['badgeType'] == 1 ? '' : $extension['badgeValue'] }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                        </div>
                        <p class="mt-1 mb-0 fs-7 text-center text-nowrap">{{ $extension['name'] }}</p>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="publish-btn mb-2">
            @if (fs_user()->check())
                @if (fs_config('forumx_quick_publish'))
                    <button class="btn btn-primary px-4" type="button" data-bs-toggle="modal" data-bs-target="#createModal">{{ fs_config('publish_post_name') }}</button>
                @else
                    <a class="btn btn-primary px-4" href="{{ route('fresns.editor.post') }}">{{ fs_config('publish_post_name') }}</a>
                @endif
            @else
                <button class="btn btn-primary px-4" type="button" data-bs-toggle="modal" data-bs-target="#commentTipModal">{{ fs_config('publish_post_name') }}</button>
            @endif
        </div>

        {{-- 是否有权浏览 --}}
        @if ($group['canViewContent'])
            <table class="table table-hover border mb-5">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">
                            @include('components.posts.filter')
                        </th>
                        <th scope="col">{{ fs_lang('contentAuthor') }}</th>
                        <th scope="col">{{ fs_config('comment_name') }}</th>
                        @desktop
                            <th scope="col">{{ fs_lang('contentLastCommentTime') }}</th>
                        @enddesktop
                    </tr>
                </thead>
                <tbody class="fs-text-decoration fs-x-link">
                    {{-- 全局置顶 --}}
                    @foreach(fs_sticky_posts() as $stickyPost)
                        @component('components.posts.x-list', [
                            'post' => $stickyPost,
                            'sticky' => true,
                            'groupSticky' => false,
                        ])@endcomponent
                    @endforeach

                    {{-- 小组置顶 --}}
                    @foreach(fs_sticky_posts($group['gid']) as $gorupPost)
                        @component('components.posts.x-list', [
                            'post' => $gorupPost,
                            'sticky' => false,
                            'groupSticky' => true,
                        ])@endcomponent
                    @endforeach

                    @if (fs_sticky_posts() || fs_sticky_posts($group['gid']))
                        <tr class="table-secondary ">
                            <td colspan="4" class="ps-lg-3 fs-7">
                                {{ fs_config('group_name').': '.fs_config('post_name') }}
                            </td>
                        </tr>
                    @endif

                    {{-- 帖子列表 --}}
                    @foreach($posts as $post)
                        @component('components.posts.x-list', [
                            'post' => $post,
                            'sticky' => false,
                            'groupSticky' => false,
                        ])@endcomponent
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-5 text-danger">
                <i class="bi bi-info-circle"></i> {{ fs_lang('contentGroupTip') }}
            </div>
        @endif

        {{-- 列表页码 --}}
        <div class="my-3 table-responsive">
            {{ $posts->links() }}
        </div>
    </main>
@endsection
