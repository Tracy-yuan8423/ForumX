<article class="d-flex my-3">
    @if ($group['cover'])
        <section class="flex-shrink-0">
            <a href="{{ fs_route(route('fresns.group.detail', ['gid' => $group['gid']])) }}">
                <img src="{{ $group['cover'] }}" loading="lazy" alt="{{ $group['name'] }}" class="rounded list-cover">
            </a>
        </section>
    @endif
    <div class="flex-grow-1 ms-3">
        <header class="d-lg-flex">
            <section class="d-flex fs-text-decoration">
                <a href="{{ fs_route(route('fresns.group.detail', ['gid' => $group['gid']])) }}" class="link-dark">{{ $group['name'] }}</a>
                @if ($group['recommend'])
                    <img src="{{ fs_theme('assets') }}images/icon-recommend.png" class="list-recommend" loading="lazy" alt="{{ fs_lang('contentRecommend') }}">
                @endif
            </section>

            <section class="list-btn ms-auto">
                {{-- 点赞 --}}
                @if ($group['interaction']['likeEnabled'])
                    @component('components.group.mark.like', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['likeCount'],
                    ])@endcomponent
                @endif

                {{-- 点踩 --}}
                @if ($group['interaction']['dislikeEnabled'])
                    @component('components.group.mark.dislike', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['dislikeCount'],
                    ])@endcomponent
                @endif

                {{-- 关注 --}}
                @if ($group['interaction']['followEnabled'])
                    @component('components.group.mark.follow', [
                        'gid' => $group['gid'],
                        'name' => $group['name'],
                        'interaction' => $group['interaction'],
                        'count' => $group['followCount'],
                    ])@endcomponent
                @endif

                {{-- 屏蔽 --}}
                @if ($group['interaction']['blockEnabled'])
                    @component('components.group.mark.block', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['blockCount'],
                    ])@endcomponent
                @endif
            </section>
        </header>

        <section class="badge-bg-info">
            <span class="badge rounded-pill">{{ $group['postCount'] }} {{ fs_config('post_name') }}</span>
            <span class="badge rounded-pill">{{ $group['postDigestCount'] }} {{ fs_lang('contentDigest') }}</span>
        </section>

        <section class="fs-7 mt-1 text-secondary">{{ $group['description'] }}</section>
    </div>
</article>
