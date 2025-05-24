<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Intersection Observer for animations
            const animateOnScroll = function (entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in', 'opacity-100', 'translate-y-0', 'scale-100', 'translate-x-0');

                        // For staggered animations
                        if (entry.target.dataset.stagger) {
                            const staggerDelay = parseInt(entry.target.dataset.staggerDelay) || 100;
                            const children = entry.target.querySelectorAll('[data-stagger-child]');

                            children.forEach((child, index) => {
                                setTimeout(() => {
                                    child.classList.add('animate-fade-in', 'opacity-100', 'translate-y-0', 'scale-100', 'translate-x-0');
                                }, index * staggerDelay);
                            });
                        }

                        observer.unobserve(entry.target);
                    }
                });
            };

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(animateOnScroll, observerOptions);

            // Observe all elements with animation classes
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });

            // Hero section animation
            setTimeout(() => {
                document.querySelector('.hero-section')?.classList.add('opacity-100', 'translate-y-0', 'translate-x-0');
            }, 300);
        });
        window.addEventListener('DOMContentLoaded', () => {
            const el = document.getElementById('fade-in');
            el.classList.remove('opacity-0', 'translate-y-5');
            el.classList.add('opacity-100', 'translate-y-0');
        });

    </script>
    @vite('resources/css/app.css')
</head>

