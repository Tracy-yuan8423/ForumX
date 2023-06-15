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

@if ($comment['operations']['buttonIcons'])
    @php
        $iconLike = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'like');
        $iconDislike = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'dislike');
        $iconFollow = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'follow');
        $iconBlock = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'block');
        $iconComment = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'comment');
        $iconShare = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'share');
        $iconMore = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'more');
    @endphp
@endif

@if ($comment['operations']['diversifyImages'])
    @php
        $title = ArrUtility::pull($comment['operations']['diversifyImages'], 'code', 'title');
        $decorate = ArrUtility::pull($comment['operations']['diversifyImages'], 'code', 'decorate');
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
                @if ($comment['author']['verifiedStatus'])
                    @if ($comment['author']['verifiedIcon'])
                        <img src="{{ $comment['author']['verifiedIcon'] }}" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $comment['author']['verifiedDesc'] }}" height="18">
                    @else
                        <img src="/assets/themes/ForumX/images/icon-verified.png" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $comment['author']['verifiedDesc'] }}" height="18">
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
            <div class="fs-8 pt-1">
                {{-- IP 属地 --}}
                @if (fs_api_config('account_ip_location_status') && current_lang_tag() == 'zh-Hans')
                    <span class="text-secondary ms-3">
                        <i class="bi bi-geo"></i>
                        @if ($comment['moreJson']['ipLocation'] ?? null)
                            {{ fs_lang('ipLocation').$comment['moreJson']['ipLocation'] }}
                        @else
                            {{ fs_lang('errorIp') }}
                        @endif
                    </span>
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
        @if ($comment['subComments'])
            @component('components.comment.section.preview', [
                'cid' => $comment['cid'],
                'commentCount' => $comment['commentCount'],
                'subComments' => $comment['subComments'],
            ])@endcomponent
        @endif

        {{-- 帖子交互功能 --}}
        <section class="interaction mx-lg-3 py-2 px-3 mt-3" style="border-top: 1px dashed #CDCDCD;">
            <div class="d-flex">
                {{-- 点赞 --}}
                @if ($comment['interaction']['likeSetting'])
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
                @if ($comment['interaction']['dislikeSetting'])
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
                            <img src="{{ $iconComment['imageUrl'] }}" loading="lazy">
                        @else
                            <img src="/assets/themes/ForumX/images/icon-comment.png" loading="lazy">
                        @endif
                        <span class="cm-count">{{ $comment['commentCount'] }}</span>
                    </button>
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
                    @component('components.comment.mark.share', [
                        'cid' => $comment['cid'],
                        'url' => $comment['url'],
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
                    @component('components.comment.mark.more', [
                        'cid' => $comment['cid'],
                        'uid' => $comment['author']['uid'],
                        'editControls' => $comment['editControls'],
                        'interaction' => $comment['interaction'],
                        'followCount' => $comment['followCount'],
                        'blockCount' => $comment['blockCount'],
                        'manages' => $comment['manages'],
                    ])@endcomponent
                </div>
            </div>

            {{-- 回复框 --}}
            @if (fs_user()->check())
                @component('components.editor.comment-modal-box', [
                    'nickname' => $comment['author']['nickname'],
                    'title' => Str::limit(strip_tags($comment['content']), 40),
                    'pid' => $comment['replyToPost']['pid'],
                    'cid' => $comment['cid'],
                ])@endcomponent
            @endif
        </section>

        {{-- 帖子作者点赞状态 --}}
        @if ($sectionAuthorLiked && $comment['interaction']['postAuthorLikeStatus'])
            <div class="post-author-liked order-5 mt-2 mx-3">
                <span class="author-badge p-1">{{ fs_lang('contentAuthorLiked') }}</span>
            </div>
        @endif
    </div>
</div>