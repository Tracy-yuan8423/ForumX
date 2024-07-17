<article class="d-flex col-md-{{ $colNumber }} mb-4">
    <section class="flex-shrink-0">
        <a href="{{ route('fresns.group.detail', ['gid' => $group['gid']]) }}">
            @if ($group['cover'])
                <img src="{{ $group['cover'] }}" loading="lazy" alt="{{ $group['name'] }}" class="rounded list-cover">
            @else
                <img src="{{ fs_theme('assets') }}images/group-null.png" loading="lazy" alt="{{ $group['name'] }}" class="rounded list-cover">
            @endif
        </a>
    </section>

    <div class="flex-grow-1 ms-3">
        <a href="{{ route('fresns.group.detail', ['gid' => $group['gid']]) }}" class="text-nowrap overflow-hidden list-name">{{ $group['name'] }}</a>
        @if ($group['recommend'])
            <img src="{{ fs_theme('assets') }}images/icon-recommend.png" class="list-recommend ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="推荐" loading="lazy" alt="推荐">
        @endif
        <div class="badge-bg-info">
            <span class="badge rounded-pill">{{ $group['postCount'] }} {{ fs_config('post_name') }}</span>
            <span class="badge rounded-pill">{{ $group['postDigestCount'] }} {{ fs_lang('contentDigest') }}</span>
        </div>
    </div>
</article>
