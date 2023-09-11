@extends('index')
@section('content')
    @if (session('pesan'))
        <p>{{ session('pesan') }}</p>
    @endif

@endsection
