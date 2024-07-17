@extends('profile.profile')

@section('list')
    {{-- 列表 --}}
    <article class="py-4">
        @foreach($users as $user)
            @component('components.users.list', compact('user'))@endcomponent
            @if (! $loop->last)
                <hr>
            @endif
        @endforeach
    </article>

    {{-- 页码 --}}
    <div class="my-3 table-responsive">
        {{ $users->links() }}
    </div>
@endsection
