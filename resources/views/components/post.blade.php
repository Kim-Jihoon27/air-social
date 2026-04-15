@props(['post'])

<article class="relative flex flex-col bg-white/80 backdrop-blur-sm ring-1 ring-white/30 rounded-2xl shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-0.5 duration-200">
    <!-- Header -->
    <header class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-100">
        <div class="flex items-center gap-3">
            @if($post->user)
                @if($post->user->profile_photo_url)
                    <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-pink-100">
                @else
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center text-white font-semibold text-sm ring-2 ring-pink-100">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                @endif
            @else
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center text-white font-semibold text-sm ring-2 ring-gray-200">
                    A
                </div>
            @endif
            <h3 class="text-base sm:text-lg font-semibold text-gray-900 hover:text-pink-600 transition-colors">
                {{ $post->user ? $post->user->name : 'Anonymous' }}
            </h3>
        </div>
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