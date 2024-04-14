@extends('commons.fresns')

@section('title', fs_lang('editor'))

@section('content')
    <div class="container-fluid">
        <div class="fresns-editor">
            <form action="{{ route('fresns.api.post', ['path' => "/api/fresns/v1/editor/{$type}/draft/{$draft['detail']['did']}"]) }}" method="post" id="fresns-editor">
                <input type="hidden" name="type" value="{{ $type ?? '' }}" />
                <input type="hidden" name="gid" id="editor-group-gid" value="{{ $draft['detail']['group']['gid'] ?? '' }}" />
                {{-- 提示: 发表权限 --}}
                @if ($configs['publish']['limit']['status'] && $configs['publish']['limit']['isInTime'])
                    @component('components.editor.tip.publish', [
                        'publishConfig' => $configs['publish'],
                    ])@endcomponent
                @endif

                {{-- 提示: 编辑控件 --}}
                @if ($draft['editControls']['isEditDraft'] && ! in_array($draft['detail']['state'], [2, 3]))
                    @component('components.editor.tip.edit', [
                        'editControls' => $draft['editControls'],
                    ])@endcomponent
                @endif

                {{-- 提示: 草稿审核中或已发表 --}}
                @if (in_array($draft['detail']['state'], [2, 3]))
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> {{ $draft['detail']['state'] == 2 ? fs_lang('contentEditReviewTip') : fs_lang('contentEditPublishedTip') }}
                    </div>
                @endif

                {{-- 小组 --}}
                @if ($configs['editor']['group']['status'])
                    @component('components.editor.section.group', [
                        'groupConfig' => $configs['editor']['group'],
                        'did' => $draft['detail']['did'],
                        'group' => $draft['detail']['group'],
                    ])@endcomponent
                @endif

                {{-- 工具栏 --}}
                @component('components.editor.section.toolbar', [
                    'type' => $type,
                    'did' => $draft['detail']['did'],
                    'editorConfig' => $configs['editor'],
                ])@endcomponent

                {{-- 内容 开始 --}}
                <div class="editor-box p-3">
                    {{-- 标题 --}}
                    @if ($configs['editor']['title']['status'] || optional($draft['detail'])['title'])
                        @component('components.editor.section.title', [
                            'titleConfig' => $configs['editor']['title'],
                            'title' => $draft['detail']['title'] ?? '',
                        ])@endcomponent
                    @endif

                    {{-- 正文 --}}
                    <textarea class="form-control rounded-0 border-0 editor-content" name="content" id="content" rows="15" placeholder="{{ fs_lang('editorContent') }}">{{ $draft['detail']['content'] }}</textarea>

                    {{-- 文件内容 --}}
                    @component('components.editor.section.files', [
                        'files' => $draft['detail']['files'],
                    ])@endcomponent

                    {{-- 扩展内容 --}}
                    @component('components.editor.section.extends', [
                        'extends' => $draft['detail']['extends'],
                    ])@endcomponent

                    {{-- 阅读权限 --}}
                    @if ($draft['detail']['permissions']['readConfig'] ?? null)
                        @component('components.editor.section.config-read', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'readConfig' => $draft['detail']['permissions']['readConfig'],
                        ])@endcomponent
                    @endif

                    {{-- 扩展按钮 --}}
                    @if ($draft['detail']['permissions']['commentConfig']['action'] ?? null)
                        @component('components.editor.section.config-action-button', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'actionButton' => $draft['detail']['permissions']['commentConfig']['action'],
                        ])@endcomponent
                    @endif

                    {{-- 附属用户列表 --}}
                    @if ($draft['detail']['permissions']['associatedUserListConfig'] ?? null)
                        @component('components.editor.section.config-associated-user-list', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'associatedUserListConfig' => $draft['detail']['permissions']['associatedUserListConfig'],
                        ])@endcomponent
                    @endif

                    <hr>

                    {{-- 位置和匿名 开始 --}}
                    <div class="d-flex justify-content-between">
                        {{-- 位置 --}}
                        @if ($configs['editor']['location']['status'])
                            @component('components.editor.section.location', [
                                'type' => $type,
                                'did' => $draft['detail']['did'],
                                'locationConfig' => $configs['editor']['location'],
                                'locationInfo' => $draft['detail']['locationInfo'],
                                'geotag' => $draft['detail']['geotag'],
                            ])@endcomponent
                        @endif

                        {{-- 匿名 --}}
                        @if ($configs['editor']['anonymous'])
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="isAnonymous" value="1" id="isAnonymous" {{ $draft['detail']['isAnonymous'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="isAnonymous">{{ fs_lang('editorAnonymous') }}</label>
                            </div>
                        @endif
                    </div>
                    {{-- 位置和匿名 结束 --}}
                </div>
                {{-- 内容 结束 --}}

                {{-- 按钮 --}}
                <div class="editor-submit d-grid">
                    <button type="submit" class="btn btn-success btn-lg mt-2 mb-5 mx-3" {{ in_array($draft['detail']['state'], [2, 3]) ? 'disabled' : ''}}>
                        {{ fs_config("publish_{$type}_name") }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 上传 Modal --}}
    <div class="modal fade" id="fresnsUploadModal" tabindex="-1" aria-labelledby="fresnsUploadModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ fs_lang('uploadTip') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="mt-2" id="upload-form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="usageType" @if ($type === 'post') value="postDraft" @elseif ($type === "comment") value="commentDraft" @endif>
                        <input type="hidden" name="usageFsid" value="{{ $draft['detail']['did'] }}">
                        <input type="hidden" name="fileType">
                        <input type="hidden" name="uploadType">
                        <input type="file" name="files" class="form-control" id="fileInput">

                        {{-- progress bar --}}
                        <div class="progress mt-3 d-none" id="uploadProgressBar" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                        </div>

                        {{-- upload tip --}}
                        <label class="form-label mt-3 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('uploadTipExtensions') }}: <span id="extensions"></span></label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('uploadTipMaxSize') }}: <span id="maxSize"></span> MB</label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-none" id="maxDurationDiv">{{ fs_lang('uploadTipMaxDuration') }}: <span id="maxDuration"></span> {{ fs_lang('unitSecond') }}</label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('uploadTipMaxNumber') }}: <span id="maxNumber"></span></label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="uploadSubmit">{{ fs_lang('uploadButton') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var updateTimer;

            function updateDraft() {
                return new Promise((resolve, reject) => {
                    var jsonData = {};

                    $('#fresns-editor').find('input, select, textarea').each(function() {
                        var name = $(this).attr('name');
                        var value = $(this).val();

                        if ($(this).attr('type') === 'checkbox') {
                            value = $(this).is(':checked') ? value : 0;
                        }

                        jsonData[name] = value;
                    });

                    $.ajax({
                        url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                        type: 'PATCH',
                        data: JSON.stringify(jsonData),
                        contentType: 'application/json',
                        success: function (res) {
                            if (res.code != 0) {
                                tips(res.message, res.code);
                            }
                            resolve(res);
                        },
                        error: function (xhr, status, error) {
                            tips(error, xhr.status);
                            reject(error);
                        },
                    });
                });
            };

            function startOrUpdateTimer() {
                if (updateTimer) {
                    clearTimeout(updateTimer);
                }
                updateTimer = setTimeout(function() {
                    updateDraft();
                }, 10000);
            }

            $('.editor-title, .editor-content').on('input', function() {
                startOrUpdateTimer();
            });

            $('.editor-checkbox, .editor-select').on('change', function() {
                updateDraft();
            });

            $('#fresns-editor').submit(function (e) {
                e.preventDefault();

                updateDraft().then(() => {
                    let form = $(this),
                        btn = form.find('button[type="submit"]'),
                        actionUrl = form.attr('action'),
                        methodType = form.attr('method') || 'POST',
                        type = "{{ $type }}",
                        detailURLTemplate = "{{ fs_route(route('fresns.post.detail', ['pid' => 'FresnsPlaceholder'])) }}";

                    if (type == 'comment') {
                        detailURLTemplate = "{{ fs_route(route('fresns.comment.detail', ['cid' => 'FresnsPlaceholder'])) }}";
                    }

                    $.ajax({
                        url: actionUrl,
                        type: methodType,
                        success: function (res) {
                            tips(res.message, res.code);

                            if (res.code == 0) {
                                let fsid = res.data.fsid;
                                let detailURL = detailURLTemplate.replace('FresnsPlaceholder', fsid);

                                window.location.href = detailURL;
                            }
                        },
                        complete: function (e) {
                            btn.prop('disabled', false);
                            btn.find('.spinner-border').remove();
                        },
                    });
                }).catch((error) => {
                    console.error('Failed to update draft', error);
                });
            });
        });

        function addEditorFile(fileInfo) {
            let html;

            if (fileInfo.type === 1) {
                html = `
                <div class="position-relative">
                    <img src="${fileInfo.imageSquareUrl}" class="img-fluid">
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileInfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>`;

                $(".editor-file-image").append(html);
                let imgLength = $(".editor-file-image").find(".position-relative").length
                $(".editor-file-image").removeClass().addClass("editor-file-image editor-file-image-"+ imgLength +" mt-3 clearfix")
            }
            if (fileInfo.type === 2) {
                var videoImage = ''
                if (fileInfo.videoPosterUrl) {
                    videoImage = `<img src="${fileInfo.videoPosterUrl}" class="img-fluid">`
                } else {
                    videoImage = `<svg class="bd-placeholder-img rounded" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>`
                }
                html = `
                <div class="position-relative">
                    ${videoImage}
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileInfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <button type="button" class="btn btn-light editor-btn-video-play" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('editorVideoPlayTip') }}" title="{{ fs_lang('editorVideoPlayTip') }}">
                            <i class="bi bi-play-fill"></i>
                        </button>
                    </div>
                </div>`
                $(".editor-file-video").append(html);
            }
            if (fileInfo.type === 3) {
                html = `
                <div class="position-relative">
                    <audio src="${fileInfo.audioUrl}" controls="controls" preload="meta" controlsList="nodownload" oncontextmenu="return false">
                        Your browser does not support the audio element.
                    </audio>
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileInfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button></div>
                </div>`
                $('.editor-file-audio').append(html);
            }
            if(fileInfo.type === 4) {
                html = `
                <div class="position-relative">
                    <div class="editor-document-box">
                        <div class="editor-document-icon">
                            <i class="bi bi-file-earmark"></i>
                        </div>
                        <div class="editor-document-name text-nowrap overflow-hidden">${fileInfo.name}</div>
                    </div>
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileInfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>`
                $(".editor-file-document").append(html);
            }
        };

        function deleteFile(obj) {
            let fid = $(obj).data('fid');

            $.ajax({
                url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                type: "PATCH",
                data: {
                    'deleteFile': fid,
                }
            });

            $(obj).parent().parent().remove();
        };

        function deleteLocation() {
            $.ajax({
                url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                type: "PATCH",
                data: {
                    'deleteLocation': 1,
                }
            });

            $('#location-info').hide();
            $('#location-btn').show();
        };

        (function($){
            $('.fresns-sticker').on('click',function (){
                $('#content').trigger('click').insertAtCaret('[' + $(this).attr('value') + ']');
            });

            $('#fresnsUploadModal').on('show.bs.modal', function (e) {
                var button = $(e.relatedTarget);

                let fileType = button.data('type'),
                    uploadType = button.data('uploadtype'),
                    accept = button.data('accept'),
                    extensions = button.data('extensions'),
                    maxSize = button.data('maxsize'),
                    maxDuration = button.data('maxduration'),
                    maxNumber = button.data('maxnumber');

                $('#extensions').text(extensions);
                $('#maxSize').text(maxSize);
                $('#maxDuration').text(maxDuration);
                $('#maxNumber').text(maxNumber);

                $('#fileInput').prop('accept', accept);

                if (maxDuration) {
                    $('#maxDurationDiv').removeClass('d-none');
                } else {
                    $('#maxDurationDiv').addClass('d-none');
                }

                if (maxNumber > 1) {
                    $('#fileInput').prop('multiple', true);
                    $('#fileInput').prop('max', maxNumber);
                }

                $(this).find("input[name='fileType']").val(fileType);
                $(this).find("input[name='uploadType']").val(uploadType);
            });

            // upload request
            $('#upload-form').submit(function (e) {
                e.preventDefault();

                let form = $(this),
                    usageType = form.find('input[name=usageType]').val(),
                    usageFsid = form.find('input[name=usageFsid]').val(),
                    fileType = form.find('input[name=fileType]').val(),
                    uploadType = form.find('input[name=uploadType]').val(),
                    files = form.find('input[name=files]')[0].files,
                    supportedExtensions = $('#extensions').text(),
                    maxSize = parseInt($('#maxSize').text()),
                    maxDuration = parseInt($('#maxDuration').text() || 0),
                    maxNumber = parseInt($('#maxNumber').text());

                console.log(usageType, usageFsid, fileType, uploadType, supportedExtensions, maxSize, maxDuration);
                fresnsFile.uploadRequest(usageType, usageFsid, fileType, uploadType, files, supportedExtensions, maxSize, maxDuration);
            });
        })(jQuery);
    </script>
@endpush
