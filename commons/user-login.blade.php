<div class="mt-lg-3">
    <a class="btn btn-primary me-3 text-decoration-none fs-6 px-4" href="{{ fs_route(route('fresns.account.login', ['redirectURL' => request()->fullUrl()])) }}" role="button">{{ fs_lang('accountLogin') }}</a>

    @if (fs_api_config('site_public_status'))
        @if (fs_api_config('site_public_service'))
            <button class="btn btn-outline-success text-decoration-none fs-6 px-4" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-type="account"
                data-scene="join"
                data-post-message-key="fresnsJoin"
                data-title="{{ fs_lang('accountRegister') }}"
                data-url="{{ fs_api_config('site_public_service') }}">
                {{ fs_lang('accountRegister') }}
            </button>
        @else
            <a class="btn btn-outline-success text-decoration-none fs-6 px-4" href="{{ fs_route(route('fresns.account.register', ['redirectURL' => request()->fullUrl()])) }}" role="button">{{ fs_lang('accountRegister') }}</a>
        @endif
    @endif
</div>
