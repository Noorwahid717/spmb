<div class="flex flex-col px-3 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 mb-5 xl:px-5 md:px-2 overflow-hidden bg-white">
        <div class="form-group mb-5 text-xs">
            <label for="alumni_smawa">Alumni SMA Wahidiyah Daerah/Pusat? <span class="text-red">*</span></label>
            <select name="alumni_smawa" id="alumni_smawa" class="form-control mt-1">
                <option value="-1" selected>--Pilih Jawaban--</option>
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>
        <div class="form-group mb-5 text-xs">
            <label for="pendidikan_asal">Pendidikan Asal <span class="text-red">*</span></label>
            <select name="pendidikan_asal" id="pendidikan_asal" class="form-control mt-1">
                <option value="-1" selected>--Pilih Jawaban--</option>
                <option value="sma">SMA</option>
                <option value="smk">SMK</option>
                <option value="ma">MA</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
        <div class="form-group mb-5 text-xs">
            <label for="jenis_pendidikan_asal">Jenis Pendidikan Asal <span class="text-red">*</span></label>
            <select name="jenis_pendidikan_asal" id="jenis_pendidikan_asal" class="form-control mt-1">
                <option value="-1" selected>--Pilih Jawaban--</option>
                <option value="negeri">Negeri</option>
                <option value="swasta">Swasta</option>
            </select>
        </div>
    </div>
    <div class="flex flex-col justify-start flex-1 mb-5 xl:px-5 md:px-2 overflow-hidden bg-white">
        <div class="form-group mb-5 text-xs">
            <label for="nama_pendidikan_asal">Nama Pendidikan Asal <span class="text-red">*</span></label>
            <input type="text" name="nama_pendidikan_asal" id="nama_pendidikan_asal" class="form-control mt-1" value=""
                placeholder="Nama Pendidikan Asal">
        </div>
        <div class="form-group mb-5 text-xs">
            <label for="nisn">NISN <span class="text-red">*</span></label>
            <input type="text" name="nisn" id="nisn" class="form-control mt-1" value="" maxlength="10"
                placeholder="NISN">
        </div>
        <div class="form-group mb-5 text-xs">
            <label for="alamat_pendidikan_asal">Alamat Sekolah Asal <span class="text-red">*</span></label>
            <input type="text" name="alamat_pendidikan_asal" id="alamat_pendidikan_asal" class="form-control mt-1"
                value="" placeholder="Alamat Sekolah Asal">
        </div>
    </div>
</div>
<input type="hidden" name="saveOrUpdateUrlStep5" id="saveOrUpdateUrlStep5"
    value="{{route('wave.biodata-update-data-riwayat-pendidikan')}}">

{{-- button nav --}}
@if($step_5!=null&&$step_5->status_step==1)
<div class="note-success my-5 py-5">
    <img src="{{ asset('/themes/tailwind/images/lock-check.png') }}" class="w-20 rounded sm:mx-auto">
    <strong>
        DATA TELAH DIVALIDASI ADMIN PENDAFTARAN
    </strong>
</div>
@else
@if($step_5!=null&&$step_5->note!=null&&$step_5->note!="")
<div class="note-error mb-5 py-2">
    <strong>
        DATA/DOKUMEN BELUM VALID !!!
    </strong>
    <p>{{$step_5->note}}</p>
</div>
@elseif($step_5!=null&&$step_5->note==null&&$step_5->note=="")
<div class="note-error mb-5 py-2">
    <strong>
        MENUNGGU VALIDASI DATA/DOKUMEN OLEH ADMIN PENDAFTARAN !!!
    </strong>
