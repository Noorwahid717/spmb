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
                    Data Bank Soal Ujian Seleksi Akademik
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Lakukan manipulasi data soal untuk memenuhi bank soal ujian seleksi akademik.
                </p>
            </div>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                data-modal="#addBankSoalModal" rel="modal:open" href="#addBankSoalModal" onclick="modalAddClick()">
                <img src="{{asset('/themes/tailwind/images/add.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Tambah Data</a>
        </div>
        <div class="relative p-5">
            <div class="flex items-center">
                <div class="form-group mb-5 text-xs" style="max-width: 250px">
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
                </div>
            </div>
            <table id="bank_soal" class="display bank_soal" style="width:100%;">
                <thead>
                    <tr>
                        <th style="text-align: center!important">NO</th>
                        <th>PRODI</th>
                        <th>PERTANYAAN</th>
                        <th>KUNCI</th>
                        <th style="text-align: center!important">STATUS</th>
                        <th style="width: 130px;text-align: center!important">ACT</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input type="hidden" id="bank_soal_url" class="bank_soal_url" name="bank_soal_url"
                value="{{route('wave.bank-soal-getlist')}}">
            <input type="hidden" id="detele_bank_soal_url" class="detele_bank_soal_url" name="detele_bank_soal_url"
                value="{{route('wave.bank-soal-delete')}}">
            @include('theme::seleksi.bank_soal.modal.add')
            @include('theme::seleksi.bank_soal.modal.detail')
            @include('theme::seleksi.bank_soal.modal.edit')
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

    var table = $('.bank_soal').DataTable({
        pageLength : 10,
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#bank_soal_url').val(),
            type:"POST",
            data:function(d){
                d._token = $('._token').data('token')
                d.filter_prodi = $('#filter_prodi_option option:selected').val()                
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
            $(cells[5]).addClass('text-sm text-center')                        
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'program_studi', name: 'program_studi'},
            {data: 'pertanyaan', name: 'pertanyaan'},
            {data: 'kunci_jawaban', name: 'kunci_jawaban'},            
            {data: 'status', name: 'status'},
            {data: 'act', name:'act'},               
        ], 
    });

    function execFil() {    
        table.ajax.reload();
    }
