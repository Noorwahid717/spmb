@extends('theme::layouts.app')


@section('content')


<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{ asset('/themes/tailwind/images/biodata.png') }}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Data Konversi Nilai Tes Potensi Akademik
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Lakukan manipulasi data konversi nilai tes potensi akademik.
                </p>
            </div>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                data-modal="#addExamConvertionResultModal" rel="modal:open" href="#addExamConvertionResultModal"
                onclick="modalAddClick()">
                <img src="{{asset('/themes/tailwind/images/add.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Tambah Data</a>
        </div>
        <div class="relative p-5">
            <div class="flex items-center">
                {{-- <div class="form-group mb-5 text-xs" style="max-width: 250px">
                    <label for="filter_prodi_option">Filter <strong>Program Studi</strong>:</label>
                    <select name="filter_prodi_option" id="filter_prodi_option"
                        class="form-control mt-1 filter_prodi_option">
                        <option value="-1">--Pilih Program Studi--</option>
                        <option value="all">--Semua Prodi--</option>
                        @foreach ($prodi as $item)
                        <option value="{{$item->id_prodi}}">{{$item->nama_program_studi}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button
                        class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                        onclick="execFil()">
                        <img src="{{asset('/themes/tailwind/images/loupe.png')}}" class="w-6 rounded sm:mx-auto">
                        &nbsp;Tampilkan Data</button>
                </div> --}}
            </div>
            <table id="exam_convertion_result" class="display exam_convertion_result" style="width:100%;">
                <thead>
                    <tr>
                        <th style="text-align: center!important">NO</th>
                        <th>RANGE AWAL</th>
                        <th>RANGE AKHIR</th>
                        <th>STATUS</th>
                        <th>KETERANGAN</th>
                        <th style="width: 130px;text-align: center!important">ACT</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input type="hidden" id="exam_convertion_result_url" class="exam_convertion_result_url"
                name="exam_convertion_result_url" value="{{route('wave.exam-convertion-result-getlist')}}">
            <input type="hidden" id="detele_exam_convertion_result_url" class="detele_exam_convertion_result_url"
                name="detele_exam_convertion_result_url" value="{{route('wave.exam-convertion-result-delete')}}">
            @include('theme::seleksi.exam_convertion_result.modal.add')
            @include('theme::seleksi.exam_convertion_result.modal.edit')
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

    var table = $('.exam_convertion_result').DataTable({
        pageLength : 10,
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#exam_convertion_result_url').val(),
            type:"POST",
            data:function(d){
                d._token = $('._token').data('token')
            }
        }, 
        createdRow: function(row, data, dataIndex, cells) {
            // console.log( data.FeederAKM );
            $(row).addClass('transparentClass') 
            $(cells[0]).addClass('text-center text-sm')
            $(cells[1]).addClass('text-sm')
            $(cells[2]).addClass('text-sm')
            $(cells[3]).addClass('text-sm')
            $(cells[4]).addClass('text-sm text-center')                        
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'range_nilai_awal', name: 'range_nilai_awal'},
            {data: 'range_nilai_akhir', name: 'range_nilai_akhir'},
            {data: 'status_cust', name: 'status_cust'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'act', name:'act'},               
        ], 
    });

    function execFil() {    
        table.ajax.reload();
    }
</script>
<script>
    function addExamConvertionResult() {
        const range_nilai_awal = $("#range_nilai_awal").val();
        const range_nilai_akhir = $("#range_nilai_akhir").val();
        const status = $("#status option:selected").val();
        const keterangan = $("#keterangan").val();
        const params = {range_nilai_awal,range_nilai_akhir,status,keterangan}

        if(range_nilai_awal!=""){
        if(range_nilai_akhir!=""){
        if(status!=-2){
        if(keterangan!=""){
            saveExamConvertionResult(params);                    
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Keterangan wajib diisi!",
                });
        }
    }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Status wajib dipilih!",
                });
        }
    }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Range nilai akhir wajib diisi!",
                });
        }
    }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Range nilai awal wajib diisi!",
                });
        }
    }
    function saveExamConvertionResult(params) {
        $('.containerr').show();
        let header = {};
        header['_method']='POST';
        header['_token']=$('._token').data('token');
        let datar = {...header,...params};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#addExamConvertionResultUrl").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    $('#close_modal').trigger("click");        
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    table.ajax.reload();
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                    });
                    $('.containerr').hide();
                }
            },
        }); 
    }
    function modalAddClick(){          
        $("#range_nilai_awal").val("");
        $("#range_nilai_akhir").val("");
        $("#status").val(-2);
        $("#keterangan").val("");
    }

    function deleteModalClick(a,b,c,d,e){
        const contents = `Anda akan menghapus konversi nilai potensi akademik berikut: <strong><br>${b}-${c} | ${d} - ${e}</strong><br>cek lagi menghapus relasi`;          
        Swal.fire({
            title: 'Apakah anda yakin!',
            // text: teks,
            html: contents,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus sekarang!',
            cancelButtonText: 'Batal',
            reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {  
                    deleteExamConvertionResult(a);
                } 
        });
    }
    function deleteExamConvertionResult(a){        
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['id']=a;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#detele_exam_convertion_result_url").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    table.ajax.reload();
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                    });
                    $('.containerr').hide();
                }
            },
        }); 
    }

    function editModalClick(a,b,c,d,e) {
        $("#edit_id").val(a);
        $("#edit_range_nilai_awal").val(b);
        $("#edit_range_nilai_akhir").val(c);
        $("#edit_status").val(d);
        $("#edit_keterangan").val(e);
    }
    // function editInterviewQuestion() {
    //     const id = $("#edit_soal_interview_id").val();
    //     const deskripsi_pertanyaan = $("#edit_deskripsi_pertanyaan").val();

    //     const params = {id,deskripsi_pertanyaan}

    //     if(deskripsi_pertanyaan!=""){
    //         updateInterviewQuestion(params);                    
    //     }else{
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Oops...',
    //             text: "Deskripsi pertanyaan wajib diisi!",
    //             });
    //     }
    // }
    // function updateInterviewQuestion(params) {
    //     $('.containerr').show();
    //     let header = {};
    //     header['_method']='POST';
    //     header['_token']=$('._token').data('token');
    //     let datar = {...header,...params};
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: 'post',
    //         url: $("#editInterviewQuestionUrl").val(),
    //         data:datar,
    //         success: function(data) {
    //             if (data.error==false) {
    //                 $('.containerr').hide();                    
    //                 $('#close_modal').trigger("click");        
    //                 Toast.fire({
    //                     icon: 'success',
    //                     title: data.message
    //                 });
    //                 table.ajax.reload();
    //             }else{
    //                 Swal.fire({
    //                 icon: 'error',
    //                 title: 'Oops...',
    //                 text: data.message,
    //                 });
    //                 $('.containerr').hide();
    //             }
    //         },
    //     }); 
    // }
</script>
@endsection