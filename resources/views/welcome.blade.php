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
                    <h1 class="text-black text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold leading-[120%] capitalize">
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
                        class="rounded-lg w-full h-auto object-cover shadow-lg" loading="lazy">
                </div>
            </div>
        </div>
    </main>
  </body>
</html>
