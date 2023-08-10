@extends('theme::layouts.app')


@section('content')


<div class="flex flex-col px-1 mx-auto my-6 lg:flex-row max-w-7xl xl:px-8">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{ asset('/themes/tailwind/images/quran.png') }}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Ujian Baca Al-Quran
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Tahun Akademik Pendaftaran - {{$ta}}
                </p>
            </div>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-yellow-400 hover:bg-yellow-600 text-dark text-sm font-medium rounded-md"
                href="{{route('wave.examination')}}">
                <img src="{{asset('/themes/tailwind/images/rewind.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Kembali</a>
            {{-- <div
                class="inline-flex self-start items-center ml-3 px-4 py-3 bg-blue-400 text-dark text-sm font-medium rounded-md">
                <img src="{{asset('/themes/tailwind/images/timeer.png')}}" class="w-6 rounded sm:mx-auto mr-5">
                <span id="timeup"></span>
            </div> --}}
        </div>
        <div class="relative">
            @if(count($peserta)==0)
            <div class="relative p-3">
                <span>Belum ada peserta yang dijadwalkan!</span>
            </div>
            @else
            {{-- PESERTA --}}
            <div class="relative">
                <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-2 lg:px-2 md:px-2">
                    <div
                        class="flex flex-col justify-start flex-1 overflow-hidden cadetblue border rounded-lg border-gray-150">
                        <div class="relative p-3" id="body-member">
                            <h3>Peserta Ujian Baca Al-Quran No.
                                <span id="no_peserta"
                                    class="p-1 bg-blue-500 text-white text-sm font-bold rounded-md">1</span>
                            </h3>
                            <hr class="mb-3 mt-1">
                            <div class="bg-gray-100 rounded-md p-2">
                                <div class="flex flex-col mx-auto my-3 lg:flex-row max-w-7xl">
                                    <div class="flex flex-col justify-start flex-1 overflow-hidden rounded-lg">
                                        <footer class="flex items-center justify-between leading-none p-1 md:p-1">
                                            <figcaption class="flex items-center justify-center space-x-3">
                                                <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                                    <div class="text-sm text-black">
                                                        NIK:
                                                    </div>
                                                    <div class="dark:text-gray-500">
                                                        {{$peserta[0]->getCamabaDataPokok->nik}}
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </footer>
                                        <footer class="flex items-center justify-between leading-none p-1 md:p-1">
                                            <figcaption class="flex items-center justify-center space-x-3">
                                                <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                                    <div class="text-sm text-black">
                                                        Nama Peserta:
                                                    </div>
                                                    <div class="dark:text-gray-500">
                                                        {{$peserta[0]->getCamabaDataPokok->nama}}
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </footer>
                                        <footer class="flex items-center justify-between leading-none p-1 md:p-1">
                                            <figcaption class="flex items-center justify-center space-x-3">
                                                <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                                    <div class="text-sm text-black">
                                                        Jenis Kelamin:
                                                    </div>
                                                    <div class="dark:text-gray-500">
                                                        {{$peserta[0]->getCamabaDataPokok->gender=='l'?'Laki-laki':'Perempuan'}}
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </footer>
                                    </div>
                                    <div class="flex flex-col justify-start flex-1 overflow-hidden rounded-lg">
                                        <footer class="flex items-center justify-between leading-none p-1 md:p-1">
                                            <figcaption class="flex items-center justify-center space-x-3">
                                                <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                                    <div class="text-sm text-black">
                                                        Tempat Lahir:
                                                    </div>
                                                    <div class="dark:text-gray-500">
                                                        {{$peserta[0]->getCamabaDataPokok->tempat_lahir}}
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </footer>
                                        <footer class="flex items-center justify-between leading-none p-1 md:p-1">
                                            <figcaption class="flex items-center justify-center space-x-3">
                                                <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                                    <div class="text-sm text-black">
                                                        Tanggal Lahir:
                                                    </div>
                                                    <div class="dark:text-gray-500">
                                                        {{$peserta[0]->getCamabaDataPokok->tanggal_lahir}}
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </footer>
                                        <footer class="flex items-center justify-between leading-none p-1 md:p-1">
                                            <figcaption class="flex items-center justify-center space-x-3">
                                                <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                                    <div class="text-sm text-black">
                                                        Pilihan Prodi (1):
                                                    </div>
                                                    <div class="dark:text-gray-500">{{$peserta[0]->prodi}}
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                            <div class="answer_options">
                                <div class="navigation_question">
                                    <div class="flex flex-col px-3 mx-auto mt-6 lg:flex-row max-w-7xl xl:px-5">
                                        <div class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden">
                                            <button
                                                class="hidden inline-flex xl:self-start self-center items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0
                                                        L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109
                                                        c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483
                                                        c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788
                                                        S18.707,9.212,18.271,9.212z" />
                                                </svg>
                                                Back
                                            </button>
                                        </div>
                                        <div
                                            class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden rounded-md">
                                            <button disabled>Peserta Nomor</button>
                                            <button disabled>1 dari {{count($peserta)}}</button>
                                        </div>
                                        <div class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden">
                                            <button onclick="refresh_navigation_member()"
                                                class="inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                                                Next &nbsp;
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M1.729,9.212h14.656l-4.184-4.184c-0.307-0.306-0.307-0.801,0-1.107c0.305-0.306,0.801-0.306,1.106,0
                                                        l5.481,5.482c0.018,0.014,0.037,0.019,0.053,0.034c0.181,0.181,0.242,0.425,0.209,0.66c-0.004,0.038-0.012,0.071-0.021,0.109
                                                        c-0.028,0.098-0.075,0.188-0.143,0.271c-0.021,0.026-0.021,0.061-0.045,0.085c-0.015,0.016-0.034,0.02-0.051,0.033l-5.483,5.483
                                                        c-0.306,0.307-0.802,0.307-1.106,0c-0.307-0.305-0.307-0.801,0-1.105l4.184-4.185H1.729c-0.436,0-0.788-0.353-0.788-0.788
                                                        S1.293,9.212,1.729,9.212z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-start flex-1 overflow-hidden cadetblue border rounded-lg lg:ml-3 border-gray-150  mt-3 lg:mt-0">
                        <div class="relative p-3">
                            <h3>Nomor Peserta Ujian Baca Al-Quran</h3>
                            <hr class="mb-3 mt-1">
                            <div class="grid grid-cols-5 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10 gap-4"
                                id="navigation-answer-member">
                                @foreach ($peserta as $key => $item)
                                <button
                                    onclick="refresh_navigation_member('curr',{{$key}},{{$item->id_camaba}},null,null)"
                                    class="p-2 {{$item->get_exam_interview_member_result_count==0?'bg-gray-100':($item->get_exam_interview_member_result_count==30?'bg-blue-300':'bg-yellow-300')}} rounded-md text-center
                                    {{$item->status_lolos==-1?'outlined-red':($item->status_lolos==1?'outlined-green':'')}}">
                                    <span>{{$key+1}}</span>
                                </button>
                                @endforeach
                            </div>
                            <div class="mt-2 text-sm leading-5 text-black-500">
                                <span class="px-2 pb-1 bg-blue-300 rounded-md outlined-green">&nbsp;&nbsp;</span>
                                = Jawaban Lengkap & Lulus
                            </div>
                            <div class="mt-2 text-sm leading-5 text-black-500">
                                <span class="px-2 pb-1 bg-blue-300 rounded-md outlined-red">&nbsp;&nbsp;</span>
                                = Jawaban Lengkap & Tidak Lulus
                            </div>
                            <div class="mt-2 text-sm leading-5 text-black-500">
                                <span class="px-2 pb-1 bg-blue-300 rounded-md">&nbsp;&nbsp;</span>
                                = Jawaban Lengkap
                            </div>
                            <div class="mt-2 text-sm leading-5 text-black-500">
                                <span class="px-2 pb-1 bg-yellow-300 rounded-md">&nbsp;&nbsp;</span>
                                = Menjawab Sebagian
                            </div>
                            <div class="mt-2 text-sm leading-5 text-black-500">
                                <span class="px-2 pb-1 bg-gray-300 rounded-md">&nbsp;&nbsp;</span>
                                = Belum Menjawab Sama Sekali
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <input type="hidden" value="{{route('wave.examination-interview-updatelist-member')}}"
                name="examination_interview_update_list_member_url" id="examination_interview_update_list_member_url"
                class="examination_interview_update_list_member_url">
        </div>


        {{-- SOAL --}}
        <div class="relative" id="body-soal">
            @if(count($peserta)==0)
            @else
            @if(!$is_time_now)
            <div class="relative p-3">
                <span>Waktu ujian belum dimulai!</span>
            </div>
            @else

            <div class="relative">
                {{-- row jadwal dan roles --}}
                <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-2 lg:px-2 md:px-2">
                    <div
                        class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                        <div class="relative p-3">
                            <h3>Soal Wawancara No.
                                <span id="no_soal"
                                    class="p-1 bg-blue-500 text-white text-sm font-bold rounded-md">1</span>
                            </h3>
                            <hr class="mb-3 mt-1">
                            <div class="m-2 p-2 bg-gray-100 rounded-md">
                                {{-- <p>{{$soal[0]->question}}</p> --}}
                                <input type="hidden" name="id_exam_interview_member_result"
                                    id="id_exam_interview_member_result">
                            </div>
                            <div class="answer_options m-2 p-2">
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-1" type="radio" value="1" name="default-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                    <label for="default-radio-1"
                                        class="ml-2 text-sm font-medium text-dark-900 dark:text-dark-300">
                                        Ya
                                    </label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-2" type="radio" value="0" name="default-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                    <label for="default-radio-2"
                                        class="ml-2 text-sm font-medium text-dark-900 dark:text-dark-300">
                                        Tidak
                                    </label>
                                </div>
                                <div class="navigation_question">
                                    <div class="flex flex-col px-3 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
                                        <div
                                            class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
                                            <button
                                                class="hidden inline-flex xl:self-start self-center items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0
                                                        L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109
                                                        c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483
                                                        c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788
                                                        S18.707,9.212,18.271,9.212z" />
                                                </svg>
                                                Back
                                            </button>
                                        </div>
                                        <div
                                            class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
                                            <button disabled>Nomor Soal</button>
                                            <button disabled>1 dari 30</button>
                                        </div>
                                        <div
                                            class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
                                            <button onclick="refresh_navigation_answer()"
                                                class="inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                                                Next &nbsp;
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M1.729,9.212h14.656l-4.184-4.184c-0.307-0.306-0.307-0.801,0-1.107c0.305-0.306,0.801-0.306,1.106,0
                                                        l5.481,5.482c0.018,0.014,0.037,0.019,0.053,0.034c0.181,0.181,0.242,0.425,0.209,0.66c-0.004,0.038-0.012,0.071-0.021,0.109
                                                        c-0.028,0.098-0.075,0.188-0.143,0.271c-0.021,0.026-0.021,0.061-0.045,0.085c-0.015,0.016-0.034,0.02-0.051,0.033l-5.483,5.483
                                                        c-0.306,0.307-0.802,0.307-1.106,0c-0.307-0.305-0.307-0.801,0-1.105l4.184-4.185H1.729c-0.436,0-0.788-0.353-0.788-0.788
                                                        S1.293,9.212,1.729,9.212z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150  mt-3 lg:mt-0">
                        <div class="relative p-3">
                            <h3>Nomor Soal Wawancara</h3>
                            <hr class="mb-3 mt-1">
                            <div class="grid grid-cols-5 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10 gap-4"
                                id="navigation-answer">
                                {{-- @foreach ($soal as $key => $item)
                                <button onclick="refresh_navigation_answer('curr',{{$key}},'')"
                                    class="p-2 {{$item->jawaban_interviewer==null?'bg-gray-100':'bg-blue-300'}} rounded-md text-center">
                                    <span>{{$key+1}}</span>
                                </button>
                                @endforeach --}}
                            </div>
                            <div class="mt-2 text-sm leading-5 text-gray-500">
                                <span class="px-2 pb-1 bg-blue-300 rounded-md">&nbsp;&nbsp;</span>
                                = Sudah Dikerjakan
                            </div>
                            {{-- <div class="mt-2 text-sm leading-5 text-gray-500">
                                <span class="px-2 pb-1 bg-yellow-300 rounded-md">&nbsp;&nbsp;</span>
                                = Ragu - Ragu
                            </div> --}}
                            <div class="mt-2 text-sm leading-5 text-gray-500">
                                <span class="px-2 pb-1 bg-gray-300 rounded-md">&nbsp;&nbsp;</span>
                                = Belum Dikerjakan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>
    @include('theme::penguji.pengujian.examination-interview.modal.status')
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
    });
</script>
@endsection