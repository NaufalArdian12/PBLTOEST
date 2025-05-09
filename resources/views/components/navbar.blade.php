<nav class="bg-white relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="67" height="38" viewBox="0 0 67 38" fill="none">
                        <path
                            d="M35.3923 1.53506C36.2713 0.620709 37.4649 0.107033 38.7079 0.107033C44.3002 0.107033 49.5703 0.107036 54.7602 0.107046C65.1986 0.107068 70.4257 13.2362 63.0447 20.9148L46.9669 37.6405C46.2289 38.4084 44.9668 37.8646 44.9668 36.7786V22.0472L46.8248 20.1142C48.301 18.5785 47.2555 15.9527 45.1678 15.9527H21.5334L35.3923 1.53506Z"
                            fill="#2D68F6" />
                        <path
                            d="M31.1076 36.4649C30.2288 37.3793 29.0351 37.893 27.7921 37.893C22.1998 37.893 16.9297 37.893 11.7398 37.893C1.30133 37.8929 -3.92574 24.7638 3.45534 17.0851L19.5331 0.35945C20.2712 -0.408412 21.5332 0.13542 21.5332 1.22134L21.5333 15.9527L19.6752 17.8857C18.199 19.4215 19.2445 22.0473 21.3322 22.0473L44.9667 22.0472L31.1076 36.4649Z"
                            fill="#2D68F6" />
                    </svg>
                </div>
                <a href="" class="hidden md:block text-2xl font-bold text-blue-600">Toest</a>
            </div>
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center justify-center flex-1">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href=""
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <a href="" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">About
                        Us</a>
                    <a href=""
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Service</a>
                </div>
            </div>

            <!-- Auth Buttons (Desktop) -->
            <div class="hidden md:flex items-center">
                <a href=""
                    class="text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-md text-sm font-medium">Login</a>
                <a href=""
                    class="ml-4 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium">Sign
                    Up</a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-button" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-blue-600 hover:text-blue-700 focus:outline-none"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger icon -->
                    <svg id="hamburger-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- X icon -->
                    <svg id="close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div id="mobile-menu" class="hidden md:hidden transform transition-all duration-300 ease-in-out -translate-y-full">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href=""
                class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">About
                Us</a>
            <a href=""
                class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Service</a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="items-center justify-center space-x-4 px-4">
                <a href=""
                    class="mb-2 text-blue-600 border border-white hover:bg-blue-600 hover:text-white block w-full text-center px-4 py-2 rounded-md text-sm font-medium">Login</a>
                <a href=""
                    class="bg-white text-blue-600 border border-blue-600 hover:bg-blue-700 hover:text-white block w-full text-center px-4 py-2 rounded-md text-sm font-medium">Sign
                    Up</a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        mobileMenuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('translate-y-0');
            mobileMenu.classList.toggle('-translate-y-full');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    });
</script>

<style>
    .mobile-menu-open {
        background-color: #2D68F6;
        /* Warna biru */
    }

    .mobile-menu-open a {
        color: white;
        /* Warna teks putih */
    }

    .mobile-menu-open .bg-white {
        background-color: white !important;
        /* Pastikan background tombol tetap putih */
        color: #2D68F6 !important;
        /* Pastikan teks tombol tetap biru */
    }

    /* Efek Slide Down */
    #mobile-menu {
        transition: transform 0.3s ease-in-out;
    }

    #mobile-menu.-translate-y-full {
        transform: translateY(-100%);
    }

    #mobile-menu.translate-y-0 {
        transform: translateY(0);
    }
</style>
