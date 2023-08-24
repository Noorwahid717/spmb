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
                    Validasi Data Pendaftaran Calon Mahasiswa Baru
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    cek data sesuai dengan dokumen yang terlampir dan lakukan validasi data pendaftaran calon mahasiswa
                    baru.
                </p>
            </div>

        </div>
        <div class="relative p-5">
            <div class="flex items-center">
                <div class="form-group mb-5 text-xs" style="max-width: 250px">
                    <label for="is_pil_prodi1_option">Filter <strong>PRODI1</strong>:</label>
                    <select name="is_pil_prodi1_option" id="is_pil_prodi1_option"
                        class="form-control mt-1 is_pil_prodi1_option">
                        <option value="null">--Belum Memilih Prodi--</option>
                        <option value="all" selected>--Semua Prodi--</option>
                        @foreach ($prodi as $item)
                        <option value="{{$item->id_prodi}}">{{$item->nama_program_studi}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-5 text-xs ml-3" style="max-width: 250px">
                    <label for="is_lunas_option">Filter <strong>VAL.BIAYA.DAFTAR</strong>:</label>
                    <select name="is_lunas_option" id="is_lunas_option" class="form-control mt-1 is_lunas_option">
                        <option value="all">--Semua--</option>
                        <option value="0">Menunggu</option>
                        <option value="1" selected>Lunas</option>
                        <option value="-1">Belum Lunas</option>
                    </select>
                </div>
                {{-- <div class="form-group mb-5 text-xs ml-3" style="max-width: 250px">
                    <label for="is_valid_option">Filter <strong>VAL.PENDAFTARAN</strong>:</label>
                    <select name="is_valid_option" id="is_valid_option" class="form-control mt-1 is_valid_option">
                        <option value="all" selected>--Semua--</option>
                        <option value="0">Menunggu</option>
                        <option value="1">Valid</option>
                        <option value="-1">Belum Valid</option>
                    </select>
                </div> --}}
                {{-- <div class="form-group mb-5 text-xs ml-3" style="max-width: 250px">
                    <label for="is_pernyataan_option">Filter <strong>VAL.PERYATAAN</strong>:</label>
                    <select name="is_pernyataan_option" id="is_pernyataan_option"
                        class="form-control mt-1 is_pernyataan_option">
                        <option value="all" selected>--Semua--</option>
                        <option value="0">Menunggu</option>
                        <option value="1">Valid</option>
                        <option value="-1">Belum Valid</option>
                    </select>
                </div> --}}
                <div>
                    <button
                        class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                        onclick="execFil()">
                        <i class="fa fa-search"></i> Tampilkan Data</button>
                </div>
                <div>
                    <button
                        class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                        onclick="exportToExcelCamaba()">
                        <i class="fa fa-search"></i> Export Camaba Lunas</button>
                    <input type="hidden" class="linkExportCamaba" id="linkExportCamaba" name="linkExportCamaba"
                        value="{{route('wave.validasi-pendaftaran-export-camaba')}}">
                </div>
            </div>
            <table id="validasi_pendaftaran" class="display validasi_pendaftaran" style="width:100%;">
                <thead style="font-size: 12px">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>TAHUN</th>
                        <th>PRODI1</th>
                        <th>DAFTAR</th>
                        <th>STATUS BIODATA</th>
                        <th>STATUS SELEKSI</th>
                        <th>UPDATED</th>
                        <th>NEO.IDMHS</th>
                        <th>ACT</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input type="hidden" id="val_pendaftaran_url" class="val_pendaftaran_url" name="val_pendaftaran_url"
                value="{{route('wave.validasi-pendaftaran-getlist')}}">
            <input type="hidden" id="insert_biodata_to_neo_url" class="insert_biodata_to_neo_url"
                name="insert_biodata_to_neo_url" value="{{route('wave.validasi-pendaftaran-insert-mhs')}}">

            {{-- @include('theme::bendahara.registrasi_awal.modal.edit') --}}
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

    var table = $('.validasi_pendaftaran').DataTable({
        pageLength : 10,
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#val_pendaftaran_url').val(),
            type:"POST",
            data:function(d){
                d._token = $('._token').data('token')
                d.is_lunas = $('#is_lunas_option option:selected').val()
                // d.is_valid = $('#is_valid_option option:selected').val()
                // d.is_pernyataan = $('#is_pernyataan_option option:selected').val()                
                d.is_prodi = $('#is_pil_prodi1_option option:selected').val()                
            }
        }, 
        createdRow: function(row, data, dataIndex, cells) {
            // console.log( data.FeederAKM );
            $(row).addClass('transparentClass') 
            $(cells[0]).addClass('text-center text-sm')
            $(cells[1]).addClass('text-sm')
            $(cells[2]).addClass('text-sm')
            $(cells[3]).addClass('text-sm')
            if(data['get_user_spmb_step'].step_2=="0"){
            $(cells[4]).addClass('text-sm gold text-center')        
            }else if(data['get_user_spmb_step'].step_2=="1"){
            $(cells[4]).addClass('text-sm greenYellow text-center')                        
            }else if(data['get_user_spmb_step'].step_2=="-1"){
            $(cells[4]).addClass('text-sm redHeart text-center')                        
            }
            
            $(cells[5]).addClass('text-sm text-center')                        
            $(cells[6]).addClass('text-center text-sm')
            $(cells[7]).addClass('text-center text-sm')
            if(data.cust_neo_id=="Registered"){
                $(cells[8]).addClass('text-center text-green-600 text-sm')
            }else if(data.cust_neo_id=="Unregistered"){
                $(cells[8]).addClass('text-center text-red-600 text-sm')            
            }
            $(cells[9]).addClass('text-center text-sm')
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'get_user.name', name: 'get_user.name'},
            {data: 'tahun_akademik_registrasi', name: 'tahun_akademik_registrasi'},
            {data: 'get_camaba_data_program_studi.get_prodi_fakultas1.nama_program_studi', name: 'get_camaba_data_program_studi.get_prodi_fakultas1.nama_program_studi'},
            {data: 'is_lunas', name: 'is_lunas'},
            {data: 'status_bio', name: 'status_bio'},
            {data: 'is_lulus_ujian', name: 'is_lulus_ujian'},
            {data: 'get_user_spmb_step.updated_at', name: 'get_user_spmb_step.updated_at'},
            {data: 'cust_neo_id', name:'cust_neo_id'},               
            {data: 'act', name:'act'},               
        ], 
    });

    function execFil() {    
        table.ajax.reload();
    }

    function insertBiodataMahasiswaToNeo(id,nama,tempat,tanggal){        
        const contents = `Anda akan menginput data calon mahasiswa ke neo-feeder berikut: <br> <strong>${nama} : ${tempat},${tanggal}</strong><br><input type="password" id="feeder_key" class="swal2-input rounded-md" placeholder="Feeder Key">`;          
        Swal.fire({
            title: 'Apakah anda yakin!',
            // text: teks,
            html: contents,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, input ke neo-feeder sekarang!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusConfirm: false,
            preConfirm: () => {
                const feeder_key = Swal.getPopup().querySelector('#feeder_key').value
                if (!feeder_key) {
                Swal.showValidationMessage(`Please enter feeder key`)
                }
                return { feeder_key: feeder_key }
            }
            }).then((result) => {
                if (result.isConfirmed) {  
                    goInsertBiodataMahasiswaToNeo(id,result.value.feeder_key);
                } 
        });
    }

    function goInsertBiodataMahasiswaToNeo(id,key) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['id']=id;
        datar['key']=key;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#insert_biodata_to_neo_url").val(),
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

    function exportToExcelCamaba(){
        let ta ='20231';
        window.open($('#linkExportCamaba').val()+`?ta_reg=${ta}`);
    }
</script>
@endsection