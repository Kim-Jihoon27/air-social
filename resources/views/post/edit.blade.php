<x-layout>
    <x-slot:name>Edit Post</x-slot:name>

    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white/80 backdrop-blur-sm ring-1 ring-white/30 rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Edit Post</h2>

                <form method="POST" action="{{ route('post.update', $post->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <textarea 
                            name="message" 
                            rows="5"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-pink-500 focus:bg-white transition resize-none text-gray-700"
                        >{{ old('message', $post->message) }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button 
                            type="submit"
                            class="flex-1 py-3 rounded-full bg-gradient-to-r from-pink-500 to-rose-600 text-white font-semibold shadow hover:opacity-90 transition"
                        >
                            Update
                        </button>
                        <a 
                            href="{{ route('newsfeed') }}"
                            class="flex-1 py-3 rounded-full border border-gray-200 text-gray-600 font-medium text-center hover:bg-gray-50 transition"
                        >
                            Cancel
                        </a>
                    </div>
                </form>

                <form method="POST" action="{{ route('post.destroy', $post->id) }}" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit"
                        class="w-full py-2 rounded-full border border-red-200 text-red-500 font-medium hover:bg-red-50 transition"
                        onclick="return confirm('Are you sure you want to delete this post?')"
                    >
                        Delete Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>