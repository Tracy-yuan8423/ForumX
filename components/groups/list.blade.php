<article class="d-flex">
    @if ($group['cover'])
        <section class="flex-shrink-0">
            <a href="{{ route('fresns.group.detail', ['gid' => $group['gid']]) }}"><img src="{{ $group['cover'] }}" loading="lazy" alt="{{ $group['name'] }}" class="rounded list-cover"></a>
        </section>
    @endif
    <div class="flex-grow-1 ms-3">
        <header class="d-lg-flex">
            <section class="d-flex">
                <a href="{{ route('fresns.group.detail', ['gid' => $group['gid']]) }}" class="text-nowrap overflow-hidden list-name">{{ $group['name'] }}</a>
                @if ($group['recommend'])
                    <img src="{{ fs_theme('assets') }}images/icon-recommend.png" class="list-recommend ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="推荐" loading="lazy" alt="推荐">
                @endif
                <div class="badge-bg-info ms-2">
                    <span class="badge rounded-pill">{{ $group['postCount'] }} {{ fs_config('post_name') }}</span>
                    <span class="badge rounded-pill">{{ $group['postDigestCount'] }} {{ fs_lang('contentDigest') }}</span>
                </div>
            </section>

            <section class="list-btn ms-auto">
                {{-- 点赞 --}}
                @if ($group['interaction']['likeEnabled'])
                    @component('components.groups.mark.like', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['likeCount'],
                    ])@endcomponent
                @endif

                {{-- 点踩 --}}
                @if ($group['interaction']['dislikeEnabled'])
                    @component('components.groups.mark.dislike', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['dislikeCount'],
                    ])@endcomponent
                @endif

                {{-- 关注 --}}
                @if ($group['interaction']['followEnabled'])
                    @component('components.groups.mark.follow', [
                        'gid' => $group['gid'],
                        'name' => $group['name'],
                        'interaction' => $group['interaction'],
                        'count' => $group['followCount'],
                    ])@endcomponent
                @endif

                {{-- 屏蔽 --}}
                @if ($group['interaction']['blockEnabled'])
                    @component('components.groups.mark.block', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['blockCount'],
                    ])@endcomponent
                @endif
            </section>
        </header>

        <section class="fs-7 mt-1 text-secondary">{{ $group['description'] }}</section>
    </div>
</article>
