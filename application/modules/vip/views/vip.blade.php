@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{base_url('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal" style="float:right;">Tambah Client</button>
                    <h4 class="card-title">List Client</h4>
                    <div class="modal fade" id="basicModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Tambah Tahun Akademik</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">                      
                                        <div class="form-group">
                                            <label>Client</label>
                                            <input type="text" class="form-control" name="form_client" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Client IP</label>
                                            <input type="text" class="form-control" name="form_clientip" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Token</label>
                                            <input type="text" class="form-control" name="form_clienttoken" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Description</label>
                                            <textarea class="form-control" name="form_clientdesc" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color:white">Close</button>
                                        <button class="btn btn-primary">Tambah Tahun</button>
                                    </div>
                                </form>     
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Client IP</th>
                                    <th scope="col">Client Token</th>
                                    <th scope="col">Client Desciption</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($api as $i => $data)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$data->client}}</td>
                                <td>{{$data->client_ip}}</td>
                                <td>{{$data->client_token}}</td>
                                <td>{{$data->client_description}}</td>
                                <td><a href="{{base_url('vip/detail/'.$data->client_id)}}" class="btn btn-secondary btn-sm" style="color:white;">Detail</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                <div>
            </div>
        <div>
    </div>
</div>
@endsection