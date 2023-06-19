<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div
        class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-lg lg:mr-3 lg:mb-0 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Halaman Dashboard
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Pelajari lebih lanjut
                </p>
            </div>
            <select name="periode" id="periode">
                <option value="2023/2024 Ganjil" selected>2023/2024 Ganjil</option>
                <option value="2024/2025 Ganjil">2024/2025 Ganjil</option>
            </select>
        </div>
        <div class="relative p-5">
            <canvas id="myBarChart" style="display: block; width: 385px; height: 208px;" class="chartjs-render-monitor"
                width="385" height="208"></canvas>
            <input type="hidden" name="linkGraphPopulasiCamabaByProdiByPeriode"
                id="linkGraphPopulasiCamabaByProdiByPeriode"
                value="{{route('wave.dashboard-pendaftaran-grafik-by-periode')}}">
        </div>
    </div>

</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // onload update variable 
$(document).ready(function() {
    $periode = $('#periode option:selected').val();
    updateChart($periode);
});

$('#periode').change(function(){
    $periode = $('#periode option:selected').val();
    updateChart($periode);
});

function updateChart(periode) {
    let datar = {};
    datar['_method']='POST';
    datar['_token']=$('._token').data('token');
    datar['periode']=$periode;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: $("#linkGraphPopulasiCamabaByProdiByPeriode").val(),
        data:datar,
        success: function(dataq) {
            myBarChart.data.labels = dataq.label_populasi_prodi_periode;
            myBarChart.data.datasets = dataq.dataset_populasi_prodi_periode;
            myBarChart.update();
        },
    });
}

// GRAFIK AKM
var mbc = document.getElementById("myBarChart");

var data = {
    labels: @json($label_populasi_prodi_periode),
    datasets: @json($dataset_populasi_prodi_periode)
};

var myBarChart = new Chart(mbc, {
    type: 'bar',
    data: data,
    options: {
        plugins: {
            title: {
                display: false,
                text: @json($nama_ps),      
            }
        },
        indexAxis: 'y',
        scales: {
            x: {
                stacked: true,
                ticks: {
                    stepSize: 1
                }
            },
            y: {
                stacked: true,
                // min: 10,
                // max: 100,
            },
        },      
        responsive: true,
        legend: {
            display: true,
            position:"top",
        },
    },
});
</script>