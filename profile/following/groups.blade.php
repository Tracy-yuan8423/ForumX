@extends('profile.profile')

@section('list')
    {{-- 列表 --}}
    <article class="py-4">
        @foreach($groups as $group)
            @component('components.group.list', compact('group'))@endcomponent
            @if (! $loop->last)
                <hr>
            @endif
        @endforeach
    </article>

    {{-- 页码 --}}
    <div class="my-3 table-responsive">
        {{ $groups->links() }}
    </div>
@endsection
