<div class="d-flex flex-row ms-2 fs-text-decoration fs-x-filter">
    <div class="me-3">
        <a href="{{ request()->url() }}">{{ fs_lang('contentAllList') }}</a>
    </div>

    <div class="dropdown">
        @foreach (fs_content_types('post') as $type)
            @if (empty(request('contentType')) && $type['fskey'] == 'All')
                <a class="dropdown-toggle @if (request('contentType')) fw-semibold @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $type['name'] }}</a>
            @endif

            @if (request('contentType') == $type['fskey'])
                <a class="dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $type['name'] }}</a>
            @endif
        @endforeach

        <ul class="dropdown-menu">
            @foreach (fs_content_types('post') as $type)
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['contentType' => $type['fskey']]) }}">{{ $type['name'] }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="mx-3">
        <a href="{{ request()->fullUrlWithQuery(['orderType' => 'createdTime']) }}" class="@if (request('orderType') == 'createdTime') fw-semibold @endif">{{ fs_lang('contentNewList') }}</a>
    </div>

    <div class="me-3">
        <a href="{{ request()->fullUrlWithQuery(['orderType' => 'like']) }}" class="@if (request('orderType') == 'like') fw-semibold @endif">{{ fs_lang('contentHotList') }}</a>
    </div>

    <div class="me-3">
        <a href="{{ request()->fullUrlWithQuery(['allDigest' => 1]) }}" class="@if (request('allDigest') == 1) fw-semibold @endif">{{ fs_lang('contentDigest') }}</a>
    </div>

    <div class="dropdown me-3">
        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('more') }}</a>

        <ul class="dropdown-menu">
            <li><span class="dropdown-item-text">{{ fs_lang('rankNum') }}</span></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['orderType' => 'createdTime']) }}">{{ fs_lang('contentPublishTime') }}</a></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['orderType' => 'comment']) }}">{{ fs_db_config('comment_name') }}</a></li>
            <li><span class="dropdown-item-text">{{ fs_lang('contentPublishTime') }}</span></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['createdDays' => 1]) }}">一天</a></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['createdDays' => 2]) }}">两天</a></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['createdDays' => 7]) }}">一周</a></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['createdDays' => 30]) }}">一个月</a></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['createdDays' => 90]) }}">三个月</a></li>
        </ul>
    </div>
</div>
