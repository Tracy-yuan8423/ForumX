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

    $detailLink = $detailLink ?? true;
    $sectionAuthorLiked = $sectionAuthorLiked ?? false;
@endphp

@if ($sticky['operations']['buttonIcons'])
    @php
        $iconLike = ArrUtility::pull($sticky['operations']['buttonIcons'], 'code', 'like');
        $iconDislike = ArrUtility::pull($sticky['operations']['buttonIcons'], 'code', 'dislike');
        $iconFollow = ArrUtility::pull($sticky['operations']['buttonIcons'], 'code', 'follow');
        $iconBlock = ArrUtility::pull($sticky['operations']['buttonIcons'], 'code', 'block');
        $iconComment = ArrUtility::pull($sticky['operations']['buttonIcons'], 'code', 'comment');
        $iconShare = ArrUtility::pull($sticky['operations']['buttonIcons'], 'code', 'share');
        $iconMore = ArrUtility::pull($sticky['operations']['buttonIcons'], 'code', 'more');
    @endphp
@endif

@if ($sticky['operations']['diversifyImages'])
    @php
        $title = ArrUtility::pull($sticky['operations']['diversifyImages'], 'code', 'title');
        $decorate = ArrUtility::pull($sticky['operations']['diversifyImages'], 'code', 'decorate');
    @endphp
@endif

<div class="position-relative pb-2" id="{{ $sticky['cid'] }}">
    {{-- 评论作者信息 --}}
    <section class="content-author order-0">
        @component('components.comment.section.author', [
            'cid' => $sticky['cid'],
            'author' => $sticky['author'],
            'isAnonymous' => $sticky['isAnonymous'],
            'createdDatetime' => $sticky['createdDatetime'],
            'createdTimeAgo' => $sticky['createdTimeAgo'],
            'editedDatetime' => $sticky['editedDatetime'],
            'editedTimeAgo' => $sticky['editedTimeAgo'],
            'moreJson' => $sticky['moreJson'],
            'location' => $sticky['location'],
            'replyToComment' => $sticky['replyToComment'],
        ])@endcomponent
    </section>

    {{-- 评论内容 --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- 标题 --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- 标题图标 --}}
            @if ($title)
                <img src="{{ $title['imageUrl'] }}" loading="lazy" alt="{{ $title['name'] }}" class="me-2">
            @endif

            {{-- 置顶 --}}
            @if ($sticky['isSticky'])
                <img src="/assets/ForumX/images/icon-sticky.png" loading="lazy" alt="置顶" class="ms-2">
            @endif

            {{-- 精华 --}}
            @if ($sticky['digestState'] == 2)
                <img src="/assets/ForumX/images/icon-digest.png" loading="lazy" alt="一级精华" class="ms-2">
            @elseif ($sticky['digestState'] == 3)
                <img src="/assets/ForumX/images/icon-digest.png" loading="lazy" alt="二级精华" class="ms-2">
            @endif
        </div>

        {{-- 正文 --}}
        <div class="content-article">
            @if ($sticky['isCommentPrivate'])
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-info-circle"></i> {{ fs_lang('editorCommentPrivate') }}
                </div>
            @else
                @if ($sticky['isMarkdown'])
                    {!! Str::markdown($sticky['content']) !!}
                @else
                    {!! nl2br($sticky['content']) !!}
                @endif

                {{-- 详情页链接 --}}
                @if ($detailLink)
                    <p class="mt-2">
                        <a href="{{ fs_route(route('fresns.comment.detail', ['cid' => $sticky['cid']])) }}" class="text-decoration-none stretched-link">
                            @if ($sticky['isBrief'])
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
            <img src="{{ $decorate['imageUrl'] }}" loading="lazy" alt="{{ $decorate['name'] }}" height="88rem">
        </div>
    @endif

    {{-- 附属文件 --}}
    <section class="content-files order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($sticky['files']['images']) }}">
        @component('components.comment.section.files', [
            'cid' => $sticky['cid'],
            'createdDatetime' => $sticky['createdDatetime'],
            'author' => $sticky['author'],
            'files' => $sticky['files'],
        ])@endcomponent
    </section>

    {{-- 附属扩展 --}}
    @if ($sticky['extends'])
        <section class="content-extends order-3 mx-3">
            @component('components.comment.section.extends', [
                'cid' => $sticky['cid'],
                'createdDatetime' => $sticky['createdDatetime'],
                'author' => $sticky['author'],
                'extends' => $sticky['extends']
            ])@endcomponent
        </section>
    @endif

    {{-- 评论交互功能 --}}
    <section class="interaction order-5 mt-3 mx-3">
        <div class="d-flex">
            {{-- 点赞 --}}
            @if ($sticky['interaction']['likeSetting'])
                <div class="interaction-box">
                    @component('components.comment.mark.like', [
                        'cid' => $sticky['cid'],
                        'interaction' => $sticky['interaction'],
                        'count' => $sticky['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- 点踩 --}}
            @if ($sticky['interaction']['dislikeSetting'])
                <div class="interaction-box">
                    @component('components.comment.mark.dislike', [
                        'cid' => $sticky['cid'],
                        'interaction' => $sticky['interaction'],
                        'count' => $sticky['dislikeCount'],
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
                        <img src="/assets/ForumX/images/icon-comment.png" loading="lazy">
                    @endif
                    <span class="cm-count">
                    {{ $sticky['commentCount'] }}
                    </span>
                </a>
            </div>

            {{-- 分享 --}}
            <div class="interaction-box dropup">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($iconShare)
                        <img src="{{ $iconShare['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="/assets/ForumX/images/icon-share.png" loading="lazy">
                    @endif
                </button>
                @component('components.comment.mark.share', [
                    'cid' => $sticky['cid'],
                    'url' => $sticky['url'],
                ])@endcomponent
            </div>

            {{-- 更多 --}}
            <div class="ms-auto dropup text-end">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    @if ($iconMore)
                        <img src="{{ $iconMore['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="/assets/ForumX/images/icon-more.png" loading="lazy">
                    @endif
                </button>
                @component('components.comment.mark.more', [
                    'cid' => $sticky['cid'],
                    'uid' => $sticky['author']['uid'],
                    'editControls' => $sticky['editControls'],
                    'interaction' => $sticky['interaction'],
                    'followCount' => $sticky['followCount'],
                    'blockCount' => $sticky['blockCount'],
                    'manages' => $sticky['manages'],
                ])@endcomponent
            </div>
        </div>

        {{-- 回复框 --}}
        @component('components.editor.comment-box', [
            'nickname' => $sticky['author']['nickname'],
            'pid' => $sticky['replyToPost']['pid'],
            'cid' => $sticky['cid'],
        ])@endcomponent
    </section>

    {{-- 帖子作者点赞状态 --}}
    @if ($sectionAuthorLiked && $sticky['interaction']['postAuthorLikeStatus'])
        <div class="post-author-liked order-5 mt-2 mx-3">
            <span class="author-badge p-1">{{ fs_lang('contentAuthorLiked') }}</span>
        </div>
    @endif
</div>
