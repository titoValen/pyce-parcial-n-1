<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Old Ink School</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Rye&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet">

  {{-- CSS --}}
  <link rel="stylesheet" href="{{ asset('css/global.css') }}">
</head>

<body>
  <header>
    <h1>Bienvenido a la Escuela de Tinta Antigua</h1>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    <p>&copy; 2026 Old Ink School. Todos los derechos reservados.</p>
  </footer>
</body>

</html>