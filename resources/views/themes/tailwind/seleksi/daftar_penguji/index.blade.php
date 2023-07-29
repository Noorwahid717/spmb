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
                    Data Daftar Penguji Seleksi PMB
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Lakukan manipulasi daftar penguji agar ujian seleksi dapat terlaksana sesuai prosedur.
                </p>
            </div>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                data-modal="#addDaftarPengujiModal" rel="modal:open" href="#addDaftarPengujiModal"
                onclick="modalAddClick()">
                <img src="{{asset('/themes/tailwind/images/add.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Tambah Data</a>
        </div>
        <div class="relative p-5">
            {{-- <div class="flex items-center">
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
            </div> --}}
            <table id="daftar_penguji" class="display daftar_penguji" style="width:100%;">
                <thead>
                    <tr>
                        <th style="text-align: center!important">NO</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th style="text-align: center!important">STATUS</th>
                        <th style="width: 130px;text-align: center!important">ACT</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input type="hidden" id="daftar_penguji_url" class="daftar_penguji_url" name="daftar_penguji_url"
                value="{{route('wave.daftar-penguji-getlist')}}">
            <input type="hidden" id="detele_daftar_penguji_url" class="detele_daftar_penguji_url"
                name="detele_daftar_penguji_url" value="{{route('wave.daftar-penguji-delete')}}">

            @include('theme::seleksi.daftar_penguji.modal.add')
            @include('theme::seleksi.daftar_penguji.modal.edit')
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

    var table = $('.daftar_penguji').DataTable({
        pageLength : 10,
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#daftar_penguji_url').val(),
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
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role_name', name: 'role_name'},            
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
        $("#nama_penguji").val("");
        $("#email").val("");
        $("#password").val("");
        $("#conf_password").val("");
        $("#show_password").prop('checked', false);
        $("#status_penguji").val(1);
        $("#edit_conf_password").attr('type', 'password');
        $("#edit_password").attr('type', 'password');
    }
    function addDaftarPenguji(){
        const nama_penguji = $("#nama_penguji").val();
        const email = $("#email").val();
        const password = $("#password").val();
        const conf_password = $("#conf_password").val();
        const status_penguji = $("#status_penguji  option:selected").val();
        const params = {
        nama_penguji,
        email,
        password,
        status_penguji
        }

        if(nama_penguji!=""){                        
        if(email!=""){
        if(password!=""){
        if(conf_password!=""){
        if(password==conf_password){
            saveDaftarPenguji(params);                            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ulangi password tidak sama!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ulangi password wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Password wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Email wajib diisi!",
                });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Nama penguji wajib diisi!",
            });
        }
    }
    function saveDaftarPenguji(params){
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
            url: $("#addDaftarPengujiUrl").val(),
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
    function showPassword(){
        if($("#show_password").is(":checked")){
            $("#conf_password").attr('type', 'text');
            $("#password").attr('type', 'text');
        }else{
            $("#conf_password").attr('type', 'password');
            $("#password").attr('type', 'password');
        }
    }
    function deleteModalClick(a,b,c,d,e,f){
        const contents = `Anda akan menghapus penguji berikut: <strong><br>${c} : ${d}</strong>`;          
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
                    deleteDaftarPenguji(a);
                } 
        });
    }
    function deleteDaftarPenguji(a){        
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
            url: $("#detele_daftar_penguji_url").val(),
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
    function editModalClick(a,b,c,d,e,f){
        $("#id_penguji").val(a);
        $("#edit_nama_penguji").val(c);
        $("#edit_email").val(d);
        $("#edit_password").val("");
        $("#edit_conf_password").val("");
        $("#edit_show_password").prop('checked', false);
        $("#edit_status_penguji").val(f);
        $("#edit_conf_password").attr('type', 'password');
        $("#edit_password").attr('type', 'password');
    }
    function showEditPassword(){
        if($("#edit_show_password").is(":checked")){
            $("#edit_conf_password").attr('type', 'text');
            $("#edit_password").attr('type', 'text');
        }else{
            $("#edit_conf_password").attr('type', 'password');
            $("#edit_password").attr('type', 'password');
        }
    }
    function editDaftarPenguji(){
        const id_penguji = $("#id_penguji").val();
        const nama_penguji = $("#edit_nama_penguji").val();
        const email = $("#edit_email").val();
        const password = $("#edit_password").val();
        const conf_password = $("#edit_conf_password").val();
        const status_penguji = $("#edit_status_penguji  option:selected").val();
        const params = {
        id_penguji,
        nama_penguji,
        email,
        password,
        status_penguji
        }

        if(nama_penguji!=""){                        
        if(email!=""){
        if(password!=""){
        if(conf_password!=""){
        if(password==conf_password){
            updateDaftarPenguji(params);                            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ulangi password tidak sama!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ulangi password wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Password wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Email wajib diisi!",
                });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Nama penguji wajib diisi!",
            });
        }
    }
    function updateDaftarPenguji(params) {
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
            url: $("#editDaftarPengujiUrl").val(),
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