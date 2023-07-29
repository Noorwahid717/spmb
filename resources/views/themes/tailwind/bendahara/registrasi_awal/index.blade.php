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
                    Data Pembayaran Registrasi Awal Calon Mahasiswa
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Input Nilai Pembayaran Registrasi Awal dan verifikasi bukti pembayaran.
                </p>
            </div>

        </div>
        <div class="relative p-5">
            <div class="flex items-center">
                <div class="form-group mb-5 text-xs">
                    <label for="is_lunas_option">Filter Status Pembayaran:</label>
                    <select name="is_lunas_option" id="is_lunas_option" class="form-control mt-1 is_lunas_option">
                        <option value="all">--Semua--</option>
                        <option value="0" selected>Menunggu</option>
                        <option value="1">Lunas</option>
                        <option value="-1">Belum Lunas</option>
                    </select>
                </div>
                <div>
                    <button
                        class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                        onclick="execFil()">
                        <i class="fa fa-search"></i> Tampilkan Data</button>
                </div>
            </div>
            <table id="registrasi_awal" class="display registrasi_awal" style="width:100%;">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NO.WA</th>
                        <th>TAHUN</th>
                        <th>NOMINAL</th>
                        <th>TANGGAL BAYAR</th>
                        <th>STATUS BAYAR</th>
                        <th>SLIP</th>
                        <th>UPDATED</th>
                        <th>ACT</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input type="hidden" id="reg_awal_url" class="reg_awal_url" name="reg_awal_url"
                value="{{route('wave.registrasi-awal-getlist')}}">
            @include('theme::bendahara.registrasi_awal.modal.edit')

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

    var table = $('.registrasi_awal').DataTable({
        pageLength : 10,
        dom: 'lfrtip',        
        processing: true,
        serverSide: true,
        ordering: true,    
        "scrollX":true,
        rowId:  'id',
        ajax: {
            url:$('#reg_awal_url').val(),
            type:"POST",
            data:function(d){
                d._token = $('._token').data('token')
                d.is_lunas = $('#is_lunas_option option:selected').val()
            }
        }, 
        createdRow: function(row, data, dataIndex, cells) {
            // console.log( data.FeederAKM );
            $(row).addClass('transparentClass') 
            $(cells[0]).addClass('text-center text-sm')
            $(cells[1]).addClass('text-sm')
            $(cells[2]).addClass('text-sm')
            $(cells[3]).addClass('text-center text-sm')
            $(cells[4]).addClass('text-sm text-right')
            $(cells[5]).addClass('text-center text-sm')
            if(data['is_lunas']=="Menunggu"){
            $(cells[6]).addClass('text-sm gold text-center')        
            }else if(data['is_lunas']=="Lunas"){
            $(cells[6]).addClass('text-sm greenYellow text-center')                        
            }else if(data['is_lunas']=="Belum Lunas"){
            $(cells[6]).addClass('text-sm redHeart text-center')                        
            }
            $(cells[7]).addClass('text-center text-sm')        
            $(cells[8]).addClass('text-center text-sm')        
            $(cells[9]).addClass('text-center text-sm')        
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'get_user.name', name: 'get_user.name'},
            {data: 'get_user.no_hp_camaba', name: 'get_user.no_hp_camaba'},
            {data: 'tahun_akademik_registrasi', name: 'tahun_akademik_registrasi'},
            {data: 'nominal', name: 'nominal'},
            {data: 'tanggal_bayar', name: 'tanggal_bayar'},
            {data: 'is_lunas', name: 'is_lunas'},
            {data: 'slip', name: 'slip'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'act', name:'act'},               
        ], 
    });

    function execFil() {    
        table.ajax.reload();
    }

    function extm() {        
        var evt = new Event();
        var m = new Magnifier(evt);
        m.attach({thumb: '#thumb_slip',
        largeWrapper: 'preview_slip',
        zoomable:true,
        mode: 'inside',
        zoom: 3
        });
    }

    function modalClik(id,nama,no_wa,email,status,nominal,url_bukti_bayar,tgl_bayar,keterangan,tahun_akademik_registrasi){    
        $("#thumb_slip").attr("src","");
        $("#thumb_slip-large").remove();
        $("#thumb_slip-lens").remove();

        // var modal = $(this)
        $('#nominal_view').text("");
        $('#id_user').val();        
        $('#nama').val();
        $('#email').val();
        $('#no_wa').val();
        $('#nominal').val();
        $("#status_bayar").val();
        $("#tglbyr").val();
        $("#keterangan").val();
        $("#ta_registrasi").val();
        $("#link_wa").attr('href','#');
        
        var element = document.getElementById("img-prev_slip");
        element.classList.remove("d-none");        
        if (url_bukti_bayar==""){
            element.classList.add("d-none");
        }else{
            var url = '{{ asset("")}}'+"storage/"+url_bukti_bayar;
            $('#thumb_slip').attr('src', url);
            $('#thumb_slip').attr('data-large-img-url', url);
            extm();
        }

        $('#id_user').val(id);        
        $('#nama').val(nama);
        $('#email').val(email);
        $('#no_wa').val(no_wa);
        $('#nominal').val(nominal);
        $("#status_bayar").val(status);
        $("#tglbyr").val(tgl_bayar);
        $("#link_wa").attr("href", "https://wa.me/"+no_wa);  
        $("#keterangan").val(keterangan);
        $("#ta_registrasi").val(tahun_akademik_registrasi);
        
        $('#nominal').val(nominal)
        if(isNaN(parseInt(nominal))){
            $('#nominal_view').text();
        }else{
            $('#nominal_view').text("Rp. "+new Intl.NumberFormat(['ban', 'id']).format(parseInt(nominal)));
        }

        $('#resetberkas').attr('onClick','resetBerkas("'+url_bukti_bayar+'")');
        
    }

    // Restricts input for the given textbox to the given inputFilter function.
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
            });
        });        
    }

    setInputFilter(document.getElementById("nominal"), function(value) {
        return  /^\d*$/.test(value) && (value === "" || parseInt(value) > 0);
    });

    function nominal_view() {      
        var x = document.getElementById("nominal").value;   
        if(isNaN(parseInt(x))){
            $('#nominal_view').text("");
        }else{
            $('#nominal_view').text("Rp. "+new Intl.NumberFormat(['ban', 'id']).format(parseInt(x)));
        }
    }

    function editValidasiPembayaran() {
        var id_user = $('#id_user').val();
        var nominal = $('#nominal').val();
        var tanggal_bayar = $('#tglbyr').val();
        var status_bayar = $('#status_bayar option:selected').val();
        var keterangan = $("#keterangan").val();   
        var ta_registrasi = $("#ta_registrasi").val();   
        let bukti_bayar = $('input[id=bukti_bayar]').val();
        let real_image_foto = $('input[id=img-value_slip]').val();

        if(calc_image_size(real_image_foto)<=3000){                        
        if(nominal>0){
            if(tanggal_bayar!=""){
                if(status_bayar!=-2){
                    updateValidasiPembayaran(id_user,nominal,tanggal_bayar,status_bayar,keterangan,ta_registrasi,real_image_foto,bukti_bayar);                    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Pilih status bayar dahulu!",
                    });
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Pilih tanggal bayar dahulu!",
                });
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Nominal tidak boleh kosong!",
                });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran bukti pembayaran melebihi 3 MB!!",
            });
        }
    }

    function updateValidasiPembayaran(
        id_user,nominal,tanggal_bayar,status_bayar,keterangan,ta_registrasi,
        real_image_foto,bukti_bayar) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['id_user']=id_user;
        datar['nominal']=nominal;
        datar['tanggal_bayar']=tanggal_bayar;        
        datar['status_bayar']=status_bayar;
        datar['keterangan']=keterangan;
        datar['ta_registrasi']=ta_registrasi;
        datar['url_bukti_bayar']=real_image_foto;
        datar['bukti_bayar']=bukti_bayar;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#updateRegAwalUrl").val(),
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

    var evt = new Event();
    function readFileKK() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                $("#thumb_slip").attr("src",e.target.result);
                $("#thumb_slip").attr("data-large-img-url",e.target.result);
                document.getElementById("img-value_slip").value = e.target.result;
                $("#thumb_slip-large").remove();
                $("#thumb_slip-lens").remove();
                var m = new Magnifier(evt);
                m.attach({thumb: '#thumb_slip',
                large: e.target.result,
                largeWrapper: 'preview_slip',
                zoomable:true,
                mode:'inside',
                zoom: 3
                });
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("bukti_bayar").addEventListener("change", readFileKK);

    function resetBerkas(url_bukti_bayar){
        $('input[id=bukti_bayar]').val("");
        $('input[id=img-value_slip]').val("");
        $("#thumb_slip").attr("src","");
        $("#thumb_slip-large").remove();
        $("#thumb_slip-lens").remove();
        var element = document.getElementById("img-prev_slip");
        element.classList.remove("d-none");        
        if (url_bukti_bayar==""){
            element.classList.add("d-none");
        }else{
            var url = '{{ asset("")}}'+"storage/"+url_bukti_bayar;
            $('#thumb_slip').attr('src', url);
            $('#thumb_slip').attr('data-large-img-url', url);
            extm();
        }
    }

    function calc_image_size(image) {
        let y =1;
        if(image.endsWith('==')){
            y = 2
        }
        const x_size = (image.length * (3/4)) - y
        return Math.round(x_size / 1024)
    }
</script>
@endsection