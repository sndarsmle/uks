@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    </br><h3>{{$title}} Kelas {{$class}}</h3></br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }} Kelas {{ $class }}</h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_siswa as $i => $data)
                                <tr>
                                    <td><b>{{ $i+=1 }}</b></td>
                                    <td>{{ $data->siswa_nis }}</td>
                                    <td>{{ $data->siswa_nama }}</td>
                                    <td>
                                        <a href="{{ base_url('profile/siswa/'.$data->siswa_id) }}" class="btn btn-success" style="color:white">Lihat</a>
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
