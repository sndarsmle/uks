@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    </br><h3>{{$title}} - {{$siswa->siswa_nama}}</h3></br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informasi Siswa</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control" value="{{$siswa->siswa_nis}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{$siswa->siswa_nama}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" class="form-control" value=" {{ $siswa->siswa_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tgl Lahir</label>
                                <input type="text" class="form-control" value="{{formatTanggal($siswa->siswa_tgl_lahir)}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" class="form-control" value="{{formatJenjang($siswa->siswa_jenjang).' - '.$siswa->siswa_kelas}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Umur Hari Ini</label>
                                <input type="text" class="form-control" value="{{$siswa->siswa_umurT.' Tahun '.$siswa->siswa_umurB.' Bulan'}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Grafik Perkembangan IMT Siswa</h4>
                    <div id="curve_chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Kegiatan</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">T.A.</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($profile as $i => $data)
                                <tr>
                                    <th>{{$i+=1}}.</th>
                                    <td>{{formatTanggal($data->periode_date)}}</td>
                                    <td>{{formatKegiatan($data->periode_name)}}</td>
                                    <td>{{$data->periode_monthName}} {{$data->periode_year}}</td>
                                    <td>{{$data->thnAkademik_yearstart}} - {{$data->thnAkademik_yearend}}</td>
                                    <td>
                                        @if($data->periode_name == 'DCU')
                                            <a href="{{ base_url('cetakdoc/precetakdcu/'.$data->id) }}" class="btn btn-success" style="color:white">Lihat</a>
                                        @elseif($data->periode_name == 'MCU' || $data->periode_name == 'SCR')
                                            <a href="{{ base_url('cetakdoc/precetakmcu/'.$data->id) }}" class="btn btn-success" style="color:white">Lihat</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{base_url('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
});
</script>
<?php
$total = count($grafik);
if ($total > 0) {;
?>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Umur', 'Batas Bawah', 'IMT', {type: 'string', role: 'tooltip'}, 'Batas Atas'],
            <?php
            for ($i = 0; $i < $total; $i++) { ?>
                [<?= '"'.date_format(date_create($grafik[$i]->tgl_periksa), "d M Y").'"'; ?>
                , <?= $grafik[$i]->batas_bawah; ?>
                , <?= isset($grafik[$i]) ? $grafik[$i]->imt : null; ?>
                , <?= isset($grafik[$i]) ? '"'.$grafik[$i]->imt.' (Umur: '.$grafik[$i]->tahun_usia.' tahun)"' : '"-"'; ?>
                , <?= $grafik[$i]->batas_atas; ?>],
            <?php }
            ?>
        ]);
        var options = {
            curveType: 'line',
            chartArea: {
                top: "10%"
            },
            legend: {
                position: 'right',
                textStyle: {
                    fontSize: 12
                }
            },
            vAxis: {
                minValue: 0
            },
            hAxis: {
                slantedText: true,
                slantedTextAngle: 45
            },
            // This line makes the entire category's tooltip active.
            focusTarget: 'category',
            height: 600
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }
</script>
<?php
}
?>
@endsection
