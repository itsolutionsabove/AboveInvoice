@extends('layouts.main')

@section('content')
    <x-dashboard.page>
        <x-dashboard.navbar :global="$global" />
        <x-dashboard.page-wrapper>
            @yield('sub_content')
        </x-dashboard.page-wrapper>
    </x-dashboard.page>
@endsection
