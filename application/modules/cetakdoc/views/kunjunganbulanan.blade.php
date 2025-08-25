@layout('template/back/main')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@section('scripts-css')

@endsection
@section('content')
<div class="container-fluid">
    </br>
    <h3> {{$title}}</h3>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Jumlah Kunjungan</th>
                                    <th scope="col"> <center> Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                            @foreach($content as $hasil)
                            
                            <?php $year='';
                            $bulan  = '';
                            $year = substr($hasil->tgl_kunjungan,0,4);
                            $month = substr($hasil->tgl_kunjungan, 5,2);
                            if ($month=='01') {
                                $bulan ='Januari';
                                # code...
                            }
                            else if ($month=='02') {
                                $bulan ='Februari';
                                # code...
                            }
                            else if ($month=='03') {
                                $bulan ='Maret';
                                # code...
                            }
                            else if ($month=='04') {
                                $bulan ='April';
                                # code...
                            }
                            else if ($month=='05') {
                                $bulan ='Mei';
                                # code...
                            }
                            else if ($month=='06') {
                                $bulan ='Juni';
                                # code...
                            }
                            else if ($month=='07') {
                                $bulan ='Juli';
                                # code...
                            }
                            else if ($month=='08') {
                                $bulan ='Agustus';
                                # code...
                            }
                            else if ($month=='09') {
                                $bulan ='September';
                                # code...
                            }
                            else if ($month=='10') {
                                $bulan ='Oktober';
                                # code...
                            }
                            else if ($month=='11') {
                                $bulan ='November';
                                # code...
                            }
                            else if ($month=='12') {
                                $bulan ='Desember';
                                # code...
                            }


                             ?>
                                <tr> <center>
                                    <th>{{$i++}}</th>
                                    <td><?php echo $bulan.' '. $year; ?> </td>
                                    <td>{{$hasil->jumlah}}</td>                                 
                                    <td><center>  <a href="{{base_url('cetak/excel_bulanan/'.$month.'/'.$year)}}" class="btn btn-success">Cetak </a>
                                    <a href="{{base_url('cetak/lihat_kunjungan_bulanan/'.$month.'/'.$year)}}" class="btn btn-primary">Lihat </a>
                                     
                                    </center></td>
                                </center></tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->

 <!-- Default box -->
      <

@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{base_url('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script >
    
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
    
});
</script>
@endsection