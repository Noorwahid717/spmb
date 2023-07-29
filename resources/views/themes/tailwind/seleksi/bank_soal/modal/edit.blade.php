<!-- Modal HTML embedded directly into document -->
<div id="editBankSoalModal" class="modal">
    <h3 class="text-lg font-semibold leading-6 text-gray-700 my-3">
        Edit Data Soal
    </h3>
    <hr>
    <div class="my-3">
        <div>
            <input type="hidden" name="edit_soal_prodi_id" id="edit_soal_prodi_id">
            <div class="form-group mb-5 text-xs">
                <label for="edit_soal_prodi_option">Program Studi</label>
                <select name="edit_soal_prodi_option" id="edit_soal_prodi_option"
                    class="form-control mt-1 edit_soal_prodi_option">
                    <option value="-1">--Pilih Program Studi--</option>
                    @foreach ($prodi as $item)
                    <option value="{{$item->id_prodi}}">{{$item->nama_program_studi}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-5 text-xs">
                <label for="edit_deskripsi_pertanyaan">Deskripsi Pertanyaan <span class="text-red">*</span></label>
                <textarea class="form-control mt-1" name="edit_deskripsi_pertanyaan" id="edit_deskripsi_pertanyaan"
                    cols="30" rows="2" placeholder="Deskripsi Pertanyaan"></textarea>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="edit_kunci_jawaban">Kunci Jawaban <span class="text-red">*</span></label>
                <input type="text" name="edit_kunci_jawaban" id="edit_kunci_jawaban" class="form-control mt-1" value=""
                    placeholder="Kunci Jawaban">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="edit_jawaban_pelengkap_1">Opsi Jawaban Lain (1) <span class="text-red">*</span></label>
                <input type="text" name="edit_jawaban_pelengkap_1" id="edit_jawaban_pelengkap_1"
                    class="form-control mt-1" value="" placeholder="Opsi Jawaban Lain (1)">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="edit_jawaban_pelengkap_2">Opsi Jawaban Lain (2) <span class="text-red">*</span></label>
                <input type="text" name="edit_jawaban_pelengkap_2" id="edit_jawaban_pelengkap_2"
                    class="form-control mt-1" value="" placeholder="Opsi Jawaban Lain (2)">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="edit_jawaban_pelengkap_3">Opsi Jawaban Lain (3) <span class="text-red">*</span></label>
                <input type="text" name="edit_jawaban_pelengkap_3" id="edit_jawaban_pelengkap_3"
                    class="form-control mt-1" value="" placeholder="Opsi Jawaban Lain (3)">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="edit_jawaban_pelengkap_4">Opsi Jawaban Lain (4) <span class="text-red">*</span></label>
                <input type="text" name="edit_jawaban_pelengkap_4" id="edit_jawaban_pelengkap_4"
                    class="form-control mt-1" value="" placeholder="Opsi Jawaban Lain (4)">
            </div>
            <div class="form-group mb-5 text-xs mb-4">
                <label for="edit_nilai_poin_pengali">Nilai Poin Pengali <span class="text-red">*</span></label>
                <input type="number" min="1" name="edit_nilai_poin_pengali" id="edit_nilai_poin_pengali"
                    class="form-control mt-1" value="" placeholder="Nilai Poin Pengali">
            </div>
            <div class="form-group mb-5 text-xs mb-4">
                <label for="edit_status_soal">Status Soal</label>
                <select name="edit_status_soal" id="edit_status_soal" class="form-control mt-1">
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <input type="hidden" id="editBankSoalUrl" name="editBankSoalUrl" value="{{route('wave.bank-soal-edit')}}">
        <div class="my-2">
            <a href="#" rel="modal:close" id="close_modal"
                class="inline-flex self-start items-center px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                Batal
            </a>
            <button onclick="editBankSoal()"
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