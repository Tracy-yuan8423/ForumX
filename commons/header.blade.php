<header class="container-lg">
    <div class="d-none d-sm-block my-4 fs-text-decoration">
        <div class="d-flex">
            <div class="x-logo flex-grow-1">
                <a href="{{ route('fresns.home') }}"><img src="{{ fs_config('site_logo') }}" height="66"></a>
            </div>
            <div class="x-profile d-flex mt-2">
                @if (fs_user()->check())
                    @include('commons.user-info')
                @else
                    @include('commons.user-login')
                @endif
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg py-lg-0" style="background-color: #2B7ACD;">
        <div class="container-fluid px-lg-0">
            <a class="navbar-brand d-block d-sm-none" href="{{ route('fresns.home') }}"><img src="{{ fs_config('site_logo') }}" height="30"></a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto fs-navbar fs-text-decoration">
                    {{-- portal --}}
                    @if (fs_config('channel_portal_status'))
                        <li class="nav-item order-{{ fs_config('forumx_navbar_portal') }}">
                            <a class="nav-link px-3 link-light {{ Route::is('fresns.portal') ? 'text-white active' : '' }}
                                @if (Route::is('fresns.home') && fs_config('default_homepage') == 'portal') text-white active @endif"
                                href="{{ route('fresns.portal') }}">
                                {{ fs_config('channel_portal_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- user --}}
                    @if (fs_config('channel_user_status'))
                        <li class="nav-item order-{{ fs_config('forumx_navbar_user') }}">
                            <a class="nav-link px-3 link-light {{ Route::is('fresns.user.*') ? 'text-white active' : '' }}
                                @if (Route::is('fresns.home') && fs_config('default_homepage') == 'user') text-white active @endif"
                                href="{{ route('fresns.user.index') }}">
                                {{ fs_config('channel_user_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- group --}}
                    @if (fs_config('channel_group_status'))
                        <li class="nav-item order-{{ fs_config('forumx_navbar_group') }}">
                            <a class="nav-link px-3 link-light {{ Route::is('fresns.group.*') ? 'text-white active' : '' }}
                                @if (Route::is('fresns.home') && fs_config('default_homepage') == 'group') text-white active @endif"
                                href="{{ route('fresns.group.index') }}">
                                {{ fs_config('channel_group_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- hashtag --}}
                    @if (fs_config('channel_hashtag_status'))
                        <li class="nav-item order-{{ fs_config('forumx_navbar_hashtag') }}">
                            <a class="nav-link px-3 link-light {{ Route::is('fresns.hashtag.*') ? 'text-white active' : '' }}
                                @if (Route::is('fresns.home') && fs_config('default_homepage') == 'hashtag') text-white active @endif"
                                href="{{ route('fresns.hashtag.index') }}">
                                {{ fs_config('channel_hashtag_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- post --}}
                    @if (fs_config('channel_post_status'))
                        <li class="nav-item order-{{ fs_config('forumx_navbar_post') }}">
                            <a class="nav-link px-3 link-light {{ Route::is('fresns.post.*') ? 'text-white active' : '' }}
                                @if (Route::is('fresns.home') && fs_config('default_homepage') == 'post') text-white active @endif"
                                href="{{ route('fresns.post.index') }}">
                                {{ fs_config('channel_post_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- comment --}}
                    @if (fs_config('channel_comment_status'))
                        <li class="nav-item order-{{ fs_config('forumx_navbar_comment') }}">
                            <a class="nav-link px-3 link-light {{ Route::is('fresns.comment.*') ? 'text-white active' : '' }}
                                @if (Route::is('fresns.home') && fs_config('default_homepage') == 'comment') text-white active @endif"
                                href="{{ route('fresns.conversation.index') }}">
                                {{ fs_config('channel_comment_name') }}
                            </a>
                        </li>
                    @endif
                </ul>

                @if (! Route::is('fresns.editor.*'))
                    @if (fs_user()->check())
                        @if (fs_config('forumx_quick_publish'))
                            <button class="btn btn-light btn-sm rounded-0 px-4 my-4 my-lg-0 ms-3 ms-lg-0 me-2" type="button" data-bs-toggle="modal" data-bs-target="#createModal">{{ fs_config('publish_post_name') }}</button>
                        @else
                            <a class="btn btn-light btn-sm rounded-0 px-4 my-4 my-lg-0 ms-3 ms-lg-0 me-2" href="{{ route('fresns.editor.post') }}">{{ fs_config('publish_post_name') }}</a>
                        @endif
                    @else
                        <button class="btn btn-light btn-sm rounded-0 px-4 my-4 my-lg-0 ms-3 ms-lg-0 me-2" type="button" data-bs-toggle="modal" data-bs-target="#commentTipModal">{{ fs_config('publish_post_name') }}</button>
                    @endif
                @endif

                <div class="d-block d-sm-none bg-light mb-3 p-2">
                    @if (fs_user()->check())
                        @include('commons.user-info')
                    @else
                        @include('commons.user-login')
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="container clearfix fs-search py-2">
        <div class="float-start clearfix">
            <form action="{{ route('fresns.search.index') }}" method="get">
                <input type="text" class="form-control float-start search-text" name="searchKey" value="{{ request('searchKey') }}" placeholder="{{ fs_lang('search') }}">
                <select class="form-select float-start search-type" name="searchType">
                    <option value="user">{{ fs_config('user_name') }}</option>
                    <option value="group">{{ fs_config('group_name') }}</option>
                    <option value="hashtag">{{ fs_config('hashtag_name') }}</option>
                    <option value="post" selected>{{ fs_config('post_name') }}</option>
                    <option value="comment">{{ fs_config('comment_name') }}</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm ms-2 search-btn"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="float-start fs-text-decoration ms-lg-3 mt-1">
            <span class="fw-bolder fs-8 me-2">{{ fs_config('channel_hashtag_list_name') }}:</span>
            @foreach(fs_content_list('hashtag', 'list') as $hashtag)
                <a class="fs-8 me-2" href="{{ route('fresns.hashtag.detail', ['htid' => $hashtag['htid']]) }}">{{ $hashtag['name'] }}</a>
            @endforeach
        </div>
    </div>
</header>
