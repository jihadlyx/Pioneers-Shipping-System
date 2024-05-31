<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    />
{{--    <link rel="stylesheet" href="./css/style.css" />--}}
    @vite('resources/css/app.css')
    <title>Tailwind Portfolio</title>
</head>
<body class="font-nunito" x-data="{ dropdownOpen: false }">
<!-- into section -->
<div
    class="h-1/2 lg:h-screen bg-gradient-to-t from-blue-200 dark:from-slate-800 dark:to-slate-900 relative overflow-hidden"
>
    <!-- navbar -->
    <nav class="w-full fixed top-0 bg-white px-5  z-10 dark:bg-slate-900">
        <div class="container mx-auto  flex flex-row-reverse items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ asset('assets/images/logo/light-logo.png') }}" class="w-20 dark:hidden flex" alt="Logo" />
                <img src="{{ asset('assets/images/logo/dark-logo.png') }}" class="w-20 dark:flex hidden" alt="Logo" />
            </div>
            <ul
                class="hidden md:flex flex-row-reverse gap-10 text-gray-600 dark:text-gray-100 font-bold text-md uppercase"
            >
                <li class="hover:text-blue-500 transition-transform hover:scale-105">
                    <a href="#">الرئيسية</a>
                </li>
                <li class="hover:text-blue-500 transition-transform hover:scale-105">
                    <a href="#about">حول</a>
                </li>
                <li class="hover:text-blue-500 transition-transform hover:scale-105" >
                    <a href="#services">الخدمات</a>
                </li>
                <li class="hover:text-blue-500 transition-transform hover:scale-105">
                    <a href="#contact">اتصل بنا</a>
                </li>
                <li class="hidden hover:text-blue-500 transition-transform hover:scale-105">
                    <a
                        class="bg-indigo-600 text-white text-xl px-3 py-2 rounded-md font-semibold w-fit"
                        href="{{ route("register") }}"
                    >انشاء حساب</a
                    >
                </li>
                <li class="hover:text-blue-500 transition-transform hover:scale-105">
                    <a
                        class="bg-indigo-600 text-white text-xl px-3 py-2 rounded-md font-semibold w-fit"
                        href="{{ route("login") }}"
                    >تسجيل</a
                    >
                </li>
            </ul>
            <img
                id="moon"
                src=" {{ asset('assets/images/img/moon.png') }}"
                class="hidden md:block w-5 cursor-pointer"
                alt=""
            />
            <div id="hamburger" class="space-y-1 md:hidden cursor-pointer z-20">
                <div class="w-6 h-0.5 bg-black"></div>
                <div class="w-6 h-0.5 bg-black"></div>
                <div class="w-6 h-0.5 bg-black"></div>
            </div>
            <ul
                id="menu"
                class="hidden bg-indigo-900 absolute left-0 top-0 w-full p-10 rounded-b-3xl space-y-10 text-white text-center"
            >
                <li>
                    <a id="hLink" href="#">الرئيسية</a>
                </li>
                <li>
                    <a id="hLink" href="#about">حول</a>
                </li>
                <li>
                    <a id="hLink" href="#services">الخدمات</a>
                </li>
                <li>
                    <a id="hLink" href="#contact">اتصل بنا</a>
                </li>
                <li class="hover:text-blue-500 transition-transform hover:scale-105">
                    <a
                        class="bg-indigo-600 text-white text-xl px-3 py-2 rounded-md font-semibold w-fit"
                        href="{{ route("register") }}"
                    >تسجيل</a
                    >
                </li>
            </ul>
        </div>
    </nav>
    <!-- intro content -->
    <!-- image -->
    <img
        class="absolute bottom-0 right-0 lg:left-0 mx-auto h-5/6 object-cover"
        src=" {{ asset('assets/images/img/man.png') }}"
        alt=""
    />
    <!-- circle -->
    <div
        class="hidden lg:block absolute -bottom-1/4 right-0 left-0 mx-auto w-big h-big bg-indigo-900 rounded-full -z-10"
    ></div>
    <!-- animated text -->
    <div
        class="absolute top-1/3 right-5 text-end text-xl sm:right-10 sm:text-4xl md:right-1/4 md:text-6xl lg:right-5 xl:right-30 xl:text-7xl font-bold"
    >
        <span class="text-gray-600">شركة الفارس</span>
        <p class="text-red-500">للشحن والتوصيل</p>
    </div>
    <!-- texts -->
    <div
        class="hidden lg:flex text-end flex-col gap-5 rounded-md shadow-lg absolute top-0 bottom-0 m-auto left-10 bg-white dark:bg-slate-900 dark:shadow-slate-800 p-6 h-fit w-1/3"
    >
        <h1 class="text-4xl font-bold text-indigo-900">شركة الفارس</h1>
        <p class="text-gray-400">
            الفارس واحدة من شركات الشحن الرائدة في ليبيا، قدمت لسنوات عديدة خدمات متميزة في الشحن البري من خلال توفير أسطول ضخم ومتنوع من الشاحنات.
        </p>
{{--        <a--}}
{{--            class="bg-indigo-600 text-white text-xl px-3 py-2 rounded-md font-semibold w-fit"--}}
{{--            href="#contact"--}}
{{--        >Hire Me</a--}}
{{--        >--}}
    </div>
