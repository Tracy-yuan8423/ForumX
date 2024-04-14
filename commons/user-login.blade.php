<div class="mt-lg-3">
    <button class="btn btn-primary me-3 text-decoration-none fs-6 px-4" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
        data-modal-height="700px"
        data-title="{{ fs_lang('accountLogin') }}"
        data-url="{{ fs_config('account_login_service') }}"
        data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
        data-post-message-key="fresnsAccountSign">
        {{ fs_lang('accountLogin') }}
    </button>

    @if (fs_config('account_register_status'))
        <button class="btn btn-outline-success text-decoration-none fs-6 px-4" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
            data-modal-height="700px"
            data-title="{{ fs_lang('accountRegister') }}"
            data-url="{{ fs_config('account_register_service') }}"
            data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
            data-post-message-key="fresnsAccountSign">
            {{ fs_lang('accountRegister') }}
        </button>
    @endif
</div>
