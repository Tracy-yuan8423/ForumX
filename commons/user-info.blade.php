<div class="x-user-info me-3 mt-2">
    <div class="d-flex">
        <i class="bi bi-person-fill me-1" style="color: #7DA0CC;"></i>
        <a href="{{ route('fresns.me.index') }}">{{ fs_user('detail.nickname') }}</a>
        <div class="vr mx-2"></div>
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('me') }}</a>
            <ul class="dropdown-menu">
                {{-- 草稿 --}}
                <li>
                    <a class="dropdown-item text-decoration-none" href="{{ route('fresns.me.drafts') }}">
                        {{ fs_config('channel_me_drafts_name') }}

                        @if (array_sum(fs_user_overview('draftCount')) > 0)
                            <span class="badge bg-primary">{{ array_sum(fs_user_overview('draftCount')) }}</span>
                        @endif
                    </a>
                </li>
                {{-- 钱包 --}}
                @if (fs_config('wallet_status'))
                    <li><a class="dropdown-item text-decoration-none" href="{{ route('fresns.me.wallet') }}">{{ fs_config('channel_me_wallet_name') }}</a></li>
                @endif
                {{-- 名下用户 --}}
                @if (count(fs_account('detail.users')) > 1)
                    <li><a class="dropdown-item text-decoration-none" href="{{ route('fresns.me.users') }}">{{ fs_config('channel_me_users_name') }}</a></li>
                @endif
            </ul>
        </div>
        <div class="vr mx-2"></div>
        <a href="{{ route('fresns.me.settings') }}">{{ fs_config('channel_me_settings_name') }}</a>
        <div class="vr mx-2"></div>
        <a href="{{ route('fresns.conversation.index') }}">
            {{ fs_config('channel_conversations_name') }}
            @if (fs_user_overview('conversations.unreadMessages') > 0)
                <span class="badge bg-danger">{{ fs_user_overview('conversations.unreadMessages') }}</span>
            @endif
        </a>
        <div class="vr mx-2"></div>
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ fs_config('channel_notifications_name') }}
                @if (fs_user_overview('unreadNotifications.all') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.all') }}</span>
                @endif
            </a>
            <ul class="dropdown-menu">
                {{-- all notifications --}}
                <li>
                    <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index') }}">
                        {{ fs_config('channel_notifications_all_name') }}
                        @if (fs_user_overview('unreadNotifications.all') > 0)
                            <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.all') }}</span>
                        @endif
                    </a>
                </li>

                {{-- system notifications --}}
                @if (in_array('systems', fs_config('fs_forumx_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index', ['types' => 1]) }}">
                            {{ fs_config('channel_notifications_systems_name') }}
                            @if (fs_user_overview('unreadNotifications.systems') > 0)
                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.systems') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- recommend notifications --}}
                @if (in_array('recommends', fs_config('fs_forumx_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index', ['types' => 2]) }}">
                            {{ fs_config('channel_notifications_recommends_name') }}
                            @if (fs_user_overview('unreadNotifications.recommends') > 0)
                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.recommends') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- like notifications --}}
                @if (in_array('likes', fs_config('fs_forumx_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index', ['types' => 3]) }}">
                            {{ fs_config('channel_notifications_likes_name') }}
                            @if (fs_user_overview('unreadNotifications.likes') > 0)
                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.likes') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- dislike notifications --}}
                @if (in_array('dislikes', fs_config('fs_forumx_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index', ['types' => 4]) }}">
                            {{ fs_config('channel_notifications_dislikes_name') }}
                            @if (fs_user_overview('unreadNotifications.dislikes') > 0)
                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.dislikes') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- follow notifications --}}
                @if (in_array('follows', fs_config('fs_forumx_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index', ['types' => 5]) }}">
                            {{ fs_config('channel_notifications_follows_name') }}
                            @if (fs_user_overview('unreadNotifications.follows') > 0)
                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.follows') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- block notifications --}}
                @if (in_array('blocks', fs_config('fs_forumx_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index', ['types' => 6]) }}">
                            {{ fs_config('channel_notifications_blocks_name') }}
                            @if (fs_user_overview('unreadNotifications.blocks') > 0)
                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.blocks') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- mention notifications --}}
                @if (in_array('mentions', fs_config('fs_forumx_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index', ['types' => 7]) }}">
                            {{ fs_config('channel_notifications_mentions_name') }}
                            @if (fs_user_overview('unreadNotifications.mentions') > 0)
                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.mentions') }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                {{-- comment notifications --}}
                @if (in_array('comments', fs_config('fs_forumx_notifications', [])))
                    <li>
                        <a class="dropdown-item text-decoration-none" href="{{ route('fresns.notification.index', ['types' => 8]) }}">
                            {{ fs_config('channel_notifications_comments_name') }}
                            @if (fs_user_overview('unreadNotifications.comments') > 0)
                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.comments') }}</span>
                            @endif
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="vr mx-2"></div>
        <a href="{{ route('fresns.me.logout') }}">{{ fs_lang('accountLogout') }}</a>
    </div>

    <div class="d-flex mt-2 mt-lg-0">
        <div class="dropdown ms-lg-auto">
            <a class="nav-link dropdown-toggle" href="{{ route('fresns.me.extcredits') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_user('detail.stats.extcredits1Name') ?? 'Extcredits 1' }}: {{ fs_user('detail.stats.extcredits1') ?? 0 }}</a>
            <ul class="dropdown-menu">
                @if (fs_user('detail.stats.extcredits1State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ route('fresns.me.extcredits', ['extcreditsId' => 1]) }}">{{ fs_user('detail.stats.extcredits1Name') ?? 'Extcredits 1' }}</a>
                        <span class="fs-8">: {{ fs_user('detail.stats.extcredits1') ?? 0 }} {{ fs_user('detail.stats.extcredits1Unit') }}</span>
                    </li>
                @endif
                @if (fs_user('detail.stats.extcredits2State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ route('fresns.me.extcredits', ['extcreditsId' => 2]) }}">{{ fs_user('detail.stats.extcredits2Name') ?? 'Extcredits 2' }}</a>
                        <span class="fs-8">: {{ fs_user('detail.stats.extcredits2') ?? 0 }} {{ fs_user('detail.stats.extcredits2Unit') }}</span>
                    </li>
                @endif
                @if (fs_user('detail.stats.extcredits3State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ route('fresns.me.extcredits', ['extcreditsId' => 3]) }}">{{ fs_user('detail.stats.extcredits3Name') ?? 'Extcredits 3' }}</a>
                        <span class="fs-8">: {{ fs_user('detail.stats.extcredits3') ?? 0 }} {{ fs_user('detail.stats.extcredits3Unit') }}</span>
                    </li>
                @endif
                @if (fs_user('detail.stats.extcredits4State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ route('fresns.me.extcredits', ['extcreditsId' => 4]) }}">{{ fs_user('detail.stats.extcredits4Name') ?? 'Extcredits 4' }}</a>
                        <span class="fs-8">: {{ fs_user('detail.stats.extcredits4') ?? 0 }} {{ fs_user('detail.stats.extcredits4Unit') }}</span>
                    </li>
                @endif
                @if (fs_user('detail.stats.extcredits5State'))
                    <li class="ms-3">
                        <a class="text-decoration-none" href="{{ route('fresns.me.extcredits', ['extcreditsId' => 5]) }}">{{ fs_user('detail.stats.extcredits5Name') ?? 'Extcredits 5' }}</a>
                        <span class="fs-8">: {{ fs_user('detail.stats.extcredits5') ?? 0 }} {{ fs_user('detail.stats.extcredits5Unit') }}</span>
                    </li>
                @endif
            </ul>
        </div>
        <div class="vr mx-3"></div>
        <a href="{{ route('fresns.me.index') }}">{{ fs_config('user_role_name') }}: {{ fs_user('detail.roleName') }}</a>
    </div>
</div>
<div class="x-user-avatar d-none d-sm-block">
    <div class="border rounded shadow-sm" style="padding:2px;">
        <a href="{{ route('fresns.me.index') }}"><img src="{{ fs_user('detail.avatar') }}" loading="lazy" class="rounded" width="48" height="48"></a>
    </div>
</div>
