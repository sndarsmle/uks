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
                    <h4 class="card-title">Daftar Pengunjung UKS</h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Hari, Tanggal</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Penanganan</th>
                                    <th scope="col">Hasil Tindakan</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $i => $cont)
                                <tr> <center>
                                    <th>{{$i+=1}}</th>
                                    <td>{{$cont->nama}}</td>
                                    <td><?php  echo $cont->hari.', '.$cont->tgl_kunjungan; ?></td>                                 
                                    
                                        </center>
                                     <td>{{$cont->keluhan}}</td>
                                     <td>{{$cont->penanganan}}</td>
                                     <td>{{$cont->hasil}}</td>   
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