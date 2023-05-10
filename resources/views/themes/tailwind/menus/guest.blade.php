<nav class="flex items-center justify-end flex-1 hidden w-full h-full space-x-10 md:flex">
    <a href="{{ route('wave.blog') }}"
        class="text-base font-medium leading-6 text-gray-500 transition duration-150 ease-in-out hover:text-wave-600 focus:outline-none focus:text-wave-600">
        Berita
    </a>
    <div class="w-1 h-5 mx-10 border-r border-gray-300"></div>
    <a href="{{ route('login') }}"
        class="text-base font-medium leading-6 text-gray-500 whitespace-no-wrap hover:text-wave-600 focus:outline-none focus:text-gray-900">
        Masuk
    </a>
    <span class="inline-flex rounded-md shadow-sm">
        <a href="{{ route('register') }}"
            class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-500 hover:bg-wave-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-wave active:bg-wave-700">
            Daftar
        </a>
    </span>
</nav>