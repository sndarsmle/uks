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
                    @if($this->session->flashdata('message'))
                        {{$this->session->flashdata('message')}}
                    @endif
                    @if($thnAkademik_id)
                        <button type="button" class="btn btn-primary tambah_periode_button float-right" data-toggle="modal" data-target="#periodeModal">Tambah Periode</button>
                    @else
                        <div class='alert alert-warning text-dark' role='alert'>Tidak ada Tahun Ajaran yang Aktif</div>
                    @endif
                    <h4 class="card-title">Periode Pemeriksaan Mingguan</h4>
                    <div class="modal fade" id="periodeModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form <span class="typeLabel">-</span> Periode</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">                      
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type='text' class='form-control' placeholder="Nama" name="name" id="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type='date' class='form-control' placeholder="Pilih tanggal" name="date" id="date" required>
                                        </div>
                                        <input type="hidden" class="form-control" name="id" id="id"/>
                                        <input type="hidden" class="form-control" name="thnAkademik_id" id="thnAkademik_id" value="{{$thnAkademik_id}}"/>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control typeSubmit" name="typeSubmit"/>
                                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary"><span class="typeLabel">-</span> Periode</button>
                                    </div>
                                </form>     
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="periodeHapusModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus Periode</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">                      
                                        <p>Anda yakin ingin menghapus data ini?</p>
                                        <input type="hidden" class="form-control" name="id" id="id-delete"/>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control typeSubmit" name="typeSubmit"/>
                                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary">Hapus Periode</button>
                                    </div>
                                </form>     
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($periode as $i => $data)
                                <tr>
                                    <th>{{$i+=1}}</th>
                                    <td>{{$data->name}}</td>                                 
                                    <td>{{formatTanggal($data->date)}}</td>
                                    <td>
                                        <a href="{{base_url('wali/checkup/'.$data->id)}}" class="btn btn-success" style="color:white">Detail</a>
                                        <button class="btn btn-info ubah_periode_button" data-toggle="modal" data-target="#periodeModal" data-id="{{$data->id}}" data-name="{{$data->name}}" data-date="{{$data->date}}">Ubah</button>
                                        <button class="btn btn-danger hapus_periode_button" data-toggle="modal" data-target="#periodeHapusModal" data-id="{{$data->id}}">Hapus</button>
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
<script src="{{base_url('assets/js/checkup/periode.js')}}"></script>
<script >
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
});
</script>
@endsection