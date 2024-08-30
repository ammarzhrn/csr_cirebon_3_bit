<div class="md:w-3/5 p-8">
    <!-- Loading line animation -->
    <div id="loading-line" class="h-1 w-full bg-gray-200 relative overflow-hidden mb-6 hidden">
        <div class="absolute h-full bg-[#98100A] animate-loading-line"></div>
    </div>
    <!-- Registration form -->
    <form action="{{ route('register') }}" method="POST" class="space-y-6 mt-[50px]" id="registerForm">
        @csrf
        <!-- Include form fields from a separate file -->
        @include('auth.partials-register.form-fields')

        <!-- reCAPTCHA -->
        {{-- <div class="g-recaptcha" data-sitekey="YOUR_RECAPTCHA_SITE_KEY"></div> --}}

        <!-- Submit button -->
        <button type="submit" id="submitButton" class="w-[300px] text-white bg-[#98100A] hover:bg-red-700 font-bold py-2 px-4 rounded flex items-center justify-center">
            <span>Daftar<a/span>
            <!-- Loading spinner -->
            <svg class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    </form>
</div>
    {{-- script recaptcha --}}
{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
<script>
// Wait for the DOM to be fully loaded before executing the script
document.addEventListener('DOMContentLoaded', function() {
    // Get references to the form elements
    const form = document.getElementById('registerForm');
    const submitButton = document.getElementById('submitButton');
    const buttonText = submitButton.querySelector('span');
    const spinner = submitButton.querySelector('svg');
    const loadingLine = document.getElementById('loading-line');

    // Add submit event listener to the form
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Validate reCAPTCHA
        // if (grecaptcha.getResponse() == "") {
        //     alert("Silakan verifikasi bahwa Anda bukan robot.");
        //     return false;
        // }

        submitButton.disabled = true; // Disable the submit button
        buttonText.textContent = 'Memproses...'; // Change button text
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
