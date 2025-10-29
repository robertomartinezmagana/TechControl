<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
  <main>
  @yield('content')
  </main>

  <footer class="footer">
    &copy; {{ date('Y') }} <strong>TechControl</strong>. Todos los derechos reservados.
  </footer>

  @stack('scripts')
  <script src="{{ asset('js/password-rules.js') }}"></script>
  <script src="{{ asset('js/password-show.js') }}"></script>
</body>
</html>
