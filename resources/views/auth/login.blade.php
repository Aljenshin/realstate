<x-guest-layout>
    <div class="text-center space-y-6">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80" class="w-full h-40 object-cover rounded-xl" alt="Homes">
        <p class="text-gray-600">Sign in to access saved searches, listings, and mortgage tools.</p>
        <button onclick="openAuthModal('login')" class="bg-gradient-hero text-white px-6 py-3 rounded-full font-semibold">Log in</button>
        <div class="text-sm text-gray-600">No account yet? <a href="#" onclick="openAuthModal('register')" class="underline">Create one</a>.</div>
    </div>
</x-guest-layout>
