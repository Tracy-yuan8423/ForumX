@php
    $modalId = $cid ?? $pid;
    $cid = $cid ?? '';
@endphp

{{-- 回复框 --}}
@if (fs_user()->check())
    <div class="modal fade" id="commentModal-{{ $modalId }}" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="commentModalLabel">{{ fs_config('publish_comment_name') }} {{ $nickname }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-8 text-secondary">RE: {{ $title }}</p>
                    <form class="form-quick-publish" action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/editor/comment/publish']) }}" method="post" enctype="multipart/form-data">
                        <div class="editor-content">
                            <input type="hidden" name="commentPid" value="{{ $pid }}">
                            <input type="hidden" name="commentCid" value="{{ $cid }}">

                            <textarea class="form-control rounded-0 border-0 editor-content" name="content" id="{{ 'modal-quick-publish-comment-content'.$pid.$cid }}" rows="5" placeholder="{{ fs_lang('editorContent') }}"></textarea>

                            {{-- 表情和上传 --}}
                            <div class="d-flex mt-2">
                                @if (fs_editor_comment('sticker'))
                                    <div class="me-2">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                            <i class="bi bi-emoji-smile"></i>
                                        </button>
                                        {{-- 表情图列表 开始 --}}
                                        <div class="dropdown-menu pt-0" aria-labelledby="stickers">
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach(fs_editor_stickers() as $sticker)
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link @if ($loop->first) active @endif" id="modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}-tab" data-bs-toggle="tab" data-bs-target="#modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}" type="button" role="tab" aria-controls="modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}" aria-selected="{{ $loop->first }}">{{ $sticker['name'] }}</button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content p-2 fs-sticker">
                                                @foreach(fs_editor_stickers() as $sticker)
                                                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}" role="tabpanel" aria-labelledby="modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}-tab">
                                                        @foreach($sticker['stickers'] ?? [] as $value)
                                                            <a class="{{ 'modal-fresns-comment-sticker'.$pid.$cid }} btn btn-outline-secondary border-0" href="javascript:;" value="{{ $value['code'] }}" title="{{ $value['code'] }}" >
                                                                <img src="{{ $value['image'] }}" loading="lazy" alt="{{ $value['code'] }}" title="{{ $value['code'] }}">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        {{-- 表情图列表 结束 --}}
                                    </div>
                                @endif

                                @if (fs_editor_comment('image.status'))
                                    <div class="input-group">
                                        <label class="input-group-text" for="comment-file-{{ $pid.$cid }}">{{ fs_lang('editorImages') }}</label>
                                        <input type="file" class="form-control" accept="{{ fs_editor_comment('image.inputAccept') }}" name="image" id="comment-file-{{ $pid.$cid }}">
                                    </div>
                                @endif
                            </div>

                            <hr>
                            <div class="d-flex bd-highlight align-items-center">
                                {{-- 评论按钮 --}}
                                <div class="bd-highlight me-auto">
                                    <button type="submit" class="btn btn-success">{{ fs_config('publish_comment_name') }}</button>
                                </div>

                                {{-- 匿名选项 --}}
                                @if (fs_editor_comment('anonymous'))
                                    <div class="bd-highlight">
                                        <div class="form-check">
                                            <input class="form-check-input" name="isAnonymous" type="checkbox" value="1" id="{{ $pid.$cid.'isAnonymous' }}">
                                            <label class="form-check-label" for="{{ $pid.$cid.'isAnonymous' }}">{{ fs_lang('editorAnonymous') }}</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@push('script')
    <script>
        $("{{ '.modal-fresns-comment-sticker'.$pid.$cid }}").on('click',function (){
            $("{{ '#modal-quick-publish-comment-content'.$pid.$cid }}").trigger('click').insertAtCaret("[" + $(this).attr('value') + "]");
        });
    </script>
@endpush
