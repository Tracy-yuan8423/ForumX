@extends('profile.profile')

@section('list')
    {{-- 列表 --}}
    <article class="py-4">
        @foreach($comments as $comment)
            @component('components.comment.list', [
                'comment' => $comment,
                'detailLink' => true,
                'sectionAuthorLiked' => false,
            ])@endcomponent
            @if (! $loop->last)
                <hr>
            @endif
        @endforeach
    </article>

    {{-- 页码 --}}
    <div class="my-3 table-responsive">
        {{ $comments->links() }}
    </div>
@endsection
