@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{base_url('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
<script src="https://www.google.com/jsapi"></script>
@endsection
@section('content')
<style type="text/css">
    .pie-chart {
            width: 300px;
            height: 200px;
            margin: 0 auto;
        }
        .text-center{
            text-align: center;
        }
</style>
<div class="container-fluid">
    </br>
    <h3> {{$title}}</h3>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                        <center>
                            <h4>Peserta</h4>
                            <br>
                            <div class="row">
                                <div class="pie-chart" id="peserta"></div>&nbsp 
                                <div class="pie-chart" id="peserta2"></div>    
                            </div>
                             
                                <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        

        var data = google.visualization.arrayToDataTable([


         
          ['Jenis Kelamin', 'Jumlah'],
          
            
            ['Laki-laki',  <?php echo $jumlah_peserta_laki->jumlah; ?>],
          
           ['Perempuan',  <?php echo $jumlah_peserta_perempuan->jumlah; ?>]
        ]);

        var options = {
          title: 'PERKEMBANGAN IMT SISWA',
          curveType: 'pie',
          chartArea : { left: "5%" },
        legend: { position: 'bottom', textStyle: { fontSize:12 }},
        // width: 810,
        };

        var data2 = google.visualization.arrayToDataTable([


         
          ['Kondisi IMT', 'Jumlah'],
          
            
            ['Sangat Kurus',  <?php echo $jumlah_sangatkurus->jumlah; ?>],
          
           ['Kurus',  <?php echo $jumlah_kurus->jumlah; ?>],
           ['Ideal',  <?php echo $jumlah_ideal->jumlah; ?>],
           ['Berlebih',  <?php echo $jumlah_berlebih->jumlah; ?>],
           ['Sangat Berlebih',  <?php echo $jumlah_sangatberlebih->jumlah; ?>]
        ]);

        var options2 = {
          title: 'Statistik IMT',
          curveType: 'pie',
           pieSliceText: 'value-and-percentage',
        legend: { position: 'right'},
        // width: 810,
        };

        var chart = new  google.visualization.PieChart(document.getElementById('peserta'));
        var chart2 = new  google.visualization.PieChart(document.getElementById('peserta2'));

        //var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart2'));


        chart.draw(data, options);
        chart2.draw(data2, options2);
      }
    </script>

                        </center>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{base_url('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{base_url('assets/plugins/toastr/js/toastr.min.js')}}"></script>
<script >
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
});
</script>
@endsection
