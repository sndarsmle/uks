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
                    
                    <h4 class="card-title">Daftar User</h4>
                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">User role</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Status User</th>
                                    <th scope="col">Aktivasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $i => $cont)
                                <tr>
                                    <th>{{$i+=1}}</th>
                                    <td>{{$cont->username}}</td>
                                    <td>{{$cont->nama_user}}</td>
                                    <td>{{$cont->user_role}}</td>
                                    <td>{{$cont->user_telpon}}</td>
                                    <td>{{ $cont->user_status == 0 ? '<span class="badge badge-dark">Nonaktif</span>' : '<span class="badge badge-success">Aktif</span>' }}</td>
                                    
                                   
                                    <td>
                                        <a href="{{base_url('aktivasi/status/'.$cont->user_id.'/'.$cont->user_status)}}" class="btn mb-1 btn-outline-info">Aktif/Nonaktif</a>
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
<script >
    
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
    
});
</script>
@endsection

