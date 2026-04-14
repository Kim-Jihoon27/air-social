<!-- resources/views/home.blade.php -->
<x-layout>
    <x-slot:title>Welcome</x-slot:title>

    <!-- Hero Banner (unchanged from previous improved version) -->
    <section class="mb-8">
        <div class="relative overflow-hidden rounded-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-50 via-rose-50 to-white -z-10"></div>
            <div class="relative px-6 py-10 sm:py-12 lg:py-14 lg:px-12">
                <div class="mx-auto max-w-3xl text-center">
                    <img src="/static/asset/air-social-logo.png" alt="Air Social" class="mx-auto w-20 h-20 object-contain mb-4">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight">Air Social</h1>
                    <p class="mt-3 text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
                        A social platform that helps you connect with people who share your interests. Discover ideas, join conversations, and build meaningful connections.
                    </p>

                    <div class="mt-6 flex justify-center gap-4">
                        <a href="#" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-gradient-to-r from-pink-500 to-rose-600 text-white font-semibold shadow-lg hover:scale-105 transform transition">Get Started</a>
                        <a href="#" class="inline-flex items-center justify-center px-5 py-3 rounded-full border border-pink-200 text-pink-600 font-medium hover:bg-pink-50 transition">Learn More</a>
                    </div>

                    <div class="mt-6 flex flex-wrap justify-center gap-3 text-xs text-gray-500">
                        <span class="px-3 py-1 rounded-full bg-white/60 backdrop-blur-sm">Discover Communities</span>
                        <span class="px-3 py-1 rounded-full bg-white/60 backdrop-blur-sm">Real Conversations</span>
                        <span class="px-3 py-1 rounded-full bg-white/60 backdrop-blur-sm">Privacy First</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feed -->
    <section class="space-y-6">
        @forelse($air_post as $post)
            <article class="relative flex flex-col bg-white/80 backdrop-blur-sm ring-1 ring-white/30 rounded-2xl shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-0.5 duration-200">
                <!-- Header -->
                <header class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-100">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 hover:text-pink-600 transition-colors">
                        {{ $post->user ? $post->user->name : 'Anonymous' }}
                    </h3>
                    <time class="text-xs text-gray-500 font-medium">
                        {{ $post->created_at->diffForHumans() }}
                    </time>
                </header>

                <!-- Message -->
                <div class="px-6 py-5">
                    <p class="text-gray-800 leading-relaxed text-sm sm:text-base">
                        {{ $post->message }}
                    </p>
                </div>
            </article>
        @empty
            <div class="text-center text-gray-500 py-16 rounded-2xl bg-gradient-to-b from-white to-pink-50 border border-dashed border-gray-200">
                <p class="text-2xl font-semibold text-gray-900 mb-2">No posts yet</p>
                <p class="text-sm text-gray-400 mb-6">Be the first to share something!</p>
                <a href="#" class="inline-block px-6 py-3 rounded-full bg-gradient-to-r from-pink-500 to-rose-600 text-white font-medium shadow hover:opacity-95 transition">Create an account</a>
            </div>
        @endforelse
    </section>
</x-layout>
