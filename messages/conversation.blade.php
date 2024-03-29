@extends('commons.fresns')

@section('title', fs_config('channel_conversations_name').' - '.$conversation['detail']['user']['nickname'])

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('me.sidebar')
            </div>

            {{-- 对话 --}}
            <div class="col-sm-9">
                <div class="card">
                    {{-- 与我对话的用户 --}}
                    <div class="card-header">
                        @if ($conversation['detail']['user']['status'])
                            <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $conversation['detail']['user']['uid']])) }}" target="_blank" class="text-decoration-none">
                                <img src="{{ $conversation['detail']['user']['avatar'] }}" loading="lazy" alt="{{ $conversation['detail']['user']['nickname'] }}" class="rounded-circle conversation-avatar">
                                <span class="ms-2 fs-5">{{ $conversation['detail']['user']['nickname'] }}</span>
                                <span class="ms-2 conversation-user-name text-secondary"><i class="bi bi-person-badge"></i>{{ $conversation['detail']['user']['uid'] }}</span>
                            </a>
                        @else
                            <img src="{{ fs_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('userDeactivate') }}" class="rounded-circle conversation-avatar">
                            {{ fs_lang('userDeactivate') }}
                        @endif
                    </div>

                    {{-- 消息列表 --}}
                    <div class="card-body">
                        @foreach($messages as $message)
                            @component('components.message.message', compact('message'))@endcomponent
                        @endforeach

                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->links() }}
                        </div>
                    </div>

                    {{-- 发送框 --}}
                    <div class="card-footer">
                        @component('components.message.send', [
                            'configs' => $conversation['configs'],
                            'user' => $conversation['detail']['user'],
                        ])@endcomponent
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
