<x-guest-layout>
    <div class="text-center space-y-6">
        <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1600&q=80" class="w-full h-40 object-cover rounded-xl" alt="Register">
        <p class="text-gray-600">Create your GintoLand account to save properties and get updates.</p>
        <button onclick="openAuthModal('register')" class="bg-gradient-hero text-white px-6 py-3 rounded-full font-semibold">Create account</button>
        <div class="text-sm text-gray-600">Already have an account? <a href="#" onclick="openAuthModal('login')" class="underline">Log in</a>.</div>
    </div>
</x-guest-layout>
