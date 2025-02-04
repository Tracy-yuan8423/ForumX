{{-- 文本框 --}}
@if ($extends['texts'])
    @foreach($extends['texts'] as $extend)
        <div class="position-relative frame-box-text">
            <div class="frame-text-content">
                {{ $extend['content'] }}
            </div>
            {{-- 页面类型 --}}
            @if ($extend['appUrl'])
                <a class="text-decoration-none stretched-link" data-bs-toggle="modal" href="#fresnsModal"
                    data-title="{{ $extend['title'] ?? '' }}"
                    data-url="{{ $extend['appUrl'] }}"
                    data-pid="{{ $pid }}"
                    data-uid="{{ $author['uid'] }}"
                    data-post-message-key="fresnsPostExtendBox">
                </a>
            @endif
        </div>
    @endforeach
@endif

{{-- 信息框 --}}
@if ($extends['infos'])
    @foreach($extends['infos'] as $extend)
        <div class="position-relative frame-box-info mb-3">
            <div class="d-flex align-items-center">
                {{-- 封面图 --}}
                <div class="flex-shrink-0">
                    <img src="{{ $extend['image'] }}" loading="lazy" class="frame-image-{{ $extend['viewTypeString'] }}">
                </div>

                <div class="flex-grow-1 px-3">
                    <div class="d-flex flex-column frame-box-{{ $extend['viewTypeString'] }}">
                        <div class="frame-title" style="color:{{ $extend['titleColor'] }}">{{ $extend['title'] }}</div>

                        @if ($extend['descPrimary'])
                            <div class="frame-desc mt-auto" style="color:{{ $extend['descPrimaryColor'] }}">{{ $extend['descPrimary'] }}</div>
                        @endif
                        @if ($extend['descSecondary'])
                            <div class="frame-desc mt-auto" style="color:{{ $extend['descSecondaryColor'] }}">{{ $extend['descSecondary'] }}</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 按钮 --}}
            @if ($extend['btnName'])
                <div class="position-absolute top-50 end-0 translate-middle-y">
                    <a href="#" role="button" class="btn btn-info btn-sm me-3" style="background-color:{{ $extend['btnColor'] }};border-color:{{ $extend['btnColor'] }}">{{ $extend['btnName'] }}</a>
                </div>
            @endif

            @if ($extend['appUrl'])
                <a class="text-decoration-none stretched-link" data-bs-toggle="modal" href="#fresnsModal"
                    data-title="{{ $extend['title'] ?? '' }}"
                    data-url="{{ $extend['appUrl'] }}"
                    data-pid="{{ $pid }}"
                    data-uid="{{ $author['uid'] }}"
                    data-post-message-key="fresnsPostExtendBox">
                </a>
            @endif
        </div>
    @endforeach
@endif
