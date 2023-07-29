@extends('theme::layouts.app')


@section('content')
<div class="flex flex-col px-2 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
    {{-- SELEKSI AKADEMIK --}}
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{asset('/themes/tailwind/images/cap.png')}}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Seleksi Potensi Akademik
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Informasi terbaru
                </p>
            </div>

        </div>
        <div class="relative">
            {{-- row jadwal dan roles --}}
            <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                    <div class="relative p-3">
                        <h3>Jadwal</h3>
                        <hr class="mb-3 mt-1">
                        <div class="form-group mb-3 text-xs">
                            <label for="sesi_academic">Nama Sesi:</label>
                            <input type="text" name="sesi_academic" id="sesi_academic"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examAca!=null?$examAca->nama_sesi:'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="tanggal_academic">Tanggal Seleksi:</label>
                            <input type="text" name="tanggal_academic" id="tanggal_academic"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examAca!=null?date('d F Y', strtotime($examAca->tanggal)):'belum terjadwal'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="mulai_academic">Waktu Mulai:</label>
                            <input type="text" name="mulai_academic" id="mulai_academic"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examAca!=null?substr($examAca->waktu_mulai, 0, 5):'belum terjadwal'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="selesai_academic">Waktu Selesai:</label>
                            <input type="text" name="selesai_academic" id="selesai_academic"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examAca!=null?substr($examAca->waktu_selesai, 0, 5):'belum terjadwal'}}"
                                readonly>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150  mt-3 lg:mt-0">
                    <div class="relative p-3">
                        <h3>Aturan dan Ketentuan</h3>
                        <hr class="mb-3 mt-1">
                        <p class="text-sm leading-5 text-gray-500 mt">
                            {{$examCat[0]->keterangan}}
                        </p>
                    </div>
                </div>
            </div>
            {{-- row hasil seleksi --}}
            <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                    <div class="relative p-3">
                        <h3>Hasil Seleksi</h3>
                        <hr class="mb-3 mt-1">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SELEKSI WAWANCARA --}}
    <div
        class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150 mt-5 lg:mt-0">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{asset('/themes/tailwind/images/interview.png')}}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Seleksi Wawancara
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Informasi terbaru
                </p>
            </div>

        </div>
        <div class="relative">
            {{-- row jadwal dan roles --}}
            <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                    <div class="relative p-3">
                        <h3>Jadwal</h3>
                        <hr class="mb-3 mt-1">
                        <div class="form-group mb-3 text-xs">
                            <label for="penguji_interview">Nama Penguji:</label>
                            <input type="text" name="penguji_interview" id="penguji_interview"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examInt!=null?$examInt->nama_penguji:'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="sesi_interview">Nama Sesi:</label>
                            <input type="text" name="sesi_interview" id="sesi_interview"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examInt!=null?$examInt->nama_sesi:'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="tanggal_interview">Tanggal Seleksi:</label>
                            <input type="text" name="tanggal_interview" id="tanggal_interview"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examInt!=null?date('d F Y', strtotime($examInt->tanggal)):'belum terjadwal'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="waktu_interview">Waktu Seleksi:</label>
                            <input type="text" name="waktu_interview" id="waktu_interview"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examInt!=null?substr($examInt->waktu, 0, 5):'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="tempat_interview">Tempat Seleksi:</label>
                            <input type="text" name="tempat_interview" id="tempat_interview"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examInt!=null?$examInt->tempat:'belum terjadwal'}}" readonly>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150  mt-3 lg:mt-0">
                    <div class="relative p-3">
                        <h3>Aturan dan Ketentuan</h3>
                        <hr class="mb-3 mt-1">
                        <p class="text-sm leading-5 text-gray-500 mt">
                            {{$examCat[1]->keterangan}}
                        </p>
                    </div>
                </div>
            </div>
            {{-- row hasil seleksi --}}
            <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                    <div class="relative p-3">
                        <h3>Hasil Seleksi</h3>
                        <hr class="mb-3 mt-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col px-2 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
    {{-- SELEKSI BACA AL-QURAN --}}
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{asset('/themes/tailwind/images/quran.png')}}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Seleksi Baca Al-Quran
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Informasi terbaru
                </p>
            </div>

        </div>
        <div class="relative">
            {{-- row jadwal dan roles --}}
            <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                    <div class="relative p-3">
                        <h3>Jadwal</h3>
                        <hr class="mb-3 mt-1">
                        <div class="form-group mb-3 text-xs">
                            <label for="penguji_read_quran">Nama Penguji:</label>
                            <input type="text" name="penguji_read_quran" id="penguji_read_quran"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRQ!=null?$examRQ->nama_penguji:'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="sesi_read_quran">Nama Sesi:</label>
                            <input type="text" name="sesi_read_quran" id="sesi_read_quran"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRQ!=null?$examRQ->nama_sesi:'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="tanggal_read_quran">Tanggal Seleksi:</label>
                            <input type="text" name="tanggal_read_quran" id="tanggal_read_quran"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRQ!=null?date('d F Y', strtotime($examRQ->tanggal)):'belum terjadwal'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="waktu_read_quran">Waktu Seleksi:</label>
                            <input type="text" name="waktu_read_quran" id="waktu_read_quran"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRQ!=null?substr($examRQ->waktu, 0, 5):'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="tempat_read_quran">Tempat Seleksi:</label>
                            <input type="text" name="tempat_read_quran" id="tempat_read_quran"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRQ!=null?$examRQ->tempat:'belum terjadwal'}}" readonly>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150  mt-3 lg:mt-0">
                    <div class="relative p-3">
                        <h3>Aturan dan Ketentuan</h3>
                        <hr class="mb-3 mt-1">
                        <p class="text-sm leading-5 text-gray-500 mt">
                            {{$examCat[2]->keterangan}}
                        </p>
                    </div>
                </div>
            </div>
            {{-- row hasil seleksi --}}
            <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                    <div class="relative p-3">
                        <h3>Hasil Seleksi</h3>
                        <hr class="mb-3 mt-1">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SELEKSI HAFALAN SHALAWAT WAHIDIYAH --}}
    <div
        class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150 mt-5 lg:mt-0">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{asset('/themes/tailwind/images/praise.png')}}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Seleksi Hafalan Shalawat Wahidiyah
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Informasi terbaru
                </p>
            </div>

        </div>
        <div class="relative">
            {{-- row jadwal dan roles --}}
            <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                    <div class="relative p-3">
                        <h3>Jadwal</h3>
                        <hr class="mb-3 mt-1">
                        <div class="form-group mb-3 text-xs">
                            <label for="penguji_read_shalawat">Nama Penguji:</label>
                            <input type="text" name="penguji_read_shalawat" id="penguji_read_shalawat"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRS!=null?$examRS->nama_penguji:'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="sesi_read_shalawat">Nama Sesi:</label>
                            <input type="text" name="sesi_read_shalawat" id="sesi_read_shalawat"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRS!=null?$examRS->nama_sesi:'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="tanggal_read_shalawat">Tanggal Seleksi:</label>
                            <input type="text" name="tanggal_read_shalawat" id="tanggal_read_shalawat"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRS!=null?date('d F Y', strtotime($examRS->tanggal)):'belum terjadwal'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="waktu_read_shalawat">Waktu Seleksi:</label>
                            <input type="text" name="waktu_read_shalawat" id="waktu_read_shalawat"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRS!=null?substr($examRS->waktu, 0, 5):'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="tempat_read_shalawat">Tempat Seleksi:</label>
                            <input type="text" name="tempat_read_shalawat" id="tempat_read_shalawat"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examRS!=null?$examRS->tempat:'belum terjadwal'}}" readonly>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150  mt-3 lg:mt-0">
                    <div class="relative p-3">
                        <h3>Aturan dan Ketentuan</h3>
                        <hr class="mb-3 mt-1">
                        <p class="text-sm leading-5 text-gray-500 mt">
                            {{$examCat[3]->keterangan}}
                        </p>
                    </div>
                </div>
            </div>
            {{-- row hasil seleksi --}}
            <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
                <div
                    class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                    <div class="relative p-3">
                        <h3>Hasil Seleksi</h3>
                        <hr class="mb-3 mt-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection