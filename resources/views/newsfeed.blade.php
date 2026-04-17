{{-- {{-- <!-- resources/views/home.blade.php --> --}}

<x-layout>
    <x-slot:name>Newsfeed</x-slot:name>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 p-4 rounded-xl bg-green-100 text-green-700 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-4 p-4 rounded-xl bg-red-100 text-red-700 border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <!-- Create Post Box -->
    <section class="mb-6" x-data="{ loading: false, improving: false, message: '', error: '', resize() { $el.style.height = 'auto'; $el.style.height = $el.scrollHeight + 'px'; }, async improve() { 
        if(!this.message.trim()) return;
        this.error = '';
        this.improving = true;
        try {
            const res = await fetch('{{ route('ai.improve') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ message: this.message })
            });
            const data = await res.json();
            if(data.improved) {
                this.message = data.improved;
                this.$nextTick(() => this.resize());
            } else if(data.error) {
                this.error = data.error;
            }
        } catch(e) { 
            this.error = 'Failed to connect. Please try again.'; 
            console.error(e); 
        }
        this.improving = false;
    } }">
        <div class="bg-white/80 backdrop-blur-sm ring-1 ring-white/30 rounded-2xl shadow-sm p-4 sm:p-6">
            <div x-show="error" x-transition class="mb-3 p-3 rounded-lg bg-red-50 text-red-600 text-sm" x-text="error" @click="error = ''"></div>
            <form x-ref="postForm" action="{{ route('newsfeed.store') }}" method="POST" @submit="loading = true">
                @csrf
                <div class="flex flex-col gap-3">
                    <textarea 
                        x-model="message"
                        name="message"
                        rows="5"
                        placeholder="What's on your mind?"
                        @input="resize(); $el.style.height = 'auto'; $el.style.height = $el.scrollHeight + 'px'"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-pink-500 focus:bg-white transition resize-none text-gray-700 placeholder-gray-400 outline-none"
                    ></textarea>
                    <div class="flex justify-between">
                        <button 
                            type="button"
                            @click="improve()"
                            :disabled="improving || !message.trim()"
                            :class="(improving || !message.trim()) ? 'opacity-50 cursor-not-allowed' : ''"
                            class="px-4 py-2.5 rounded-full border border-gray-200 text-gray-600 font-medium text-sm hover:bg-gray-50 transition flex items-center gap-2"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span x-show="!improving">Improve</span>
                            <span x-show="improving" x-cloak>Improving...</span>
                        </button>
                        <button 
                            type="submit"
                            :disabled="loading"
                            :class="loading ? 'opacity-60 cursor-not-allowed' : ''"
                            class="px-6 py-2.5 rounded-full bg-gradient-to-r from-pink-500 to-rose-600 text-white font-medium shadow-sm hover:opacity-90 transition"
                        >
                            <span x-show="!loading">Air Post</span>
                            <span x-show="loading" x-cloak>Posting...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Feed -->
    <section class="space-y-6">
        @forelse($air_post as $post)
            <x-post :post="$post" />
        @empty
            <div class="text-center text-gray-500 py-16 rounded-2xl bg-gradient-to-b from-white to-pink-50 border border-dashed border-gray-200">
                <p class="text-2xl font-semibold text-gray-900 mb-2">No posts yet</p>
                <p class="text-sm text-gray-400 mb-6">Be the first to share something!</p>
            </div>
        @endforelse
    </section>
</x-layout>

{{-- 
#Note to review - KIM --}}
{{-- 
<x-post> references the component at resources/views/components/post.blade.php
:post (with the : prefix) is a property binding — it passes a PHP variable/expression, not a literal string
"$post" is the value being passed — each $post from the @forelse($air_post as $post) loop
 --}}