</div>
@endif
<div id="button_manipulation_step_5">
    @if($step_5==null)
    <div style="display:flex; align-items:center; justify-content:center" id="save_step_5">
        <button onclick="ValidateStep5()"
            class="inline-flex self-start items-center px-4 py-2 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.064,4.656l-2.05-2.035C14.936,2.544,14.831,2.5,14.721,2.5H3.854c-0.229,0-0.417,0.188-0.417,0.417v14.167c0,0.229,0.188,0.417,0.417,0.417h12.917c0.229,0,0.416-0.188,0.416-0.417V4.952C17.188,4.84,17.144,4.733,17.064,4.656M6.354,3.333h7.917V10H6.354V3.333z M16.354,16.667H4.271V3.333h1.25v7.083c0,0.229,0.188,0.417,0.417,0.417h8.75c0.229,0,0.416-0.188,0.416-0.417V3.886l1.25,1.239V16.667z M13.402,4.688v3.958c0,0.229-0.186,0.417-0.417,0.417c-0.229,0-0.417-0.188-0.417-0.417V4.688c0-0.229,0.188-0.417,0.417-0.417C13.217,4.271,13.402,4.458,13.402,4.688" />
            </svg>
            Simpan
        </button>
    </div>
    @else
    <div style="align-items:center; justify-content:center" class="flex" id="edit_step_5">
        <button
            class="inline-flex self-start items-center px-4 py-2 bg-gray-400 hover:bg-gray-600 text-white text-sm font-medium rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon>
                <line x1="3" y1="22" x2="21" y2="22"></line>
            </svg>
            &nbsp;Edit
        </button>
    </div>
    @endif
    <div style="align-items:center; justify-content:center" class="flex" id="update_step_5">
        <button onclick="batalUpdateStep5()"
            class="inline-flex self-start items-center px-4 py-2 bg-gray-400 hover:bg-gray-600 text-white text-sm font-medium rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            &nbsp;Batal
        </button>
        <button onclick="ValidateStep5()"
            class="ml-3 inline-flex self-start items-center px-4 py-2 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.064,4.656l-2.05-2.035C14.936,2.544,14.831,2.5,14.721,2.5H3.854c-0.229,0-0.417,0.188-0.417,0.417v14.167c0,0.229,0.188,0.417,0.417,0.417h12.917c0.229,0,0.416-0.188,0.416-0.417V4.952C17.188,4.84,17.144,4.733,17.064,4.656M6.354,3.333h7.917V10H6.354V3.333z M16.354,16.667H4.271V3.333h1.25v7.083c0,0.229,0.188,0.417,0.417,0.417h8.75c0.229,0,0.416-0.188,0.416-0.417V3.886l1.25,1.239V16.667z M13.402,4.688v3.958c0,0.229-0.186,0.417-0.417,0.417c-0.229,0-0.417-0.188-0.417-0.417V4.688c0-0.229,0.188-0.417,0.417-0.417C13.217,4.271,13.402,4.458,13.402,4.688" />
            </svg>
            &nbsp;Update
        </button>
    </div>
</div>
@endif
<div class="flex flex-col px-3 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
        <button onclick="document.getElementById('tablinks4').click()"
            class="inline-flex xl:self-start self-center items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0
                L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109
                c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483
                c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788
                S18.707,9.212,18.271,9.212z" />
            </svg>
            Back
        </button>
    </div>
    <div class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
        <button disabled>Step 5 of 8</button>
    </div>
    <div class="flex flex-col justify-start flex-1 mb-5 px-5 overflow-hidden bg-white">
        <button onclick="document.getElementById('tablinks6').click()"
            class="inline-flex xl:self-end self-center items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
            Next &nbsp;
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.729,9.212h14.656l-4.184-4.184c-0.307-0.306-0.307-0.801,0-1.107c0.305-0.306,0.801-0.306,1.106,0
                l5.481,5.482c0.018,0.014,0.037,0.019,0.053,0.034c0.181,0.181,0.242,0.425,0.209,0.66c-0.004,0.038-0.012,0.071-0.021,0.109
                c-0.028,0.098-0.075,0.188-0.143,0.271c-0.021,0.026-0.021,0.061-0.045,0.085c-0.015,0.016-0.034,0.02-0.051,0.033l-5.483,5.483
                c-0.306,0.307-0.802,0.307-1.106,0c-0.307-0.305-0.307-0.801,0-1.105l4.184-4.185H1.729c-0.436,0-0.788-0.353-0.788-0.788
                S1.293,9.212,1.729,9.212z" />
            </svg>
        </button>
    </div>
</div>