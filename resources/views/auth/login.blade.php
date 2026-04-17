<x-layout>
    <x-slot:name>Login</x-slot:name>

    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white/80 backdrop-blur-sm ring-1 ring-white/30 rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Welcome Back</h2>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-pink-500 focus:bg-white transition"
                            placeholder="you@example.com"
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-pink-500 focus:bg-white transition"
                            placeholder="Your password"
                        >
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button 
                        type="submit"
                        class="w-full py-3 rounded-full bg-gradient-to-r from-pink-500 to-rose-600 text-white font-semibold shadow hover:opacity-90 transition"
                    >
                        Sign In
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600 mt-6">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-pink-600 font-medium hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>