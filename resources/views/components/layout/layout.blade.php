@props(['title' => ''])

        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    @vite(['resources/js/app.js','resources/css/app.css'])
    <title>BirdBord{{ $title ? ' - ' . $title : ''  }}</title>
    <script>
      const savedTheme = localStorage.getItem("theme") || "dark-theme";
      document.documentElement.classList.add(savedTheme);
    </script>
</head>
<body {{ $attributes->merge(['class' => 'bg-primary']) }}>
@auth
    <x-general.header />
@endauth
{{ $slot }}
</body>
</html>