@extends('theme::layouts.app')


@section('content')


<div class="flex flex-col px-1 mx-auto my-6 lg:flex-row max-w-7xl xl:px-8">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{ asset('/themes/tailwind/images/interview.png') }}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Ujian Wawancara
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
                            <h3>Peserta Wawancara No.
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
                            <h3>Nomor Peserta Wawancara</h3>
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
                                <p>{{$soal[0]->question}}</p>
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
                                @foreach ($soal as $key => $item)
                                <button onclick="refresh_navigation_answer('curr',{{$key}},'')"
                                    class="p-2 {{$item->jawaban_interviewer==null?'bg-gray-100':'bg-blue-300'}} rounded-md text-center">
                                    <span>{{$key+1}}</span>
                                </button>
                                @endforeach
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
        let body = document.getElementById("body-member");
        body.innerHTML = bodyMember(0,@json($peserta));      
        
        let body_soal = document.getElementById("body-soal");
        let f_peserta = @json($peserta);
        body_soal.innerHTML = bodySoal(0,@json($soal),@json($peserta),@json($is_time_now),'curr',0,f_peserta[0].id_camaba);      
    } );

</script>
<script>
    function refresh_navigation_member(direction,currIdx,targetedUserId,soalDirection,soalcurrIdx) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');     
        datar['id']=@json($id_exam_interview);   
        datar['targeted_id_camaba']=targetedUserId;
        datar['selected_answer']=$("input[name='default-radio']:checked").val();
        datar['id_exam_interview_member_result']=$("#id_exam_interview_member_result").val();
        datar['id_exam_interview_member']=$("#id_exam_interview_member").val();
        datar['status_ujian']=$("#status_ujian option:selected").val();
        datar['catatan_penguji']=$("#catatan_penguji").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#examination_interview_update_list_member_url").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();
                    $('#close_modal').trigger("click");        

                    let body = document.getElementById("body-member");
                    if(direction=='next'){
                        targetIdx = currIdx+1;
                    }else if(direction=='prev'){
                        targetIdx = currIdx-1;
                    }else if(direction=='curr'){
                        targetIdx = currIdx;
                    }
                    if(currIdx+1==data.member.length&&direction=='next'){
                        targetIdx = currIdx
                    }
                    body.innerHTML = bodyMember(targetIdx,data.member);  
                    // -------------------------------------------
                    let nue = data.member.map(function (item,index) {
                        return elementMember(item,index);
                    }).join('');
                    $('#navigation-answer-member').html(nue);
                    // ===========================================
                    let body_soal = document.getElementById("body-soal");
                    if(soalDirection=='next'){
                        soaltargetIdx = soalcurrIdx+1;
                    }else if(soalDirection=='prev'){
                        soaltargetIdx = soalcurrIdx-1;
                    }else if(soalDirection=='curr'){
                        soaltargetIdx = soalcurrIdx;
                    }else if(soalDirection==null){
                        soaltargetIdx = 0;
                    }
                    if(soalcurrIdx+1==data.soal.length&&soalDirection=='next'){
                        soaltargetIdx = soalcurrIdx;
                    }
                    body_soal.innerHTML = bodySoal(soaltargetIdx,data.soal,data.member,data.is_time_now,direction,currIdx,targetedUserId);                    
                }
            },
        }); 
    }

    function elementMember(data,i) {
        return `<button onclick="refresh_navigation_member('curr',${i},${data.id_camaba},null,null)"
            class="p-2 ${data.get_exam_interview_member_result_count==0?'bg-gray-100':(data.get_exam_interview_member_result_count==30?'bg-blue-300':'bg-yellow-300')} rounded-md text-center
            ${data.status_lolos==-1?'outlined-red':(data.status_lolos==1?'outlined-green':'')}">
            <span>${i+1}</span>
        </button>`;
    }    
