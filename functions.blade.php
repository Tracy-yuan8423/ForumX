@extends('FsView::commons.functionLayout')

@section('body')
    <main>
        <div class="container-lg p-0 p-lg-3">
            <div class="bg-white shadow-sm mt-4 mt-lg-2 p-3 p-lg-5">
                <div class="row mb-2">
                    <div class="col-7">
                        <h3>{{ $lang['name'] }}</h3>
                        <p class="text-secondary">{{ $lang['description'] }}</p>
                    </div>
                    <div class="col-5 text-end"></div>
                </div>
                {{-- 主题模板设置 开始 --}}
                <form class="mt-4" action="{{route('panel.theme.functions.update', ['theme' => 'ForumX'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    {{-- 菜单导航顺序 --}}
                    <div class="row mb-4">
                        <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['menuConfig'] }}</label>
                        <div class="col-lg-6">
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ __('FsLang::panel.portal') }}</span>
                                <select class="form-select" name="fs_forumx_navbar_portal">
                                    <option value="0" @if ($params['fs_forumx_navbar_portal']['value'] == 0) selected @endif>1</option>
                                    <option value="1" @if ($params['fs_forumx_navbar_portal']['value'] == 1) selected @endif>2</option>
                                    <option value="2" @if ($params['fs_forumx_navbar_portal']['value'] == 2) selected @endif>3</option>
                                    <option value="3" @if ($params['fs_forumx_navbar_portal']['value'] == 3) selected @endif>4</option>
                                    <option value="4" @if ($params['fs_forumx_navbar_portal']['value'] == 4) selected @endif>5</option>
                                    <option value="5" @if ($params['fs_forumx_navbar_portal']['value'] == 5) selected @endif>6</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ __('FsLang::panel.user') }}</span>
                                <select class="form-select" name="fs_forumx_navbar_user">
                                    <option value="0" @if ($params['fs_forumx_navbar_user']['value'] == 0) selected @endif>1</option>
                                    <option value="1" @if ($params['fs_forumx_navbar_user']['value'] == 1) selected @endif>2</option>
                                    <option value="2" @if ($params['fs_forumx_navbar_user']['value'] == 2) selected @endif>3</option>
                                    <option value="3" @if ($params['fs_forumx_navbar_user']['value'] == 3) selected @endif>4</option>
                                    <option value="4" @if ($params['fs_forumx_navbar_user']['value'] == 4) selected @endif>5</option>
                                    <option value="5" @if ($params['fs_forumx_navbar_user']['value'] == 5) selected @endif>6</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ __('FsLang::panel.group') }}</span>
                                <select class="form-select" name="fs_forumx_navbar_group">
                                    <option value="0" @if ($params['fs_forumx_navbar_group']['value'] == 0) selected @endif>1</option>
                                    <option value="1" @if ($params['fs_forumx_navbar_group']['value'] == 1) selected @endif>2</option>
                                    <option value="2" @if ($params['fs_forumx_navbar_group']['value'] == 2) selected @endif>3</option>
                                    <option value="3" @if ($params['fs_forumx_navbar_group']['value'] == 3) selected @endif>4</option>
                                    <option value="4" @if ($params['fs_forumx_navbar_group']['value'] == 4) selected @endif>5</option>
                                    <option value="5" @if ($params['fs_forumx_navbar_group']['value'] == 5) selected @endif>6</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ __('FsLang::panel.hashtag') }}</span>
                                <select class="form-select" name="fs_forumx_navbar_hashtag">
                                    <option value="0" @if ($params['fs_forumx_navbar_hashtag']['value'] == 0) selected @endif>1</option>
                                    <option value="1" @if ($params['fs_forumx_navbar_hashtag']['value'] == 1) selected @endif>2</option>
                                    <option value="2" @if ($params['fs_forumx_navbar_hashtag']['value'] == 2) selected @endif>3</option>
                                    <option value="3" @if ($params['fs_forumx_navbar_hashtag']['value'] == 3) selected @endif>4</option>
                                    <option value="4" @if ($params['fs_forumx_navbar_hashtag']['value'] == 4) selected @endif>5</option>
                                    <option value="5" @if ($params['fs_forumx_navbar_hashtag']['value'] == 5) selected @endif>6</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ __('FsLang::panel.post') }}</span>
                                <select class="form-select" name="fs_forumx_navbar_post">
                                    <option value="0" @if ($params['fs_forumx_navbar_post']['value'] == 0) selected @endif>1</option>
                                    <option value="1" @if ($params['fs_forumx_navbar_post']['value'] == 1) selected @endif>2</option>
                                    <option value="2" @if ($params['fs_forumx_navbar_post']['value'] == 2) selected @endif>3</option>
                                    <option value="3" @if ($params['fs_forumx_navbar_post']['value'] == 3) selected @endif>4</option>
                                    <option value="4" @if ($params['fs_forumx_navbar_post']['value'] == 4) selected @endif>5</option>
                                    <option value="5" @if ($params['fs_forumx_navbar_post']['value'] == 5) selected @endif>6</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ __('FsLang::panel.comment') }}</span>
                                <select class="form-select" name="fs_forumx_navbar_comment">
                                    <option value="0" @if ($params['fs_forumx_navbar_comment']['value'] == 0) selected @endif>1</option>
                                    <option value="1" @if ($params['fs_forumx_navbar_comment']['value'] == 1) selected @endif>2</option>
                                    <option value="2" @if ($params['fs_forumx_navbar_comment']['value'] == 2) selected @endif>3</option>
                                    <option value="3" @if ($params['fs_forumx_navbar_comment']['value'] == 3) selected @endif>4</option>
                                    <option value="4" @if ($params['fs_forumx_navbar_comment']['value'] == 4) selected @endif>5</option>
                                    <option value="5" @if ($params['fs_forumx_navbar_comment']['value'] == 5) selected @endif>6</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- 小组主页显示样式 --}}
                    <div class="row mb-4">
                        <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['groupConfig'] }}</label>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <select class="form-select" name="fs_forumx_group_index">
                                    <option selected disabled>{{ $lang['option_tip'] }}</option>
                                    <option value="1" @if ($params['fs_forumx_group_index']['value'] == 1) selected @endif>1</option>
                                    <option value="2" @if ($params['fs_forumx_group_index']['value'] == 2) selected @endif>2</option>
                                    <option value="3" @if ($params['fs_forumx_group_index']['value'] == 3) selected @endif>3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- 加载动效 --}}
                    <div class="row mb-4">
                        <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['loadingConfig'] }}</label>
                        <div class="col-lg-6 mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fs_theme_loading" id="loading_true" value="true" {{ ($params['fs_theme_loading']['value'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="loading_true">{{ __('FsLang::panel.option_activate') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fs_theme_loading" id="loading_false" value="false" {{ ! ($params['fs_theme_loading']['value'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="loading_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                            </div>
                        </div>
                    </div>

                    {{-- 快速发帖 --}}
                    <div class="row mb-4">
                        <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['quickPublishConfig'] }}</label>
                        <div class="col-lg-6 mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fs_theme_quick_publish" id="quick_publish_true" value="true" {{ ($params['fs_theme_quick_publish']['value'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="quick_publish_true">{{ __('FsLang::panel.option_activate') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fs_theme_quick_publish" id="quick_publish_false" value="false" {{ ! ($params['fs_theme_quick_publish']['value'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="quick_publish_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                            </div>
                        </div>
                    </div>

                    {{-- 消息页是否显示 --}}
                    <div class="row mb-4">
                        <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['notificationConfig'] }}</label>
                        <div class="col-lg-10 mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_systems" name="fs_theme_notifications[]" value="systems" {{ in_array('systems', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_systems">{{ $lang['notification_systems'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_recommends" name="fs_theme_notifications[]" value="recommends" {{ in_array('recommends', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_recommends">{{ $lang['notification_recommends'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_likes" name="fs_theme_notifications[]" value="likes" {{ in_array('likes', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_likes">{{ $lang['notification_likes'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_dislikes" name="fs_theme_notifications[]" value="dislikes" {{ in_array('dislikes', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_dislikes">{{ $lang['notification_dislikes'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_follows" name="fs_theme_notifications[]" value="follows" {{ in_array('follows', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_follows">{{ $lang['notification_follows'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_blocks" name="fs_theme_notifications[]" value="blocks" {{ in_array('blocks', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_blocks">{{ $lang['notification_blocks'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_mentions" name="fs_theme_notifications[]" value="mentions" {{ in_array('mentions', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_mentions">{{ $lang['notification_mentions'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_comments" name="fs_theme_notifications[]" value="comments" {{ in_array('comments', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_comments">{{ $lang['notification_comments'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="notification_quotes" name="fs_theme_notifications[]" value="quotes" {{ in_array('quotes', $params['fs_theme_notifications']['value'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="notification_quotes">{{ $lang['notification_quotes'] }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10"><button type="submit" class="btn btn-primary">{{ $lang['save'] }}</button></div>
                    </div>
                </form>
                {{-- 主题模板设置 结束 --}}
            </div>
        </div>
    </main>
@endsection
