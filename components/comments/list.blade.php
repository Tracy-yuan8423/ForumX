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

    $detailLink = $detailLink ?? true;
    $sectionAuthorLiked = $sectionAuthorLiked ?? false;
@endphp

@if ($comment['operations']['buttonIcons'])
    @php
        $iconLike = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'like',
            'asArray' => false,
        ]);
        $iconDislike = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'dislike',
            'asArray' => false,
        ]);
        $iconFollow = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'follow',
            'asArray' => false,
        ]);
        $iconBlock = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'block',
            'asArray' => false,
        ]);
        $iconComment = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'comment',
            'asArray' => false,
        ]);
        $iconShare = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'share',
            'asArray' => false,
        ]);
        $iconMore = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'more',
            'asArray' => false,
        ]);
    @endphp
@endif

@if ($comment['operations']['diversifyImages'])
    @php
        $title = fs_helpers('Arr', 'pull', $comment['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'title',
            'asArray' => false,
        ]);
        $decorate = fs_helpers('Arr', 'pull', $comment['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'decorate',
            'asArray' => false,
        ]);
    @endphp
@endif

<div class="position-relative pb-2" id="{{ $comment['cid'] }}">
    {{-- 评论作者信息 --}}
    <section class="content-author order-0">
        @component('components.comments.sections.author', [
            'cid' => $comment['cid'],
            'author' => $comment['author'],
            'isAnonymous' => $comment['isAnonymous'],
            'createdDatetime' => $comment['createdDatetime'],
            'createdTimeAgo' => $comment['createdTimeAgo'],
            'editedDatetime' => $comment['editedDatetime'],
            'editedTimeAgo' => $comment['editedTimeAgo'],
            'geotag' => $comment['geotag'],
            'moreInfo' => $comment['moreInfo'],
            'replyToComment' => $comment['replyToComment'],
        ])@endcomponent
    </section>

    {{-- 评论内容 --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- 标题 --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- 标题图标 --}}
            @if ($title)
                <img src="{{ $title['image'] }}" loading="lazy" alt="{{ $title['name'] }}" class="me-2">
            @endif

            {{-- 置顶 --}}
            @if ($comment['isSticky'])
                <img src="{{ fs_theme('assets') }}images/icon-sticky.png" loading="lazy" alt="置顶" class="ms-2">
            @endif

            {{-- 精华 --}}
            @if ($comment['digestState'] == 2)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="一级精华" class="ms-2">
            @elseif ($comment['digestState'] == 3)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="二级精华" class="ms-2">
            @endif
        </div>

        {{-- 正文 --}}
        <div class="content-article">
            @if ($comment['privacy'] == 'private')
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-info-circle"></i> {{ fs_lang('editorCommentPrivate') }}
                </div>
            @else
                @if ($comment['isMarkdown'])
                    {!! Str::markdown($comment['content']) !!}
                @else
                    {!! nl2br($comment['content']) !!}
                @endif

                {{-- 详情页链接 --}}
                @if ($detailLink)
                    <p class="mt-2">
                        <a href="{{ route('fresns.comment.detail', ['cid' => $comment['cid']]) }}" class="text-decoration-none stretched-link">
                            @if ($comment['isBrief'])
                                {{ fs_lang('contentFull') }}
                            @endif
                        </a>
                    </p>
                @endif
            @endif
        </div>
    </section>

    {{-- 评论角标图 --}}
    @if ($decorate)
        <div class="position-absolute top-0 end-0">
            <img src="{{ $decorate['image'] }}" loading="lazy" alt="{{ $decorate['name'] }}" height="88rem">
        </div>
    @endif

    {{-- 附属文件 --}}
    <section class="content-files order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($comment['files']['images']) }}">
        @component('components.comments.sections.files', [
            'cid' => $comment['cid'],
            'createdDatetime' => $comment['createdDatetime'],
            'author' => $comment['author'],
            'files' => $comment['files'],
        ])@endcomponent
    </section>

    {{-- 附属扩展 --}}
    @if ($comment['extends'])
        <section class="content-extends order-3 mx-3">
            @component('components.comments.sections.extends', [
                'cid' => $comment['cid'],
                'createdDatetime' => $comment['createdDatetime'],
                'author' => $comment['author'],
                'extends' => $comment['extends']
            ])@endcomponent
        </section>
    @endif

    {{-- 评论交互功能 --}}
    <section class="interaction order-5 mt-3 mx-3">
        <div class="d-flex">
            {{-- 点赞 --}}
            @if ($comment['interaction']['likeEnabled'])
                <div class="interaction-box">
                    @component('components.comments.mark.like', [
                        'cid' => $comment['cid'],
                        'interaction' => $comment['interaction'],
                        'count' => $comment['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- 点踩 --}}
            @if ($comment['interaction']['dislikeEnabled'])
                <div class="interaction-box">
                    @component('components.comments.mark.dislike', [
                        'cid' => $comment['cid'],
                        'interaction' => $comment['interaction'],
                        'count' => $comment['dislikeCount'],
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
                    {{ $comment['commentCount'] }}
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
                @component('components.comments.mark.share', [
                    'cid' => $comment['cid'],
                    'url' => $comment['url'],
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
                @component('components.comments.mark.more', [
                    'cid' => $comment['cid'],
                    'uid' => $comment['author']['uid'],
                    'controls' => $comment['controls'],
                    'interaction' => $comment['interaction'],
                    'followCount' => $comment['followCount'],
                    'blockCount' => $comment['blockCount'],
                    'manages' => $comment['manages'],
                    'viewType' => 'list',
                ])@endcomponent
            </div>
        </div>

        {{-- 回复框 --}}
        @component('components.editor.quick-publish-comment', [
            'nickname' => $comment['author']['nickname'],
            'pid' => $comment['replyToPost']['pid'] ?? null,
            'cid' => $comment['cid'],
        ])@endcomponent
    </section>

    {{-- 帖子作者点赞状态 --}}
    @if ($sectionAuthorLiked && $comment['interaction']['postAuthorLikeStatus'])
        <div class="post-author-liked order-5 mt-2 mx-3">
            <span class="author-badge p-1">{{ fs_lang('contentAuthorLiked') }}</span>
        </div>
    @endif

    {{-- 评论预览信息 --}}
    @if ($comment['previewComments'])
        @component('components.comments.sections.preview', [
            'cid' => $comment['cid'],
            'commentCount' => $comment['commentCount'],
            'previewComments' => $comment['previewComments'],
        ])@endcomponent
    @endif

    {{-- 主帖预览内容 --}}
    @if ($comment['replyToPost'])
        @component('components.comments.sections.post', [
            'post' => $comment['replyToPost'],
        ])@endcomponent
    @endif
</div>
