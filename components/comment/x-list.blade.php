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

<div class="row mx-0" id="{{ $comment['cid'] }}">
    <div class="col-md-2 px-0 fs-text-decoration" style="background: #E5EDF2;border-bottom: 4px solid #C2D5E3;">
        {{-- 用户昵称 --}}
        <div class="ps-3 py-1 fw-semibold" style="border-bottom: 1px dashed #CDCDCD;">

            @if (! $comment['author']['status'])
                {{-- 停用作者 --}}
                <span class="link-dark fs-7">{{ fs_lang('userDeactivate') }}</span>
            @elseif ($comment['isAnonymous'])
                {{-- 匿名作者 --}}
                <span class="link-dark fs-7">{{ $comment['author']['nickname'] }}</span>
            @else
                {{-- 正常作者 --}}
                <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $comment['author']['uid']])) }}" target="_blank" class="link-dark fs-7">{{ $comment['author']['nickname'] }}</a>
                @if ($comment['author']['verified'])
                    @if ($comment['author']['verifiedIcon'])
                        <img src="{{ $comment['author']['verifiedIcon'] }}" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $comment['author']['verifiedDesc'] }}" height="18">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $comment['author']['verifiedDesc'] }}" height="18">
                    @endif
                @endif
            @endif
        </div>

        {{-- 用户资料 --}}
        <div class="px-3">
            @component('components.comment.section.x-author', [
                'cid' => $comment['cid'],
                'author' => $comment['author'],
                'isAnonymous' => $comment['isAnonymous'],
            ])@endcomponent
        </div>
    </div>
    <div class="col-md-10 px-0" style="border-bottom: 4px solid #E5EDF2;">
        {{-- 发表时间 --}}
        <div class="mx-lg-3 py-1 d-flex" style="border-bottom: 1px dashed #CDCDCD;">
            <div class="flex-grow-1">
                {{-- 帖子创建时间 --}}
                <i class="bi bi-person-square" style="color: var(--bs-orange)"></i>
                <span class="fs-8">{{ fs_lang('contentPublishedOn') }}</span>
                <time class="fs-8" datetime="{{ $comment['createdDatetime'] }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $comment['createdDatetime'] }}">{{ $comment['createdTimeAgo'] }}</time>

                {{-- 帖子编辑时间 --}}
                @if ($comment['editedDatetime'])
                    <span class="text-secondary fs-8 ms-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $comment['editedDatetime'] }}">({{ fs_lang('contentEditedOn') }} {{ $comment['editedTimeAgo'] }})</span>
                @endif
            </div>
        </div>

        {{-- 正文 --}}
        <div class="content-article px-lg-3 my-3">
            @if ($comment['isMarkdown'])
                {!! Str::markdown($comment['content']) !!}
            @else
                {!! nl2br($comment['content']) !!}
            @endif
        </div>

        {{-- 附属文件 --}}
        <section class="content-files mx-3 my-2 d-flex align-content-start flex-wrap file-image-{{ count($comment['files']['images']) }}">
            @component('components.comment.section.files', [
                'cid' => $comment['cid'],
                'createdDatetime' => $comment['createdDatetime'],
                'author' => $comment['author'],
                'files' => $comment['files'],
            ])@endcomponent
        </section>

        {{-- 评论预览信息 --}}
        @if ($comment['previewComments'])
            @component('components.comment.section.preview', [
                'cid' => $comment['cid'],
                'commentCount' => $comment['commentCount'],
                'previewComments' => $comment['previewComments'],
            ])@endcomponent
        @endif

        {{-- 帖子交互功能 --}}
        <section class="interaction mx-lg-3 py-2 px-3 mt-3" style="border-top: 1px dashed #CDCDCD;">
            <div class="d-flex">
                {{-- 点赞 --}}
                @if ($comment['interaction']['likeEnabled'])
                    <div class="interaction-box">
                        @component('components.comment.mark.like', [
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
                        @component('components.comment.mark.dislike', [
                            'cid' => $comment['cid'],
                            'interaction' => $comment['interaction'],
                            'count' => $comment['dislikeCount'],
                            'icon' => $iconDislike,
                        ])@endcomponent
                    </div>
                @endif

                {{-- 评论 --}}
                <div class="interaction-box">
                    <button class="btn btn-inter" type="button" data-bs-toggle="modal" @if (fs_user()->check()) data-bs-target="#commentModal-{{ $comment['cid'] }}" @else data-bs-target="#commentTipModal" @endif>
                        @if ($iconComment)
                            <img src="{{ $iconComment['image'] }}" loading="lazy">
                        @else
                            <img src="{{ fs_theme('assets') }}images/icon-comment.png" loading="lazy">
                        @endif
                        <span class="cm-count">{{ $comment['commentCount'] }}</span>
                    </button>
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
                    @component('components.comment.mark.share', [
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
                    @component('components.comment.mark.more', [
                        'cid' => $comment['cid'],
                        'uid' => $comment['author']['uid'],
                        'editControls' => $comment['editControls'],
                        'interaction' => $comment['interaction'],
                        'followCount' => $comment['followCount'],
                        'blockCount' => $comment['blockCount'],
                        'manages' => $comment['manages'],
                        'viewType' => 'list',
                    ])@endcomponent
                </div>
            </div>

            {{-- 帖子作者点赞状态 --}}
            @if ($sectionAuthorLiked && $comment['interaction']['postAuthorLikeStatus'])
                <div class="post-author-liked order-5 mt-2">
                    <span class="author-badge p-1">{{ fs_lang('contentAuthorLiked') }}</span>
                </div>
            @endif

            {{-- 回复框 --}}
            @if (fs_user()->check())
                @component('components.editor.quick-publish-comment-modal', [
                    'nickname' => $comment['author']['nickname'],
                    'title' => Str::limit(strip_tags($comment['content']), 40),
                    'pid' => $comment['replyToPost']['pid'] ?? null,
                    'cid' => $comment['cid'],
                ])@endcomponent
            @endif
        </section>
    </div>
</div>
