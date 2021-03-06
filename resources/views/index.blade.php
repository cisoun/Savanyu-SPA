@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'githubAuth' => config('services.github.client_id'),
];

$polyfills = [
    'Promise',
    'Object.assign',
    'Object.values',
    'Array.prototype.find',
    'Array.prototype.findIndex',
    'Array.prototype.includes',
    'String.prototype.includes',
    'String.prototype.startsWith',
    'String.prototype.endsWith',
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Oeuvres de Victor Savanyu.">
  <meta name="keywords" content="Victor,Savanyu,oeuvres,peinture,photographie,sculpture,vidéo">
  <meta name="author" content="Victor Savanyu">

  <title>{{ config('app.name') }}</title>

  <link rel="preload" href="../fonts/dinpro-light.otf" as="font" />
  <link rel="preload" href="../fonts/dinpro-regular.otf" as="font" />
  <link rel="preload" href="../fonts/dinpro-medium.otf" as="font" />
  <link rel="preload" href="../fonts/dinpro-black.otf" as="font" />

  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
</head>
<body>
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>window.config = @json($config);</script>

  {{-- Polyfill JS features via polyfill.io --}}
  <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features={{ implode(',', $polyfills) }}"></script>

  {{-- Load the application scripts --}}
  <script src="{{ mix('dist/js/app.js') }}"></script>
</body>
</html>