</script>
<script>
    function addBankSoal() {
        const id_prodi = $("#soal_prodi_option option:selected").val();
        const deskripsi_pertanyaan = $("#deskripsi_pertanyaan").val();
        const kunci_jawaban = $("#kunci_jawaban").val();
        const jawaban_pelengkap_1 = $("#jawaban_pelengkap_1").val();
        const jawaban_pelengkap_2 = $("#jawaban_pelengkap_2").val();
        const jawaban_pelengkap_3 = $("#jawaban_pelengkap_3").val();
        const jawaban_pelengkap_4 = $("#jawaban_pelengkap_4").val();
        const status_soal = $("#status_soal").val();
        const params = {id_prodi,deskripsi_pertanyaan,kunci_jawaban,jawaban_pelengkap_1,
            jawaban_pelengkap_2,jawaban_pelengkap_3,jawaban_pelengkap_4,status_soal}

        if(id_prodi!=-1){                        
        if(deskripsi_pertanyaan!=""){
        if(kunci_jawaban!=""){
        if(jawaban_pelengkap_1!=""){
        if(jawaban_pelengkap_2!=""){
        if(jawaban_pelengkap_3!=""){
        if(jawaban_pelengkap_4!=""){
            saveBankSoal(params);                    
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Opsi jawaban lain (4) wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Opsi jawaban lain (3) wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Opsi jawaban lain (2) wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Opsi jawaban lain (1) wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Kunci jawaban wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Deskripsi pertanyaan wajib diisi!",
                });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih program studi terlebih dahulu!",
            });
        }
    }

    function saveBankSoal(params) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['id_prodi']=params.id_prodi;
        datar['deskripsi_pertanyaan']=params.deskripsi_pertanyaan;
        datar['kunci_jawaban']=params.kunci_jawaban;        
        datar['jawaban_pelengkap_1']=params.jawaban_pelengkap_1;
        datar['jawaban_pelengkap_2']=params.jawaban_pelengkap_2;
        datar['jawaban_pelengkap_3']=params.jawaban_pelengkap_3;
        datar['jawaban_pelengkap_4']=params.jawaban_pelengkap_4;
        datar['status_soal']=params.status_soal;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#addBankSoalUrl").val(),
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
        $("#soal_prodi_option").val(-1);
        $("#deskripsi_pertanyaan").val("");
        $("#kunci_jawaban").val("");
        $("#jawaban_pelengkap_1").val("");
        $("#jawaban_pelengkap_2").val("");
        $("#jawaban_pelengkap_3").val("");
        $("#jawaban_pelengkap_4").val("");
        $("#status_soal").val(1);
    }

    function detailModalClick(a,b,c,d,e,f,g,h,i){          
        $("#detail_soal_prodi_option").val(b);
        $("#detail_deskripsi_pertanyaan").val(c);
        $("#detail_kunci_jawaban").val(d);
        $("#detail_jawaban_pelengkap_1").val(e);
        $("#detail_jawaban_pelengkap_2").val(f);
        $("#detail_jawaban_pelengkap_3").val(g);
        $("#detail_jawaban_pelengkap_4").val(h);
        $("#detail_status_soal").val(i);
    }
    function deleteModalClick(a,b,c,d,e,f,g,h,i){
        const contents = `Anda akan menghapus soal berikut: <strong><br>${c}</strong>`;          
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
                    deleteBankSoal(a);
                } 
        });
    }
    function deleteBankSoal(a){        
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
            url: $("#detele_bank_soal_url").val(),
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
    function editModalClick(a,b,c,d,e,f,g,h,i) {
        $("#edit_soal_prodi_id").val(a);
        $("#edit_soal_prodi_option").val(b);
        $("#edit_deskripsi_pertanyaan").val(c);
        $("#edit_kunci_jawaban").val(d);
        $("#edit_jawaban_pelengkap_1").val(e);
        $("#edit_jawaban_pelengkap_2").val(f);
        $("#edit_jawaban_pelengkap_3").val(g);
        $("#edit_jawaban_pelengkap_4").val(h);
        $("#edit_status_soal").val(i);
    }
    function editBankSoal() {
        const id = $("#edit_soal_prodi_id").val();
        const id_prodi = $("#edit_soal_prodi_option option:selected").val();
        const deskripsi_pertanyaan = $("#edit_deskripsi_pertanyaan").val();
        const kunci_jawaban = $("#edit_kunci_jawaban").val();
        const jawaban_pelengkap_1 = $("#edit_jawaban_pelengkap_1").val();
        const jawaban_pelengkap_2 = $("#edit_jawaban_pelengkap_2").val();
        const jawaban_pelengkap_3 = $("#edit_jawaban_pelengkap_3").val();
        const jawaban_pelengkap_4 = $("#edit_jawaban_pelengkap_4").val();
        const status_soal = $("#edit_status_soal").val();
        const params = {id,id_prodi,deskripsi_pertanyaan,kunci_jawaban,jawaban_pelengkap_1,
            jawaban_pelengkap_2,jawaban_pelengkap_3,jawaban_pelengkap_4,status_soal}

        if(id_prodi!=-1){                        
        if(deskripsi_pertanyaan!=""){
        if(kunci_jawaban!=""){
        if(jawaban_pelengkap_1!=""){
        if(jawaban_pelengkap_2!=""){
        if(jawaban_pelengkap_3!=""){
        if(jawaban_pelengkap_4!=""){
            updateBankSoal(params);                    
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Opsi jawaban lain (4) wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Opsi jawaban lain (3) wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Opsi jawaban lain (2) wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Opsi jawaban lain (1) wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Kunci jawaban wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Deskripsi pertanyaan wajib diisi!",
                });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih program studi terlebih dahulu!",
            });
        }
    }
    function updateBankSoal(params) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['id']=params.id;
        datar['id_prodi']=params.id_prodi;
        datar['deskripsi_pertanyaan']=params.deskripsi_pertanyaan;
        datar['kunci_jawaban']=params.kunci_jawaban;        
        datar['jawaban_pelengkap_1']=params.jawaban_pelengkap_1;
        datar['jawaban_pelengkap_2']=params.jawaban_pelengkap_2;
        datar['jawaban_pelengkap_3']=params.jawaban_pelengkap_3;
        datar['jawaban_pelengkap_4']=params.jawaban_pelengkap_4;
        datar['status_soal']=params.status_soal;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#editBankSoalUrl").val(),
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
</script>
@endsection