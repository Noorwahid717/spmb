<!-- Modal HTML embedded directly into document -->
<div id="addDaftarPengujiModal" class="modal">
    <h3 class="text-lg font-semibold leading-6 text-gray-700 my-3">
        Tambah Data Penguji
    </h3>
    <hr>
    <div class="my-3">
        <div>
            <div class="form-group mb-5 text-xs">
                <label for="nama_penguji">Nama Penguji <span class="text-red">*</span></label>
                <input type="text" name="nama_penguji" id="nama_penguji" class="form-control mt-1" value=""
                    placeholder="Nama Penguji">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="email">Alamat Email <span class="text-red">*</span></label>
                <input type="text" name="email" id="email" class="form-control mt-1" value=""
                    placeholder="Alamat Email">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="password">Password <span class="text-red">*</span></label>
                <input type="password" name="password" id="password" class="form-control mt-1" value=""
                    placeholder="Password" minlength="6">
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="conf_password">Ulangi Password <span class="text-red">*</span></label>
                <input type="password" name="conf_password" id="conf_password" class="form-control mt-1" value=""
                    placeholder="Password" minlength="6">
            </div>
            <div class="form-group mb-5 text-xs text-right">
                <label for="show_password" class="mr-3">Lihat Password</label>
                <input type="checkbox" name="show_password" id="show_password" onclick="showPassword()">
            </div>
            <div class="form-group mb-5 text-xs mb-4">
                <label for="status_penguji">Status Penguji</label>
                <select name="status_penguji" id="status_penguji" class="form-control mt-1">
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <input type="hidden" id="addDaftarPengujiUrl" name="addDaftarPengujiUrl"
            value="{{route('wave.daftar-penguji-add')}}">
        <div class="my-2">
            <a href="#" rel="modal:close" id="close_modal"
                class="inline-flex self-start items-center px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                Batal
            </a>
            <button onclick="addDaftarPenguji()"
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