<body class="font-sans scroll-smooth">
    @include('components.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4 bg-white py-6 md:px-16">
        <!-- Hero Section -->
        <div class="container mx-auto">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-8 lg:gap-12">
                <!-- Left content -->
                <div
                    class="w-full lg:w-1/2 flex flex-col justify-center items-start gap-6 hero-section opacity-0 -translate-x-10 transition-all duration-700 ease-out">
                    <h1
                        class="text-black text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold leading-[120%] capitalize">
                        English Test That Measures The Ability To Communicate In Everyday Life.
                    </h1>

                    <p class="text-[#666] text-lg sm:text-xl md:text-2xl font-normal leading-[130%]">
                        Helping institutions to improve their reputation in the eyes of
                        employers and attract more prospective students and helping individuals to
                        expand their employment opportunities.
                    </p>

                    <div class="flex flex-col-reverse sm:flex-row gap-2 w-full sm:w-auto" data-stagger-child>
                        <a href="#"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center transform hover:scale-105 transition-transform">
                            Have Certificate?
                        </a>
                        <a href="#"
                            class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition text-center transform hover:scale-105 transition-transform">
                            Need Certificate?
                        </a>
                    </div>
                </div>

                <!-- Right image -->
                <div class="lg:w-1/2 hero-section opacity-0 translate-y-5 transition-all duration-700 ease-out"
                    onload="this.classList.remove('opacity-0', 'translate-y-5')" id="fade-in">
                    <img src="{{ asset('images/auditorium-seats.png') }}" alt="Blue auditorium seats"
                        class="w-full h-auto object-cover" loading="lazy">
                </div>
            </div>
        </div>

        <!-- Blue Gradient Section -->
        <section
            class="py-12 rounded-xl bg-gradient-to-b from-blue-800 via-blue-700 to-blue-600 via-30% from-10% mt-16 animate-on-scroll opacity-0 scale-95 transition-all duration-600 ease-out">
            <div class="container mx-auto text-center">
                <img src="/images/toest_logo.png" alt="TOEST Logo"
                    class="w-auto h-16 sm:h-20 md:h-24 lg:h-28 mx-auto transform hover:scale-105 transition-transform">
                <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-white mt-12">
                    Test of English for International Communication
                </p>
            </div>

            <div class="mt-8 px-4 sm:px-32">
                <h3 class="text-white text-lg sm:text-xl md:text-xl">
                    <b>TOEIC® Exam at Malang State Polytechnic</b> entitled to one free TOEIC
                    exam during their studies. If you wish to take additional exams, they are available through a paid
                    route at a special
                    discounted price. This system simplifies the process of registration, verification, and access to
                    exam-related
                    information.
                </h3>
            </div>

            <div class="text-white px-4 sm:px-32 mt-10">
                <h3 class="text-3xl sm:text-2xl font-bold">Terms and Conditions</h3>
                <ul class="list-disc list-inside space-y-3 text-lg sm:text-xl mt-6">
                    <li class="hover:text-blue-200 transition-colors duration-300">
                        <strong>One Free Exam Policy:</strong> Each student gets one free TOEIC exam during their
                        studies, non-transferable and must be taken within the institution's eligibility period.
                    </li>
                    <li class="hover:text-blue-200 transition-colors duration-300">
                        <strong>Additional Exams & Fees:</strong> Extra exams are available at a special discounted
                        price, with payment required before the registration deadline.
                    </li>
                    <li class="hover:text-blue-200 transition-colors duration-300">
                        <strong>Cancellations & Rescheduling:</strong> Notify the administration in advance if
                        unable to attend. Rescheduling depends on availability and may incur fees.
                    </li>
                    <li class="hover:text-blue-200 transition-colors duration-300">
                        <strong>Results & Certification:</strong> Scores will be available within the set timeframe
                        and can be downloaded from the portal.
                    </li>
                </ul>
            </div>

            <div class="w-full h-[2px] bg-blue-500 mt-12 mx-auto max-w-4xl"></div>

            <!-- Features Section -->
            <section
                class="pt-16 sm:pt-20 md:pt-24 lg:pt-32 mx-4 sm:mx-24 animate-on-scroll opacity-0 transition-all duration-700 ease-out"
                data-stagger data-stagger-delay="150">
                <div class="container mx-auto">
                    <h2 class="text-2xl sm:text-3xl font-bold text-center mb-8 text-white">
                        Our Features
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="p-6 bg-[#A0C4FF] rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-on-scroll opacity-0 translate-y-5"
                            data-stagger-child>
                            <img src="/images/Scadule.png" alt="Schedule"
                                class="w-auto h-8 sm:h-10 md:h-12 lg:h-14 mx-auto pb-2 transform hover:scale-110 transition-transform">
                            <h3 class="font-semibold text-lg text-center text-white">Exam Schedule and Information</h3>
                        </div>
                        <div class="p-6 bg-[#A0C4FF] rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-on-scroll opacity-0 translate-y-5 delay-100"
                            data-stagger-child>
                            <img src="/images/User.png" alt="Access"
                                class="w-auto h-8 sm:h-10 md:h-12 lg:h-14 mx-auto pb-2 transform hover:scale-110 transition-transform">
                            <h3 class="font-semibold text-lg text-center text-white">User Access and Rights</h3>
                        </div>
                        <div class="p-6 bg-[#A0C4FF] rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-on-scroll opacity-0 translate-y-5 delay-200"
                            data-stagger-child>
                            <img src="/images/Search.png" alt="Filter"
                                class="w-auto h-8 sm:h-10 md:h-12 lg:h-14 mx-auto pb-2 transform hover:scale-110 transition-transform">
                            <h3 class="font-semibold text-lg text-center text-white">Search and Filter Data</h3>
                        </div>
                        <div class="p-6 bg-[#A0C4FF] rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-on-scroll opacity-0 translate-y-5 delay-300"
                            data-stagger-child>
                            <img src="/images/Exam.png" alt="Registration"
                                class="w-auto h-8 sm:h-10 md:h-12 lg:h-14 mx-auto pb-2 transform hover:scale-110 transition-transform">
                            <h3 class="font-semibold text-lg text-center text-white">TOEIC Exam Registration</h3>
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <!-- Timeline Section -->
        <section
            class="py-12 px-6 mt-16 sm:mt-32 animate-on-scroll opacity-0 scale-95 transition-all duration-600 ease-out">
            <div class="container mx-auto text-center">
                <h2 class="text-2xl sm:text-3xl mb-4">Polinema <span class="text-blue-500 font-bold">TOEIC</span>
                    Registration Timeline</h2>
                <p class="text-lg text-gray-600">Follow the steps for a smooth registration process.</p>
                <img src="/images/Timeline.png" alt="TOEST Timeline"
                    class="w-auto h-64 sm:h-80 md:h-96 lg:h-112 mx-auto my-12 sm:my-24 transform hover:scale-105 transition-transform">
            </div>
        </section>

        <!-- Testimonials Section -->
        <section
            class="bg-blue-600 py-12 rounded-2xl bg-gradient-to-b from-blue-800 via-blue-700 to-blue-600 via-30% from-10% animate-on-scroll opacity-0 transition-all duration-700 ease-out">
            <div class="container mx-auto">
                <h2 class="text-2xl sm:text-3xl font-bold text-center text-white">Take a Look At Our Customer Interest
                    🤩</h2>
                <p class="text-lg sm:text-lg text-center text-white mb-8 mt-2">Your comments help us provide even better
                    service 🛠️</p>

                <div class="flex flex-col md:flex-row justify-center items-center gap-6 mx-4 sm:mx-12" data-stagger
                    data-stagger-delay="200">
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll opacity-0 translate-y-5"
                        data-stagger-child>
                        <blockquote>
                            <p class="text-gray-600">"This test is really helpful for testing English skills, especially
                                in listening and reading. It's quite challenging, but the format is clear so it doesn't
                                make you confused."</p>
                            <div class="flex items-center gap-2 mt-4">
                                <img src="/images/profile.png" alt="User"
                                    class="h-8 sm:h-10 md:h-12 lg:h-14 rounded-full">
                                <span class="font-medium">Hach Van</span>
                            </div>
                        </blockquote>
                    </div>
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll opacity-0 translate-y-5 delay-100"
                        data-stagger-child>
                        <blockquote>
                            <p class="text-gray-600">"Listening to the various accents, it was a bit difficult at first,
                                but the more you practice, the easier it is to grasp the conversation. Overall, this is
                                a really useful exercise for preparation!"</p>
                            <div class="flex items-center gap-2 mt-4">
                                <img src="/images/profile.png" alt="User"
                                    class="h-8 sm:h-10 md:h-12 lg:h-14 rounded-full">
                                <span class="font-medium">Hach Van</span>
                            </div>
                        </blockquote>
                    </div>
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll opacity-0 translate-y-5 delay-200"
                        data-stagger-child>
                        <blockquote>
                            <p class="text-gray-600">"The test interface is very user-friendly and the results came much
                                faster than I expected. Definitely recommend for anyone looking to certify their English
                                skills."</p>
                            <div class="flex items-center gap-2 mt-4">
                                <img src="/images/profile.png" alt="User"
                                    class="h-8 sm:h-10 md:h-12 lg:h-14 rounded-full">
                                <span class="font-medium">Hach Van</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-12 animate-on-scroll opacity-0 transition-all duration-700 ease-out" data-stagger
            data-stagger-delay="100">
            <div class="container mx-auto px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-center mb-4">
                    Frequently Asked Questions 🤷🏻‍♂️
                </h2>
                <p class="text-center text-sm pb-8 sm:pb-12 text-gray-500">
                    Got questions? Check out the FAQs below for quick answers<br class="hidden sm:block">
                    about the TOEIC exam registration, eligibility, fees, and more! 😊
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll opacity-0 translate-y-5"
                        data-stagger-child>
                        <div class="flex items-start gap-3">
                            <img src="/images/WhatIs.png" alt="Icon" class="h-6 sm:h-8 md:h-10 lg:h-12 flex-shrink-0">
                            <div>
                                <h3 class="font-semibold text-lg">What is The TOEIC Exam?</h3>
                                <p class="text-gray-600 mt-2">Measures English proficiency for the workplace with a
                                    focus on international communication in professional environments.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll opacity-0 translate-y-5 delay-100"
                        data-stagger-child>
                        <div class="flex items-start gap-3">
                            <img src="/images/WhatIs.png" alt="Icon" class="h-6 sm:h-8 md:h-10 lg:h-12 flex-shrink-0">
                            <div>
                                <h3 class="font-semibold text-lg">How do I pay for the TOEIC exam?</h3>
                                <p class="text-gray-600 mt-2">Payment can be made via bank transfer, credit card, or
                                    other available methods listed on our portal.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll opacity-0 translate-y-5 delay-200"
                        data-stagger-child>
                        <div class="flex items-start gap-3">
                            <img src="/images/WhatIs.png" alt="Icon" class="h-6 sm:h-8 md:h-10 lg:h-12 flex-shrink-0">
                            <div>
                                <h3 class="font-semibold text-lg">Who can take the TOEIC exam?</h3>
                                <p class="text-gray-600 mt-2">The exam is open to all students and professionals who
                                    need to certify their English proficiency for academic or career purposes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll opacity-0 translate-y-5 delay-300"
                        data-stagger-child>
                        <div class="flex items-start gap-3">
                            <img src="/images/WhatIs.png" alt="Icon" class="h-6 sm:h-8 md:h-10 lg:h-12 flex-shrink-0">
                            <div>
                                <h3 class="font-semibold text-lg">When will I get my results?</h3>
                                <p class="text-gray-600 mt-2">Results are typically available within 5-7 business days
                                    after taking the exam.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll opacity-0 translate-y-5 delay-400"
                        data-stagger-child>
                        <div class="flex items-start gap-3">
                            <img src="/images/WhatIs.png" alt="Icon" class="h-6 sm:h-8 md:h-10 lg:h-12 flex-shrink-0">
                            <div>
                                <h3 class="font-semibold text-lg">How long is the certificate valid?</h3>
                                <p class="text-gray-600 mt-2">TOEIC certificates are valid for two years from the date
                                    of issue.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll opacity-0 translate-y-5 delay-500"
                        data-stagger-child>
                        <div class="flex items-start gap-3">
                            <img src="/images/WhatIs.png" alt="Icon" class="h-6 sm:h-8 md:h-10 lg:h-12 flex-shrink-0">
                            <div>
                                <h3 class="font-semibold text-lg">Can I retake the exam?</h3>
                                <p class="text-gray-600 mt-2">Yes, you can retake the exam as many times as you need.
                                    There's no limit on attempts.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer
            class="bg-blue-100 text-blue-600 text-sm animate-on-scroll opacity-0 transition-all duration-700 ease-out">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between py-8">
                    <!-- Logo & Contact -->
                    <div class="mb-8 md:mb-0">
                        <div class="flex items-start justify-center transform hover:scale-105 transition-transform">
                            <img src="/images/Logo.png" alt="Logo" class="w-24 h-24 object-contain">
                        </div>
                        <p class="mb-1 hover:text-blue-800 transition-colors duration-300">Toeic@course.com</p>
                        <p class="hover:text-blue-800 transition-colors duration-300">+1 (201) 897-12413</p>
                    </div>

                    <!-- Links -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                        <div>
                            <h3 class="font-semibold mb-2">Company</h3>
                            <ul class="space-y-1">
                                <li><a href="#" class="hover:text-blue-800 transition-colors duration-300">Blog</a></li>
                                <li><a href="#" class="hover:text-blue-800 transition-colors duration-300">Careers</a>
                                </li>
                                <li><a href="#" class="hover:text-blue-800 transition-colors duration-300">Pricing</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-2">Resources</h3>
                            <ul class="space-y-1">
                                <li><a href="#"
                                        class="hover:text-blue-800 transition-colors duration-300">Documentation</a>
                                </li>
                                <li><a href="#" class="hover:text-blue-800 transition-colors duration-300">Papers</a>
                                </li>
                                <li><a href="#" class="hover:text-blue-800 transition-colors duration-300">Press
                                        Conferences</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-2">Legal</h3>
                            <ul class="space-y-1">
                                <li><a href="#" class="hover:text-blue-800 transition-colors duration-300">Terms of
                                        Service</a></li>
                                <li><a href="#" class="hover:text-blue-800 transition-colors duration-300">Privacy
                                        Policy</a></li>
                                <li><a href="#" class="hover:text-blue-800 transition-colors duration-300">Cookies
                                        Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <hr class="border-blue-300 my-4">

                <!-- Bottom Section -->
                <div class="flex flex-col md:flex-row justify-between items-center pb-6">
                    <!-- Copyright -->
                    <p class="font-bold mb-4 md:mb-0">© 2025 PBL TOEST. All rights reserved.</p>

                    <!-- Contact Info & Social Media -->
                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-12">
                        <!-- Phone -->
                        <div class="flex items-center space-x-2">
                            <img src="/images/Phone.png" alt="Phone" class="w-5 h-5">
                            <div>
                                <h3 class="text-xs font-semibold">Phone</h3>
                                <p class="text-xs hover:text-blue-800 transition-colors duration-300">0813-xxx-xxx-xxx
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-center space-x-2">
                            <img src="/images/Email.png" alt="Email" class="w-7 h-5">
                            <div>
                                <h3 class="text-xs font-semibold">Email</h3>
                                <p class="text-xs hover:text-blue-800 transition-colors duration-300">Toest@gmail.com
                                </p>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="flex space-x-3">
                            <a href="#" aria-label="Instagram"
                                class="transform hover:scale-110 transition-transform duration-300">
                                <img src="/images/instagram.png" alt="Instagram" class="w-6 h-6">
                            </a>
                            <a href="#" aria-label="Facebook"
                                class="transform hover:scale-110 transition-transform duration-300">
                                <img src="/images/facebook.png" alt="Facebook" class="w-7 h-7">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
</body>

</html>