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
                    Pengelolaan Ujian Baca Al-Quran
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Kelola Ujian Baca Al-Quran Tahun Akademik <strong>{{$ta_long}}</strong> Nama Gelombang
                    <strong>{{$schedule->keterangan}}</strong>
                </p>
            </div>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-yellow-400 hover:bg-yellow-600 text-dark text-sm font-medium rounded-md"
                href="{{route('wave.penjadwalan-ujian')}}">
                <img src="{{asset('/themes/tailwind/images/rewind.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Kembali</a>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                data-modal="#addExamReadQuranModal" rel="modal:open" href="#addExamReadQuranModal"
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
            <table id="exam_read_quran" class="display exam_read_quran" style="width:100%;">
                <thead>
                    <tr>
                        <th style="text-align: center!important">NO</th>
                        <th>PENGUJI</th>
                        <th>NAMA SESI</th>
                        <th>TANGGAL</th>
                        <th>WAKTU</th>
                        <th>JML PESERTA</th>
                        <th>LOLOS UJIAN</th>
                        <th style="width: 130px;text-align: center!important">ACT</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input type="hidden" id="exam_read_quran_url" class="exam_read_quran_url" name="exam_read_quran_url"
                value="{{route('wave.exam-read-quran-getlist')}}">
            <input type="hidden" id="detele_exam_read_quran_url" class="detele_exam_read_quran_url"
                name="detele_exam_read_quran_url" value="{{route('wave.exam-read-quran-delete')}}">
            <input type="hidden" id="exam_read_quran_reset_url" class="exam_read_quran_reset_url"
                name="exam_read_quran_reset_url" value="{{route('wave.exam-read-quran-reset')}}">

            @include('theme::seleksi.exam_read_quran.modal.add')
            @include('theme::seleksi.exam_read_quran.modal.edit')
            @include('theme::seleksi.exam_read_quran.modal.detail-mhs')
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

    var table = $('.exam_read_quran').DataTable({
        pageLength : 10,
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#exam_read_quran_url').val(),
            type:"POST",
            data:function(d){
                d._token = $('._token').data('token');
                d.id_exam_schedule = @json($schedule->id);
                d.keterangan = @json($schedule->keterangan);
                d.ta_long = @json($ta_long);            
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
            $(cells[5]).addClass('text-sm ')
            $(cells[6]).addClass('text-sm ')
            $(cells[7]).addClass('text-sm text-center')                        
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_penguji', name: 'nama_penguji'},
            {data: 'nama_sesi', name: 'nama_sesi'},
            {data: 'tanggal', name: 'tanggal'},            
            {data: 'waktu_custom', name: 'waktu_custom'},            
            {data: 'jumlah_peserta_custom', name: 'jumlah_peserta_custom'},
            {data: 'jumlah_lolos', name: 'jumlah_lolos'},
            {data: 'act', name:'act'},               
        ], 
    });

    function execFil() {    
        table.ajax.reload();
    }
