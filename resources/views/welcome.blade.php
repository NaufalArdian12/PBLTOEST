<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>

<body>
    @include('components.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4 bg-white py-6 md:px-16">
        <div class="container mx-auto">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-8 lg:gap-12">
                {{-- Left side content --}}
                <div class="w-full lg:w-1/2 flex flex-col justify-center items-start gap-6">
                    <h1
                        class="text-black text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold leading-[120%] capitalize">
                        English Test That Measures The Ability To Communicate In Everyday Life.
                    </h1>

                    <p class="text-[#666] text-lg sm:text-xl md:text-2xl font-normal leading-[130%]">
                        Helping institutions to improve their reputation in the eyes of
                        employers and attract more prospective students and helping individuals to
                        expand their employment opportunities.
                    </p>

                    <div class="flex flex-col-reverse sm:flex-row gap-2 w-full sm:w-auto">
                        <a href=""
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center">
                            Have Certificate?
                        </a>

                        <a href=""
                            class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition text-center">
                            Need Certificate?
                        </a>
                    </div>
                </div>

                {{-- Right side image --}}
                <div class="lg:block lg:w-1/2">
                    <img src="{{ asset('images/auditorium-seats.png') }}" alt="Blue auditorium seats"
                        class="rounded-lg w-full h-auto object-cover" loading="lazy">
                </div>
            </div>
        </div>
        <br>
        <section class="bg-blue-600 py-12 rounded-xl">
            <div class="container mx-auto text-center">
                <img src="/images/toest_logo.png" alt="TOEST Logo"
                    class="w-auto h-16 sm:h-20 md:h-24 lg:h-28 mx-auto" />
                <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-white mt-12">
                    Test of English for International Communication
                </p>
            </div>
            <br>
            <div>
                <h3 class="text-white px-32 text-lg sm:text-xl md:text-2xl"><b>TOEIC® Exam at Malang State
                        Polytechnic</b> entitled to one free TOEIC
                    exam during their studies.
                    If you wish to take additional exams, they are available through a paid route at a special
                    discounted price.
                    This system simplifies the process of registration, verification, and access to exam-related
                    information.</h3>
            </div>
            <div>
                <div class="text-white px-32">
                    <h3 class="text-3xl sm:text-4xl font-bold mb-6">Terms and Conditions</h3>
                    <ul class="list-disc list-inside space-y-3 text-lg sm:text-xl">
                        <li>
                            <strong>One Free Exam Policy:</strong> Each student gets one free TOEIC exam during their
                            studies, non-transferable and must be taken within the institution's eligibility period.
                        </li>
                        <li>
                            <strong>Additional Exams & Fees:</strong> Extra exams are available at a special discounted
                            price, with payment required before the registration deadline.
                        </li>
                        <li>
                            <strong>Cancellations & Rescheduling:</strong> Notify the administration in advance if
                            unable to attend. Rescheduling depends on availability and may incur fees.
                        </li>
                        <li>
                            <strong>Results & Certification:</strong> Scores will be available within the set timeframe
                            and can be downloaded from the portal.
                        </li>
                    </ul>
                </div>
            </div>

            <section>
                <div class="w-full h-[2px] bg-blue-500 mt-12"></div>
            </section>

            <section class="pt-16 sm:pt-20 md:pt-24 lg:pt-32 mx-24">
                <div class="container mx-auto">
                    <h2 class="text-2xl sm:text-3xl font-bold text-center mb-8 text-white">
                        Our Feature
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                        <div class="p-6 bg-[#A0C4FF] rounded-lg shadow-md">
                            <img src="/images/Scadule.png" alt="Scadule"
                                class="w-auto h-8 sm:h-10 md:h-12 lg:h-14 mx-auto pb-2" />
                            <h3 class="font-semibold text-lg text-center text-white">Exam Schedule and Information</h3>
                        </div>
                        <div class="p-6 bg-[#A0C4FF] rounded-lg shadow-md">
                            <img src="/images/User.png" alt="Access"
                                class="w-auto h-8 sm:h-10 md:h-12 lg:h-14 mx-auto pb-2" />
                            <h3 class="font-semibold text-lg text-center text-white">User Access and Rights</h3>
                        </div>
                        <div class="p-6 bg-[#A0C4FF] rounded-lg shadow-md">
                            <img src="/images/Search.png" alt="Filter"
                                class="w-auto h-8 sm:h-10 md:h-12 lg:h-14 mx-auto pb-2" />
                            <h3 class="font-semibold text-lg text-center text-white">Search and Filter Data</h3>
                        </div>
                        <div class="p-6 bg-[#A0C4FF] rounded-lg shadow-md">
                            <img src="/images/Exam.png" alt="registeration"
                                class="w-auto h-8 sm:h-10 md:h-12 lg:h-14 mx-auto pb-2" />
                            <h3 class="font-semibold text-lg text-center text-white">TOEIC Exam Registration</h3>
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <section class="py-12 px-6 mt-32">
            <div class="container mx-auto text-center">
                <h2 class="text-2xl sm:text-3xl mb-4">Polinema <b class="text-blue-500">TOEIC</b> Registration Timeline
                </h2>
                <p class="text-lg text-gray-600">Follow the steps for a smooth registration process.</p>
                <img src="/images/Timeline.png" alt="TOEST Logo"
                    class="w-auto h-64 sm:h-80 md:h-96 lg:h-112 mx-auto my-24" />
            </div>
        </section>

        <section class="bg-blue-600 py-12 rounded-2xl">
            <div class="container mx-auto">
                <h2 class="text-2xl sm:text-3xl font-bold text-center text-white">Take a Look For our customer
                    Interest🤩</h2>
                <h2 class="text-l sm:text-l text-center text-white mb-8">your comments help us provide even better
                    service🛠️</h2>
                <div class="flex flex-col md:flex-row justify-center items-center gap-3 mx-12">
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md">
                        <blockquote>
                            <p class="text-gray-600">“This test is really helpful for testing English skills, especially
                                in listening and reading. It's quite challenging, but the format is clear so it doesn't
                                make you confused.”</p>
                            <div class="flex items-center gap-2 mt-4">
                                <img src="/images/PFP ALL.png" alt="TOEST Logo" class="h-8 sm:h-10 md:h-12 lg:h-14" />
                                <span class="font-medium">Hach Van</span>
                            </div>
                        </blockquote>
                    </div>
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md">
                        <blockquote>
                            <p class="text-gray-600">“Listening to the various accents, it was a bit difficult at first,
                                but the more you practice, the easier it is to grasp the conversation. Overall, this is
                                a really useful exercise for preparation!”</p>
                            <div class="flex items-center gap-2 mt-4">
                                <img src="/images/PFP ALL.png" alt="TOEST Logo" class="h-8 sm:h-10 md:h-12 lg:h-14" />
                                <span class="font-medium">Hach Van</span>
                            </div>
                        </blockquote>
                    </div>
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md">
                        <blockquote>
                            <p class="text-gray-600">“Listening to the various accents, it was a bit difficult at first,
                                but the more you practice, the easier it is to grasp the conversation. Overall, this is
                                a really useful exercise for preparation!”</p>
                            <div class="flex items-center gap-2 mt-4">
                                <img src="/images/PFP ALL.png" alt="TOEST Logo" class="h-8 sm:h-10 md:h-12 lg:h-14" />
                                <span class="font-medium">Hach Van</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12">
            <div class="container mx-auto">
                <h2 class="text-2xl sm:text-3xl font-bold text-center mb-4">
                    Freqruently Asked Question🤷🏻‍♂️
                </h2>
                <p class="text-center text-sm pb-12 text-gray-500">
                    Got questions? Check out the FAQs below for quick answers<br class="hidden sm:block" />
                    about the TOEIC exam registration, eligibility, fees, and more! 😊
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <img src="/images/WhatIs.png" alt="TOEST Logo" class="h-6 sm:h-8 md:h-10 lg:h-12" />
                        <span class="font-semibold">What is The TOEIC Exam?</span>
                        <p class="text-gray-600">Measures English proficiency for the workplace.</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow-md">
                         <img src="/images/WhatIs.png" alt="TOEST Logo" class="h-6 sm:h-8 md:h-10 lg:h-12" />
                        <span class="font-semibold">How do I pay for the TOEIC exam?</span>
                        <p>The TOEIC (Test of English for International Communication) measures English proficiency for the workplace.</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow-md">
                         <img src="/images/WhatIs.png" alt="TOEST Logo" class="h-6 sm:h-8 md:h-10 lg:h-12" />
                        <span class="font-semibold">Who can take the TOEIC exam at Malang State Polytechnic?</span>
                        <p>Payment can be made via bank transfer or other available methods listed on the portal.</p>
                    </div>
                    
                    <div class="p-6 bg-white rounded-lg shadow-md">
                         <img src="/images/WhatIs.png" alt="TOEST Logo" class="h-6 sm:h-8 md:h-10 lg:h-12" />
                        <span class="font-semibold">Can I take the TOEIC exam more than once?</span>
                        <p>Payment can be made via bank transfer or other available methods listed on the portal.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-blue-600 text-white py-6">
            <div class="container mx-auto text-center">
                <p>© 2023 POL TOEST. All rights reserved.</p>
            </div>
        </footer>

    </main>
</body>

</html>