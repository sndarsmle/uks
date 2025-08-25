@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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

                    <h4 class="card-title">Daftar Jadwal</h4>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">#</th>
                                    <th scope="col" style="text-align: center;">Nama</th>
                                    <th scope="col" style="text-align: center;">kelas</th>
                                    <th scope="col"style="text-align: center;">Periode Medical Checkup</th>
                                    <th scope="col"style="text-align: center;">Followup</th>
                                    <th scope="col"style="text-align: center;">Tindakan Followup</th>
                                    <th scope="col"style="text-align: center;">Status Follow up</th>
                                    <th scope="col"style="text-align: center;">Tanggal Tindakan</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $count = 0; ?>
                            @foreach($content as $i => $cont)
                                <tr>
                                    <th>{{$i+=1}}.</th>
                                    <td>{{$cont->nama}}</td>
                                    <td>{{$cont->kelas_tingkat}}{{$cont->kelas_rombel}}</td>
                                    <td>{{$cont->jadwal_mcu}}</td>
                                    
                                    <td style="max-width: 40%">{{$cont->followup}}</td>
                                    <td style=>{{$cont->hasil_followup}}</td>
                                    <td style="text-align: center;">{{ $cont->status_followup == 2 ? '<span class="badge badge-dark">SUdah</span>' : '<span class="badge badge-danger">Belum</span>' }}</td>
                                    <td style="text-align: center;">{{$cont->tgl_followup}}</td>
                                    
                                </tr>
                                
                    <?php $count++; ?>
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
<script >
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
    
});
</script>
@endsection
