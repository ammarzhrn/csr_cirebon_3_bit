<div class="md:w-[60%] p-8">
    <!-- Loading line animation -->
    <div id="loading-line" class="h-1 w-full bg-gray-200 relative overflow-hidden mb-6 hidden">
        <div class="absolute h-full bg-[#98100A] animate-loading-line"></div>
    </div>
    <!-- Login form -->
    <form class="flex flex-col h-full mt-5" method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf
        <!-- Email input field -->
        <div class="flex flex-col mb-4">
            <label for="email" class="block text-sm font-bold text-gray-700">
                Email
                <span class="text-red-500"> *</span>
            </label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukan email anda" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-300 ease-in-out" required>
            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password input field -->
        <div class="flex flex-col mb-4">
            <label for="password" class="block text-sm font-bold text-gray-700">
                Kata Sandi
                <span class="text-red-500"> *</span>
            </label>
            <div class="relative">
                <input type="password" id="password" name="password" placeholder="Masukan kata sandi anda" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-300 ease-in-out" required>
                <!-- Toggle password visibility button -->
                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <!-- Show password icon -->
                    <svg id="showPasswordIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <!-- Hide password icon -->
                    <svg id="hidePasswordIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
            @error('password')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit button -->
        <div class="mt-6 flex">
            <button type="submit" id="submitButton" class="w-full md:w-[300px] h-[44px] px-[18px] py-[10px] bg-[#98100A] text-white font-semibold rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:bg-[#7a0c08] flex items-center justify-center">
                <span>Masuk</span>
                <!-- Loading spinner -->
                <svg class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </div>
    </form>
</div>

<script>
// Wait for the DOM to be fully loaded before executing the script
document.addEventListener('DOMContentLoaded', function() {
    // Get references to the form elements
    const form = document.getElementById('loginForm');
    const submitButton = document.getElementById('submitButton');
    const buttonText = submitButton.querySelector('span');
    const spinner = submitButton.querySelector('svg');
    const loadingLine = document.getElementById('loading-line');

    // Add submit event listener to the form
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        submitButton.disabled = true; // Disable the submit button
        buttonText.textContent = 'Processing...'; // Change button text
        spinner.classList.remove('hidden'); // Show the loading spinner
        loadingLine.classList.remove('hidden'); // Show the loading line

        // Simulate a delay before submitting the form (for demonstration purposes)
        setTimeout(() => {
            form.submit(); // Actually submit the form
        }, 2000); // 2000ms = 2s, matches the duration of the loading animation
    });
});
</script>

<style>
/* Define the loading line animation */
@keyframes loadingLine {
    0% { width: 0; }
    100% { width: 100%; }
}

/* Apply the loading line animation */
.animate-loading-line {
    animation: loadingLine 2s linear forwards;
}
</style>
