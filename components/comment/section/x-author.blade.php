<div class="border shadow-sm bg-body mx-auto mt-3" style="width: 150px;padding: 10px;">
    @if (! $author['status'])
        {{-- 停用作者 --}}
        <a href="#"><img src="{{ fs_db_config('deactivate_avatar') }}" loading="lazy" class="rounded-0" height="130"></a>
    @elseif ($isAnonymous)
        {{-- 匿名作者 --}}
        <a href="#"><img src="{{ $author['avatar'] }}" loading="lazy" class="rounded-0" height="130"></a>
    @else
        {{-- 正常作者 --}}
        <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $author['uid']])) }}">
            <img src="{{ $author['avatar'] }}" loading="lazy" alt="{{ $author['uid'] }}" class="rounded-0" height="130">
        </a>
    @endif
</div>
<div class="d-flex flex-row justify-content-center fs-8 my-3">
    <div class="text-center">
        <p class="mb-0"><a href="{{ fs_route(route('fresns.profile.posts', ['uidOrUsername' => $author['uid']])) }}">{{ $author['stats']['postPublishCount'] }}</a></p>
        <p class="mb-0">{{ fs_db_config('post_name') }}</p>
    </div>
    <div class="vr mx-3"></div>
    <div class="text-center">
        <p class="mb-0"><a href="{{ fs_route(route('fresns.profile.comments', ['uidOrUsername' => $author['uid']])) }}">{{ $author['stats']['commentPublishCount'] }}</a></p>
        <p class="mb-0">{{ fs_db_config('comment_name') }}</p>
    </div>
    <div class="vr mx-3"></div>
    <div class="text-center">
        <p class="mb-0"><a href="{{ fs_route(route('fresns.profile.followers', ['uidOrUsername' => $author['uid']])) }}">{{ $author['stats']['followMeCount'] }}</a></p>
        <p class="mb-0">{{ fs_db_config('follow_user_name') }}</p>
    </div>
</div>
<div class="mx-3 fs-8 text-secondary">
    <p class="mb-1">{{ fs_db_config('user_uid_name') }}: {{ $author['uid'] }}</p>
    <p class="mb-1">{{ fs_db_config('user_role_name') }}: {{ $author['roleName'] }}</p>
    <p>{{ fs_db_config('user_bio_name') }}: {!! $author['bioHtml'] !!}</p>
</div>
