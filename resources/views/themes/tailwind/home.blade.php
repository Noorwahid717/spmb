@extends('theme::layouts.app')

@section('content')


<div class="relative flex items-center w-full">
    <div class="relative z-20 px-8 mx-auto xl:px-5 max-w-7xl">
        <div class="flex justify-center">
            <button id="alur_click"
                class="mx-1 inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium"
                style="border-bottom-left-radius: 20px;">
                Pendaftaran
            </button>
            <button id="brosur_click"
                class="mx-1 inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium">
                Brosur
            </button>
            <button id="syarat_click"
                class="mx-1 inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium"
                style="border-bottom-right-radius: 20px;">
                Persyaratan
            </button>
        </div>
        <div class="flex flex-col items-center h-full pt-16 pb-56 lg:flex-row">
            <div
                class="flex flex-col items-start w-full mb-16 md:items-center lg:pr-12 lg:items-start lg:w-1/2 lg:mb-0">

                <h2 class="invisible text-sm font-semibold tracking-wide text-gray-700 uppercase transition-none duration-700 ease-out transform translate-y-12 opacity-0 sm:text-base lg:text-sm xl:text-base"
                    data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }'>
                    {{ theme('home_headline') }}</h2>
                <h1 class="invisible pb-2 mt-3 text-4xl font-extrabold leading-10 tracking-tight text-transparent transition-none duration-700 ease-out delay-150 transform translate-y-12 opacity-0 bg-clip-text bg-gradient-to-r from-blue-600 via-blue-500 to-purple-600 scale-10 md:my-5 sm:leading-none lg:text-5xl xl:text-6xl"
                    data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }'>
                    {{ theme('home_subheadline') }}</h1>
                <p class="invisible max-w-2xl mt-0 text-base text-left text-gray-600 transition-none duration-700 ease-out delay-300 transform translate-y-12 opacity-0 md:text-center lg:text-left sm:mt-2 md:mt-0 sm:text-base lg:text-lg xl:text-xl"
                    data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }'>
                    {{ theme('home_description') }}</p>
                <div class="invisible w-full mt-5 transition-none duration-700 ease-out transform translate-y-12 opacity-0 delay-450 sm:mt-8 sm:flex sm:justify-center lg:justify-start sm:w-auto"
                    data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-y-12": "translate-y-0", "opacity-0": "opacity-100" }'>
                    <div class="rounded-md">
                        <a href="{{ theme('home_cta_url') }}"
                            class="flex items-center justify-center w-full px-8 py-3 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-500 hover:bg-wave-600 focus:outline-none focus:border-wave-600 focus:shadow-outline-indigo md:py-4 md:text-lg md:px-10">
                            {{ theme('home_cta') }}
                        </a>
                    </div>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                        <a href="{{url('/login')}}"
                            class="flex items-center justify-center w-full px-8 py-3 text-base font-medium leading-6 text-indigo-700 transition duration-150 ease-in-out bg-indigo-100 border-2 border-transparent rounded-md hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-300 md:py-4 md:text-lg md:px-10">
                            Masuk
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex w-full mb-16 lg:w-1/2 lg:mb-0">

                <div class="relative invisible transition-none duration-1000 delay-100 transform translate-x-12 opacity-0"
                    data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-x-12": "translate-y-0", "opacity-0": "opacity-100" }'>
                    <img src="{{ Voyager::image(theme('home_promo_image')) }}" class="w-full max-w-3xl sm:w-auto">
                </div>

            </div>
        </div>
    </div>



</div>

<div class="relative z-40 -mt-64">

    <svg viewBox="0 0 120 28" class="-mt-64">
        <defs>
            <path id="wave"
                d="M 0,10 C 30,10 30,15 60,15 90,15 90,10 120,10 150,10 150,15 180,15 210,15 210,10 240,10 v 28 h -240 z" />
        </defs>
        <use id="wave3" class="wave" xlink:href="#wave" x="0" y="-2"></use>
        <use id="wave2" class="wave" xlink:href="#wave" x="0" y="0"></use>
        <use id="wave1" class="wave" xlink:href="#wave" x="0" y="1" />
    </svg>
</div>

