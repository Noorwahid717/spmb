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
                    Data Penjadwalan Ujian Seleksi PMB
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Lakukan manipulasi penjadwalan ujian agar ujian seleksi dapat terlaksana sesuai prosedur.
                </p>
            </div>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                data-modal="#addPenjadwalanUjianModal" rel="modal:open" href="#addPenjadwalanUjianModal"
                onclick="modalAddClick()">
                <img src="{{asset('/themes/tailwind/images/add.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Tambah Data</a>
        </div>
        <div class="relative p-5">
            <div class="flex items-center">
                <div class="form-group mb-5 text-xs" style="max-width: 250px">
                    <label for="filter_periode_option">Filter <strong>Periode Akademik</strong>:</label>
                    <select name="filter_periode_option" id="filter_periode_option"
                        class="form-control mt-1 filter_periode_option">
                        <option value="-1">--Pilih Periode Akademik--</option>
                        @foreach ($periode as $item)
                        <option value="{{$item->id_semester}}">{{$item->nama_semester}}</option>
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
            <table id="penjadwalan_ujian" class="display penjadwalan_ujian" style="width:100%;">
                <thead>
                    <tr>
                        <th style="text-align: center!important">NO</th>
                        <th>TAHUN AKADEMIK</th>
                        <th>KETERANGAN</th>
                        <th>MULAI</th>
                        <th>SAMPAI</th>
                        <th style="text-align: center!important">SETTING SELEKSI</th>
                        <th style="text-align: center!important">STATUS</th>
                        <th style="width: 130px;text-align: center!important">ACT</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input type="hidden" id="penjadwalan_ujian_url" class="penjadwalan_ujian_url" name="penjadwalan_ujian_url"
                value="{{route('wave.penjadwalan-ujian-getlist')}}">
            @include('theme::seleksi.penjadwalan_ujian.modal.add')
            @include('theme::seleksi.penjadwalan_ujian.modal.edit')
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

    var table = $('.penjadwalan_ujian').DataTable({
        pageLength : 10,
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#penjadwalan_ujian_url').val(),
            type:"POST",
            data:function(d){
                d._token = $('._token').data('token')
                // d.filter_prodi = $('#filter_prodi_option option:selected').val()                
                d.filter_periode = $('#filter_periode_option option:selected').val()                
            }
        }, 
        createdRow: function(row, data, dataIndex, cells) {
            // console.log( data.FeederAKM );
            $(row).addClass('transparentClass') 
            $(cells[0]).addClass('text-center text-sm')
            $(cells[1]).addClass('text-sm')
            $(cells[2]).addClass('text-sm')
            $(cells[3]).addClass('text-sm')
            $(cells[4]).addClass('text-sm ')
            $(cells[5]).addClass('text-sm text-center')
            $(cells[6]).addClass('text-sm text-center')                        
            $(cells[7]).addClass('text-sm text-center')                        
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'tahun_akademik', name: 'tahun_akademik'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'start_date', name: 'start_date'},            
            {data: 'end_date', name: 'end_date'},
            {data: 'exams', name: 'exams'},
            {data: 'status', name: 'status'},
            {data: 'act', name:'act'},               
        ], 
    });

    function execFil() {    
        table.ajax.reload();
    }
</script>
<script>
    function modalAddClick(){
        $("#periode_akademik").val("-1");
        $("#keterangan").val("");
        $("#tanggal_mulai").val("");
        $("#tanggal_selesai").val("");        
    }

    function addPenjadwalanUjian(){
        const tahun_akademik = $("#periode_akademik option:selected").val();
        const keterangan = $("#keterangan").val();
        const tanggal_mulai = $("#tanggal_mulai").val();
        const tanggal_selesai = $("#tanggal_selesai").val();
        const params = {
        tahun_akademik,
        keterangan,
        tanggal_mulai,
        tanggal_selesai
        }

        if(tahun_akademik!=""){                        
        if(keterangan!=""){
        if(tanggal_mulai!=""){
        if(tanggal_selesai!=""){
        if(tanggal_mulai<tanggal_selesai){
            savePenjadwalanUjian(params);                            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tanggal selesai tidak boleh lebih awal dari pada tanggal mulai!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tanggal selesai wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tanggal mulai wajib diisi!",
            });
        }
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
                text: "Periode Akademik wajib diisi!",
            });
        }
    }

    function savePenjadwalanUjian(params){
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
            url: $("#addPenjadwalanUjianUrl").val(),
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

    function deleteModalClick(id,tasa,keterangan){
        const contents = `Anda akan menghapus penjadwalan ujian berikut: <strong><br>${tasa} : ${keterangan}</strong>`;          
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
                    // deleteDaftarPenguji(a);
                } 
        });
    }

    function editModalClick(id,tahun_akademik,keterangan,start_date,end_date){
        $("#edit_id_penjadwalan_ujian").val(id);
        $("#edit_periode_akademik").val(tahun_akademik);
        $("#old_keterangan").val(keterangan);
        $("#edit_keterangan").val(keterangan);
        $("#edit_tanggal_mulai").val(start_date);
        $("#edit_tanggal_selesai").val(end_date);  
    }

    function editPenjadwalanUjian(){
        const tahun_akademik = $("#edit_periode_akademik option:selected").val();
        const keterangan = $("#edit_keterangan").val();
        const old_keterangan = $("#old_keterangan").val();
        const tanggal_mulai = $("#edit_tanggal_mulai").val();
        const tanggal_selesai = $("#edit_tanggal_selesai").val();
        const id = $("#edit_id_penjadwalan_ujian").val();
        const params = {
        id,
        tahun_akademik,
        keterangan,
        old_keterangan,
        tanggal_mulai,
        tanggal_selesai
        }

        if(tahun_akademik!=""){                        
        if(keterangan!=""){
        if(tanggal_mulai!=""){
        if(tanggal_selesai!=""){
        if(tanggal_mulai<tanggal_selesai){
            updatePenjadwalanUjian(params);                            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tanggal selesai tidak boleh lebih awal dari pada tanggal mulai!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tanggal selesai wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tanggal mulai wajib diisi!",
            });
        }
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
                text: "Periode Akademik wajib diisi!",
            });
        }
    }

    function updatePenjadwalanUjian(params){
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
            url: $("#editPenjadwalanUjianUrl").val(),
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
<script>
    function KelolaExamInterview(id,ta,ta_long,ket){
        
    }
</script>
@endsection