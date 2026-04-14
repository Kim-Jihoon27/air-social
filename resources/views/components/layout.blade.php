<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ isset($title) ? $title . ' - Air Social' : 'Air Social' }}</title>
  <link rel="preconnect" href="https://fonts.bunny.net" />
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col font-sans text-gray-900 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">

  <!-- Navigation -->
  <nav class="fixed top-0 left-0 w-full bg-white/85 backdrop-blur-md shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <img src="/static/asset/air-social-logo.png" alt="Air Social Logo" class="w-10 h-10 object-contain">
        <span class="text-xl font-semibold bg-gradient-to-r from-pink-500 to-rose-600 bg-clip-text text-transparent">
          Air Social
        </span>
      </div>

      <div class="flex items-center space-x-4">
        <a href="#" class="text-sm font-medium text-gray-700 hover:text-pink-600 transition-colors">Login</a>
        <a href="#" class="text-sm font-medium text-white bg-gradient-to-r from-pink-500 to-rose-600 px-4 py-2 rounded-lg shadow-sm hover:opacity-95 transition">Register</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="flex-grow pt-28 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-center">
        <div class="w-full max-w-2xl lg:max-w-4xl">
          {{ $slot }}
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white/85 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600 gap-4">
      <p class="text-center sm:text-left">
        &copy; 2026 <span class="font-semibold bg-gradient-to-r from-pink-500 to-rose-600 bg-clip-text text-transparent">Air Social</span>. All rights reserved.
      </p>

      <div class="flex space-x-6">
        <a href="#" class="hover:text-pink-600 transition">Privacy</a>
        <a href="#" class="hover:text-pink-600 transition">Terms</a>
      </div>
    </div>
  </footer>

</body>
</html>
