@extends('commons.fresns')

@section('title', fs_config('channel_conversations_name'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('me.sidebar')
            </div>

            <div class="col-sm-9">
                {{-- 对话列表 --}}
                <div class="list-group mt-4 mx-auto" style="max-width:500px;">
                    @foreach($conversations as $conversation)
                        @component('components.message.conversation', compact('conversation'))@endcomponent
                    @endforeach
                </div>

                {{-- 列表页码 --}}
                <div class="d-flex justify-content-center my-3">
                    {{ $conversations->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
