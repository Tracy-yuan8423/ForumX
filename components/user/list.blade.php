<article class="d-flex mb-3">
    {{-- 头像 --}}
    <section class="flex-shrink-0">
        <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $user['uid']])) }}">
            @if ($user['decorate'])
                <img src="{{ $user['decorate'] }}" loading="lazy" alt="头像挂件" class="user-decorate">
            @endif
            <img src="{{ $user['avatar'] }}" loading="lazy" alt="{{ $user['nickname'] }}" class="user-avatar rounded-circle">
        </a>
    </section>
    <div class="flex-grow-1">
        {{-- 头部信息 --}}
        <header class="user-primary d-lg-flex">
            <div class="user-info d-flex text-nowrap overflow-hidden">
                <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $user['uid']])) }}" class="user-link d-flex">
                    <div class="user-nickname text-nowrap overflow-hidden" style="color:{{ $user['nicknameColor'] }};">{{ $user['nickname'] }}</div>
                    @if ($user['verified'])
                        <div class="user-verified">
                            @if ($user['verifiedIcon'])
                                <img src="{{ $user['verifiedIcon'] }}" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}">
                            @else
                                <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}">
                            @endif
                        </div>
                    @endif
                    <div class="user-name text-secondary"><i class="bi bi-person-badge"></i>{{ $user['uid'] }}</div>
                </a>
                <div class="user-role d-flex">
                    @if ($user['roleIconDisplay'])
                        <div class="user-role-icon"><img src="{{ $user['roleIcon'] }}" loading="lazy" alt="{{ $user['roleName'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['roleName'] }}"></div>
                    @endif
                    @if ($user['roleNameDisplay'])
                        <div class="user-role-name"><span class="badge rounded-pill">{{ $user['roleName'] }}</span></div>
                    @endif
                </div>
            </div>

            {{-- 用户附属图标 --}}
            @if ($user['operations']['diversifyImages'])
                <div class="user-icon d-flex flex-wrap flex-lg-nowrap overflow-hidden my-2 my-lg-0">
                    @foreach($user['operations']['diversifyImages'] as $icon)
                        <img src="{{ $icon['image'] }}" loading="lazy" alt="{{ $icon['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $icon['name'] }}">
                    @endforeach
                </div>
            @endif
        </header>

        {{-- 介绍信息 --}}
        <section class="user-secondary d-flex flex-wrap mb-1">
            <p class="fs-7 mt-1 mb-2 pe-2 text-secondary">{!! $user['bioHtml'] !!}</p>
        </section>

        {{-- 互动信息和功能 --}}
        <footer class="interaction-btn">
            {{-- 点赞 --}}
            @if ($user['interaction']['likeEnabled'])
                @component('components.user.mark.like', [
                    'uid' => $user['uid'],
                    'interaction' => $user['interaction'],
                    'count' => $user['stats']['likerCount']
                ])@endcomponent
            @endif

            {{-- 点踩 --}}
            @if ($user['interaction']['dislikeEnabled'])
                @component('components.user.mark.dislike', [
                    'uid' => $user['uid'],
                    'interaction' => $user['interaction'],
                    'count' => $user['stats']['dislikerCount']
                ])@endcomponent
            @endif

            {{-- 关注 --}}
            @if ($user['interaction']['followEnabled'])
                @component('components.user.mark.follow', [
                    'uid' => $user['uid'],
                    'interaction' => $user['interaction'],
                    'count' => $user['stats']['followerCount']
                ])@endcomponent
            @endif

            {{-- 屏蔽 --}}
            @if ($user['interaction']['blockEnabled'])
                @component('components.user.mark.block', [
                    'uid' => $user['uid'],
                    'interaction' => $user['interaction'],
                    'count' => $user['stats']['blockerCount']
                ])@endcomponent
            @endif

            {{-- 关注状态 --}}
            @if ($user['interaction']['followMeStatus'] && $user['interaction']['followStatus'])
                <span class="badge rounded-pill bg-secondary m-1">{{ fs_lang('userFollowMutual') }}</span>
            @elseif ($user['interaction']['followMeStatus'])
                <span class="badge rounded-pill bg-secondary m-1">{{ fs_lang('userFollowMe') }}</span>
            @endif
        </footer>
    </div>
</article>
