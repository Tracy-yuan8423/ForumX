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

<div class="row mx-0" id="{{ $post['pid'] }}">
    <div class="col-md-2 px-0 fs-text-decoration" style="background: #E5EDF2;border-bottom: 4px solid #C2D5E3;">
        @desktop
            {{-- 评论数 --}}
            <div class="text-center fs-8 text-secondary pt-2" style="border-bottom: 4px solid #C2D5E3;height: 40px;">
                {{ $post['interaction']['likeName'] }}: <span class="text-danger">{{ $post['likeCount'] }}</span>
                <span style="color: #CCC;" class="mx-2">|</span>
                {{ fs_config('comment_name') }}: <span class="text-danger">{{ $post['commentCount'] }}</span>
            </div>

            {{-- 用户昵称 --}}
            <div class="ps-3 py-1 fw-semibold" style="border-bottom: 1px dashed #CDCDCD;">
                @if (! $post['author']['status'])
                    {{-- 停用作者 --}}
                    <span class="link-dark fs-7">{{ fs_lang('userDeactivate') }}</span>
                @elseif ($post['isAnonymous'])
                    {{-- 匿名作者 --}}
                    <span class="link-dark fs-7">{{ $post['author']['nickname'] }}</span>
                @else
                    {{-- 正常作者 --}}
                    <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $post['author']['uid']]) }}" target="_blank" class="link-dark fs-7">{{ $post['author']['nickname'] }}</a>
                    @if ($post['author']['verified'])
                        @if ($post['author']['verifiedIcon'])
                            <img src="{{ $post['author']['verifiedIcon'] }}" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $post['author']['verifiedDesc'] }}" height="18">
                        @else
                            <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $post['author']['verifiedDesc'] }}" height="18">
                        @endif
                    @endif
                @endif
            </div>

            {{-- 用户资料 --}}
            <div class="px-3">
                @component('components.posts.sections.x-author', [
                    'pid' => $post['pid'],
                    'author' => $post['author'],
                    'isAnonymous' => $post['isAnonymous'],
                ])@endcomponent
            </div>
        @else
            <section class="content-author">
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
        @enddesktop
    </div>

    <div class="col-md-10 px-0" style="border-bottom: 4px solid #E5EDF2;">
        {{-- 标题 --}}
        <div class="d-lg-flex fs-text-decoration" style="border-bottom: 4px solid #E5EDF2; @desktop height: 40px; @else padding-bottom: 10px; @enddesktop">
            <h1 class="mb-0 ps-3" style="font:700 16px 'Microsoft Yahei','Hei',Tahoma,'SimHei',sans-serif;padding-top: 10px;">{{ $post['title'] ?? Str::limit(strip_tags($post['content']), 40) }}</h1>
            <a href="#" onclick="copyToClipboard('#{{ $post['pid'].'-url' }}')" class="link-secondary fs-8 pt-2 ms-3 mb-3 mb-lg-0">[{{ fs_lang('copyLink') }}]</a>
        </div>

        {{-- 发表时间 --}}
        <div class="mx-lg-3 py-1 d-flex" style="border-bottom: 1px dashed #CDCDCD;">
            <div class="flex-grow-1">
                {{-- 帖子创建时间 --}}
                <i class="bi bi-person-square" style="color: var(--bs-orange)"></i>
                <span class="fs-8">{{ fs_lang('contentPublishedOn') }}</span>
                <time class="fs-8" datetime="{{ $post['createdDatetime'] }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $post['createdDatetime'] }}">{{ $post['createdTimeAgo'] }}</time>

                {{-- 帖子编辑时间 --}}
                @if ($post['editedDatetime'])
                    <span class="text-secondary fs-8 ms-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $post['editedDatetime'] }}">({{ fs_lang('contentEditedOn') }} {{ $post['editedTimeAgo'] }})</span>
                @endif
            </div>
        </div>

        {{-- 正文 --}}
        <div class="content-article px-lg-3 my-3">
            @if ($post['isMarkdown'])
                @php
                    $searchArr = [
                        '&lt;audio class=&quot;fresns_file_audio&quot; controls preload=&quot;metadata&quot; controlsList=&quot;nodownload&quot; src=&quot;',
                        '&quot;&gt;</audio>',
                    ];
                    $replaceArr = [
                        '<audio class="fresns_file_audio" controls preload="metadata" controlsList="nodownload" src="',
                        '"></audio>',
                    ];
                @endphp
                {!! str_replace($searchArr, $replaceArr, Str::markdown($post['content'])) !!}
            @else
                {!! nl2br($post['content']) !!}
            @endif
        </div>

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

        {{-- 附属文件 --}}
        <section class="content-files mx-3 my-2 d-flex align-content-start flex-wrap file-image-{{ count($post['files']['images']) }}">
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
            <section class="content-append order-4 m-3 d-flex">
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

        {{-- 帖子交互功能 --}}
        <section class="interaction mx-lg-3 py-2 px-3" style="border-top: 1px dashed #CDCDCD;">
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
                <div class="interaction-box">
                    <button class="btn btn-inter" type="button" data-bs-toggle="modal" @if (fs_user()->check()) data-bs-target="#commentModal-{{ $post['pid'] }}" @else data-bs-target="#commentTipModal" @endif>
                        @if ($iconComment)
                            <img src="{{ $iconComment['image'] }}" loading="lazy">
                        @else
                            <img src="{{ fs_theme('assets') }}images/icon-comment.png" loading="lazy">
                        @endif
                        <span class="cm-count">{{ $post['commentCount'] }}</span>
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
                        'viewType' => 'detail',
                    ])@endcomponent
                </div>
            </div>
        </section>
    </div>
</div>
