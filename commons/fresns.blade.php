<!doctype html>
<html lang="{{ current_lang_tag() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Fresns" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title') - {{ fs_db_config('site_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ fs_db_config('site_name') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ fs_db_config('site_icon') }}">
    <link rel="icon" href="{{ fs_db_config('site_icon') }}">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css?v={{ $fresnsVersion }}">
    <link rel="stylesheet" href="/static/css/bootstrap-icons.min.css?v={{ $fresnsVersion }}">
    <link rel="stylesheet" href="/static/css/select2.min.css?v={{ $fresnsVersion }}">
    <link rel="stylesheet" href="/assets/themes/ForumX/css/atwho.min.css?v={{ $themeVersion }}">
    <link rel="stylesheet" href="/assets/themes/ForumX/css/prism.min.css?v={{ $themeVersion }}">
    <link rel="stylesheet" href="/assets/themes/ForumX/css/fresns.css?v={{ $themeVersion }}">
    <script src="/static/js/jquery.min.js"></script>
    @stack('style')
    @if (fs_db_config('website_stat_position') == 'head')
        {!! fs_db_config('website_stat_code') !!}
    @endif
</head>

<body>
    {{-- Language --}}
    @if (fs_api_config('language_status'))
        <div class="fs-lang-nav fs-text-decoration">
            <div class="container">
                @foreach(fs_api_config('language_menus') as $lang)
                    @if ($lang['isEnabled'])
                        <a class="me-2 @if (current_lang_tag() == $lang['langTag']) active @endif" hreflang="{{ $lang['langTag'] }}" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($lang['langTag'], null, [], true) }}">
                            {{ $lang['langName'] }}
                            @if ($lang['areaName'])
                                {{ '('.$lang['areaName'].')' }}
                            @endif
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    {{-- Header --}}
    @include('commons.header')

    {{-- Private mode user status handling --}}
    @if (fs_user()->check() && fs_user('detail.expired'))
        <div class="mt-5 pt-5">
            <div class="alert alert-warning mx-3" role="alert">
                <i class="bi bi-info-circle"></i>
                @if (fs_api_config('site_private_end_after') == 1)
                    {{ fs_lang('privateContentHide') }}
                @else
                    {{ fs_lang('privateContentShowOld') }}
                @endif

                <button class="btn btn-primary btn-sm ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-type="account"
                    data-scene="renewal"
                    data-post-message-key="fresnsRenewal"
                    data-title="{{ fs_lang('renewal') }}"
                    data-url="{{ fs_api_config('site_public_service') }}">
                    {{ fs_lang('renewal') }}
                </button>
            </div>
        </div>
    @endif

    {{-- Main --}}
    @yield('content')

    {{-- Fresns Extensions Modal --}}
    <div class="modal fade fresnsExtensions" id="fresnsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fresnsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fresnsModalLabel">Extensions title</h5>
                    <button type="button" class="btn-close btn-done-extensions" id="done-extensions" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding:0"></div>
            </div>
        </div>
    </div>

    {{-- Image Zoom Modal --}}
    <div class="modal fade image-zoom" id="imageZoom" tabindex="-1" aria-labelledby="imageZoomLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="mx-auto text-center">
                <img class="img-fluid" loading="lazy">
            </div>
        </div>
    </div>

    {{-- Quick Post Box --}}
    @if (fs_user()->check())
        @component('components.editor.post-box', [
            'group' => $group ?? null
        ])@endcomponent
    @endif

    {{-- Tip Toasts --}}
    <div class="fresns-tips">
        @include('commons.tips')
    </div>

    {{-- Footer --}}
    @include('commons.footer')

    {{-- Loading --}}
    @if (fs_db_config('fs_theme_loading'))
        <div id="loading" class="position-fixed top-50 start-50 translate-middle bg-light bg-opacity-75 rounded p-4" style="z-index:2048;display:none;">
            <div class="spinner"></div>
        </div>
    @endif

    {{-- User Auth --}}
    @include('commons.user-auth')

    {{-- No login comment tip --}}
    @if (fs_user()->guest())
        <div class="modal fade" id="commentTipModal" tabindex="-1" aria-labelledby="commentTipModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="commentTipModalLabel">{{ fs_db_config('publish_comment_name') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4 pb-5 text-center">
                        <p class="mt-2 mb-4 text-secondary">{{ fs_lang('errorNoLogin') }}</p>
            
                        <a class="btn btn-outline-success me-3" href="{{ fs_route(route('fresns.account.login', ['redirectURL' => request()->fullUrl()])) }}" role="button">{{ fs_lang('accountLogin') }}</a>
            
                        @if (fs_api_config('site_public_status'))
                            @if (fs_api_config('site_public_service'))
                                <button class="btn btn-success me-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                    data-type="account"
                                    data-scene="join"
                                    data-post-message-key="fresnsJoin"
                                    data-title="{{ fs_lang('accountRegister') }}"
                                    data-url="{{ fs_api_config('site_public_service') }}">
                                    {{ fs_lang('accountRegister') }}
                                </button>
                            @else
                                <a class="btn btn-success me-3" href="{{ fs_route(route('fresns.account.register', ['redirectURL' => request()->fullUrl()])) }}" role="button">{{ fs_lang('accountRegister') }}</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Stat Code --}}
    @if (fs_db_config('website_stat_position') == 'body')
        <div style="display:none;">{!! fs_db_config('website_stat_code') !!}</div>
    @endif
    <script src="/static/js/base64.js?v={{ $fresnsVersion }}"></script>
    <script src="/static/js/bootstrap.bundle.min.js?v={{ $fresnsVersion }}"></script>
    <script src="/static/js/select2.min.js?v={{ $fresnsVersion }}"></script>
    <script src="/static/js/masonry.pkgd.min.js?v={{ $themeVersion }}"></script>
    <script src="/static/js/iframeResizer.min.js?v={{ $fresnsVersion }}"></script>
    <script>
        window.ajaxGetList = false;
        window.siteName = "{{ fs_db_config('site_name') }}";
        window.siteIcon = "{{ fs_db_config('site_icon') }}";
        window.langTag = "{{ current_lang_tag() }}";
        window.userIdentifier = "{{ fs_api_config('user_identifier') }}";
        window.mentionStatus = {{ fs_api_config('mention_status') ? 1 : 0 }};
        window.hashtagStatus = {{ fs_api_config('hashtag_status') ? 1 : 0 }};
        window.hashtagFormat = {{ fs_api_config('hashtag_format') }};

        $('.fs-content-author').hover(function() {
            $(this).find('.dropdown-menu').addClass('show')
        }, function() {
            $(this).find('.dropdown-menu').removeClass('show')
        });
    </script>
    <script src="/assets/plugins/{{ $engineFskey }}/js/fresns-iframe.js?v={{ $engineVersion }}"></script>
    <script src="/assets/themes/ForumX/js/jquery.caret.min.js?v={{ $themeVersion }}"></script>
    <script src="/assets/themes/ForumX/js/atwho.min.js?v={{ $themeVersion }}"></script>
    <script src="/assets/themes/ForumX/js/prism.min.js?v={{ $themeVersion }}"></script>
    <script src="/assets/themes/ForumX/js/fresns.js?v={{ $themeVersion }}"></script>
    @stack('script')
</body>

</html>
