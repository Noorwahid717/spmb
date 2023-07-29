<!-- Modal HTML embedded directly into document -->
<div id="detailBankSoalModal" class="modal">
    <h3 class="text-lg font-semibold leading-6 text-gray-700 my-3">
        Detail Data Soal
    </h3>
    <hr>
    <div class="my-3">
        <div>
            <div class="form-group mb-5 text-xs">
                <label for="detail_soal_prodi_option">Program Studi</label>
                <select name="detail_soal_prodi_option" id="detail_soal_prodi_option"
                    class="form-control mt-1 detail_soal_prodi_option read_only" disabled>
                    <option value="-1">--Pilih Program Studi--</option>
                    @foreach ($prodi as $item)
                    <option value="{{$item->id_prodi}}">{{$item->nama_program_studi}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-5 text-xs">
                <label for="detail_deskripsi_pertanyaan">Deskripsi Pertanyaan <span class="text-red">*</span></label>
                <textarea class="form-control mt-1 read_only" name="detail_deskripsi_pertanyaan"
                    id="detail_deskripsi_pertanyaan" cols="30" rows="2" placeholder="Deskripsi Pertanyaan"
                    readonly></textarea>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="detail_kunci_jawaban">Kunci Jawaban <span class="text-red">*</span></label>
                <input type="text" name="detail_kunci_jawaban" id="detail_kunci_jawaban"
                    class="form-control mt-1 read_only" value="" placeholder="Kunci Jawaban" readonly>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="detail_jawaban_pelengkap_1">Opsi Jawaban Lain (1) <span class="text-red">*</span></label>
                <input type="text" name="detail_jawaban_pelengkap_1" id="detail_jawaban_pelengkap_1"
                    class="form-control mt-1 read_only" value="" placeholder="Opsi Jawaban Lain (1)" readonly>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="detail_jawaban_pelengkap_2">Opsi Jawaban Lain (2) <span class="text-red">*</span></label>
                <input type="text" name="detail_jawaban_pelengkap_2" id="detail_jawaban_pelengkap_2"
                    class="form-control mt-1 read_only" value="" placeholder="Opsi Jawaban Lain (2)" readonly>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="detail_jawaban_pelengkap_3">Opsi Jawaban Lain (3) <span class="text-red">*</span></label>
                <input type="text" name="detail_jawaban_pelengkap_3" id="detail_jawaban_pelengkap_3"
                    class="form-control mt-1 read_only" value="" placeholder="Opsi Jawaban Lain (3)" readonly>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="detail_jawaban_pelengkap_4">Opsi Jawaban Lain (4) <span class="text-red">*</span></label>
                <input type="text" name="detail_jawaban_pelengkap_4" id="detail_jawaban_pelengkap_4"
                    class="form-control mt-1 read_only" value="" placeholder="Opsi Jawaban Lain (4)" readonly>
            </div>
            <div class="form-group mb-5 text-xs mb-4">
                <label for="detail_nilai_poin_pengali">Nilai Poin Pengali <span class="text-red">*</span></label>
                <input type="number" min="1" name="detail_nilai_poin_pengali" id="detail_nilai_poin_pengali"
                    class="form-control mt-1 read_only" value="" placeholder="Nilai Poin Pengali" readonly>
            </div>
            <div class="form-group mb-5 text-xs mb-4">
                <label for="detail_status_soal">Status Soal</label>
                <select name="detail_status_soal" id="detail_status_soal" class="form-control mt-1 read_only" disabled>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="my-2">
            <a href="#" rel="modal:close" id="close_modal"
                class="inline-flex self-start items-center px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                Keluar
            </a>
        </div>
    </div>
</div>