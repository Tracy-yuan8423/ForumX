<div class="x-user-info me-3 mt-2">
    <div class="d-flex">
        <i class="bi bi-person-fill me-1" style="color: #7DA0CC;"></i>
        <a href="{{ fs_route(route('fresns.account.index')) }}">{{ fs_user('detail.nickname') }}</a>
        <div class="vr mx-2"></div>
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('userMy') }}</a>
            <ul class="dropdown-menu">
                {{-- 草稿 --}}
                <li>
                    <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.editor.drafts', ['type' => 'posts'])) }}">
                        {{ fs_db_config('menu_editor_drafts') }}

                        @if (array_sum(fs_user_panel('draftCount')) > 0)
                            <span class="badge bg-primary">{{ array_sum(fs_user_panel('draftCount')) }}</span>
                        @endif
                    </a>
                </li>
                {{-- 钱包 --}}
                @if (fs_api_config('wallet_status'))
                    <li><a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.account.wallet')) }}">{{ fs_db_config('menu_account_wallet') }}</a></li>
                @endif
                {{-- 名下用户 --}}
                @if (count(fs_account('detail.users')) > 1)
                    <li><a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.account.users')) }}">{{ fs_db_config('menu_account_users') }}</a></li>
                @endif
            </ul>
        </div>
        <div class="vr mx-2"></div>
        <a href="{{ fs_route(route('fresns.account.settings')) }}">{{ fs_db_config('menu_account_settings') }}</a>
        <div class="vr mx-2"></div>
        <a href="{{ fs_route(route('fresns.messages.index')) }}">
            {{ fs_db_config('menu_conversations') }}
            @if (fs_user_panel('conversations.unreadMessages') > 0)
                <span class="badge bg-danger">{{ fs_user_panel('conversations.unreadMessages') }}</span>
            @endif
        </a>
        <div class="vr mx-2"></div>
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ fs_db_config('menu_notifications') }}
                @if (array_sum(fs_user_panel('unreadNotifications')) > 0)
                    <span class="badge bg-danger">{{ array_sum(fs_user_panel('unreadNotifications')) }}</span>
                @endif
            </a>
            <ul class="dropdown-menu">
                {{-- all notifications --}}
                <li>
                    <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index')) }}">
                        {{ fs_db_config('menu_notifications_all') }}
                        @if (array_sum(fs_user_panel('unreadNotifications')) > 0)
                            <span class="badge bg-danger">{{ array_sum(fs_user_panel('unreadNotifications')) }}</span>
                        @endif
                    </a>
                </li>

                {{-- system notifications --}}
                @if (in_array('systems', fs_db_config('fs_theme_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index', ['types' => 1])) }}">
                            {{ fs_db_config('menu_notifications_systems') }}
                            @if (fs_user_panel('unreadNotifications.systems') > 0)
                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.systems') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- recommend notifications --}}
                @if (in_array('recommends', fs_db_config('fs_theme_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index', ['types' => 2])) }}">
                            {{ fs_db_config('menu_notifications_recommends') }}
                            @if (fs_user_panel('unreadNotifications.recommends') > 0)
                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.recommends') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- like notifications --}}
                @if (in_array('likes', fs_db_config('fs_theme_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index', ['types' => 3])) }}">
                            {{ fs_db_config('menu_notifications_likes') }}
                            @if (fs_user_panel('unreadNotifications.likes') > 0)
                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.likes') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- dislike notifications --}}
                @if (in_array('dislikes', fs_db_config('fs_theme_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index', ['types' => 4])) }}">
                            {{ fs_db_config('menu_notifications_dislikes') }}
                            @if (fs_user_panel('unreadNotifications.dislikes') > 0)
                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.dislikes') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- follow notifications --}}
                @if (in_array('follows', fs_db_config('fs_theme_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index', ['types' => 5])) }}">
                            {{ fs_db_config('menu_notifications_follows') }}
                            @if (fs_user_panel('unreadNotifications.follows') > 0)
                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.follows') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- block notifications --}}
                @if (in_array('blocks', fs_db_config('fs_theme_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index', ['types' => 6])) }}">
                            {{ fs_db_config('menu_notifications_blocks') }}
                            @if (fs_user_panel('unreadNotifications.blocks') > 0)
                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.blocks') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- mention notifications --}}
                @if (in_array('mentions', fs_db_config('fs_theme_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index', ['types' => 7])) }}">
                            {{ fs_db_config('menu_notifications_mentions') }}
                            @if (fs_user_panel('unreadNotifications.mentions') > 0)
                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.mentions') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- comment notifications --}}
                @if (in_array('comments', fs_db_config('fs_theme_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ fs_route(route('fresns.notifications.index', ['types' => 8])) }}">
                            {{ fs_db_config('menu_notifications_comments') }}
                            @if (fs_user_panel('unreadNotifications.comments') > 0)
                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.comments') }}</span>
                            @endif
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="vr mx-2"></div>
        <a href="{{ fs_route(route('fresns.account.logout')) }}">{{ fs_lang('accountLogout') }}</a>
    </div>

    <div class="d-flex mt-2 mt-lg-0">
        <div class="dropdown ms-lg-auto">
            <a class="nav-link dropdown-toggle" href="{{ fs_route(route('fresns.account.user.extcredits')) }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_user('detail.stats.extcredits1Name') ?? 'Extcredits 1' }}: {{ fs_user('detail.stats.extcredits1') ?? 0 }}</a>
            <ul class="dropdown-menu">
                @if (fs_user('detail.stats.extcredits1State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ fs_route(route('fresns.account.user.extcredits', ['extcreditsId' => 1])) }}">{{ fs_user('detail.stats.extcredits1Name') ?? 'Extcredits 1' }}</a>:
                        {{ fs_user('detail.stats.extcredits1') ?? 0 }}
                        {{ fs_user('detail.stats.extcredits1Unit') }}
                    </li>
                @endif
                @if (fs_user('detail.stats.extcredits2State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ fs_route(route('fresns.account.user.extcredits', ['extcreditsId' => 2])) }}">{{ fs_user('detail.stats.extcredits2Name') ?? 'Extcredits 2' }}</a>:
                        {{ fs_user('detail.stats.extcredits2') ?? 0 }}
                        {{ fs_user('detail.stats.extcredits2Unit') }}
                    </li>
                @endif
                @if (fs_user('detail.stats.extcredits3State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ fs_route(route('fresns.account.user.extcredits', ['extcreditsId' => 3])) }}">{{ fs_user('detail.stats.extcredits3Name') ?? 'Extcredits 3' }}</a>:
                        {{ fs_user('detail.stats.extcredits3') ?? 0 }}
                        {{ fs_user('detail.stats.extcredits3Unit') }}
                    </li>
                @endif
                @if (fs_user('detail.stats.extcredits4State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ fs_route(route('fresns.account.user.extcredits', ['extcreditsId' => 4])) }}">{{ fs_user('detail.stats.extcredits4Name') ?? 'Extcredits 4' }}</a>:
                        {{ fs_user('detail.stats.extcredits4') ?? 0 }}
                        {{ fs_user('detail.stats.extcredits4Unit') }}
                    </li>
                @endif
                @if (fs_user('detail.stats.extcredits5State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ fs_route(route('fresns.account.user.extcredits', ['extcreditsId' => 5])) }}">{{ fs_user('detail.stats.extcredits5Name') ?? 'Extcredits 5' }}</a>:
                        {{ fs_user('detail.stats.extcredits5') ?? 0 }}
                        {{ fs_user('detail.stats.extcredits5Unit') }}
                    </li>
                @endif
            </ul>
        </div>
        <div class="vr mx-3"></div>
        <a href="{{ fs_route(route('fresns.account.index')) }}">{{ fs_db_config('user_role_name') }}: {{ fs_user('detail.roleName') }}</a>
    </div>
</div>
<div class="x-user-avatar d-none d-sm-block">
    <div class="border rounded shadow-sm" style="padding:2px;">
        <a href="{{ fs_route(route('fresns.account.index')) }}"><img src="{{ fs_user('detail.avatar') }}" loading="lazy" class="rounded" width="48" height="48"></a>
    </div>
</div>