{{-- FEATURES SECTION --}}
<section
    class="relative z-40 w-full pt-10 pb-16 lg:pt-5 xl:-mt-24 bg-gradient-to-b from-wave-500 via-wave-600 to-wave-400">

    <div class="absolute top-0 left-0 z-10 w-full h-full transform -translate-x-1/2 opacity-10">
        <svg class="w-full h-full text-white opacity-25 fill-current" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 205 205">
            <defs />
            <g fill="#FFF" fill-rule="evenodd">
                <path
                    d="M182.63 37c14.521 18.317 22.413 41.087 22.37 64.545C205 158.68 159.1 205 102.486 205c-39.382-.01-75.277-22.79-92.35-58.605C-6.939 110.58-2.172 68.061 22.398 37a105.958 105.958 0 00-9.15 43.352c0 54.239 39.966 98.206 89.265 98.206 49.3 0 89.265-43.973 89.265-98.206A105.958 105.958 0 00182.629 37z" />
                <path
                    d="M103.11 0A84.144 84.144 0 01150 14.21C117.312-.651 78.806 8.94 56.7 37.45c-22.105 28.51-22.105 68.58 0 97.09 22.106 28.51 60.612 38.101 93.3 23.239-30.384 20.26-70.158 18.753-98.954-3.75-28.797-22.504-40.24-61.021-28.47-95.829C34.346 23.392 66.723.002 103.127.006L103.11 0z" />
                <path
                    d="M116.479 13c36.655-.004 67.014 28.98 69.375 66.234 2.36 37.253-24.089 69.971-60.44 74.766 29.817-8.654 48.753-38.434 44.308-69.685-4.445-31.25-30.9-54.333-61.904-54.014-31.003.32-56.995 23.944-60.818 55.28v-1.777C46.99 44.714 78.096 13.016 116.479 13z" />
            </g>
        </svg>
    </div>

    <div id="alur_pendaftaran"
        class="relative z-20 flex flex-col items-start justify-start px-8 mx-auto sm:items-center max-w-7xl xl:px-5">
        <h2 class="text-4xl font-medium leading-9 text-white">Alur Proses Penerimaan Mahasiswa Baru Universitas
            Wahidiyah</h2>
        {{-- <p class="mt-4 leading-6 sm:text-center text-wave-200">Keterangan<br class="hidden md:block"> Deskripsi</p>
        --}}

        <div class="grid mt-16 gap-y-10 sm:grid-cols-2 sm:gap-x-8 md:gap-x-12 lg:grid-cols-3 xl:grid-cols-4 lg:gap-20">
            @foreach(\App\Models\SpmbStep::all() as $item)
            @if($item['id']==4)
            @if(\App\Models\SpmbConfig::where('id',1)->first()->kip_enable=="true")
            <div>
                <img src="{{ $item['icon'] }}" class="w-18 rounded sm:mx-auto">
                <h3 class="mt-6 text-sm font-semibold leading-6 sm:text-center text-wave-100">{{ $item['title'] }}</h3>
                <p class="mt-2 text-sm leading-5 sm:text-center text-wave-200">{{ $item['description'] }}</p>
            </div>
            @endif
            @else
            <div>
                <img src="{{ $item['icon'] }}" class="w-18 rounded sm:mx-auto">
                <h3 class="mt-6 text-sm font-semibold leading-6 sm:text-center text-wave-100">{{ $item['title'] }}</h3>
                <p class="mt-2 text-sm leading-5 sm:text-center text-wave-200">{{ $item['description'] }}</p>
            </div>
            @endif
            @endforeach
        </div>

    </div>
</section>

<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" class="bg-gray-100"
    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1440 156"
    style="enable-background:new 0 0 1440 126;" xml:space="preserve">
    <style type="text/css">
        .wave-svg {
            fill: #0069ff;
        }

        .wave-svg-lighter {
            fill: #4c95fe
        }
    </style>
    <g fill-rule="nonzero">
        <path class="wave-svg"
            d="M694,94.437587 C327,161.381336 194,153.298248 0,143.434189 L2.01616501e-13,44.1765618 L1440,27 L1440,121 C1244,94.437587 999.43006,38.7246898 694,94.437587 Z"
            id="Shape" fill="#0069FF" opacity="0.519587054"></path>
        <path class="wave-svg"
            d="M686.868924,95.4364002 C416,151.323752 170.73341,134.021565 1.35713663e-12,119.957876 L0,25.1467017 L1440,8 L1440,107.854321 C1252.11022,92.2972893 1034.37894,23.7359827 686.868924,95.4364002 Z"
            id="Shape" fill="#0069FF" opacity="0.347991071"></path>
        <path class="wave-svg-lighter"
            d="M685.6,30.8323303 C418.7,-19.0491687 170.2,1.94304528 0,22.035593 L0,118 L1440,118 L1440,22.035593 C1252.7,44.2273621 1010,91.4098622 685.6,30.8323303 Z"
            transform="translate(720.000000, 59.000000) scale(1, -1) translate(-720.000000, -59.000000) "></path>
    </g>
</svg>


