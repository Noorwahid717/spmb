<!-- Modal HTML embedded directly into document -->
<div id="detailExamInterviewMemberModal" class="modal w-full h-full" style="max-width: inherit;">
    <h3 class="text-lg font-semibold leading-6 text-gray-700 my-3">
        Detail Peserta Ujian Interview
    </h3>
    <hr>
    <div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
        <div
            class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-lg lg:mr-3 lg:mb-0 border-gray-150">
            <div
                class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
                <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-yellow-200">
                    <svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="relative flex-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-700">
                        Calon Peserta Seleksi Wawancara Yang Masih Tersedia
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Pendaftar Tahun Akademik {{{$ta_aktif}}}
                    </p>
                </div>

            </div>
            <div class="relative p-5">
                <table id="available_member" class="display available_member text-xs" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center!important">NO</th>
                            <th>NAMA</th>
                            <th>PRODI</th>
                            <th>LUNAS</th>
                            <th>DOKUMEN</th>
                            <th style="width: 20px;text-align: center!important">ACT</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <input type="hidden" id="available_member_url" class="available_member_url" name="available_member_url"
                    value="{{route('wave.exam-interview-getlist-available-member')}}">
                <input type="hidden" id="addInterviewMemberUrl" class="addInterviewMemberUrl"
                    name="addInterviewMemberUrl" value="{{route('wave.exam-interview-add-member')}}">

            </div>
        </div>






        <input type="hidden" name="id_exam_interview" class="id_exam_interview" id="id_exam_interview">





        <div
            class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-lg lg:mr-3 lg:mb-0 border-gray-150">
            <div
                class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
                <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-green-200">
                    <svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="relative flex-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-700">
                        Peserta Seleksi Wawancara Yang Terploting
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt terploting">

                    </p>
                </div>

            </div>
            <div class="relative p-5">
                <table id="joined_member" class="display joined_member text-xs" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="width: 20px;text-align: center!important">ACT</th>
                            <th style="text-align: center!important">NO</th>
                            <th>NAMA</th>
                            <th>PRODI</th>
                            <th>LUNAS</th>
                            <th>DOKUMEN</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <input type="hidden" id="joined_member_url" class="joined_member_url" name="joined_member_url"
                    value="{{route('wave.exam-interview-getlist-joined-member')}}">
                <input type="hidden" id="deleteInterviewMemberUrl" class="deleteInterviewMemberUrl"
                    name="deleteInterviewMemberUrl" value="{{route('wave.exam-interview-delete-member')}}">
            </div>
        </div>
    </div>
</div>