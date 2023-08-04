<!-- Modal HTML embedded directly into document -->
<div id="addExamConvertionResultModal" class="modal">
    <h3 class="text-lg font-semibold leading-6 text-gray-700 my-3">
        Tambah Data Konversi Nilai Potensi Akademik
    </h3>
    <hr>
    <div class="my-3">
        <div>
            <div class="form-group mb-5 text-xs">
                <label for="range_nilai_awal">Range Nilai Awal <span class="text-red">*</span></label>
                <input type="number" class="form-control mt-1" name="range_nilai_awal" id="range_nilai_awal" max="100"
                    min="0">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="range_nilai_akhir">Range Nilai Akhir <span class="text-red">*</span></label>
                <input type="number" class="form-control mt-1" name="range_nilai_akhir" id="range_nilai_akhir" max="100"
                    min="0">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="status">Status <span class="text-red">*</span></label>
                <select class="status form-control mt-1" name="status" id="status">
                    <option value="-2" selected>--Pilih Status--</option>
                    <option value="-1">Tidak Lulus</option>
                    <option value="1">Lulus</option>
                </select>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="keterangan">Keterangan <span class="text-red">*</span></label>
                <textarea class="form-control mt-1" name="keterangan" id="keterangan" cols="30" rows="2"
                    placeholder="Keterangan"></textarea>
            </div>
        </div>
        <input type="hidden" id="addExamConvertionResultUrl" name="addExamConvertionResultUrl"
            value="{{route('wave.exam-convertion-result-add')}}">
        <div class="my-2">
            <a href="#" rel="modal:close" id="close_modal"
                class="inline-flex self-start items-center px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                Batal
            </a>
            <button onclick="addExamConvertionResult()"
                class="inline-flex self-start items-center px-3 py-2 bg-wave-400 hover:bg-wave-600 text-white text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.064,4.656l-2.05-2.035C14.936,2.544,14.831,2.5,14.721,2.5H3.854c-0.229,0-0.417,0.188-0.417,0.417v14.167c0,0.229,0.188,0.417,0.417,0.417h12.917c0.229,0,0.416-0.188,0.416-0.417V4.952C17.188,4.84,17.144,4.733,17.064,4.656M6.354,3.333h7.917V10H6.354V3.333z M16.354,16.667H4.271V3.333h1.25v7.083c0,0.229,0.188,0.417,0.417,0.417h8.75c0.229,0,0.416-0.188,0.416-0.417V3.886l1.25,1.239V16.667z M13.402,4.688v3.958c0,0.229-0.186,0.417-0.417,0.417c-0.229,0-0.417-0.188-0.417-0.417V4.688c0-0.229,0.188-0.417,0.417-0.417C13.217,4.271,13.402,4.458,13.402,4.688" />
                </svg>
                Simpan
            </button>
        </div>
    </div>
</div>