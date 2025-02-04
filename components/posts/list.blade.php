@php
    $iconLike = null;
    $iconDislike = null;
    $iconFollow = null;
    $iconBlock = null;
    $iconComment = null;
    $iconShare = null;
    $iconMore = null;

    $title = null;
    $decorate = null;
@endphp

@if ($post['operations']['buttonIcons'])
    @php
        $iconLike = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'like',
            'asArray' => false,
        ]);
        $iconDislike = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'dislike',
            'asArray' => false,
        ]);
        $iconFollow = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'follow',
            'asArray' => false,
        ]);
        $iconBlock = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'block',
            'asArray' => false,
        ]);
        $iconComment = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'comment',
            'asArray' => false,
        ]);
        $iconShare = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'share',
            'asArray' => false,
        ]);
        $iconMore = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'more',
            'asArray' => false,
        ]);
    @endphp
@endif

@if ($post['operations']['diversifyImages'])
    @php
        $title = fs_helpers('Arr', 'pull', $post['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'title',
            'asArray' => false,
        ]);
        $decorate = fs_helpers('Arr', 'pull', $post['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'decorate',
            'asArray' => false,
        ]);
    @endphp
@endif

<div class="position-relative pb-2" id="{{ $post['pid'] }}">
    {{-- 帖子作者信息 --}}
    <section class="content-author order-0">
        @component('components.posts.sections.author', [
            'pid' => $post['pid'],
            'author' => $post['author'],
            'isAnonymous' => $post['isAnonymous'],
            'createdDatetime' => $post['createdDatetime'],
            'createdTimeAgo' => $post['createdTimeAgo'],
            'editedDatetime' => $post['editedDatetime'],
            'editedTimeAgo' => $post['editedTimeAgo'],
            'geotag' => $post['geotag'],
            'moreInfo' => $post['moreInfo'],
        ])@endcomponent
    </section>

    {{-- 帖子内容 --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- 标题 --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- 标题图标 --}}
            @if ($title)
                <img src="{{ $title['image'] }}" loading="lazy" alt="{{ $title['name'] }}" class="me-2">
            @endif

            {{-- 标题 --}}
            @if ($post['title'])
                <h1 class="h5 mb-3">{{ $post['title'] }}</h1>
            @endif

            {{-- 置顶 --}}
            @if ($post['stickyState'] == 2)
                <img src="{{ fs_theme('assets') }}images/icon-sticky.png" loading="lazy" alt="小组页置顶" class="ms-2">
            @elseif ($post['stickyState'] == 3)
                <img src="{{ fs_theme('assets') }}images/icon-sticky.png" loading="lazy" alt="全局置顶" class="ms-2">
            @endif

            {{-- 精华 --}}
            @if ($post['digestState'] == 2)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="一级精华" class="ms-2">
            @elseif ($post['digestState'] == 3)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="二级精华" class="ms-2">
            @endif
        </div>

        {{-- 正文 --}}
        <div class="content-article">
            @if ($post['isMarkdown'])
                {!! Str::markdown($post['content']) !!}
            @else
                {!! nl2br($post['content']) !!}
            @endif

            {{-- 详情页链接 --}}
            <p class="mt-2">
                <a href="{{ route('fresns.post.detail', ['pid' => $post['pid']]) }}" class="text-decoration-none stretched-link">
                    @if ($post['isBrief'])
                        {{ fs_lang('contentFull') }}
                    @endif
                </a>
            </p>
        </div>
    </section>

    {{-- 帖子权限信息 --}}
    @if ($post['readConfig']['isReadLocked'])
        <section class="post-allow order-2">
            <div class="post-allow-static"></div>
            <div class="text-center">
                <p class="text-secondary mb-2">{{ fs_lang('contentPreReadInfo') }} {{ $post['readConfig']['previewPercentage'] }}%</p>
                <button type="button" class="btn btn-outline-info btn-lg w-50" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-title="{{ $post['readConfig']['buttonName'] }}"
                    data-url="{{ $post['readConfig']['buttonUrl'] }}"
                    data-pid="{{ $post['pid'] }}"
                    data-uid="{{ $post['author']['uid'] }}"
                    data-post-message-key="fresnsPostAuthBtn">
                    {{ $post['readConfig']['buttonName'] }}
                </button>
            </div>
        </section>
    @endif

    {{-- 帖子角标图 --}}
    @if ($decorate)
        <div class="position-absolute top-0 end-0">
            <img src="{{ $decorate['image'] }}" loading="lazy" alt="{{ $decorate['name'] }}" height="88rem">
        </div>
    @endif

    {{-- 附属文件 --}}
    <section class="content-files order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($post['files']['images']) }}">
        @component('components.posts.sections.files', [
            'pid' => $post['pid'],
            'createdDatetime' => $post['createdDatetime'],
            'author' => $post['author'],
            'files' => $post['files'],
        ])@endcomponent
    </section>

    {{-- 附属扩展 --}}
    <section class="content-extends order-3 mx-3">
        @component('components.posts.sections.extends', [
            'pid' => $post['pid'],
            'createdDatetime' => $post['createdDatetime'],
            'author' => $post['author'],
            'extends' => $post['extends']
        ])@endcomponent
    </section>

    {{-- 帖子扩展信息 --}}
    @if ($post['group'] || $post['associatedUserListConfig']['hasUserList'] || $post['hashtags'])
        <section class="content-append order-4 mx-3 mt-3 d-flex">
            <div class="me-auto d-flex flex-row">
                {{-- 帖子小组 --}}
                @if ($post['group'])
                    <div class="content-group me-2">
                        <a href="{{ route('fresns.group.detail', ['gid' => $post['group']['gid']]) }}" class="badge rounded-pill text-decoration-none">
                            @if ($post['group']['cover'])
                                <img src="{{ $post['group']['cover'] }}" loading="lazy" alt="$post['group']['name']" class="rounded">
                            @endif
                            {{ $post['group']['name'] }}
                        </a>
                    </div>
                @endif

                {{-- 帖子话题 --}}
                @if ($post['hashtags'])
                    @foreach($post['hashtags'] as $hashtag)
                        <div class="content-group me-2 mt-1">
                            <a href="{{ route('fresns.hashtag.detail', ['htid' => $hashtag['htid']]) }}" class="badge rounded-pill text-decoration-none">
                                {{ '# '.$hashtag['name'] }}
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- 帖子特定成员 --}}
            @if ($post['associatedUserListConfig']['hasUserList'])
                <div class="content-user-list">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                        data-title="{{ $post['associatedUserListConfig']['userListName'] }}"
                        data-url="{{ $post['associatedUserListConfig']['userListUrl'] }}"
                        data-pid="{{ $post['pid'] }}"
                        data-uid="{{ $post['author']['uid'] }}"
                        data-post-message-key="fresnsPostUserList">
                        {{ $post['associatedUserListConfig']['userListName'] }}
                        <span class="badge bg-light text-dark">{{ $post['associatedUserListConfig']['userListCount'] }}</span>
                    </button>
                </div>
            @endif
        </section>
    @endif

    {{-- 帖子评论预览 --}}
    @if ($post['previewComments'])
        @component('components.posts.sections.preview-comment', [
            'pid' => $post['pid'],
            'commentCount' => $post['commentCount'],
            'previewComments' => $post['previewComments'],
        ])@endcomponent
    @endif

    {{-- 帖子交互功能 --}}
    <section class="interaction order-5 mt-3 px-3">
        <div class="d-flex">
            {{-- 点赞 --}}
            @if ($post['interaction']['likeEnabled'])
                <div class="interaction-box">
                    @component('components.posts.mark.like', [
                        'pid' => $post['pid'],
                        'interaction' => $post['interaction'],
                        'count' => $post['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- 点踩 --}}
            @if ($post['interaction']['dislikeEnabled'])
                <div class="interaction-box">
                    @component('components.posts.mark.dislike', [
                        'pid' => $post['pid'],
                        'interaction' => $post['interaction'],
                        'count' => $post['dislikeCount'],
                        'icon' => $iconDislike,
                    ])@endcomponent
                </div>
            @endif

            {{-- 评论 --}}
            <div class="interaction-box fresns-trigger-reply">
                <a class="btn btn-inter" href="javascript:;" role="button">
                    @if ($iconComment)
                        <img src="{{ $iconComment['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-comment.png" loading="lazy">
                    @endif
                    <span class="cm-count">
                        {{ $post['commentCount'] }}
                    </span>
                </a>
            </div>

            {{-- 分享 --}}
            <div class="interaction-box dropup">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($iconShare)
                        <img src="{{ $iconShare['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-share.png" loading="lazy">
                    @endif
                </button>
                @component('components.posts.mark.share', [
                    'pid' => $post['pid'],
                    'url' => $post['url'],
                ])@endcomponent
            </div>

            {{-- 更多 --}}
            <div class="ms-auto dropup text-end">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    @if ($iconMore)
                        <img src="{{ $iconMore['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-more.png" loading="lazy">
                    @endif
                </button>
                @component('components.posts.mark.more', [
                    'pid' => $post['pid'],
                    'uid' => $post['author']['uid'],
                    'controls' => $post['controls'],
                    'interaction' => $post['interaction'],
                    'followCount' => $post['followCount'],
                    'blockCount' => $post['blockCount'],
                    'manages' => $post['manages'],
                    'viewType' => 'list',
                ])@endcomponent
            </div>
        </div>

        {{-- 评论回复框 --}}
        @component('components.editor.quick-publish-comment', [
            'nickname' => $post['author']['nickname'],
            'pid' => $post['pid'],
        ])@endcomponent
    </section>
</div>
