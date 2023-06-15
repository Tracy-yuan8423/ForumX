@php
    use \App\Utilities\ArrUtility;

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
        $iconLike = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'like');
        $iconDislike = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'dislike');
        $iconFollow = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'follow');
        $iconBlock = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'block');
        $iconComment = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'comment');
        $iconShare = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'share');
        $iconMore = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'more');
    @endphp
@endif

@if ($post['operations']['diversifyImages'])
    @php
        $title = ArrUtility::pull($post['operations']['diversifyImages'], 'code', 'title');
        $decorate = ArrUtility::pull($post['operations']['diversifyImages'], 'code', 'decorate');
    @endphp
@endif

<div class="position-relative pb-2" id="{{ $post['pid'] }}">
    {{-- 帖子作者信息 --}}
    <section class="content-author order-0">
        @component('components.post.section.author', [
            'pid' => $post['pid'],
            'author' => $post['author'],
            'isAnonymous' => $post['isAnonymous'],
            'createdDatetime' => $post['createdDatetime'],
            'createdTimeAgo' => $post['createdTimeAgo'],
            'editedDatetime' => $post['editedDatetime'],
            'editedTimeAgo' => $post['editedTimeAgo'],
            'moreJson' => $post['moreJson'],
            'location' => $post['location']
        ])@endcomponent
    </section>

    {{-- 帖子内容 --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- 标题 --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- 标题图标 --}}
            @if ($title)
                <img src="{{ $title['imageUrl'] }}" loading="lazy" alt="{{ $title['name'] }}" class="me-2">
            @endif

            {{-- 标题 --}}
            @if ($post['title'])
                <h1 class="h3 mb-3">{{ $post['title'] }}</h1>
            @endif

            {{-- 置顶 --}}
            @if ($post['stickyState'] == 2)
                <img src="/assets/themes/ForumX/images/icon-sticky.png" loading="lazy" alt="小组页置顶" class="ms-2">
            @elseif ($post['stickyState'] == 3)
                <img src="/assets/themes/ForumX/images/icon-sticky.png" loading="lazy" alt="全局置顶" class="ms-2">
            @endif

            {{-- 精华 --}}
            @if ($post['digestState'] == 2)
                <img src="/assets/themes/ForumX/images/icon-digest.png" loading="lazy" alt="一级精华" class="ms-2">
            @elseif ($post['digestState'] == 3)
                <img src="/assets/themes/ForumX/images/icon-digest.png" loading="lazy" alt="二级精华" class="ms-2">
            @endif
        </div>

        {{-- 正文 --}}
        <div class="content-article">
            @if ($post['isMarkdown'])
                {!! Str::markdown($post['content']) !!}
            @else
                {!! nl2br($post['content']) !!}
            @endif
        </div>
    </section>

    {{-- 帖子权限信息 --}}
    @if ($post['readConfig']['isReadLocked'])
        <section class="post-allow order-2">
            <div class="post-allow-static"></div>
            <div class="text-center">
                <p class="text-secondary mb-2">{{ fs_lang('contentPreReadInfo') }} {{ $post['readConfig']['previewPercentage'] }}%</p>
                <button type="button" class="btn btn-outline-info btn-lg w-50" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-type="post"
                    data-scene="postAuthBtn"
                    data-post-message-key="fresnsPostAuthBtn"
                    data-pid="{{ $post['pid'] }}"
                    data-uid="{{ $post['author']['uid'] }}"
                    data-title="{{ $post['readConfig']['buttonName'] }}"
                    data-url="{{ $post['readConfig']['buttonUrl'] }}">
                    {{ $post['readConfig']['buttonName'] }}
                </button>
            </div>
        </section>
    @endif

    {{-- 帖子角标图 --}}
    @if ($decorate)
        <div class="position-absolute top-0 end-0">
            <img src="{{ $decorate['imageUrl'] }}" loading="lazy" alt="{{ $decorate['name'] }}" height="88rem">
        </div>
    @endif

    {{-- 附属文件 --}}
    <section class="content-files order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($post['files']['images']) }}">
        @component('components.post.section.files', [
            'pid' => $post['pid'],
            'createdDatetime' => $post['createdDatetime'],
            'author' => $post['author'],
            'files' => $post['files'],
        ])@endcomponent
    </section>

    {{-- 附属扩展 --}}
    <section class="content-extends order-3 mx-3">
        @component('components.post.section.extends', [
            'pid' => $post['pid'],
            'createdDatetime' => $post['createdDatetime'],
            'author' => $post['author'],
            'extends' => $post['extends']
        ])@endcomponent
    </section>

    {{-- 帖子扩展信息 --}}
    @if ($post['group'] || $post['affiliatedUserConfig']['hasUserList'] || $post['hashtags'])
        <section class="content-append order-4 mx-3 mt-3 d-flex">
            <div class="me-auto d-flex flex-row">
                {{-- 帖子小组 --}}
                @if ($post['group'])
                    <div class="content-group me-2">
                        <a href="{{ fs_route(route('fresns.group.detail', ['gid' => $post['group']['gid']])) }}" class="badge rounded-pill text-decoration-none">
                            @if (!empty($post['group']['cover']))
                                <img src="{{ $post['group']['cover'] }}" loading="lazy" alt="$post['group']['gname']" class="rounded">
                            @endif
                            {{ $post['group']['gname'] }}
                        </a>
                    </div>
                @endif

                {{-- 帖子话题 --}}
                @if ($post['hashtags'])
                    @foreach($post['hashtags'] as $hashtag)
                        <div class="content-group me-2 mt-1">
                            <a href="{{ fs_route(route('fresns.hashtag.detail', ['hid' => $hashtag['hid']])) }}" class="badge rounded-pill text-decoration-none">
                                {{ '# '.$hashtag['hname'] }}
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- 帖子特定成员 --}}
            @if ($post['affiliatedUserConfig']['hasUserList'])
                <div class="content-user-list">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                        data-type="post"
                        data-scene="postUserList"
                        data-post-message-key="fresnsPostUserList"
                        data-pid="{{ $post['pid'] }}"
                        data-uid="{{ $post['author']['uid'] }}"
                        data-title="{{ $post['affiliatedUserConfig']['userListName'] }}"
                        data-url="{{ $post['affiliatedUserConfig']['userListUrl'] }}">
                        {{ $post['affiliatedUserConfig']['userListName'] }}
                        <span class="badge bg-light text-dark">{{ $post['affiliatedUserConfig']['userListCount'] }}</span>
                    </button>
                </div>
            @endif
        </section>
    @endif

    {{-- 帖子交互功能 --}}
    <section class="interaction order-5 mt-3 px-3">
        <div class="d-flex">
            {{-- 点赞 --}}
            @if ($post['interaction']['likeSetting'])
                <div class="interaction-box">
                    @component('components.post.mark.like', [
                        'pid' => $post['pid'],
                        'interaction' => $post['interaction'],
                        'count' => $post['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- 点踩 --}}
            @if ($post['interaction']['dislikeSetting'])
                <div class="interaction-box">
                    @component('components.post.mark.dislike', [
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
                        <img src="{{ $iconComment['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="/assets/themes/ForumX/images/icon-comment.png" loading="lazy">
                    @endif
                    {{ $post['commentCount'] }}
                </a>
            </div>

            {{-- 分享 --}}
            <div class="interaction-box dropup">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($iconShare)
                        <img src="{{ $iconShare['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="/assets/themes/ForumX/images/icon-share.png" loading="lazy">
                    @endif
                </button>
                @component('components.post.mark.share', [
                    'pid' => $post['pid'],
                    'url' => $post['url'],
                ])@endcomponent
            </div>

            {{-- 更多 --}}
            <div class="ms-auto dropup text-end">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    @if ($iconMore)
                        <img src="{{ $iconMore['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="/assets/themes/ForumX/images/icon-more.png" loading="lazy">
                    @endif
                </button>
                @component('components.post.mark.more', [
                    'pid' => $post['pid'],
                    'uid' => $post['author']['uid'],
                    'editControls' => $post['editControls'],
                    'interaction' => $post['interaction'],
                    'followCount' => $post['followCount'],
                    'blockCount' => $post['blockCount'],
                    'manages' => $post['manages'],
                ])@endcomponent
            </div>
        </div>

        {{-- 评论回复框 --}}
        @component('components.editor.comment-box', [
            'nickname' => $post['author']['nickname'],
            'pid' => $post['pid'],
            'show' => true,
        ])@endcomponent
    </section>
</div>
