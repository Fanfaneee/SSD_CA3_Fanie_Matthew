<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body class="bg-custom-background">

  <div>
    <!-- Header -->
    <header class="{{ request()->routeIs('home') ? 'relative bg-cover bg-center text-white' : 'bg-black text-white' }}" 
            style="{{ request()->routeIs('home') ? 'background-image: url(' . asset('images/image_crop.png') . '); height: 100vh;' : 'height: 128px;' }}">
      <nav class="absolute top-0 left-0 right-0 flex items-center justify-between p-4">
        <!-- Left side: Navigation links -->
        <div class="flex  pl-40 space-x-40 flex-1 justify-start font-custom-rubik">
          <a href="{{ route('home') }}" class="text-white font-bold hover:text-gray-300">Home</a>
          <a href="{{ route('festivals.index') }}" class="text-white font-bold hover:text-gray-300">Festivals</a>
          <a href="{{ route('map') }}" class="text-white font-bold hover:text-gray-300">Map</a>
        </div>

        <!-- Center: Logo -->
        <div class="flex justify-center flex-none">
          <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-24 animate-spin">
        </div>

        <!-- Right side: Navigation links -->
        <div class="flex space-x-40 pr-40 flex-1 justify-end font-custom-rubik">
          <a href="{{ route('calendar') }}" class="text-white font-bold hover:text-gray-300">Calendar</a>
          <a href="{{ route('contact') }}" class="text-white font-bold hover:text-gray-300">Contact</a>
          @auth
              @if (Auth::user()->is_admin)
                  <!-- Admin Dropdown -->
                  <div class="relative">
                    <button id="admin-menu-button" class="text-white font-bold hover:text-gray-300">
                        Admin Menu
                    </button>
                    <div id="admin-menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg hidden">
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-200">Admin Dashboard</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                    </div>
                </div>
              @else
                  <!-- Logout Link for Non-Admin Users -->
                  <a href="#" class="text-white font-bold hover:text-gray-300"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     Logout
                  </a>
              @endif
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                  @csrf
              </form>
          @else
              <!-- Login/Register Links for Guests -->
              <a href="{{ route('login') }}" class="text-white font-bold hover:text-gray-300">Login / Register</a>
          @endauth
        </div>
      </nav>
    </header>
    <main>
      @yield('content')
    </main>
  </div> 
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const adminMenuButton = document.getElementById('admin-menu-button');
        const adminMenuDropdown = document.getElementById('admin-menu-dropdown');

        adminMenuButton.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent the click from propagating to the document
            adminMenuDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function () {
            // Hide the dropdown if clicking outside of it
            adminMenuDropdown.classList.add('hidden');
        });

        adminMenuDropdown.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent the dropdown click from closing itself
        });
    });
</script>
</body>
</html>