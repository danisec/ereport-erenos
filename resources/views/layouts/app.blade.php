<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('favico.svg') }}" rel="shortcut icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Josefin+Sans:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>{{ $title }} - Sekolah Erenos</title>
    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex min-h-screen flex-col">
        <x-organisms.header />


        <div class="flex-1">
            {{ $slot }}
        </div>
    </div>

    @notifyJs
    <x:notify-messages />
</body>

</html>