<!-- BEGINNING OF TESTIMONIALS SECTION -->
<div id="testimonials">
    <div class="relative flex items-center justify-center pt-32 pb-12 bg-gray-100 md:pb-32 lg:pb-64 min-w-screen">
        <div class="max-w-6xl px-10 pb-20 mx-auto bg-gray-100">
            <div class="flex flex-col items-center lg:flex-row">
                <img id="brosur_pmb" src="{{ asset('/storage/brosur/brosur_2023.png') }}"
                    class="w-200 rounded sm:mx-auto">
            </div>
        </div>

        <svg version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 w-full"
            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1440 126"
            style="enable-background:new 0 0 1440 126;" xml:space="preserve">
            <style type="text/css">
                .wave-svg-light {
                    fill: #ffffff;
                }
            </style>
            <g id="wave" transform="translate(720.000000, 75.000000) scale(1, -1) translate(-720.000000, -75.000000) "
                fill-rule="nonzero">
                <path class="wave-svg-light"
                    d="M694,94.437587 C327,161.381336 194,153.298248 0,143.434189 L2.01616501e-13,44.1765618 L1440,27 L1440,121 C1244,94.437587 999.43006,38.7246898 694,94.437587 Z"
                    id="Shape" fill="#0069FF" opacity="0.519587054"></path>
                <path class="wave-svg-light"
                    d="M686.868924,95.4364002 C416,151.323752 170.73341,134.021565 1.35713663e-12,119.957876 L0,25.1467017 L1440,8 L1440,107.854321 C1252.11022,92.2972893 1034.37894,23.7359827 686.868924,95.4364002 Z"
                    id="Shape" fill="#0069FF" opacity="0.347991071"></path>
                <path class="wave-svg-light"
                    d="M685.6,30.8323303 C418.7,-19.0491687 170.2,1.94304528 0,22.035593 L0,118 L1440,118 L1440,22.035593 C1252.7,44.2273621 1010,91.4098622 685.6,30.8323303 Z"
                    id="Shape" fill="url(#linearGradient-1)"
                    transform="translate(720.000000, 59.000000) scale(1, -1) translate(-720.000000, -59.000000) ">
                </path>
            </g>
        </svg>

    </div>
</div>
<!-- END OF TESTIMONIALS SECTION -->


<!-- BEGINNING OF PRICING SECTION -->
<div id="syarat_pendaftaran" class="relative">

    <div class="relative z-20 px-8 pb-8 mx-auto max-w-7xl xl:px-5">
        <div class="w-full text-left sm:text-center">
            <h2 class="pt-12 text-4xl font-extrabold text-gray-900 lg:text-5xl">Persyaratan Pendaftaran</h2>
            <p class="w-full my-1 text-base text-left text-gray-900 opacity-75 sm:my-2 sm:text-center sm:text-xl">

            </p>
        </div>

        <div class="px-2 mx-auto mt-12 max-w-7xl">
            <div class="w-full p-10 text-gray-600 bg-blue-50 rounded-xl">
                <div class="flex items-center pb-4">
                    <svg class="mr-2 w-14 h-14 text-wave-500" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                        <path fill-rule="evenodd"
                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="relative">
                        <h2 class="text-base font-bold text-wave-500">Persiapkan beberapa dokumen berikut untuk mulai
                            melakukan pendaftaran online</h2>
                        <p class="text-sm text-blue-400">Pastikan ukuran foto dokumen-dokumen tidak melebihi 3 MB, serta
                            pastikan pula format dokumen yang diupload adalah format pdf atau format gambar (jpg, jpeg,
                            png).</p>
                    </div>
                </div>
                <div class="relative px-10 pt-0 pb-12 mt-auto text-gray-700 rounded-b-lg">
                    <?php
                    $features = [
                        "Upload Foto Bukti Transfer Biaya Pendaftaran",
                        "Upload Foto KTP Calon Mahasiswa",
                        "Upload Pas Foto Calon Mahasiswa",
                        "Upload Foto KTP Ayah",
                        "Upload Foto KTP Ibu",
                        "Upload Foto Kartu Keluarga",
                        "Upload Foto KTP Wali",
                        "Upload Foto Akta Kelahiran",
                        "Upload Foto Ijasah",
                        "Upload Foto Nilai Ujian Sekolah",
                        "Upload Foto Nilai Rapor",
                    ]
                    ?>
                    <ul class="flex flex-col space-y-2.5">
                        @foreach($features as $feature)
                        <li class="relative">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-3 text-green-500 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"></path>
                                </svg>

                                <span>
                                    {{ $feature }}
                                </span>
                            </span>
                        </li>
                        @endforeach
                    </ul>


                </div>
            </div>
        </div>

    </div>
</div>
<!-- END OF PRICING SECTION -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script>
    $("#alur_click").click(function() {
        $('html, body').animate({
            scrollTop: $("#alur_pendaftaran").offset().top
        }, 1000);
    });
    $("#syarat_click").click(function() {
        $('html, body').animate({
            scrollTop: $("#syarat_pendaftaran").offset().top
        }, 1000);
    });
    $("#brosur_click").click(function() {
        $('html, body').animate({
            scrollTop: $("#brosur_pmb").offset().top
        }, 1000);
    });
    
</script>
@endsection