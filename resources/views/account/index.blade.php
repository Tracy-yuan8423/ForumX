@extends('commons.fresns')

@section('title', fs_db_config('menu_account'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('account.sidebar')
            </div>

            {{-- 账号内容 --}}
            <div class="col-sm-9">
                {{-- 用户功能扩展 --}}
                <div class="clearfix">
                    @foreach(fs_user_panel('features') as $feature)
                        <div class="float-start mt-3" style="width:20%">
                            <a class="text-decoration-none" data-bs-toggle="modal" href="#fresnsModal"
                                data-type="account"
                                data-scene="featureExtension"
                                data-post-message-key="fresnsFeatureExtension"
                                data-title="{{ $feature['name'] }}"
                                data-url="{{ $feature['url'] }}">
                                <div class="position-relative mx-auto" style="width:52px">
                                    <img src="{{ $feature['icon'] }}" loading="lazy" class="rounded" height="52">
                                    @if ($feature['badgeType'])
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                            {{ $feature['badgeType'] == 1 ? '' : $feature['badgeValue'] }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-1 mb-0 fs-7 text-center text-nowrap">{{ $feature['name'] }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
