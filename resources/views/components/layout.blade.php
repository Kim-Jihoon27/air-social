<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ isset($title) ? $title . ' - Air Social' : 'Air Social' }}</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 text-gray-900 font-sans flex flex-col min-h-screen">

  <!-- Navigation -->
  <nav class="fixed top-0 left-0 w-full bg-white/90 backdrop-blur-md shadow-md z-50">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
      <!-- Logo + App Name -->
      <div class="flex items-center space-x-2">
        <div class="w-9 h-9 bg-gradient-to-r from-indigo-600 to-pink-500 rounded-full flex items-center justify-center text-white font-bold">A</div>
        <span class="text-xl font-semibold text-indigo-700">Air Social</span>
      </div>

      <!-- Auth Buttons -->
      <div class="space-x-4">
        <a href="#" class="text-gray-700 hover:text-indigo-600 transition">Login</a>
        <a href="#" class="bg-gradient-to-r from-indigo-600 to-pink-500 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">Register</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="flex-grow flex items-center justify-center text-center px-6 pt-24">
     {{ $slot }}
  </main>

  <!-- Footer -->
  <footer class="bg-white/90 backdrop-blur-md border-t">
    <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center text-sm text-gray-600">
      <p>&copy; 2026 Air Social. All rights reserved.</p>
      <div class="space-x-4">
        <a href="#" class="hover:text-indigo-600 transition">Privacy</a>
        <a href="#" class="hover:text-indigo-600 transition">Terms</a>
      </div>
    </div>
  </footer>

</body>
</html>
