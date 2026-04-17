@props(['post'])

<article class="relative flex flex-col bg-white/80 backdrop-blur-sm ring-1 ring-white/30 rounded-2xl shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-0.5 duration-200" x-data="{ editing: false, saving: false, deleting: false, message: '{{ addslashes($post->message) }}', resize() { this.$nextTick(() => { const ta = this.$refs.editTextarea; if(ta) { ta.style.height = 'auto'; ta.style.height = ta.scrollHeight + 'px'; } }); } }" x-ref="post{{ $post->id }}">
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
            <h3 class="text-base sm:text-lg font-semibold text-gray-900">
                {{ $post->user ? $post->user->name : 'Anonymous' }}
            </h3>
        </div>
        <div class="flex items-center gap-2">
            <time class="text-xs text-gray-500 font-medium">
                {{ $post->created_at->diffForHumans() }}
            </time>
            @auth
                @if(Auth::id() === $post->user_id)
                    <div class="relative" x-data="{ dropdown: false }">
                        <button type="button" @click="dropdown = !dropdown" x-show="!editing && !deleting" class="text-gray-400 hover:text-gray-600 transition p-1 rounded-full hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                        <div x-show="dropdown" x-cloak @click.away="dropdown = false" class="absolute right-0 mt-1 w-28 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-20">
                            <button type="button" @click="editing = true; dropdown = false" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <form action="{{ url('/post/' . $post->id) }}" method="POST" @submit="deleting = true">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    :disabled="deleting"
                                    class="w-full text-left px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition flex items-center gap-2"
                                    :class="deleting ? 'opacity-60' : ''"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span x-show="!deleting">Delete</span>
                                    <span x-show="deleting" x-cloak>Deleting...</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </header>

    <!-- Message -->
    <div class="px-6 py-5">
        <!-- View Mode -->
        <p x-show="!editing" class="text-gray-800 leading-relaxed text-sm sm:text-base">
            {{ $post->message }}
        </p>

        <!-- Edit Mode -->
        <form x-show="editing" x-cloak action="{{ url('/post/' . $post->id) }}" method="POST" @submit="saving = true" class="space-y-3">
            @csrf
            @method('PUT')
            <input type="hidden" name="message" :value="message">
            <textarea 
                x-ref="editTextarea"
                x-model="message"
                @input="resize()"
                rows="5"
                :disabled="saving"
                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-pink-500 focus:bg-white transition resize-none text-gray-700 outline-none"
                :class="saving ? 'opacity-50' : ''"
                placeholder="What's on your mind?"
            ></textarea>
            <div class="flex gap-2">
                <button 
                    type="submit"
                    :disabled="saving"
                    class="px-4 py-2 rounded-full bg-gradient-to-r from-pink-500 to-rose-600 text-white text-xs font-medium shadow hover:opacity-90 transition flex items-center gap-2"
                    :class="saving ? 'opacity-60 cursor-not-allowed' : ''"
                >
                    <span x-show="!saving">Save</span>
                    <span x-show="saving" x-cloak>Saving...</span>
                </button>
                <button 
                    type="button"
                    @click="editing = false; message = '{{ addslashes($post->message) }}'"
                    :disabled="saving"
                    class="px-4 py-2 rounded-full border border-gray-200 text-gray-600 text-xs font-medium hover:bg-gray-50 transition"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>
</article>