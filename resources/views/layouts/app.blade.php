<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Sounds Of Eire')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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
      <a href="{{ route('favorites.index') }}" class="block px-4 py-2 hover:bg-gray-200">Favorites</a>
      <a href="{{ route('account.settings') }}" class="block px-4 py-2 hover:bg-gray-200">Account Management</a>
      <a href="#" class="block px-4 py-2 hover:bg-gray-200"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         Logout
      </a>
  </div>
</div>
              @else
                  <!-- Account Dropdown -->
<div class="relative">
  <button id="account-menu-button" class="text-white font-bold hover:text-gray-300">
      Account
  </button>
  <div id="account-menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg hidden">
      <a href="{{ route('favorites.index') }}" class="block px-4 py-2 hover:bg-gray-200">Favorites</a>
      <a href="{{ route('account.settings') }}" class="block px-4 py-2 hover:bg-gray-200">Account Management</a>
      <a href="#" class="block px-4 py-2 hover:bg-gray-200"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         Logout
      </a>
  </div>
</div>
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
        const accountMenuButton = document.getElementById('account-menu-button');
        const accountMenuDropdown = document.getElementById('account-menu-dropdown');

        // Admin Dropdown
        if (adminMenuButton) {
            adminMenuButton.addEventListener('click', function (event) {
                event.stopPropagation();
                adminMenuDropdown.classList.toggle('hidden');
                if (accountMenuDropdown) accountMenuDropdown.classList.add('hidden'); // Close account dropdown if open
            });
        }

        // Account Dropdown
        if (accountMenuButton) {
            accountMenuButton.addEventListener('click', function (event) {
                event.stopPropagation();
                accountMenuDropdown.classList.toggle('hidden');
                if (adminMenuDropdown) adminMenuDropdown.classList.add('hidden'); // Close admin dropdown if open
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function () {
            if (adminMenuDropdown) adminMenuDropdown.classList.add('hidden');
            if (accountMenuDropdown) accountMenuDropdown.classList.add('hidden');
        });

        // Prevent dropdowns from closing when clicking inside
        if (adminMenuDropdown) {
            adminMenuDropdown.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        }

        if (accountMenuDropdown) {
            accountMenuDropdown.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        }
    });
</script>
</body>
</html>