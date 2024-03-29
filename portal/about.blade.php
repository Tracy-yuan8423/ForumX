@extends('commons.fresns')

@section('title', fs_lang('accountLoginOrRegister'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            <div class="card mx-auto" style="max-width:800px;">
                {!! Str::markdown(fs_config('site_intro')) !!}
            </div>
        </div>
    </main>
@endsection