</script>
<script>
    function deleteModalClick(id,id_penguji,sesi,penguji,ta,gelombang){        
        const contents = `Anda akan menghapus ujian baca al-quran berikut: ${ta} ${gelombang} <br>Penguji <strong>${penguji} : ${sesi}</strong>`;          
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
                    deleteExamReadQuran(id);
                } 
        });
    }
    function deleteExamReadQuran(id) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['id']=id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#detele_exam_read_quran_url").val(),
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
</script>
<script>
    // Detail Peserta Ujian
    var tableAvailable = $('.available_member').DataTable({
        lengthMenu: [
        [ 5, 10, 25, 50, -1 ],
        [ 5,10, 25, 50, 'all' ]
        ],
        buttons: [
            'pageLength'
        ],
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#available_member_url').val(),
            type:"POST",
            data:function(d){
                d._token = $('._token').data('token');
                d.id_exam_schedule = @json($schedule->id);
                d.keterangan = @json($schedule->keterangan);
                d.ta_seleksi = @json($schedule->tahun_akademik);
                d.ta_long = @json($ta_long);
                d.id_exam_read_quran = $('#id_exam_read_quran').val();           
                // d.filter_prodi = $('#filter_prodi_option option:selected').val()                
                // d.filter_periode = $('#filter_periode_option option:selected').val()                
            }
        }, 
        createdRow: function(row, data, dataIndex, cells) {
            // console.log( data.FeederAKM );
            $(row).addClass('transparentClass') 
            $(cells[0]).addClass('text-center text-sm')
            $(cells[1]).addClass('text-sm')
            $(cells[2]).addClass('text-sm')
            $(cells[3]).addClass('text-center text-sm')
            $(cells[4]).addClass('text-center text-sm ')
            $(cells[5]).addClass('text-sm text-center')                        
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama', name: 'nama'},
            {data: 'prodi', name: 'prodi'},
            {data: 'custom_lunas', name: 'custom_lunas'},            
            {data: 'custom_adm', name: 'custom_adm'},
            {data: 'act', name:'act'},               
        ], 
    });

    function execFil() {    
        tableAvailable.ajax.reload();
    }

    function setIdExamReadQuranModal(id,tanggal,waktu,tempat,nama_penguji,sesi){
        $('#id_exam_read_quran').val(id);
        $('.terploting').html(`Penguji: ${nama_penguji} - ${sesi} - ${tanggal} - ${waktu} - ${tempat}`);
        tableAvailable.ajax.reload();
        tableJoined.ajax.reload();
    }

    var tableJoined = $('.joined_member').DataTable({
        lengthMenu: [
        [ 5, 10, 25, 50, -1 ],
        [ 5,10, 25, 50, 'all' ]
        ],
        buttons: [
            'pageLength'
        ],
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#joined_member_url').val(),
            type:"POST",
            data:function(d){
                d._token = $('._token').data('token');
                d.id_exam_schedule = @json($schedule->id);
                d.keterangan = @json($schedule->keterangan);
                d.ta_long = @json($ta_long);
                d.id_exam_read_quran = $('#id_exam_read_quran').val();           
                d.ta_seleksi = @json($schedule->tahun_akademik);
            }
        }, 
        createdRow: function(row, data, dataIndex, cells) {
            // console.log( data.FeederAKM );
            $(row).addClass('transparentClass') 
            $(cells[0]).addClass('text-center text-sm')
            $(cells[1]).addClass('text-center text-sm')
            $(cells[2]).addClass('text-sm')
            $(cells[3]).addClass('text-sm')
            $(cells[4]).addClass('text-center text-sm ')
            $(cells[5]).addClass('text-sm text-center')                        
            $(cells[6]).addClass('text-sm text-center')                        
            $(cells[7]).addClass('text-sm text-center')                        
        },
        columns: [
            {data: 'act', name:'act'},               
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama', name: 'nama'},
            {data: 'prodi', name: 'prodi'},
            {data: 'custom_lunas', name: 'custom_lunas'},            
            {data: 'custom_adm', name: 'custom_adm'},
            {data: 'status_lolos', name: 'status_lolos'},
            {data: 'reset', name: 'reset'},
        ], 
    });

    function execFil() {    
        tableJoined.ajax.reload();
    }
