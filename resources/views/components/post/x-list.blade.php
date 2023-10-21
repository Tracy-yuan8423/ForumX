@php
    use \App\Utilities\ArrUtility;

    $title = null;
@endphp

@if ($post['operations']['diversifyImages'])
    @php
        $title = ArrUtility::pull($post['operations']['diversifyImages'], 'code', 'title');
    @endphp
@endif

<tr>
    <td class="w-75 ps-lg-3">
        @if ($sticky)
            <i class="bi bi-arrow-up-square-fill me-1" style="color: #F40;"></i>
        @endif
        @if ($groupSticky)
            <i class="bi bi-arrow-up-square-fill text-primary me-1"></i>
        @endif

        <a href="{{ fs_route(route('fresns.post.detail', ['pid' => $post['pid']])) }}">{{ $post['title'] ?? Str::limit(strip_tags($post['content']), 40) }}</a>

        @if (count($post['files']['images']) > 0)
            <i class="bi bi-images text-primary mx-2"></i>
        @endif
        @if (count($post['files']['videos']) > 0)
            <i class="bi bi-youtube text-primary mx-2"></i>
        @endif
        @if (count($post['files']['audios']) > 0)
            <i class="bi bi-music-note-beamed text-primary mx-2"></i>
        @endif
        @if (count($post['files']['documents']) > 0)
            <i class="bi bi-file-earmark-fill text-primary mx-2"></i>
        @endif

        {{-- 精华 --}}
        @if ($post['digestState'] == 2)
            <img src="/assets/ForumX/images/icon-digest.png" loading="lazy" alt="一级精华" class="ms-2" height="24">
        @elseif ($post['digestState'] == 3)
            <img src="/assets/ForumX/images/icon-digest.png" loading="lazy" alt="二级精华" class="ms-2" height="24">
        @endif
    </td>
    <td class="dropdown fs-content-author">
        @if (! $post['author']['status'])
            {{-- 停用作者 --}}
            <span class="text-muted">{{ fs_lang('userDeactivate') }}</span>
        @elseif ($post['isAnonymous'])
            {{-- 匿名作者 --}}
            <span class="text-muted">{{ fs_lang('contentAuthorAnonymous') }}</span>
        @else
            {{-- 正常作者 --}}
            <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $post['author']['uid']])) }}">{{ $post['author']['nickname'] }}</a>
        @endif

        <div class="dropdown-menu rounded-0 shadow-sm bg-light" style="width: 300px">
            <div class="content-author">
                @component('components.post.section.author', [
                    'pid' => $post['pid'],
                    'author' => $post['author'],
                    'isAnonymous' => $post['isAnonymous'],
                    'createdDatetime' => $post['createdDatetime'],
                    'createdTimeAgo' => $post['createdTimeAgo'],
                    'editedDatetime' => $post['editedDatetime'],
                    'editedTimeAgo' => $post['editedTimeAgo'],
                    'moreJson' => $post['moreJson'],
                    'location' => $post['location']
                ])@endcomponent
            </div>
        </div>
    </td>
    <td><span class="badge bg-secondary">{{ $post['commentCount'] }}</span></td>
    @desktop
        <td class="pe-lg-3 fs-8 text-secondary" style="padding-top: 12px;">{{ $post['latestCommentTimeAgo'] }}</td>
    @enddesktop
</tr>
