@extends('theme::layouts.app')


@section('content')


<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{asset('/themes/tailwind/images/interview.png')}}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Jadwal Ujian Wawancara
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Tahun Akademik {{$ta_aktif}}
                </p>
            </div>
        </div>
        <div class="relative p-3">
            @if($interview==null)
            <p class="text-sm leading-5 text-gray-500 mt">
                Belum ada penjadwalan ujian.
            </p>
            @else

            <div class="container my-1 mx-auto px-1 md:px-12">
                <div class="flex flex-wrap -mx-1 lg:-mx-4">
                    @foreach ($interview as $item)
                    <div class="my-2 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                        <!-- Article -->
                        <article class="overflow-hidden rounded-lg shadow-lg"
                            style="background-color: lightgoldenrodyellow;">
                            <header class="flex items-center justify-between leading-tight p-4 md:p-4">
                                <div class="row">
                                    <h1 class="text-lg">
                                        {{$item->nama_sesi}}
                                    </h1>
                                    <p class="text-sm leading-5 text-gray-500 mt">
                                        {{$item->nama_schedule}}
                                    </p>
                                </div>
                            </header>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Penguji</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{$item->nama_penguji}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Tanggal Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ date('j F Y', strtotime($item->tanggal)) }}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Waktu Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{substr($item->waktu,0,5)}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Tempat Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{$item->tempat}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <div class="grid grid-cols-2 gap-1">
                                <div class="text-center bg-indigo-400 mx-3 mb-3 p-2 rounded-md">
                                    <div>{{$item->jumlah_peserta}}</div>
                                    <div class="text-sm text-white dark:text-white font-bold">Belum Seleksi
                                    </div>
                                </div>
                                <div class="text-center bg-cyan-500 mx-3 mb-3 p-2 rounded-md">
                                    <div>
                                        {{$item->get_exam_interview_member_count==null?'0':$item->get_exam_interview_member_count}}
                                    </div>
                                    <div class="text-sm text-white dark:text-white font-bold">Sudah Seleksi
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <button onclick="goToExaminationInterview('{{$item->id}}')"
                                    class="m-3 p-2 py-3 text-center justify-center {{$item->get_exam_interview_member_count==
                                        explode(" ",$item->jumlah_peserta)[0]?'bg-green-500 hover:bg-green-700':'bg-red-500 hover:bg-red-700'}} rounded-md">
                                    <span class="text-center text-white font-bold">
                                        {{$item->get_exam_interview_member_count==
                                        explode(" ",$item->jumlah_peserta)[0]?'Detail
                                        Seleksi':'Mulai
                                        Seleksi'}}
                                    </span>
                                </button>
                            </div>
                        </article>
                        <!-- END Article -->
                    </div>
                    <!-- END Column -->
                    @endforeach

                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{asset('/themes/tailwind/images/quran.png')}}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Jadwal Ujian Baca Al-Quran
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Tahun Akademik {{$ta_aktif}}
                </p>
            </div>
        </div>
        <div class="relative p-3">
            @if($quran==null)
            <p class="text-sm leading-5 text-gray-500 mt">
                Belum ada penjadwalan ujian.
            </p>
            @else

            <div class="container my-1 mx-auto px-1 md:px-12">
                <div class="flex flex-wrap -mx-1 lg:-mx-4">
                    @foreach ($quran as $item)
                    <div class="my-2 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                        <!-- Article -->
                        <article class="overflow-hidden rounded-lg shadow-lg" style="background-color: lavender;">
                            <header class="flex items-center justify-between leading-tight p-4 md:p-4">
                                <div class="row">
                                    <h1 class="text-lg">
                                        {{$item->nama_sesi}}
                                    </h1>
                                    <p class="text-sm leading-5 text-gray-500 mt">
                                        {{$item->nama_schedule}}
                                    </p>
                                </div>
                            </header>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Penguji</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{$item->nama_penguji}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Tanggal Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ date('j F Y', strtotime($item->tanggal)) }}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Waktu Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{substr($item->waktu,0,5)}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Tempat Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{$item->tempat}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <div class="grid grid-cols-2 gap-1">
                                <div class="text-center bg-indigo-400 mx-3 mb-3 p-2 rounded-md">
                                    <div>{{$item->jumlah_peserta}}</div>
                                    <div class="text-sm text-white dark:text-white font-bold">Belum Seleksi
                                    </div>
                                </div>
                                <div class="text-center bg-cyan-500 mx-3 mb-3 p-2 rounded-md">
                                    <div>{{$item->get_exam_read_quran_member_count}}</div>
                                    <div class="text-sm text-white dark:text-white font-bold">Sudah Seleksi
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <button onclick="goToExaminationQuran({{$item->id}})"
                                    class="m-3 p-2 py-3 text-center justify-center {{$item->get_exam_read_quran_member_count==
                                        explode(" ",$item->jumlah_peserta)[0]?'bg-green-500 hover:bg-green-700':'bg-red-500 hover:bg-red-700'}} rounded-md">
                                    <span class="text-center text-white font-bold">
                                        {{$item->get_exam_read_quran_member_count==
                                        explode(" ",$item->jumlah_peserta)[0]?'Detail
                                        Seleksi':'Mulai
                                        Seleksi'}}
                                    </span>
                                </button>
                            </div>
                        </article>
                        <!-- END Article -->
                    </div>
                    <!-- END Column -->
                    @endforeach

                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{asset('/themes/tailwind/images/praise.png')}}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Jadwal Ujian Hafalan Shalawat Wahidiyah
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Tahun Akademik {{$ta_aktif}}
                </p>
            </div>
        </div>
        <div class="relative p-3">
            @if($shalawat==null)
            <p class="text-sm leading-5 text-gray-500 mt">
                Belum ada penjadwalan ujian.
            </p>
            @else

            <div class="container my-1 mx-auto px-1 md:px-12">
                <div class="flex flex-wrap -mx-1 lg:-mx-4">
                    @foreach ($shalawat as $item)
                    <div class="my-2 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                        <!-- Article -->
                        <article class="overflow-hidden rounded-lg shadow-lg"
                            style="background-color: lightgoldenrodyellow;">
                            <header class="flex items-center justify-between leading-tight p-4 md:p-4">
                                <div class="row">
                                    <h1 class="text-lg">
                                        {{$item->nama_sesi}}
                                    </h1>
                                    <p class="text-sm leading-5 text-gray-500 mt">
                                        {{$item->nama_schedule}}
                                    </p>
                                </div>
                            </header>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Penguji</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{$item->nama_penguji}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Tanggal Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ date('j F Y', strtotime($item->tanggal)) }}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Waktu Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{substr($item->waktu,0,5)}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <footer class="flex items-center justify-between leading-none p-4 md:p-4">
                                <figcaption class="flex items-center justify-center space-x-3">
                                    <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                        <div>Tempat Seleksi</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{$item->tempat}}
                                        </div>
                                    </div>
                                </figcaption>
                            </footer>
                            <div class="grid grid-cols-2 gap-1">
                                <div class="text-center bg-indigo-400 mx-3 mb-3 p-2 rounded-md">
                                    <div>{{$item->jumlah_peserta}}</div>
                                    <div class="text-sm text-white dark:text-white font-bold">Belum Seleksi
                                    </div>
                                </div>
                                <div class="text-center bg-cyan-500 mx-3 mb-3 p-2 rounded-md">
                                    <div>{{$item->get_exam_read_shalawat_member_count}}</div>
                                    <div class="text-sm text-white dark:text-white font-bold">Sudah Seleksi
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <button onclick="goToExaminationShalawat({{$item->id}})"
                                    class="m-3 p-2 py-3 text-center justify-center {{$item->get_exam_read_shalawat_member_count==
                                        explode(" ",$item->jumlah_peserta)[0]?'bg-green-500 hover:bg-green-700':'bg-red-500 hover:bg-red-700'}} rounded-md">
                                    <span class="text-center text-white font-bold">
                                        {{$item->get_exam_read_shalawat_member_count==
                                        explode(" ",$item->jumlah_peserta)[0]?'Detail
                                        Seleksi':'Mulai
                                        Seleksi'}}
                                    </span>
                                </button>
                            </div>
                        </article>
                        <!-- END Article -->
                    </div>
                    <!-- END Column -->
                    @endforeach

                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<input type="hidden" id="examination_interview_url" class="examination_interview_url" name="examination_interview_url"
    value="{{url('examination-interview')}}">
<input type="hidden" id="examination_quran_url" class="examination_quran_url" name="examination_quran_url"
    value="{{url('examination-quran')}}">
<input type="hidden" id="examination_shalawat_url" class="examination_shalawat_url" name="examination_shalawat_url"
    value="{{url('examination-shalawat')}}">
{{-- @include('theme::seleksi.exam_interview.modal.add') --}}
{{-- @include('theme::seleksi.exam_interview.modal.edit') --}}
{{-- @include('theme::seleksi.exam_interview.modal.detail-mhs') --}}
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

    function goToExaminationInterview(param) {
        let link = $('#examination_interview_url').val()+'/'+param;
        window.open(link, '_blank').focus();
    }

    function goToExaminationQuran(param) {
        let link = $('#examination_quran_url').val()+'/'+param;
        window.open(link, '_blank').focus();
    }

    function goToExaminationShalawat(param) {
        let link = $('#examination_shalawat_url').val()+'/'+param;
        window.open(link, '_blank').focus();
    }
</script>
@endsection