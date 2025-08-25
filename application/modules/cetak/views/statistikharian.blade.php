@layout('template/back/main')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@section('scripts-css')

@endsection
@section('content')
<div class="container-fluid">
    </br>
    <h3> {{$title}}</h3>
    <?php  $i=0; ?>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Laporan jumlah Medical Checkup Periode {{$periode}}</h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>Tanggal</th>
                                    <th scope="col">Jumlah Kelas</th>
                                    <th scope="col">Jumlah siswa</th>
                                    <th></th>

                                    
                                    <!-- <th scope="col">Hasil Tindakan</th> -->
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $i => $cont)
                                <tr> <center>
                                    <th>{{$i+=1}}</th>
                                    <td>{{$cont->tgl_periksa}}</td>
                                    <td>{{$cont->jumlah_kelas}} Kelas</td>
                                    <td><?php  echo $cont->jumlah_siswa?> Siswa</td>                                 
                                    
                                        </center>
                                     <td><center>  <a href="{{base_url('cetak/detaillaporanharian/'.$cont->tgl)}}" class="btn btn-success">Lihat Detail </a>

                                    <!-- <a href="{{base_url('cetak/edit_mcu/'.$nama[0]->nis.'/'.$jad->kode_mcu)}}" class="btn btn-primary">Edit </a> -->
                                    </center></td>
                                     <!-- <td></td> -->   
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

<!-- CSS -->



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