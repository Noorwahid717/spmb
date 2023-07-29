@extends('theme::layouts.app')


@section('content')
<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Ujian Seleksi Potensi Akademik
                </h3>
                <div class="grid grid-cols-3 gap-1" style="width: 250px">
                    <div class="col">Prodi</div>
                    <div class="col">: S1 - Teknik Informatika</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{ asset('/themes/tailwind/images/quiz.png') }}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Info Seleksi
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Informasi seputar pelaksanaan seleksi
                </p>
            </div>

        </div>
        <div class="relative p-5">
            <h1 class="mb-5 text-5xl font-medium">Info</h1>
            <p class="py-0 my-0">Semua calon mahasiswa wajib melaksanakan seleksi sebelum dikukuhkan sebagai mahasiswa
                Universitas
                Wahidiyah secara resmi oleh Rektor Universitas Wahidiyah melalui Surat Keputusan. Seleksi terbagi
                menjadi 2, pertama seleksi akademik dimana mahasiswa akan diberikan soal pengetahuan umum dan
                pengetahuan bidang studi sesuai dengan program studi yang dipilih. Kedua seleksi non akademik dimana
                mahasiswa akan menghadapi tes wawancara, tes kemampuan membaca Al-Qur’an serta tes hafalan sholawat
                wahidiyah. Hasil seleksi akan menentukan apakah calon mahasiswa memenuhi syarat sebagai mahasiswa
                Universitas Wahidiyah atau tidak.
            </p>
            <h1 class="mt-6 mb-5 text-5xl font-medium">Jadwal</h1>
            <table style="border: 0px solid green">
                <tr>
                    <td style="width: 40%">
                        Seleksi Akademik
                    </td>
                    <td style="width: 5%">
                        :
                    </td>
                    <td style="width: 40%">
                        Tunggu info lebih lanjut
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">
                        Seleksi Non-Akademik
                    </td>
                    <td style="width: 5%">
                        :
                    </td>
                    <td style="width: 40%">
                        Tunggu info lebih lanjut
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">
                        Hasil Seleksi
                    </td>
                    <td style="width: 5%">
                        :
                    </td>
                    <td style="width: 40%">
                        Tunggu info lebih lanjut
                    </td>
                </tr>
            </table>


            <h1 class="mt-6 mb-5 text-5xl font-medium">Pelaksanaan Seleksi</h1>

            <b class="text-wave-600"> Seleksi akademik </b> : dilaksanakan secara serentak oleh seluruh
            calon mahasiswa baru Universitas Wahidiyah
            secara online pada menu <a class="text-wave-500" href="#">Pelaksanaan Seleksi</a> di tempat
            masing-masing sesuai jadwal yang telah
            ditentukan
            dengan menggunakan perangkat yang dimiliki seperti PC, HP, Laptop, dsb.
            <br>
            <b class="text-wave-600">Seleksi non akademik</b> : dilaksanakan secara bertahap sesuai dengan kelompok
            seleksi non akademik yang
            telah ditentukan sesuai lampiran pada jadwal.

            <h1 class="mt-6 mb-5 text-5xl font-medium">Hasil Seleksi</h1>
            Hasil seleksi dapat dilihat pada menu <a class="text-wave-500" href="#">Hasil Seleksi</a> sesuai dengan
            jadwal yang telah ditentukan.

        </div>
    </div>
</div>

@endsection