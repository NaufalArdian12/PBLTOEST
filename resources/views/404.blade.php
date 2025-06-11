<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .glitch {
            position: relative;
            color: #fff;
            font-size: 8rem;
            font-weight: 700;
            text-transform: uppercase;
            animation: glitch 2s infinite;
        }

        @keyframes glitch {

            0%,
            100% {
                text-shadow: 0.05em 0 0 #00fffc, -0.03em -0.04em 0 #fc00ff,
                    0.025em 0.04em 0 #fffc00;
            }

            15% {
                text-shadow: 0.05em 0 0 #00fffc, -0.03em -0.04em 0 #fc00ff,
                    0.025em 0.04em 0 #fffc00;
            }

            16% {
                text-shadow: -0.05em -0.025em 0 #00fffc, 0.025em 0.035em 0 #fc00ff,
                    -0.05em -0.05em 0 #fffc00;
            }

            49% {
                text-shadow: -0.05em -0.025em 0 #00fffc, 0.025em 0.035em 0 #fc00ff,
                    -0.05em -0.05em 0 #fffc00;
            }

            50% {
                text-shadow: 0.05em 0.035em 0 #00fffc, 0.03em 0 0 #fc00ff,
                    0 -0.04em 0 #fffc00;
            }

            99% {
                text-shadow: 0.05em 0.035em 0 #00fffc, 0.03em 0 0 #fc00ff,
                    0 -0.04em 0 #fffc00;
            }
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #00fffc;
            border-radius: 50%;
            animation: particles 5s linear infinite;
        }

        @keyframes particles {
            0% {
                opacity: 0;
                transform: translateY(100vh) scale(0);
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateY(-100vh) scale(1);
            }
        }

        .gradient-text {
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-gray-900 via-purple-900 to-violet-900 min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Animated Particles Background -->
    <div class="particles">
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
        <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
        <div class="particle" style="left: 50%; animation-delay: 4s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 0.5s;"></div>
        <div class="particle" style="left: 70%; animation-delay: 1.5s;"></div>
        <div class="particle" style="left: 80%; animation-delay: 2.5s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 3.5s;"></div>
    </div>

    <!-- Main Content -->
    <div class="text-center z-10 relative px-4">
        <!-- Glitch 404 Text -->
        <div class="glitch mb-8 sm:mb-12">
            <span class="text-6xl sm:text-8xl md:text-9xl">404</span>
        </div>

        <!-- Floating Robot/Astronaut Icon -->
        <div class="floating mb-8">
            <div
                class="w-24 h-24 sm:w-32 sm:h-32 mx-auto bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center shadow-2xl">
                <svg class="w-12 h-12 sm:w-16 sm:h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
            </div>
        </div>

        <!-- Error Messages -->
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-4 sm:mb-6">
            <span class="gradient-text">Oops!</span>
        </h1>

        <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold text-gray-300 mb-4 sm:mb-6">
            Page Not Found
        </h2>

        <p class="text-base sm:text-lg text-gray-400 mb-8 sm:mb-12 max-w-md mx-auto leading-relaxed">
            The page you're looking for seems to have vanished into the digital void.
            Don't worry, it happens to the best of us!
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ url('/') }}"
                class="group relative px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl text-center">
                <span class="relative z-10">Go Back</span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-700 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </a>
        </div>

        <!-- Additional Help -->
        <div class="mt-12 sm:mt-16">
            <p class="text-sm text-gray-500 mb-4">Still lost? Try these:</p>
            <div class="flex flex-wrap gap-2 justify-center">
                <button onclick="searchSite()"
                    class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-md text-sm transition-colors duration-200">
                    Search Site
                </button>
                <button onclick="showHelp()"
                    class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-md text-sm transition-colors duration-200">
                    Get Help
                </button>
                <button onclick="reportIssue()"
                    class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-md text-sm transition-colors duration-200">
                    Report Issue
                </button>
            </div>
        </div>
    </div>

    <!-- Background Decoration -->
    <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-gray-900 to-transparent"></div>

    <script>
        function goHome() {
            // Redirect to home page
            window.location.href = '/';
        }

        function goBack() {
            // Go back to previous page
            window.history.back();
        }

        function searchSite() {
            // Implement site search functionality
            const query = prompt('What are you looking for?');
            if (query) {
                // Redirect to search results or implement search logic
                console.log('Searching for:', query);
                alert('Search functionality would be implemented here');
            }
        }

        function showHelp() {
            // Show help modal or redirect to help page
            alert('Help section would be implemented here');
        }

        function reportIssue() {
            // Report the broken link or issue
            alert('Issue reporting would be implemented here');
        }

        // Add some interactive particles on mouse move
        document.addEventListener('mousemove', function (e) {
            const particle = document.createElement('div');
            particle.className = 'absolute w-1 h-1 bg-blue-400 rounded-full pointer-events-none';
            particle.style.left = e.clientX + 'px';
            particle.style.top = e.clientY + 'px';
            particle.style.animation = 'particles 2s linear forwards';
            document.body.appendChild(particle);

            setTimeout(() => {
                particle.remove();
            }, 2000);
        });
    </script>
</body>

</html>