</script>
<script>
    function resetHasilUjianReadQuran(id_exam_read_quran_member,id_camaba,nama,prodi,ta_seleksi) {
        const contents = `Anda akan mereset hasil ujian baca Al-Quran berikut: <strong>${nama} - ${prodi} - ${ta_seleksi}</strong>`;          
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
                    doResetHasilUjianReadQuran(id_exam_read_quran_member,id_camaba,ta_seleksi);
                } 
        });
    }

    function doResetHasilUjianReadQuran(id_exam_read_quran_member,id_camaba,ta_seleksi){
        $('.containerr').show();
        let params = {id_exam_read_quran_member,id_camaba,ta_seleksi};
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
            url: $("#exam_read_quran_reset_url").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    // $('#close_modal').trigger("click");        
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    tableAvailable.ajax.reload();
                    tableJoined.ajax.reload();
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

    function editModalClick(id,id_penguji,nama_sesi,tanggal,waktu,tempat){
        $('#edit_id_exam_read_quran').val(id);
        $("#edit_daftar_penguji").val(id_penguji);
        $("#old_session_name").val(nama_sesi);
        $("#edit_session_name").val(nama_sesi);
        $("#edit_tanggal_read_quran").val(tanggal);
        $("#edit_waktu_read_quran").val(waktu.substring(0, 5));
        $("#edit_tempat_read_quran").val(tempat);
    }

    function editExamReadQuran(){
        const id = $("#edit_id_exam_read_quran").val();
        const id_exam_schedule = @json($schedule->id);
        const id_penguji = $("#edit_daftar_penguji option:selected").val();
        const old_session_name = $("#old_session_name").val();
        const session_name = $("#edit_session_name").val();
        const tanggal_read_quran = $("#edit_tanggal_read_quran").val();
        const waktu_read_quran = $("#edit_waktu_read_quran").val();
        const tempat_read_quran = $("#edit_tempat_read_quran").val();
        const params = {
            id,
            id_exam_schedule,
            id_penguji,
            old_session_name,
            session_name,
            tanggal_read_quran,
            waktu_read_quran,
            tempat_read_quran
        };

        if(id_penguji!="-1"){                        
        if(session_name!=""){
        if(tanggal_read_quran!=""){
        if(waktu_read_quran!=""){
        if(tempat_read_quran){
            updateExamReadQuran(params);                            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tempat ujian baca al-quran wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Waktu ujian baca al-quran wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tanggal ujian baca al-quran wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Nama sesi wajib diisi!",
                });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih penguji terlebih dahulu!",
            });
        }
    }

    function updateExamReadQuran(params){
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
            url: $("#editExamReadQuranUrl").val(),
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
        $('#id_exam_schedule').val(@json($schedule->id));
        $("#daftar_penguji").val('-1');
        $("#session_name").val("");
        $("#tanggal_read_quran").val("");
        $("#waktu_read_quran").val("");
        $("#tempat_read_quran").val("");
    }

    function addExamReadQuran(){
        const id_exam_schedule = $("#id_exam_schedule").val();
        const id_penguji = $("#daftar_penguji option:selected").val();
        const session_name = $("#session_name").val();
        const tanggal_read_quran = $("#tanggal_read_quran").val();
        const waktu_read_quran = $("#waktu_read_quran").val();
        const tempat_read_quran = $("#tempat_read_quran").val();
        const params = {
            id_exam_schedule,
            id_penguji,
            session_name,
            tanggal_read_quran,
            waktu_read_quran,
            tempat_read_quran
        };

        if(id_penguji!="-1"){                        
        if(session_name!=""){
        if(tanggal_read_quran!=""){
        if(waktu_read_quran!=""){
        if(tempat_read_quran){
            saveExamReadQuran(params);                            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tempat ujian baca al-quran wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Waktu ujian baca al-quran wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Tanggal ujian baca al-quran wajib diisi!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Nama sesi wajib diisi!",
                });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih penguji terlebih dahulu!",
            });
        }
    }

    function saveExamReadQuran(params){
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
            url: $("#addExamReadQuranUrl").val(),
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

    function addMemberClick(id_exam_read_quran,id_camaba,ta_seleksi){
        $('.containerr').show();
        let params = {id_exam_read_quran,id_camaba,ta_seleksi};
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
            url: $("#addReadQuranMemberUrl").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    // $('#close_modal').trigger("click");        
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    tableAvailable.ajax.reload();
                    tableJoined.ajax.reload();
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

    function deleteMemberClick(id_exam_read_quran,id_camaba,ta_seleksi){
        $('.containerr').show();
        let params = {id_exam_read_quran,id_camaba,ta_seleksi};
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
            url: $("#deleteReadQuranMemberUrl").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    // $('#close_modal').trigger("click");        
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    tableAvailable.ajax.reload();
                    tableJoined.ajax.reload();
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