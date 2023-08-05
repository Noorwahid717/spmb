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
                    Pengujian Calon Mahasiswa Baru
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Tahun Akademik
                </p>
            </div>
            {{-- <a
                class="inline-flex self-start items-center ml-3 px-4 py-3 bg-yellow-400 hover:bg-yellow-600 text-dark text-sm font-medium rounded-md"
                href="{{route('wave.penjadwalan-ujian')}}">
                <img src="{{asset('/themes/tailwind/images/rewind.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Kembali</a>
            <a class="inline-flex self-start items-center ml-3 px-4 py-3 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md"
                data-modal="#addExamInterviewModal" rel="modal:open" href="#addExamInterviewModal"
                onclick="modalAddClick()">
                <img src="{{asset('/themes/tailwind/images/add.png')}}" class="w-6 rounded sm:mx-auto">
                &nbsp;Tambah Data</a> --}}
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
            <table id="exam_interview" class="display exam_interview" style="width:100%;">
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
            {{-- <input type="hidden" id="exam_interview_url" class="exam_interview_url" name="exam_interview_url"
                value="{{route('wave.exam-interview-getlist')}}"> --}}
            {{-- <input type="hidden" id="detele_exam_interview_url" class="detele_exam_interview_url"
                name="detele_exam_interview_url" value="{{route('wave.exam-interview-delete')}}"> --}}
            {{-- @include('theme::seleksi.exam_interview.modal.add') --}}
            {{-- @include('theme::seleksi.exam_interview.modal.edit') --}}
            {{-- @include('theme::seleksi.exam_interview.modal.detail-mhs') --}}
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
    <script>
@endsection