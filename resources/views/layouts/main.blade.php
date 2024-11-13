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
    <link href="{{ asset("styles/dashboard.css") }}" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body  class=" d-flex flex-column">

@yield('content')

<script>
    const global = JSON.parse("{{$global->AppInfo->toJSString()}}".replace(/&quot;/g, '"').replace(/\\/g, '\\\\'));
</script>
<script src="{{ asset("dist/js/demo-theme.min.js") }}" defer></script>
<script src="{{ asset("dist/js/tabler.min.js") }}" defer></script>
<script src="{{ asset("dist/js/demo.min.js") }}" defer></script>
<script type="module" src="{{ asset("js/initial.js") }}"></script>
</body>
</html>
