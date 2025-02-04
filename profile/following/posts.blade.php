@extends('profile.profile')

@section('list')
    {{-- 列表 --}}
    <article class="py-4">
        @foreach($posts as $post)
            @component('components.posts.list', compact('post'))@endcomponent
            @if (! $loop->last)
                <hr>
            @endif
        @endforeach
    </article>

    {{-- 页码 --}}
    <div class="my-3 table-responsive">
        {{ $posts->links() }}
    </div>
@endsection
