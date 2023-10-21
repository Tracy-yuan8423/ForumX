@extends('commons.fresns')

@section('title', $items['title'] ?? $post['title'] ?? Str::limit(strip_tags($post['content']), 40))
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? Str::limit(strip_tags($post['content']), 140))

@section('content')
    <main class="container">
        {{-- 导航 --}}
        <div class="d-flex justify-content-between fs-text-decoration fs-breadcrumb mt-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ fs_route(route('fresns.home')) }}"><i class="bi bi-house-door-fill"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ fs_route(route('fresns.group.index')) }}">{{ fs_db_config('menu_group_name') }}</a></li>
                    @if ($post['group'])
                        <li class="breadcrumb-item"><span class="fs-8">{{ $post['group']['category']['gname'] }}</span></li>
                        <li class="breadcrumb-item"><a href="{{ fs_route(route('fresns.group.detail', ['gid' => $post['group']['gid']])) }}">{{ $post['group']['gname'] }}</a></li>
                    @endif
                    <li class="breadcrumb-item"><a href="{{ fs_route(route('fresns.post.detail', ['pid' => $post['pid']])) }}">{{ $post['title'] ?? Str::limit(strip_tags($post['content']), 40) }}</a></li>
                </ol>
            </nav>
            <div class="pt-1">
                @if (fs_user()->check())
                    <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => fs_user('detail.uid')])) }}" class="fs-8">{{ fs_lang('userProfile') }}</a>
                @endif
            </div>
        </div>

        <div class="publish-btn my-2">
            @if (fs_user()->check())
                @if (fs_db_config('fs_forumx_quick_publish'))
                    <button class="btn btn-primary px-4" type="button" data-bs-toggle="modal" data-bs-target="#createModal">{{ fs_db_config('publish_post_name') }}</button>
                @else
                    <a class="btn btn-primary px-4" href="{{ fs_route(route('fresns.editor.index', ['type' => 'post'])) }}">{{ fs_db_config('publish_post_name') }}</a>
                @endif
            @else
                <button class="btn btn-primary px-4" type="button" data-bs-toggle="modal" data-bs-target="#commentTipModal">{{ fs_db_config('publish_post_name') }}</button>
            @endif

            <button class="btn btn-primary px-4" type="button" data-bs-toggle="modal" @if (fs_user()->check()) data-bs-target="#commentModal-{{ $post['pid'] }}" @else data-bs-target="#commentTipModal" @endif>{{ fs_db_config('publish_comment_name') }}</button>
        </div>

        <div class="@desktop border @enddesktop clearfix" id="commentList" name="commentList">
            {{-- 帖子内容 --}}
            @component('components.post.x-detail', compact('post'))@endcomponent

            {{-- 置顶评论列表 --}}
            @if (fs_sticky_comments($post['pid']))
                <div class="card-body bg-primary bg-opacity-10">
                    @foreach(fs_sticky_comments($post['pid']) as $sticky)
                        @component('components.comment.sticky', [
                            'sticky' => $sticky,
                            'detailLink' => true,
                            'sectionAuthorLiked' => true,
                        ])@endcomponent
                    @endforeach
                </div>
            @endif

            {{-- 评论列表 --}}
            @desktop
                @foreach($comments as $comment)
                    @component('components.comment.x-list', [
                        'comment' => $comment,
                        'detailLink' => true,
                        'sectionAuthorLiked' => true,
                    ])@endcomponent
                @endforeach
            @else
                @foreach($comments as $comment)
                    @component('components.comment.list', [
                        'comment' => $comment,
                        'detailLink' => true,
                        'sectionAuthorLiked' => true,
                    ])@endcomponent

                    @if (! $loop->last)
                        <hr>
                    @endif
                @endforeach
            @enddesktop
        </div>

        {{-- 评论页码 --}}
        <div class="my-3 table-responsive">
            {{ $comments->links() }}
        </div>
    </main>

    {{-- 评论回复框 --}}
    @if (fs_user()->check())
        @component('components.editor.comment-modal-box', [
            'nickname' => $post['author']['nickname'],
            'title' => $post['title'] ?? Str::limit(strip_tags($post['content']), 40),
            'pid' => $post['pid'],
        ])@endcomponent
    @endif
@endsection
