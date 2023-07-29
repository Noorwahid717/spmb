<!-- Modal HTML embedded directly into document -->
<div id="editPenjadwalanUjianModal" class="modal">
    <h3 class="text-lg font-semibold leading-6 text-gray-700 my-3">
        Edit Data Penjadwalan Ujian
    </h3>
    <hr>
    <div class="my-3">
        <div>
            <input type="hidden" name="edit_id_penjadwalan_ujian" id="edit_id_penjadwalan_ujian"
                class="edit_id_penjadwalan_ujian">
            <div class="form-group mb-5 text-xs">
                <label for="edit_periode_akademik">Periode Akademik <span class="text-red">*</span></label>
                <select name="edit_periode_akademik" id="edit_periode_akademik"
                    class="form-control mt-1 edit_periode_akademik">
                    <option value="-1" selected>--Pilih Periode Akademik--</option>
                    @foreach ($periode as $item)
                    <option value="{{$item->id_semester}}">{{$item->nama_semester}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="edit_keterangan">Keterangan <span class="text-red">*</span></label>
                <input type="text" name="edit_keterangan" id="edit_keterangan" class="form-control mt-1" value=""
                    placeholder="Keterangan">
                <input type="hidden" name="old_keterangan" id="old_keterangan" class="old_keterangan">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="edit_tanggal_mulai">Tanggal Mulai <span class="text-red">*</span></label>
                <input type="date" name="edit_tanggal_mulai" id="edit_tanggal_mulai" class="form-control mt-1" value=""
                    placeholder="Tanggal Mulai">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="edit_tanggal_selesai">Tanggal Selesai <span class="text-red">*</span></label>
                <input type="date" name="edit_tanggal_selesai" id="edit_tanggal_selesai" class="form-control mt-1"
                    value="" placeholder="Tanggal Selesai">
            </div>
        </div>
        <input type="hidden" id="editPenjadwalanUjianUrl" name="editPenjadwalanUjianUrl"
            value="{{route('wave.penjadwalan-ujian-edit')}}">
        <div class="my-2">
            <a href="#" rel="modal:close" id="close_modal"
                class="inline-flex self-start items-center px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                Batal
            </a>
            <button onclick="editPenjadwalanUjian()"
                class="inline-flex self-start items-center px-3 py-2 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.064,4.656l-2.05-2.035C14.936,2.544,14.831,2.5,14.721,2.5H3.854c-0.229,0-0.417,0.188-0.417,0.417v14.167c0,0.229,0.188,0.417,0.417,0.417h12.917c0.229,0,0.416-0.188,0.416-0.417V4.952C17.188,4.84,17.144,4.733,17.064,4.656M6.354,3.333h7.917V10H6.354V3.333z M16.354,16.667H4.271V3.333h1.25v7.083c0,0.229,0.188,0.417,0.417,0.417h8.75c0.229,0,0.416-0.188,0.416-0.417V3.886l1.25,1.239V16.667z M13.402,4.688v3.958c0,0.229-0.186,0.417-0.417,0.417c-0.229,0-0.417-0.188-0.417-0.417V4.688c0-0.229,0.188-0.417,0.417-0.417C13.217,4.271,13.402,4.458,13.402,4.688" />
                </svg>
                Update
            </button>
        </div>
    </div>
</div>