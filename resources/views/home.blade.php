{{-- {{-- <!-- resources/views/home.blade.php --> --}}


<x-layout>
    <x-slot:name>Welcome</x-slot:name>

    <!-- Hero -->
    <section class="-mx-4 -mt-4 mb-8">
        <div class="w-full min-h-[80vh] flex items-center justify-center py-16 lg:py-20">
            <div class="w-full max-w-4xl px-8 lg:px-16 text-center">
                <img src="/static/asset/air-social-logo.svg" alt="Air Social" class="mx-auto w-32 h-32 lg:w-40 lg:h-40 object-contain mb-6">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">Air Social</h1>
                <p class="mt-4 sm:mt-6 text-lg sm:text-xl lg:text-2xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    A social platform that helps you connect with people who share your interests. Discover ideas, join conversations, and build meaningful connections.
                </p>

                <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row justify-center gap-4 sm:gap-6">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-gradient-to-r from-pink-500 to-rose-600 text-white font-bold text-lg hover:opacity-90 transition">Get Started</a>
                    <a href="{{ route('newsfeed') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-full border-2 border-pink-300 text-pink-600 font-semibold text-lg hover:bg-white/50 transition">Explore as Guest</a>
                </div>

                <div class="mt-10 sm:mt-12 flex flex-wrap justify-center gap-4 sm:gap-5">
                    <span class="px-4 py-2 rounded-full bg-white/70 backdrop-blur-sm text-sm font-medium text-gray-700">Discover Communities</span>
                    <span class="px-4 py-2 rounded-full bg-white/70 backdrop-blur-sm text-sm font-medium text-gray-700">Real Conversations</span>
                    <span class="px-4 py-2 rounded-full bg-white/70 backdrop-blur-sm text-sm font-medium text-gray-700">Privacy First</span>
                </div>
            </div>
        </div>
    </section>
</x-layout>

{{-- 
#Note to review - KIM --}}
{{-- 
<x-post> references the component at resources/views/components/post.blade.php
:post (with the : prefix) is a property binding — it passes a PHP variable/expression, not a literal string
"$post" is the value being passed — each $post from the @forelse($air_post as $post) loop
 --}}