</script>
<script>
    // body - member
    function bodyMember(idx,data) {
        return `<h3>Peserta Wawancara No.
            <span id="no_peserta"
                class="p-1 bg-blue-500 text-white text-sm font-bold rounded-md">${idx+1}</span>
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
                                    ${data[idx].get_camaba_data_pokok.nik}
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
                                    ${data[idx].get_camaba_data_pokok.nama}
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
                                    ${data[idx].get_camaba_data_pokok.gender=='l'?'Laki-laki':'Perempuan'}
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
                                    ${data[idx].get_camaba_data_pokok.tempat_lahir}
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
                                    ${data[idx].get_camaba_data_pokok.tanggal_lahir}
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
                                <div class="dark:text-gray-500">
                                    ${data[idx].prodi}
                                </div>
                            </div>
                        </figcaption>
                    </footer>
                </div>
            </div>
            <div class="${data[idx].get_exam_interview_member_result_count==30?'':'hidden'}">
                <div class="flex flex-col mx-auto my-3 lg:flex-row max-w-7xl">
                    <div class="flex flex-col justify-start flex-1 overflow-hidden rounded-sm">            
                        <footer class="flex items-center justify-between leading-none p-1 md:p-1 m-1">
                            <figcaption class="flex items-center justify-center space-x-3">
                                <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                    <div class="text-sm text-black bg-green-500 px-2 py-1 rounded-md">
                                        Status Ujian Wawancara:
                                    </div>
                                    <div class="dark:text-gray-500 text-center p-1">
                                        ${data[idx].status_lolos==0?'Belum distatuskan':(data[idx].status_lolos==1?'Lulus':'Tidak Lulus')}
                                    </div>
                                </div>
                            </figcaption>
                        </footer>
                    </div>
                    <div class="flex flex-col justify-start flex-1 overflow-hidden rounded-md">            
                        <footer class="flex items-center justify-between leading-none p-1 md:p-1 m-1">
                            <figcaption class="flex items-center justify-center space-x-3">
                                <div class="space-y-0.5 font-medium dark:text-gray text-left">
                                    <div class="text-sm text-black bg-green-500 px-2 py-1 rounded-md">
                                        Catatan Penguji:
                                    </div>
                                    <div class="dark:text-gray-500 p-1">
                                        <p>${data[idx].catatan_penguji==null?'-':data[idx].catatan_penguji}</p>
                                    </div>
                                </div>
                            </figcaption>
                        </footer>
                    </div>
                </div>
                <div class="flex flex-col mx-auto my-3 lg:flex-row max-w-7xl">
                    <div class="flex flex-col justify-start flex-1 overflow-hidden rounded-md">            
                        <a class="items-center mx-2 px-4 py-3 bg-sky-500 hover:bg-sky-700 text-center text-white text-md font-bold rounded-md"
                        data-modal="#updateStatusWawancara" rel="modal:open" href="#updateStatusWawancara"
                        onclick="updateStatusUjian(                            
                            \'${data[idx].id}\',
                            \'${data[idx].get_camaba_data_pokok.nama}\',
                            \'${data[idx].prodi}\',
                            \'${data[idx].status_lolos==0?-2:data[idx].status_lolos}\',
                            \'${data[idx].catatan_penguji==null?'':data[idx].catatan_penguji}\',
                            \'${idx}\',
                            \'${data[idx].id_camaba}\')">
                            Ubah Status Ujian
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="answer_options">
            <div class="navigation_question">
                <div class="flex flex-col px-3 mx-auto mt-6 lg:flex-row max-w-7xl xl:px-5">
                    <div class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden">
                        <button onclick="refresh_navigation_member('prev',${idx},${idx==0?data[idx].id_camaba:data[idx-1].id_camaba},null,null)"
                        class="${idx==0?'hidden':''} inline-flex xl:self-start self-center items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
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
                        <button disabled>${idx+1} dari ${data.length}</button>
                    </div>
                    <div class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden">
                        <button onclick="refresh_navigation_member('next',${idx},${idx==data.length-1?data[idx].id_camaba:data[idx+1].id_camaba},null,null)"
                            class="${idx==data.length-1?'hidden':''} inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
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
        </div>`;
    }
    // body - soal
    function bodySoal(idx,soal,peserta,is_time_now,direction,currIdx,targetedUserId) {
        let nav_soal = "";        
        soal.forEach((e,i) => {            
            nav_soal = nav_soal + `<button 
            onclick="refresh_navigation_member('curr',${currIdx},${targetedUserId},'curr',${i})"
                class="p-2 ${e.jawaban_interviewer==null?'bg-gray-100':'bg-blue-300'} rounded-md text-center">
                <span>${i+1}</span>
            </button>`;
        });

        if(peserta.length==0){
            return ``;
        }else{
            if(!is_time_now){
                return `<div class="relative p-3">
                    <span>Waktu ujian belum dimulai!</span>
                </div>`;
            }else{                
                return `<div class="relative">                
                <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-2 lg:px-2 md:px-2">
                    <div
                        class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                        <div class="relative p-3">
                            <h3>Soal Wawancara No.
                                <span id="no_soal"
                                    class="p-1 bg-blue-500 text-white text-sm font-bold rounded-md">${idx+1}</span>
                            </h3>
                            <hr class="mb-3 mt-1">
                            <div class="m-2 p-2 bg-gray-100 rounded-md">
                                <p>${soal[idx].question}</p>
                                <input type="hidden" name="id_exam_interview_member_result"
                                    id="id_exam_interview_member_result" value="${soal[idx].id}">
                            </div>
                            <div class="answer_options m-2 p-2">
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-1" type="radio" value="1" name="default-radio"
                                    
                                    ${soal[idx].jawaban_interviewer==1?'checked':''}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                    <label for="default-radio-1"
                                        class="ml-2 text-sm font-medium text-dark-900 dark:text-dark-300">
                                        Ya
                                    </label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-2" type="radio" value="0" name="default-radio"
                                    
                                    ${soal[idx].jawaban_interviewer==0?'checked':''}
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
                                            <button onclick="refresh_navigation_member('curr',${currIdx},${targetedUserId},'prev',${idx})"
                                                class="${idx==0?'hidden':''} inline-flex xl:self-start self-center items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
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
                                            <button disabled>${idx+1} dari ${soal.length}</button>
                                        </div>
                                        <div
                                            class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
                                            <button onclick="refresh_navigation_member('curr',${currIdx},${targetedUserId},'next',${idx})"
                                                class="inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                                                ${idx+1==soal.length?'Save':'Next'} &nbsp;
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
                                ${nav_soal}
                            </div>
                            <div class="mt-2 text-sm leading-5 text-gray-500">
                                <span class="px-2 pb-1 bg-blue-300 rounded-md">&nbsp;&nbsp;</span>
                                = Sudah Dikerjakan
                            </div>
                            <div class="mt-2 text-sm leading-5 text-gray-500">
                                <span class="px-2 pb-1 bg-gray-300 rounded-md">&nbsp;&nbsp;</span>
                                = Belum Dikerjakan
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            }
        }
    }

    function updateStatusUjian(id_exam_interview_member,nama,prodi,status,catatan,idx,id_camaba) {
        $('#id_exam_interview_member').val(id_exam_interview_member);
        $('#nama').val(nama);
        $('#prodi').val(prodi);
        $('#status_ujian').val(status);
        $('#catatan_penguji').val(catatan);
        $('#saveButton').attr("onclick",`refresh_navigation_member('curr',${idx},${id_camaba},null,null)`);
    }
</script>
@endsection