@php
    $user = $user ?? $profile;
    $followersYouFollow = $followersYouFollow ?? [];
@endphp

@if ($user['banner'])
    <div style="margin-left:-12px;margin-right:-12px;filter:blur(2px);">
        <img src="{{ $user['banner'] }}" loading="lazy" class="w-100 rounded-top" style="max-height:200px;">
    </div>
@endif

<section class="avatar">
    @if ($user['decorate'])
        <img src="{{ $user['decorate'] }}" loading="lazy" alt="头像挂件" class="profile-decorate">
    @endif
    <img src="{{ $user['avatar'] }}" loading="lazy" alt="{{ $user['nickname'] }}" class="profile-avatar rounded-circle">
</section>

<section class="userinfo">
    <div class="profile-nickname d-flex justify-content-center">
        <h1 style="color:{{ $user['nicknameColor'] }};">{{ $user['nickname'] }}</h1>
        @if ($user['verified'])
            @if ($user['verifiedIcon'])
                <img src="{{ $user['verifiedIcon'] }}" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}">
            @else
                <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="认证图标" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}">
            @endif
        @endif
        @if ($user['roleIconDisplay'] && $user['roleIcon'])
            <img src="{{ $user['roleIcon'] }}" loading="lazy" alt="{{ $user['roleName'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['roleName'] }}">
        @endif
        @if ($user['roleNameDisplay'])
            <span class="badge text-bg-secondary">{{ $user['roleName'] }}</span>
        @endif
    </div>

    <div class="mb-2 text-secondary"><i class="bi bi-person-badge"></i>{{ $user['uid'] }}</div>

    @if ($user['verified'] && $user['verifiedDesc'])
        <span class="badge rounded-pill text-bg-warning fw-normal mb-2">
            <i class="bi bi-patch-check"></i>
            {{ $user['verifiedDesc'] }}
        </span>
    @endif

    @if ($user['status'])
        <p class="fs-7 text-secondary px-4">{!! $user['bioHtml'] !!}</p>
    @else
        <div class="alert alert-warning" role="alert"><i class="bi bi-exclamation-triangle-fill"></i> {{ fs_lang('userSuspended') }}</div>
    @endif

    {{-- 用户附属图标 --}}
    @if ($user['operations']['diversifyImages'])
        <div class="text-center">
            @foreach($user['operations']['diversifyImages'] as $icon)
                <img src="{{ $icon['image'] }}" loading="lazy" alt="{{ $icon['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $icon['name'] }}" style="height:2rem">
            @endforeach
        </div>
    @endif
</section>

@if (fs_config('profile_followers_you_follow_enabled') && $followersYouFollow)
    <section class="text-center my-3">
        <a href="{{ route('fresns.profile.followers.you.follow', ['uidOrUsername' => $user['uid']]) }}" class="text-muted fs-7 text-decoration-none">
            @foreach($followersYouFollow as $friend)
                {{ $friend['nickname'] }}@if (! $loop->last), @endif
            @endforeach
            {{ fs_lang('userFollowersYouKnow') }}
        </a>
    </section>
@endif

<section class="d-flex justify-content-center overflow-hidden mb-4">
    {{-- 对话 --}}
    @if (fs_config('conversation_status') && $user['conversation']['status'])
        <button type="button" class="btn btn-outline-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#conversationModal-{{ $user['uid'] }}">{{ fs_config('channel_conversations_name') }}</button>
    @endif

    {{-- 点赞 --}}
    @if ($user['interaction']['likeEnabled'])
        @component('components.users.mark.like', [
            'uid' => $user['uid'],
            'interaction' => $user['interaction'],
            'count' => $user['stats']['likerCount']
        ])@endcomponent
    @endif

    {{-- 点踩 --}}
    @if ($user['interaction']['dislikeEnabled'])
        @component('components.users.mark.dislike', [
            'uid' => $user['uid'],
            'interaction' => $user['interaction'],
            'count' => $user['stats']['dislikerCount']
        ])@endcomponent
    @endif

    {{-- 关注 --}}
    @if ($user['interaction']['followEnabled'])
        @component('components.users.mark.follow', [
            'uid' => $user['uid'],
            'interaction' => $user['interaction'],
            'count' => $user['stats']['followerCount']
        ])@endcomponent
    @endif

    {{-- 屏蔽 --}}
    @if ($user['interaction']['blockEnabled'])
        @component('components.users.mark.block', [
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
</section>

{{-- 对话 --}}
@if (fs_config('conversation_status') && $user['conversation']['status'])
    <div class="modal fade" id="conversationModal-{{ $user['uid'] }}" tabindex="-1" aria-labelledby="conversationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="conversationModalLabel">
                        <a href="{{ route('fresns.conversation.index') }}" target="_blank" class="text-decoration-none"><i class="bi bi-chat-square-dots"></i> {{ fs_config('channel_conversations_name') }}</a>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @component('components.messages.send', [
                        'user' => $user,
                    ])@endcomponent
                </div>
            </div>
        </div>
    </div>
@endif
