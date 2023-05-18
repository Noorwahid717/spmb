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
                    Data Registrasi Ulang Mahasiswa Baru
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Input Nomer Briva, Nominal Pembayaran Registrasi Ulang dan verifikasi bukti pembayaran.
                </p>
            </div>

        </div>
        <div class="relative p-5">
            {{-- <div class="flex items-center">
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
            </div> --}}
            {{-- <table id="registrasi_awal" class="display registrasi_awal" style="width:100%;">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NO.WA</th>
                        <th>TAHUN</th>
                        <th>NOMINAL</th>
                        <th>TANGGAL BAYAR</th>
                        <th>STATUS BAYAR</th>
                        <th>UPDATED</th>
                        <th>ACT</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table> --}}
            {{-- <input type="hidden" id="reg_awal_url" class="reg_awal_url" name="reg_awal_url"
                value="{{route('wave.registrasi-awal-getlist')}}">
            @include('theme::bendahara.registrasi_awal.modal.edit') --}}
        </div>
    </div>
</div>
@endsection