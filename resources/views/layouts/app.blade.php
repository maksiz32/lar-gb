<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maksim Manzulin">
    <meta name="keywords" content='GeekBrains'>
    <meta name="description" content='GeekBrains. Laravel - глубокое погружение'>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/app.js') }}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @stack("head")
    <title>@yield("title")</title>
</head>
<body>

        <main class="py-4">
            @yield('content')
        </main>
</body>
</html>
