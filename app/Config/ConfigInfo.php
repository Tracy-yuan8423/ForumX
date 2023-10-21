<?php

/*
 * Fresns (https://fresns.org)
 * Copyright (C) 2021-Present Jevan Tang
 * Released under the Apache-2.0 License.
 */

namespace Plugins\ForumX\Config;

class ConfigInfo
{
    const NAMESPACE = 'ForumX';

    const ROUTE_NAME = 'forumx';

    const ITEMS = [
        [
            'item_key' => 'fs_forumx_loading',
            'item_value' => 'true',
            'item_type' => 'boolean', // number, string, boolean, array, object, file, plugin, plugins
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_quick_publish',
            'item_value' => 'true',
            'item_type' => 'boolean',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_editor_markdown',
            'item_value' => '{"quickPublish":1,"editor":1,"commentBox":1}',
            'item_type' => 'array',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_notifications',
            'item_value' => '["systems","recommends","likes","dislikes","follows","blocks","mentions","comments","quotes"]',
            'item_type' => 'array',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_navbar_portal',
            'item_value' => 0,
            'item_type' => 'number',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_navbar_user',
            'item_value' => 1,
            'item_type' => 'number',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_navbar_group',
            'item_value' => 2,
            'item_type' => 'number',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_navbar_hashtag',
            'item_value' => 3,
            'item_type' => 'number',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_navbar_post',
            'item_value' => 4,
            'item_type' => 'number',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_navbar_comment',
            'item_value' => 5,
            'item_type' => 'number',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'fs_forumx_group_index',
            'item_value' => 1,
            'item_type' => 'number',
            'item_tag' => 'themes',
        ],
    ];
}
