<!-- Modal HTML embedded directly into document -->
<div id="registrasi-awal-modal" class="modal">
    <h3 class="text-lg font-semibold leading-6 text-gray-700 my-3">
        Edit Status Pembayaran Registrasi Awal
    </h3>
    <hr>
    <div class="my-3">
        <div>
            <div id="img-prev_slip">
                <div class="mb-3 px-2 py-2 d-flex justify-center border rounded"
                    style="border: 1px solid #ff008f !important;">
                    <a class="magnifier-thumb-wrapper">
                        <img id="thumb_slip" src="" data-large-img-url="" data-large-img-wrapper="preview_slip"
                            style="max-width:100%">
                    </a>
                </div>
            </div>
            <input type="hidden" name="id_user" value id="id_user" class="id_user">
            <input type="hidden" name="ta_registrasi" value id="ta_registrasi" class="ta_registrasi">
            <div class="form-group mb-5 text-xs">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control mt-1" value="" placeholder="Nama" readonly>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="email">Alamat Email</label>
                <input type="text" name="email" id="email" class="form-control mt-1" value="" placeholder="Alamat Email"
                    readonly>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="no_wa">Nomor Whatsapp</label>
                <div class="flex">
                    <input type="text" name="no_wa" id="no_wa" class="form-control mt-1" value=""
                        placeholder="Nomor Whatsapp" readonly>
                    <a href="" id="link_wa" target="_blank"
                        class="ml-3 inline-flex self-start items-center mt-1 py-2 px-4 w-100 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                        <img src="{{ asset('/themes/tailwind/images/whatsapp.png') }}" class="w-8 rounded sm:mx-auto">
                    </a>
                </div>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="nominal">Nominal</label>
                <input type="text" name="nominal" id="nominal" class="form-control mt-1" value="" placeholder="Nominal"
                    oninput="nominal_view()">
                <strong>
                    <span class="text-wave-600 m-1" style="float: right" id="nominal_view"></span>
                </strong>
            </div>
            <div class="form-group mb-5 text-xs">
                <label for="tglbyr">Tanggal Bayar</label>
                <input type="date" name="tglbyr" id="tglbyr" class="form-control mt-1" value=""
                    placeholder="Tanggal Bayar">
            </div>
            <div class="form-group mb-5 text-xs mb-4">
                <label for="status_bayar">Status Bayar</label>
                <select name="status_bayar" id="status_bayar" class="form-control mt-1">
                    <option value="-2" selected>--Pilih Status--</option>
                    <option value="-1">Belum Lunas</option>
                    <option value="0">Menunggu</option>
                    <option value="1">Lunas</option>
                </select>
            </div>
            <div class="form-group mb-5 text-xs mb-4">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control mt-1" name="keterangan" id="keterangan" cols="30" rows="1"
                    placeholder="Keterangan terkait status pembayaran"></textarea>
            </div>
        </div>
        <input type="hidden" id="updateRegAwalUrl" name="updateRegAwalUrl"
            value="{{route('wave.update-registrasi-awal-status')}}">
        <div class="my-2">
            <a href="#" rel="modal:close" id="close_modal"
                class="inline-flex self-start items-center px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                Batal
            </a>
            <button onclick="editValidasiPembayaran()"
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