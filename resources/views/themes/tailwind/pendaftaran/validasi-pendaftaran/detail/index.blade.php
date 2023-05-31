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

                <div class="form-group mb-5 text-xs">
                    <label for="is_valid_option">Filter Status Validitas Data Keseluruhan:</label>
                    <select name="is_valid_option" id="is_valid_option" class="form-control mt-1 is_valid_option">
                        <option value="all">--Semua--</option>
                        <option value="0" selected>Menunggu</option>
                        <option value="1">Valid</option>
                        <option value="-1">Belum Valid</option>
                    </select>
                </div>
                <div class="form-group mb-5 text-xs ml-3">
                    <label for="is_lunas_option">Filter Status Pembayaran:</label>
                    <select name="is_lunas_option" id="is_lunas_option" class="form-control mt-1 is_lunas_option">
                        <option value="all">--Semua--</option>
                        <option value="0">Menunggu</option>
                        <option value="1" selected>Lunas</option>
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
            {{-- <input type="hidden" id="val_pendaftaran_url" class="val_pendaftaran_url" name="val_pendaftaran_url"
                value="{{route('wave.validasi-pendaftaran-getlist')}}"> --}}
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

</script>
@endsection