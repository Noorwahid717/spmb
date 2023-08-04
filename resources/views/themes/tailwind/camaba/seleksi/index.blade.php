@extends('theme::layouts.app')


@section('content')
<div class="flex flex-col px-2 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
    {{-- SELEKSI AKADEMIK --}}
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div
            class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap lightsteelblue">
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
                        @if($examAca==null)
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Jadwal seleksi belum rilis.
                        </p>
                        @else
                        <div class="form-group mb-3 text-xs">
                            <label for="sesi_academic">Nama Sesi:</label>
                            <input type="text" name="sesi_academic" id="sesi_academic"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$examAca!=null?$examAca->nama_sesi:'belum terjadwal'}}" readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="soal_prodi">Potensi Akademik Prodi:</label>
                            <input type="text" name="soal_prodi" id="soal_prodi"
                                class="form-control mt-1 read_only inputaslabel"
                                value="{{$prodi!=null?$prodi->program_studi_1:'belum memilih prodi'}}" readonly>
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
                        <button
                            class="mt-2 inline-flex xl:self-start self-center items-center px-4 py-2 {{$is_startable?'bg-red-500':'bg-green-500'}} hover:{{$is_startable?'bg-red-700':'bg-green-700'}} text-white text-sm font-medium rounded-md"
                            onclick="mulaiUjian({{$examAcaMem==null?null:$examAcaMem->id}})">
                            {{$is_startable?'Mulai Ujian Sekarang':'Detail Hasil Ujian'}}
                        </button>
                        @endif
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
                        @if($examAcaMem==null||$examAcaMem->status_lolos==0)
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Hasil seleksi belum rilis.
                        </p>
                        @else
                        <div class="form-group mb-3 text-xs">
                            <label for="total_menjawab">Total Pertanyaan:</label>
                            <input type="text" name="total_menjawab" id="total_menjawab"
                                class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                value="{{$total_question}}" readonly>
                        </div>
                        <div class="grid grid-cols-1 xl:grid-cols-3 md:grid-cols-3 sm:grid-cols-3 gap-2">
                            <div class="form-group mb-3 text-xs">
                                <label for="total_benar">Total Jawaban Benar:</label>
                                <input type="text" name="total_benar" id="total_benar"
                                    class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                    value="{{$correct}}" readonly>
                            </div>
                            <div class="form-group mb-3 text-xs">
                                <label for="total_salah">Total Jawaban Salah:</label>
                                <input type="text" name="total_salah" id="total_salah"
                                    class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                    value="{{$incorrect}}" readonly>
                            </div>
                            <div class="form-group mb-3 text-xs">
                                <label for="total_tak_jawab">Total Tidak Terjawab:</label>
                                <input type="text" name="total_tak_jawab" id="total_tak_jawab"
                                    class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                    value="{{$tak_jawab}}" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 xl:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 gap-2">
                            <div class="form-group mb-3 text-xs">
                                <label for="skor_academic">Skor:</label>
                                <input type="text" name="skor_academic" id="skor_academic"
                                    class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                    value="{{$total_poin}}" readonly>
                            </div>
                            <div class="form-group mb-3 text-xs">
                                <label for="status_academic">Status:</label>
                                <input type="text" name="status_academic" id="status_academic"
                                    class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                    value="{{$examAcaMem!=null?($examAcaMem->status_lolos==-1?'Tidak Lulus':'Lulus'):'Hasil seleksi belum rilis.'}}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="catatan">Catatan:</label>
                            <textarea name="catatan" id="catatan" cols="30" rows="2"
                                class="form-control mt-1 read_only powderblue"
                                readonly>{{$examAcaMem!=null?$examAcaMem->catatan:'Hasil seleksi belum rilis.'}}</textarea>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SELEKSI WAWANCARA --}}
    <div
        class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150 mt-5 lg:mt-0">
        <div
            class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap lightsteelblue">
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
                        @if($examInt==null)
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Jadwal seleksi belum rilis.
                        </p>
                        @else
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
                        @endif
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
                        @if($examIntMem==null||$examIntMem->status_lolos==0)
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Hasil seleksi belum rilis.
                        </p>
                        @else
                        <div class="form-group mb-3 text-xs">
                            <input type="text" name="status_interview" id="status_interview"
                                class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                value="{{$examIntMem!=null?($examIntMem->status_lolos==-1?'Tidak Lulus':'Lulus'):'Hasil seleksi belum rilis.'}}"
                                readonly>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col px-2 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5 lg:px-8 md:px-8">
    {{-- SELEKSI BACA AL-QURAN --}}
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div
            class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap lightsteelblue">
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
                        @if($examRQ==null)
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Jadwal seleksi belum rilis.
                        </p>
                        @else
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
                        @endif
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
                        @if($examRQMem->id_nilai_kelancaran==null||$examRQMem->id_nilai_tajwid==null||$examRQMem->id_nilai_makhraj==null)
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Hasil seleksi belum rilis.
                        </p>
                        @else
                        <div class="form-group mb-3 text-xs">
                            <label for="nilai_kelancaran_rq">Nilai Kelancaran:</label>
                            <input type="text" name="nilai_kelancaran_rq" id="nilai_kelancaran_rq"
                                class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                value="{{$examRQMem!=null?$examRQMem->nilai_lancar:'Hasil seleksi belum rilis.'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="nilai_tajwid_rq">Nilai Tajwid:</label>
                            <input type="text" name="nilai_tajwid_rq" id="nilai_tajwid_rq"
                                class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                value="{{$examRQMem!=null?$examRQMem->nilai_tajwid:'Hasil seleksi belum rilis.'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="nilai_makhraj_rq">Nilai Makhraj:</label>
                            <input type="text" name="nilai_makhraj_rq" id="nilai_makhraj_rq"
                                class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                value="{{$examRQMem!=null?$examRQMem->nilai_makhraj:'Hasil seleksi belum rilis.'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="catatan_rq">Catatan Penguji:</label>
                            <textarea name="" id="" cols="30" rows="2" class="form-control mt-1 read_only powderblue"
                                readonly>{{$examRQMem!=null?$examRQMem->catatan_penguji:'Hasil seleksi belum rilis.'}}</textarea>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SELEKSI HAFALAN SHALAWAT WAHIDIYAH --}}
    <div
        class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150 mt-5 lg:mt-0">
        <div
            class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap lightsteelblue">
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
                        @if($examRS==null)
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Jadwal seleksi belum rilis.
                        </p>
                        @else
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
                        @endif
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
                        @if($examRSMem->id_nilai_kelancaran==null||$examRSMem->id_nilai_tajwid==null||$examRSMem->id_nilai_makhraj==null)
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Hasil seleksi belum rilis.
                        </p>
                        @else
                        <div class="form-group mb-3 text-xs">
                            <label for="nilai_kelancaran_rs">Nilai Kelancaran:</label>
                            <input type="text" name="nilai_kelancaran_rs" id="nilai_kelancaran_rs"
                                class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                value="{{$examRSMem!=null?$examRSMem->nilai_lancar:'Hasil seleksi belum rilis.'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="nilai_tajwid_rs">Nilai Tajwid:</label>
                            <input type="text" name="nilai_tajwid_rs" id="nilai_tajwid_rs"
                                class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                value="{{$examRSMem!=null?$examRSMem->nilai_tajwid:'Hasil seleksi belum rilis.'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="nilai_makhraj_rs">Nilai Makhraj:</label>
                            <input type="text" name="nilai_makhraj_rs" id="nilai_makhraj_rs"
                                class="form-control mt-1 read_only inputaslabel powderblue text-center"
                                value="{{$examRSMem!=null?$examRSMem->nilai_makhraj:'Hasil seleksi belum rilis.'}}"
                                readonly>
                        </div>
                        <div class="form-group mb-3 text-xs">
                            <label for="catatan_rs">Catatan Penguji:</label>
                            <textarea name="" id="" cols="30" rows="2" class="form-control mt-1 read_only powderblue"
                                readonly>{{$examRSMem!=null?$examRSMem->catatan_penguji:'Hasil seleksi belum rilis.'}}</textarea>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })
</script>
<script src="{{ asset('themes/' . $theme->folder . '/js/Magnifier.js') }}"></script>
<script src="{{ asset('themes/' . $theme->folder . '/js/Event.js') }}"></script>
<script>
    $(document).ready( function () {
            
    } );

    function mulaiUjian(id_exam_academic_member){
        const contents = `Waktu ujian dimulai dan akan berakhir sesuai dengan jadwal yang telah diterbitkan!`;          
        Swal.fire({
            title: 'Yakin mulai ujian!',
            // text: teks,
            html: contents,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, mulai!',
            cancelButtonText: 'Tidak',
            reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {  
                    window.location.href = @json(url('do-exam-academic'));
                } 
        });
    }
</script>
@endsection