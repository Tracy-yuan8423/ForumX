@extends('ThemeFunctions::layout')

@section('body')
    <header class="border-bottom mb-3 pt-5 ps-5 pb-3">
        <h3>{{ $lang['name'] }}</h3>
        <p class="text-secondary"><i class="bi bi-palette"></i> {{ $lang['description'] }}</p>
    </header>

    <main class="my-5">
        <form action="{{ route('fresns.api.functions', ['fskey' => 'ForumX']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            {{-- 菜单导航顺序 --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['menuConfig'] }}</label>
                <div class="col-lg-6">
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.portal') }}</span>
                        <select class="form-select" name="forumx_navbar_portal">
                            <option value="0" @if ($params['forumx_navbar_portal'] == 0) selected @endif>1</option>
                            <option value="1" @if ($params['forumx_navbar_portal'] == 1) selected @endif>2</option>
                            <option value="2" @if ($params['forumx_navbar_portal'] == 2) selected @endif>3</option>
                            <option value="3" @if ($params['forumx_navbar_portal'] == 3) selected @endif>4</option>
                            <option value="4" @if ($params['forumx_navbar_portal'] == 4) selected @endif>5</option>
                            <option value="5" @if ($params['forumx_navbar_portal'] == 5) selected @endif>6</option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.user') }}</span>
                        <select class="form-select" name="forumx_navbar_user">
                            <option value="0" @if ($params['forumx_navbar_user'] == 0) selected @endif>1</option>
                            <option value="1" @if ($params['forumx_navbar_user'] == 1) selected @endif>2</option>
                            <option value="2" @if ($params['forumx_navbar_user'] == 2) selected @endif>3</option>
                            <option value="3" @if ($params['forumx_navbar_user'] == 3) selected @endif>4</option>
                            <option value="4" @if ($params['forumx_navbar_user'] == 4) selected @endif>5</option>
                            <option value="5" @if ($params['forumx_navbar_user'] == 5) selected @endif>6</option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.group') }}</span>
                        <select class="form-select" name="forumx_navbar_group">
                            <option value="0" @if ($params['forumx_navbar_group'] == 0) selected @endif>1</option>
                            <option value="1" @if ($params['forumx_navbar_group'] == 1) selected @endif>2</option>
                            <option value="2" @if ($params['forumx_navbar_group'] == 2) selected @endif>3</option>
                            <option value="3" @if ($params['forumx_navbar_group'] == 3) selected @endif>4</option>
                            <option value="4" @if ($params['forumx_navbar_group'] == 4) selected @endif>5</option>
                            <option value="5" @if ($params['forumx_navbar_group'] == 5) selected @endif>6</option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.hashtag') }}</span>
                        <select class="form-select" name="forumx_navbar_hashtag">
                            <option value="0" @if ($params['forumx_navbar_hashtag'] == 0) selected @endif>1</option>
                            <option value="1" @if ($params['forumx_navbar_hashtag'] == 1) selected @endif>2</option>
                            <option value="2" @if ($params['forumx_navbar_hashtag'] == 2) selected @endif>3</option>
                            <option value="3" @if ($params['forumx_navbar_hashtag'] == 3) selected @endif>4</option>
                            <option value="4" @if ($params['forumx_navbar_hashtag'] == 4) selected @endif>5</option>
                            <option value="5" @if ($params['forumx_navbar_hashtag'] == 5) selected @endif>6</option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.post') }}</span>
                        <select class="form-select" name="forumx_navbar_post">
                            <option value="0" @if ($params['forumx_navbar_post'] == 0) selected @endif>1</option>
                            <option value="1" @if ($params['forumx_navbar_post'] == 1) selected @endif>2</option>
                            <option value="2" @if ($params['forumx_navbar_post'] == 2) selected @endif>3</option>
                            <option value="3" @if ($params['forumx_navbar_post'] == 3) selected @endif>4</option>
                            <option value="4" @if ($params['forumx_navbar_post'] == 4) selected @endif>5</option>
                            <option value="5" @if ($params['forumx_navbar_post'] == 5) selected @endif>6</option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.comment') }}</span>
                        <select class="form-select" name="forumx_navbar_comment">
                            <option value="0" @if ($params['forumx_navbar_comment'] == 0) selected @endif>1</option>
                            <option value="1" @if ($params['forumx_navbar_comment'] == 1) selected @endif>2</option>
                            <option value="2" @if ($params['forumx_navbar_comment'] == 2) selected @endif>3</option>
                            <option value="3" @if ($params['forumx_navbar_comment'] == 3) selected @endif>4</option>
                            <option value="4" @if ($params['forumx_navbar_comment'] == 4) selected @endif>5</option>
                            <option value="5" @if ($params['forumx_navbar_comment'] == 5) selected @endif>6</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- 小组主页显示样式 --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['groupConfig'] }}</label>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <select class="form-select" name="forumx_group_index">
                            <option selected disabled>{{ $lang['option_tip'] }}</option>
                            <option value="1" @if ($params['forumx_group_index'] == 1) selected @endif>1</option>
                            <option value="2" @if ($params['forumx_group_index'] == 2) selected @endif>2</option>
                            <option value="3" @if ($params['forumx_group_index'] == 3) selected @endif>3</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- 加载动效 --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['loadingConfig'] }}</label>
                <div class="col-lg-6 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="forumx_loading" id="loading_true" value="true" {{ $params['forumx_loading'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_true">{{ __('FsLang::panel.option_activate') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="forumx_loading" id="loading_false" value="false" {{ ! $params['forumx_loading'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                    </div>
                </div>
            </div>

            {{-- 快速发帖 --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['quickPublishConfig'] }}</label>
                <div class="col-lg-6 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="forumx_quick_publish" id="quick_publish_true" value="true" {{ $params['forumx_quick_publish'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="quick_publish_true">{{ __('FsLang::panel.option_activate') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="forumx_quick_publish" id="quick_publish_false" value="false" {{ ! $params['forumx_quick_publish'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="quick_publish_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                    </div>
                </div>
            </div>

            {{-- 消息页是否显示 --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['notificationConfig'] }}</label>
                <div class="col-lg-10 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_systems" name="forumx_notifications[]" value="systems" {{ in_array('systems', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_systems">{{ $lang['notification_systems'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_recommends" name="forumx_notifications[]" value="recommends" {{ in_array('recommends', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_recommends">{{ $lang['notification_recommends'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_likes" name="forumx_notifications[]" value="likes" {{ in_array('likes', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_likes">{{ $lang['notification_likes'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_dislikes" name="forumx_notifications[]" value="dislikes" {{ in_array('dislikes', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_dislikes">{{ $lang['notification_dislikes'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_follows" name="forumx_notifications[]" value="follows" {{ in_array('follows', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_follows">{{ $lang['notification_follows'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_blocks" name="forumx_notifications[]" value="blocks" {{ in_array('blocks', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_blocks">{{ $lang['notification_blocks'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_mentions" name="forumx_notifications[]" value="mentions" {{ in_array('mentions', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_mentions">{{ $lang['notification_mentions'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_comments" name="forumx_notifications[]" value="comments" {{ in_array('comments', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_comments">{{ $lang['notification_comments'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_quotes" name="forumx_notifications[]" value="quotes" {{ in_array('quotes', $params['forumx_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_quotes">{{ $lang['notification_quotes'] }}</label>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-10"><button type="submit" class="btn btn-primary">{{ $lang['save'] }}</button></div>
            </div>
        </form>
    </main>

    <footer class="copyright text-center">
        <p class="my-5 text-muted">&copy; <span class="copyright-year"></span> Fresns</p>
    </footer>
@endsection
