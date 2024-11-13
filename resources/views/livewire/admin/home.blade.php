<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="{{$global->meta->description}}">
    <meta name="keywords" content="{{$global->meta->keywords}}">
    <meta name="author" content="{{$global->meta->author}}">
    <meta name="viewport" content="{{$global->meta->viewport}}"/>
    <link rel="icon" type="image/x-icon" href="{{$global->meta->icon}}">
    <title>{{$global->page->title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <!-- CSS files -->
    <link href="{{ asset("dist/css/tabler.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("dist/css/tabler-flags.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("dist/css/tabler-payments.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("dist/css/tabler-vendors.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("dist/css/demo.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("dist/style.css") }}" rel="stylesheet"/>
    <link href="{{ asset("styles/dashboard.css") }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    <script src="{{ asset("dist/js/demo-theme.min.js") }}" defer></script>
    <script src="{{ asset("dist/js/tabler.min.js") }}" defer></script>
    <script src="{{ asset("dist/js/demo.min.js") }}" defer></script>
    <script src="{{ asset("dist/libs/JQuery/JQuery.js") }}" defer></script>
    <script src="{{ asset("dist/libs/JQuery/print.min.js") }}" defer></script>
    <script src="{{ asset("dist/libs/sweetAlert/swal.js") }}" defer></script>   
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @livewireStyles
</head>
<body  class=" d-flex flex-column">
<x-admin.page>
    <x-admin.navbar :global="$global" />
    <x-admin.page-wrapper>
        <x-admin.page-header :global="$global" :title="$global->page->title" :back="$back ?? null" />
        <x-admin.page-body>
            @livewire($global->data->content)
        </x-admin.page-body>
    </x-admin.page-wrapper>
</x-admin.page>

@livewireScripts

</body>
</html>