</div>
<!-- about -->
{{--<div id="about" class="px-10 dark:bg-slate-900">--}}
{{--    <div--}}
{{--        class="container mx-auto py-40 flex flex-col-reverse lg:flex-row items-center gap-20"--}}
{{--    >--}}
{{--        <!-- left -->--}}
{{--        <div class="relative">--}}
{{--            <img--}}
{{--                class="h-1/4 absolute top-0 left-0 -z-10"--}}
{{--                src=" {{ asset('assets/images/img/dots.png') }}"--}}
{{--                alt=""--}}
{{--            />--}}
{{--            <div class="h-full rounded-full overflow-hidden">--}}
{{--                <img src=" {{ asset('assets/images/img/portrait.png') }}" alt="" />--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- right -->--}}
{{--        <div class="my-auto flex flex-col gap-3">--}}
{{--            <h1 class="text-indigo-600 font-bold">ABOUT ME</h1>--}}
{{--            <h1 class="text-3xl font-medium dark:text-white">Better Design</h1>--}}
{{--            <h1 class="text-3xl font-medium dark:text-white">--}}
{{--                Better Experience--}}
{{--            </h1>--}}
{{--            <p class="text-gray-400">--}}
{{--                I design and build digital products. I'm also a multi-disciplinary--}}
{{--                maker with over 10 years of experiences in wide range of design--}}
{{--                disciplines.--}}
{{--            </p>--}}
{{--            <h2 class="text-gray-400 font-medium">HTML</h2>--}}
{{--            <div class="w-full bg-gray-200 h-1.5 rounded-md">--}}
{{--                <div class="w-full bg-indigo-600 h-1.5 rounded-md"></div>--}}
{{--            </div>--}}
{{--            <h2 class="text-gray-400 font-medium">Javascript</h2>--}}
{{--            <div class="w-full bg-gray-200 h-1.5 rounded-md">--}}
{{--                <div class="w-4/6 bg-indigo-600 h-1.5 rounded-md"></div>--}}
{{--            </div>--}}
{{--            <h2 class="text-gray-400 font-medium">React</h2>--}}
{{--            <div class="w-full bg-gray-200 h-1.5 rounded-md">--}}
{{--                <div class="w-5/6 bg-indigo-600 h-1.5 rounded-md"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- services -->--}}
{{--<div id="services" class="dark:bg-slate-900">--}}
{{--    <div class="container mx-auto">--}}
{{--        <!-- top -->--}}
{{--        <div class="flex flex-col gap-3 items-center">--}}
{{--            <h1 class="text-indigo-600 font-bold">SERVICES</h1>--}}
{{--            <h1 class="text-3xl dark:text-white">What do I offer?</h1>--}}
{{--            <p class="w-1/2 text-center text-gray-400">--}}
{{--                My approach to website design is to create a website that--}}
{{--                strengthens your company’s brand while ensuring ease of use and--}}
{{--                simplicity for your audience.--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <!-- bottom -->--}}
{{--        <div class="p-5 sm:p-0 flex flex-wrap justify-between">--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-4/12 shadow-xl rounded-lg p-5 my-3 md:my-10 flex flex-col gap-3"--}}
{{--            >--}}
{{--                <img class="w-10" src=" {{ asset('assets/images/img/icon.png') }}" alt="" />--}}
{{--                <h1 class="font-medium text-lg dark:text-white">UX / UI Design</h1>--}}
{{--                <p class="text-gray-400">--}}
{{--                    I specialize in creating interactive websites for individuals and--}}
{{--                    small businesses.--}}
{{--                </p>--}}
{{--                <a class="text-indigo-600 font-semibold text-sm" href=""--}}
{{--                >Read More</a--}}
{{--                >--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-4/12 shadow-xl rounded-lg p-5 my-3 md:my-10 flex flex-col gap-3"--}}
{{--            >--}}
{{--                <img class="w-10" src=" {{ asset('assets/images/img/icon.png') }}" alt="" />--}}
{{--                <h1 class="font-medium text-lg dark:text-white">UX / UI Design</h1>--}}
{{--                <p class="text-gray-400">--}}
{{--                    I specialize in creating interactive websites for individuals and--}}
{{--                    small businesses.--}}
{{--                </p>--}}
{{--                <a class="text-indigo-600 font-semibold text-sm" href=""--}}
{{--                >Read More</a--}}
{{--                >--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-4/12 shadow-xl rounded-lg p-5 my-3 md:my-10 flex flex-col gap-3"--}}
{{--            >--}}
{{--                <img class="w-10" src=" {{ asset('assets/images/img/icon.png') }}" alt="" />--}}
{{--                <h1 class="font-medium text-lg dark:text-white">UX / UI Design</h1>--}}
{{--                <p class="text-gray-400">--}}
{{--                    I specialize in creating interactive websites for individuals and--}}
{{--                    small businesses.--}}
{{--                </p>--}}
{{--                <a class="text-indigo-600 font-semibold text-sm" href=""--}}
{{--                >Read More</a--}}
{{--                >--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-4/12 shadow-xl rounded-lg p-5 my-3 md:my-10 flex flex-col gap-3"--}}
{{--            >--}}
{{--                <img class="w-10" src=" {{ asset('assets/images/img/icon.png') }}" alt="" />--}}
{{--                <h1 class="font-medium text-lg dark:text-white">UX / UI Design</h1>--}}
{{--                <p class="text-gray-400">--}}
{{--                    I specialize in creating interactive websites for individuals and--}}
{{--                    small businesses.--}}
{{--                </p>--}}
{{--                <a class="text-indigo-600 font-semibold text-sm" href=""--}}
{{--                >Read More</a--}}
{{--                >--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-4/12 shadow-xl rounded-lg p-5 my-3 md:my-10 flex flex-col gap-3"--}}
{{--            >--}}
{{--                <img class="w-10" src=" {{ asset('assets/images/img/icon.png') }}" alt="" />--}}
{{--                <h1 class="font-medium text-lg dark:text-white">UX / UI Design</h1>--}}
{{--                <p class="text-gray-400">--}}
{{--                    I specialize in creating interactive websites for individuals and--}}
{{--                    small businesses.--}}
{{--                </p>--}}
{{--                <a class="text-indigo-600 font-semibold text-sm" href=""--}}
{{--                >Read More</a--}}
{{--                >--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-4/12 shadow-xl rounded-lg p-5 my-3 md:my-10 flex flex-col gap-3"--}}
{{--            >--}}
{{--                <img class="w-10" src=" {{ asset('assets/images/img/icon.png') }}" alt="" />--}}
{{--                <h1 class="font-medium text-lg dark:text-white">UX / UI Design</h1>--}}
{{--                <p class="text-gray-400">--}}
{{--                    I specialize in creating interactive websites for individuals and--}}
{{--                    small businesses.--}}
{{--                </p>--}}
{{--                <a class="text-indigo-600 font-semibold text-sm" href=""--}}
{{--                >Read More</a--}}
{{--                >--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- works -->--}}
{{--<div id="works" class="py-40 dark:bg-slate-900">--}}
{{--    <div class="container mx-auto">--}}
{{--        <!-- top -->--}}
{{--        <div class="flex flex-col gap-3 items-center">--}}
{{--            <h1 class="text-indigo-600 font-bold">PORTFOLIO</h1>--}}
{{--            <h1 class="text-3xl dark:text-white">Works & Projects</h1>--}}
{{--            <p class="w-1/2 text-center text-gray-400">--}}
{{--                I help designers, small agencies and businesses bring their ideas to--}}
{{--                life. Powered by Figma, VS Code and coffee, I turn your requirements--}}
{{--                into a well-designed websites--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <!-- bottom -->--}}
{{--        <div class="p-5 sm:p-0 flex flex-wrap justify-between">--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-5/12 lg:w-1/5 shadow-xl rounded-lg my-3 md:my-10 m-1 transition-all hover:scale-110"--}}
{{--            >--}}
{{--                <img src=" {{ asset('assets/images/img/item.png') }}" />--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-5/12 lg:w-1/5 shadow-xl rounded-lg my-3 md:my-10 m-1 transition-all hover:scale-110"--}}
{{--            >--}}
{{--                <img src=" {{ asset('assets/images/img/item.png') }}" />--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-5/12 lg:w-1/5 shadow-xl rounded-lg my-3 md:my-10 m-1 transition-all hover:scale-110"--}}
{{--            >--}}
{{--                <img src=" {{ asset('assets/images/img/item.png') }}" />--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-5/12 lg:w-1/5 shadow-xl rounded-lg my-3 md:my-10 m-1 transition-all hover:scale-110"--}}
{{--            >--}}
{{--                <img src=" {{ asset('assets/images/img/item.png') }}" />--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-5/12 lg:w-1/5 shadow-xl rounded-lg my-3 md:my-10 m-1 transition-all hover:scale-110"--}}
{{--            >--}}
{{--                <img src=" {{ asset('assets/images/img/item.png') }}" />--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-5/12 lg:w-1/5 shadow-xl rounded-lg my-3 md:my-10 m-1 transition-all hover:scale-110"--}}
{{--            >--}}
{{--                <img src=" {{ asset('assets/images/img/item.png') }}" />--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-5/12 lg:w-1/5 shadow-xl rounded-lg my-3 md:my-10 m-1 transition-all hover:scale-110"--}}
{{--            >--}}
{{--                <img src=" {{ asset('assets/images/img/item.png') }}" />--}}
{{--            </div>--}}
{{--            <!-- card -->--}}
{{--            <div--}}
{{--                class="w-full md:w-5/12 lg:w-1/5 shadow-xl rounded-lg my-3 md:my-10 m-1 transition-all hover:scale-110"--}}
{{--            >--}}
{{--                <img src=" {{ asset('assets/images/img/item.png') }}" />--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- contact -->--}}
{{--<div id="contact" class="dark:bg-slate-900">--}}
{{--    <div class="container mx-auto">--}}
{{--        <!-- top -->--}}
{{--        <div class="flex flex-col gap-3 items-center">--}}
{{--            <h1 class="text-indigo-600 font-bold">CONTACT</h1>--}}
{{--            <h1 class="text-3xl dark:text-white">Have a Question?</h1>--}}
{{--            <p class="w-1/2 text-center text-gray-400">--}}
{{--                Do you have an idea? Let's discuss it and see what we can do--}}
{{--                together.--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <!-- bottom -->--}}
{{--        <form class="mt-5 p-8 flex flex-col gap-5 items-center">--}}
{{--            <input--}}
{{--                class="p-2 w-full md:w-1/2 ring-1 ring-indigo-300 rounded-sm dark:bg-slate-800 dark:ring-0 dark:text-white"--}}
{{--                type="text"--}}
{{--                placeholder="Name Surname"--}}
{{--            />--}}
{{--            <input--}}
{{--                class="p-2 w-full md:w-1/2 ring-1 ring-indigo-300 rounded-sm dark:bg-slate-800 dark:ring-0 dark:text-white"--}}
{{--                type="email"--}}
{{--                placeholder="Email"--}}
{{--            />--}}
{{--            <textarea--}}
{{--                class="p-2 w-full md:w-1/2 ring-1 ring-indigo-300 rounded-sm dark:bg-slate-800 dark:ring-0 dark:text-white"--}}
{{--                cols="30"--}}
{{--                rows="10"--}}
{{--                placeholder="Message..."--}}
{{--            ></textarea>--}}
{{--            <button--}}
{{--                class="w-1/2 bg-indigo-600 text-white font-medium px-3 py-2 rounded-md cursor-pointer"--}}
{{--            >--}}
{{--                Submit--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- footer -->--}}
{{--<div class="w-full bg-gray-800">--}}
{{--    <div class="container mx-auto py-5 flex items-center justify-between">--}}
{{--        <div class="flex items-center gap-2">--}}
{{--            <img class="w-8" src=" {{ asset('assets/images/img/logo.png') }}" alt="" />--}}
{{--            <span class="text-2xl font-bold text-white">Portwind.</span>--}}
{{--        </div>--}}
{{--        <span class="hidden md:block font-medium text-white"--}}
{{--        >© 2022 Portwind. Design with ♥️ by Lama Dev.</span--}}
{{--        >--}}
{{--        <div class="flex gap-2">--}}
{{--            <img class="w-4 cursor-pointer" src=" {{ asset('assets/images/img/facebook.png') }}" alt="" />--}}
{{--            <img class="w-4 cursor-pointer" src=" {{ asset('assets/images/img/instagram.png') }}" alt="" />--}}
{{--            <img class="w-4 cursor-pointer" src=" {{ asset('assets/images/img/twitter.png') }}" alt="" />--}}
{{--            <img class="w-4 cursor-pointer" src=" {{ asset('assets/images/img/linkedin.png') }}" alt="" />--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<script>
    const hamburger = document.querySelector("#hamburger")
    const menu = document.querySelector("#menu")
    const moon = document.querySelector("#moon")
    const body = document.querySelector("body")
    const hLinks = document.querySelectorAll("#hLink")

    hamburger.addEventListener("click", ()=>{
        menu.classList.toggle("hidden")
        hamburger.classList.toggle("bg-white")
    })

    hLinks.forEach(link=>{
        link.addEventListener("click", ()=>{
            menu.classList.toggle("hidden")
            hamburger.classList.toggle("bg-white")
        })
    })

    moon.addEventListener("click", ()=>{
        body.classList.toggle("dark")
    })
</script>
{{--<script src="{{ asset('assets/js/autotyping.js') }}"></script>--}}
</body>
</html>
