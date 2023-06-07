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
                    Biaya Formulir Pendaftaran
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Info update terkait status pembayaran biaya formulir pendaftaran.
                </p>
            </div>
        </div>
        <div class="relative p-5">
            <div>
                <div class="form-group mb-5 text-xs">
                    <label for="nama">Bukti Pembayaran</label>
                    <div id="img-prev_slip" class="mt-1">
                        <div class="mb-3 px-2 py-2 d-flex justify-center border rounded"
                            style="border: 1px solid #ff008f !important;">
                            <a class="magnifier-thumb-wrapper">
                                <img id="thumb_slip" src="" data-large-img-url="" data-large-img-wrapper="preview_slip"
                                    style="max-width:100%">
                            </a>
                        </div>
                    </div>
                </div>
                @if($reg_awal->is_lunas!=1)
                <div class="flex">
                    <div class="form-group mb-5 text-xs">
                        <label for="bukti_bayar">Upload Bukti Pembayaran (maks. ukuran 3 MB)</label>
                        <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control mt-1" value=""
                            accept="image/*">
                        <input type="hidden" name="realimage_slip" id="img-value_slip">

                    </div>
                    <a href="#"
                        class="inline-flex self-center items-center ml-3 px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md"
                        onclick="reloadPage()">
                        Batal
                    </a>
                    <button onclick="updateBuktiBayar()"
                        class="inline-flex self-center items-center ml-3 px-3 py-2 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.064,4.656l-2.05-2.035C14.936,2.544,14.831,2.5,14.721,2.5H3.854c-0.229,0-0.417,0.188-0.417,0.417v14.167c0,0.229,0.188,0.417,0.417,0.417h12.917c0.229,0,0.416-0.188,0.416-0.417V4.952C17.188,4.84,17.144,4.733,17.064,4.656M6.354,3.333h7.917V10H6.354V3.333z M16.354,16.667H4.271V3.333h1.25v7.083c0,0.229,0.188,0.417,0.417,0.417h8.75c0.229,0,0.416-0.188,0.416-0.417V3.886l1.25,1.239V16.667z M13.402,4.688v3.958c0,0.229-0.186,0.417-0.417,0.417c-0.229,0-0.417-0.188-0.417-0.417V4.688c0-0.229,0.188-0.417,0.417-0.417C13.217,4.271,13.402,4.458,13.402,4.688" />
                        </svg>
                        Simpan
                    </button>
                </div>
                @endif
                <input type="hidden" name="id_user" value="{{$reg_awal->id_user}}" id="id_user" class="id_user">
                <input type="hidden" name="ta_registrasi" value="{{$reg_awal->tahun_akademik_registrasi}}"
                    id="ta_registrasi" class="ta_registrasi">
                <div class="form-group mb-5 text-xs">
                    <label for="nominal">Nominal</label>
                    <input type="text" name="nominal" id="nominal" class="form-control mt-1 read_only"
                        value="{{$reg_awal->nominal}}" placeholder="Nominal" oninput="nominal_view()" readonly>
                    <strong>
                        <span class="text-wave-600 m-1" style="float: right" id="nominal_view"></span>
                    </strong>
                </div>
                <div class="form-group mb-5 text-xs">
                    <label for="tglbyr">Tanggal Bayar</label>
                    <input type="date" name="tglbyr" id="tglbyr" class="form-control mt-1 read_only"
                        value="{{$reg_awal->tanggal_bayar}}" placeholder="Tanggal Bayar" readonly>
                </div>
                <div class="form-group mb-5 text-xs mb-4">
                    <label for="status_bayar">Status Bayar</label>
                    <select name="status_bayar" id="status_bayar" class="form-control mt-1" disabled
                        style="{{$reg_awal->is_lunas==1?'background:green;':($reg_awal->is_lunas==0?'background:lightgrey;':'background:red;')}}">
                        <option value="-2">--Pilih Status--</option>
                        <option value="-1">Belum Lunas</option>
                        <option value="0">Menunggu</option>
                        <option value="1">Lunas</option>
                    </select>
                </div>
                <div class="form-group mb-5 text-xs mb-4">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control mt-1 read_only" name="keterangan" id="keterangan" cols="30" rows="1"
                        placeholder="Keterangan terkait status pembayaran" readonly>{{$reg_awal->keterangan}}</textarea>
                </div>
            </div>
        </div>
    </div>


    {{-- PENDAFTARAN ULANG --}}
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{ asset('/themes/tailwind/images/biodata.png') }}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Biaya Pendaftaran Ulang
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Info update terkait status pembayaran biaya pendaftaran ulang.
                </p>
            </div>
            <input type="hidden" name="updatebuktibayarurl" id="updatebuktibayarurl"
                value="{{route('wave.tagihan-camaba-update-slip-pendaftaran')}}">
        </div>
        <div class="relative p-5">
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
        $("#thumb_slip").attr("src","");
        $("#thumb_slip-large").remove();
        $("#thumb_slip-lens").remove();
        let reg_awal =@json($reg_awal);
        var element = document.getElementById("img-prev_slip");
        element.classList.remove("d-none");        
        if (reg_awal['url_bukti_bayar']==""){
            element.classList.add("d-none");
        }else{
            var url = '{{ asset("")}}'+"storage/"+reg_awal['url_bukti_bayar'];
            $('#thumb_slip').attr('src', url);
            $('#thumb_slip').attr('data-large-img-url', url);
            extm();
        }

        let nominal = reg_awal['nominal'];
        $('#nominal').val(nominal)
        if(isNaN(parseInt(nominal))){
            $('#nominal_view').text();
        }else{
            $('#nominal_view').text("Rp. "+new Intl.NumberFormat(['ban', 'id']).format(parseInt(nominal)));
        }

        let status = reg_awal['is_lunas'];
        $('#status_bayar').val(status)
    } );
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
    function updateBuktiBayar() {
        let bukti_bayar = $('input[id=bukti_bayar]').val();
        let id_user = $('input[id=id_user]').val();
        let ta_registrasi = $('#ta_registrasi').val();
        let real_image_foto = $('input[id=img-value_slip]').val();
        if(bukti_bayar==""){
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Pilih bukti pembayaran dahulu!",
                    });
        }else{
            if(calc_image_size(real_image_foto)<=3000){                        
                Swal.fire({
                    title: 'Are you sure!',
                    text: "Anda akan mengupload bukti pembayaran!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan sekarang!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {       
                        // console.log(selected);         
                        UploadBuktiBayar(id_user,real_image_foto,ta_registrasi,bukti_bayar.files);
                    } 
                }); 
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Ukuran bukti pembayaran melebihi 3 MB!",
                });
            }
        }
    }

    function UploadBuktiBayar(id_user,real_image_foto,ta_registrasi,bukti_bayar) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['id_user']=id_user;
        datar['url_bukti_bayar']=real_image_foto;
        datar['ta_registrasi']=ta_registrasi;
        datar['bukti_bayar']=bukti_bayar;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#updatebuktibayarurl").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    location.reload(); 
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

    function reloadPage() {
        $('#bukti_bayar').val('');
        location.reload();
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