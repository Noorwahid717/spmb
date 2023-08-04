@extends('theme::layouts.app')


@section('content')


<div class="flex flex-col px-1 mx-auto my-6 lg:flex-row max-w-7xl xl:px-8">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{ asset('/themes/tailwind/images/biodata.png') }}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Ujian Potensi Akademik - {{$prodi->program_studi_1}}
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Tahun Akademik Pendaftaran - {{$ta}}
                </p>
            </div>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-yellow-400 hover:bg-yellow-600 text-dark text-sm font-medium rounded-md"
                href="{{route('wave.seleksi-info')}}">
                <img src="{{asset('/themes/tailwind/images/rewind.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Kembali</a>
            <div
                class="inline-flex self-start items-center ml-3 px-4 py-3 bg-blue-400 text-dark text-sm font-medium rounded-md">
                <img src="{{asset('/themes/tailwind/images/timeer.png')}}" class="w-6 rounded sm:mx-auto mr-5">
                <span id="timeup"></span>
            </div>
        </div>
        <div class="relative">
            {{-- <div class="flex items-center"> --}}
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
                            <div class="relative p-3" id="body-soal">
                                <h3>Soal No.
                                    <span id="no_soal"
                                        class="p-1 bg-blue-500 text-white text-sm font-bold rounded-md">1</span>
                                </h3>
                                <hr class="mb-3 mt-1">
                                <div class="m-2 p-2 bg-gray-100 rounded-md">
                                    <p>{{$soal[0]->pertanyaan}}</p>
                                    <input type="hidden" name="id_exam_academic_member_result"
                                        id="id_exam_academic_member_result">
                                </div>
                                <div class="answer_options m-2 p-2">
                                    @for ($i = 0; $i < 5; $i++) <div class="flex items-center mb-4">
                                        <input id="default-radio-{{$i+1}}" type="radio" value="" name="default-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                        <label for="default-radio-{{$i+1}}"
                                            class="ml-2 text-sm font-medium text-dark-900 dark:text-dark-300">
                                            @switch($i+1)
                                            @case(1)
                                            A. {{$soal[0]->ans_a}}
                                            @break
                                            @case(2)
                                            B. {{$soal[0]->ans_b}}
                                            @break
                                            @case(3)
                                            C. {{$soal[0]->ans_c}}
                                            @break
                                            @case(4)
                                            D. {{$soal[0]->ans_d}}
                                            @break
                                            @default
                                            E. {{$soal[0]->ans_e}}
                                            @break
                                            @endswitch
                                        </label>
                                </div>
                                @endfor
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
                                            <button disabled>1 dari 50</button>
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
                            <h3>Nomor Soal</h3>
                            <hr class="mb-3 mt-1">
                            <div class="grid grid-cols-5 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10 gap-4"
                                id="navigation-answer">
                                @foreach ($soal as $key => $item)
                                <button onclick="refresh_navigation_answer('curr',{{$key}},'')"
                                    class="p-2 {{$item->selected_answer==null?'bg-gray-100':'bg-blue-300'}} rounded-md text-center">
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
                {{-- row hasil seleksi --}}
                {{-- <div class="flex flex-col px-2 mx-auto my-3 lg:flex-row max-w-7xl xl:px-2 lg:px-2 md:px-2">
                    <div
                        class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg border-gray-150">
                        <div class="relative p-3">
                            <h3>Hasil Seleksi</h3>
                            <hr class="mb-3 mt-1">

                        </div>
                    </div>
                </div> --}}
            </div>
            @endif
            <input type="hidden" value="{{route('wave.do-exam-academic-updatelist')}}"
                name="do_exam_academic_update_list_url" id="do_exam_academic_update_list_url"
                class="do_exam_academic_update_list_url">

            {{--
        </div> --}}
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
        let body = document.getElementById("body-soal");
        body.innerHTML = bodySoal(0,@json($soal),@json($is_editable));            
    } );

</script>
<script>
    function refresh_navigation_answer(direction,currIdx,is_editable) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['is_editable']=is_editable;
        datar['selected_answer']=$("input[name='default-radio']:checked").val();;
        datar['id_exam_academic_member_result']=$("#id_exam_academic_member_result").val();;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#do_exam_academic_update_list_url").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();
                    let body = document.getElementById("body-soal");
                    if(direction=='next'){
                        targetIdx = currIdx+1;
                    }else if(direction=='prev'){
                        targetIdx = currIdx-1;
                    }else if(direction=='curr'){
                        targetIdx = currIdx;
                    }
                    if(currIdx+1==data.data.length&&direction=='next'){
                        targetIdx = currIdx
                    }
                    body.innerHTML = bodySoal(targetIdx,data.data,data.is_editable);  
                    // -------------------------------------------
                    let nue = data.data.map(function (item,index) {
                        return element(item,index);
                    }).join('');
                    $('#navigation-answer').html(nue);
                }
            },
        }); 
    }

    function element (data,i){
            return`<button onclick="refresh_navigation_answer('curr',${i},'')"
                class="p-2 ${data.selected_answer==null?'bg-gray-100':'bg-blue-300'} rounded-md text-center">
                <span>${i+1}</span>
            </button>`;        
    }
</script>
<script>
    // body - soal
    function bodySoal(idx,data,is_editable) {
        let options = "";
        for (let index = 0; index < 5; index++) {
            options = options + `<div class="flex items-center mb-4">
                <input id="default-radio-${index+1}" type="radio" value="${index+1}" name="default-radio"
                ${is_editable==false?'disabled':''}
                ${data[idx].selected_answer==index+1?'checked':''}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                <label for="default-radio-${index+1}"
                    class="ml-2 text-sm font-medium text-dark-900 dark:text-dark-300">
                    ${index+1==1?'A. '+data[idx].ans_a:
                    (index+1==2?'B. '+data[idx].ans_b:
                    (index+1==3?'C. '+data[idx].ans_c:
                    (index+1==4?'D. '+data[idx].ans_d:'E. '+data[idx].ans_e)))}
                </label>
                </div>`;
        }

        return `<h3>Soal No. 
            <span id="no_soal" class="p-1 bg-blue-500 text-white text-sm font-bold rounded-md">${idx+1}</span>
        </h3>
        <hr class="mb-3 mt-1">
        <div class="m-2 p-2 bg-gray-100 rounded-md">
            <p>${data[idx].pertanyaan}</p>
            <input type="hidden" name="id_exam_academic_member_result" id="id_exam_academic_member_result" value="${data[idx].id}">
        </div>
        <div class="answer_options m-2 p-2">
            ${options}
        <div class="navigation_question">
            <div class="flex flex-col px-3 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
                <div
                    class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
                    <button onclick="refresh_navigation_answer('prev',${idx},${is_editable})"
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
                    <button disabled>${idx+1} dari 50</button>
                </div>
                <div
                    class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
                    <button onclick="refresh_navigation_answer('next',${idx},${is_editable})"
                        class="inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                        ${idx+1==data.length?'Save':'Next'} &nbsp;
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
        </div>`;
    }
</script>
<script>
    // Set the date we're counting down to
    const ndate = @json($tanggal.' '.$waktu_selesai);
    var countDownDate = new Date(ndate).getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("timeup").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
        
      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("timeup").innerHTML = "Waktu Habis";
      }
    }, 1000);
</script>
@endsection