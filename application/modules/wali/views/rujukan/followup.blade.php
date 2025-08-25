@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    </br><h3> {{$title}} - {{$class}}</h3></br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Rujukan dari Dokter</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Rujukan</th>
                                    <th scope="col">Status Follow up</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($followup as $i => $data)
                                <tr>
                                    <th>{{$i+=1}}.</th>
                                    <td>{{$data->siswa_nama}}</td>
                                    <td>{{$data->siswa_kelas}}</td>
                                    <td>{{$data->periode_name}} - {{$data->periode_monthName}}</td>
                                    <td>{{$data->followup}}</td>
                                    <td>
                                        @if(empty($data->followup_id) or ($data->jml_proses == 0 and $data->jml_selesai == 0))
                                            <span class="badge badge-dark">Belum diproses</span>
                                        @else
                                            @if($data->jml_proses != 0)
                                                <span class="badge badge-primary">Sedang proses ({{$data->jml_proses}}x)</span>
                                            @endif
                                            @if($data->jml_selesai != 0)
                                                <span class="badge badge-success">Sudah Selesai ({{$data->jml_selesai}}x)</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                    @if(empty($data->followup_id))
                                        <button class="btn btn-info btn-sm waves-effect waves-light btn-upload" data-toggle="modal" data-target="#uploadRujukan" data-id="{{$data->mcu_id}}">Upload Rujukan</button>
                                    @else
                                        <a class="btn btn-primary btn-sm waves-effect waves-light" href="{{base_url('wali/followup/detail/'.$data->followup_id)}}">Detail Proses</button>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="uploadRujukan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0">Upload File Rujukan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method='POST' enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <p>Upload Rujukan dari dokter berupa file JPG, atau PDF.</p>
                                        <input type="hidden" class="form-control" name="form_id" id="form_id"/>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file" id="inputGroupFile02" accept=".pdf,.jpg,.jpeg" />
                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                        </div>
                                        <label class="text-danger font-italic mt-1">*Ukuran File Max. 5 MB</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="withFileCheck" name="withFileCheck" value="1">
                                            <label class="form-check-label font-weight-bold" for="withFileCheck">Tanpa File Rujukan</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control typeSubmit" name="typeSubmit"/>
                                        <button class="btn btn-secondary waves-effect" data-dismiss="modal" style="color:white">Close</button>
                                        <button type="submit" class="btn btn-success waves-effect waves-light" style="color:white">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<script src="{{base_url('assets/js/followup/followup.js')}}"></script>
<script >
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
});
</script>
@endsection
