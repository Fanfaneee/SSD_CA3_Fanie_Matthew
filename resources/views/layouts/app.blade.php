<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>
<body>
  <div>
    <header class="bg-gray-800 text-white p-4">
      this is the header
    </header>
    <main>
      @yield('content')
    </main>
  </div> 
  @include('layouts.footer')
</body>
</html>