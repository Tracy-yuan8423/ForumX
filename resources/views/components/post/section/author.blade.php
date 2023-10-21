@if (! $author['status'])
    {{-- 停用作者 --}}
    <div class="d-flex">
        <div class="flex-shrink-0">
            <img src="{{ fs_db_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('userDeactivate') }}" class="user-avatar rounded-circle">
        </div>
        <div class="flex-grow-1">
            <div class="user-primary d-lg-flex">
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <div class="text-muted">{{ fs_lang('userDeactivate') }}</div>
                </div>
            </div>
            <div class="user-secondary d-flex flex-wrap mb-3">
                {{-- 帖子创建时间 --}}
                <time class="text-secondary" datetime="{{ $createdDatetime }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $createdDatetime }}">{{ $createdTimeAgo }}</time>

                {{-- 帖子编辑时间 --}}
                @if ($editedDatetime)
                    <div class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $editedDatetime }}">({{ fs_lang('contentEditedOn') }} {{ $editedTimeAgo }})</div>
                @endif

                {{-- IP 属地 --}}
                @if (fs_api_config('account_ip_location_status') && current_lang_tag() == 'zh-Hans')
                    <span class="text-secondary ms-3">
                        <i class="bi bi-geo"></i>
                        @if ($moreJson['ipLocation'] ?? null)
                            {{ fs_lang('ipLocation').$moreJson['ipLocation'] }}
                        @else
                            {{ fs_lang('errorIp') }}
                        @endif
                    </span>
                @endif

                {{-- 帖子位置 --}}
                @if ($location['isLbs'])
                    <a href="{{ fs_route(route('fresns.post.location', $location['encode'])) }}" class="link-secondary ms-3"><i class="bi bi-geo-alt-fill"></i> {{ $location['poi'] }}</a>
                @endif
            </div>
        </div>
    </div>
@elseif ($isAnonymous)
    {{-- 匿名作者 --}}
    <div class="d-flex">
        <div class="flex-shrink-0">
            <img src="{{ $author['avatar'] }}" loading="lazy" alt="{{ fs_lang('contentAuthorAnonymous') }}" class="user-avatar rounded-circle">
        </div>
        <div class="flex-grow-1">
            <div class="user-primary d-lg-flex">
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <div class="text-muted">{{ fs_lang('contentAuthorAnonymous') }}</div>
                </div>
            </div>
            <div class="user-secondary d-flex flex-wrap mb-3">
                {{-- 帖子创建时间 --}}
                <time class="text-secondary" datetime="{{ $createdDatetime }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $createdDatetime }}">{{ $createdTimeAgo }}</time>

                {{-- 帖子编辑时间 --}}
                @if ($editedDatetime)
                    <div class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $editedDatetime }}">({{ fs_lang('contentEditedOn') }} {{ $editedTimeAgo }})</div>
                @endif

                {{-- IP 属地 --}}
                @if (fs_api_config('account_ip_location_status') && current_lang_tag() == 'zh-Hans')
                    <span class="text-secondary ms-3">
                        <i class="bi bi-geo"></i>
                        @if ($moreJson['ipLocation'] ?? null)
                            {{ fs_lang('ipLocation').$moreJson['ipLocation'] }}
                        @else
                            {{ fs_lang('errorIp') }}
                        @endif
                    </span>
                @endif

                {{-- 帖子位置 --}}
                @if ($location['isLbs'])
                    <a href="{{ fs_route(route('fresns.post.location', $location['encode'])) }}" class="link-secondary ms-3"><i class="bi bi-geo-alt-fill"></i> {{ $location['poi'] }}</a>
                @endif
            </div>
        </div>
    </div>
@else
    {{-- 正常作者 --}}
    <div class="d-flex">
        <div class="flex-shrink-0">
            <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $author['uid']])) }}">
                @if ($author['decorate'])
                    <img src="{{ $author['decorate'] }}" loading="lazy" alt="头像挂件" class="user-decorate">
                @endif
                <img src="{{ $author['avatar'] }}" loading="lazy" alt="{{ $author['uid'] }}" class="user-avatar rounded-circle">
            </a>
        </div>
        <div class="flex-grow-1">
            <div class="user-primary d-lg-flex">
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $author['uid']])) }}" class="user-link d-flex">
                        <div class="user-nickname text-nowrap overflow-hidden" style="color:{{ $author['nicknameColor'] }};">{{ $author['nickname'] }}</div>
                        @if ($author['verifiedStatus'])
                            <div class="user-verified">
                                @if ($author['verifiedIcon'])
                                    <img src="{{ $author['verifiedIcon'] }}" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $author['verifiedDesc'] }}">
                                @else
                                    <img src="/assets/ForumX/images/icon-verified.png" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $author['verifiedDesc'] }}">
                                @endif
                            </div>
                        @endif
                        <div class="user-name text-secondary"><i class="bi bi-person-badge"></i>{{ $author['uid'] }}</div>
                    </a>
                    <div class="user-role d-flex">
                        @if ($author['roleIconDisplay'])
                            <div class="user-role-icon"><img src="{{ $author['roleIcon'] }}" loading="lazy" alt="{{ $author['roleName'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $author['roleName'] }}"></div>
                        @endif
                        @if ($author['roleNameDisplay'])
                            <div class="user-role-name"><span class="badge rounded-pill">{{ $author['roleName'] }}</span></div>
                        @endif
                    </div>
                </div>

                {{-- 用户附属图标 --}}
                @if ($author['operations']['diversifyImages'])
                    <div class="user-icon d-flex flex-wrap flex-lg-nowrap overflow-hidden my-2 my-lg-0">
                        @foreach($author['operations']['diversifyImages'] as $icon)
                            <img src="{{ $icon['imageUrl'] }}" loading="lazy" alt="{{ $icon['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $icon['name'] }}">
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="user-secondary d-flex flex-wrap mb-3">
                {{-- 帖子创建时间 --}}
                <time class="text-secondary" datetime="{{ $createdDatetime }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $createdDatetime }}">{{ $createdTimeAgo }}</time>

                {{-- 帖子编辑时间 --}}
                @if ($editedDatetime)
                    <div class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $editedDatetime }}">({{ fs_lang('contentEditedOn') }} {{ $editedTimeAgo }})</div>
                @endif

                {{-- IP 属地 --}}
                @if (fs_api_config('account_ip_location_status') && current_lang_tag() == 'zh-Hans')
                    <span class="text-secondary ms-3">
                        <i class="bi bi-geo"></i>
                        @if ($moreJson['ipLocation'] ?? null)
                            {{ fs_lang('ipLocation').$moreJson['ipLocation'] }}
                        @else
                            {{ fs_lang('errorIp') }}
                        @endif
                    </span>
                @endif

                {{-- 帖子位置 --}}
                @if ($location['isLbs'])
                    <a href="{{ fs_route(route('fresns.post.location', $location['encode'])) }}" class="link-secondary ms-3"><i class="bi bi-geo-alt-fill"></i> {{ $location['poi'] }}</a>
                @endif
            </div>
        </div>
    </div>
@endif
