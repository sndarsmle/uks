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
                    @if($this->session->flashdata('message'))
                        {{$this->session->flashdata('message')}}
                    @endif
                    <?php
                        unset($_SESSION['message']);
                    ?>
                    <div class="row float-right">    
                        <div class="col-12">
                            <a href="{{base_url('wali/followup/')}}" type="button" class="btn btn-primary"><span><i class="ti-angle-double-left align-middle"></i> </span> Kembali ke menu Rujukan</a>
                            @if(isset($followup->followup_url) and $followup->followup_url != '-')
                            <a href="{{base_url().$followup->followup_url}}" target="_blank" type="button" class="btn btn-primary">Lihat File Rujukan</a>
                            @endif
                            <button class="btn btn-primary waves-effect waves-light tambah_followup_detail_button" data-toggle="modal" data-target="#followupDetailModal">Tambah Detail</button>
                        </div>
                    </div>
                    <div id="followupDetailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="followupDetailModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="followupDetailModalLabel">Form <span class="typeLabel">-</span> Detail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action='' method='POST'>
                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label>Tanggal</label>
                                            <input type='date' class='form-control' placeholder="Pilih tanggal" name="tgl_followup" id="tgl_followup" required>
                                        </div>
                                        <div class='form-group'>
                                            <label>Respon</label>
                                            <textarea class='form-control' name="respon" id="respon" rows="5"></textarea>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-10">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="isfinish" id="isfinishChoice1" value="1">
                                                    <label class="form-check-label" for="isfinishChoice1">Selesai</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="isfinish" id="isfinishChoice2" value="0">
                                                    <label class="form-check-label" for="isfinishChoice2">Belum Selesai</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" name="id" id="id"/>
                                        <input type="hidden" class="form-control" name="followup_id" id="followup_id" value="{{$followup->followup_id}}"/>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control typeSubmit" name="typeSubmit"/>
                                        <button class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary waves-effect waves-light"><span class="typeLabel">-</span> Detail</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="followupDetailHapusModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="followupDetailHapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="followupDetailHapusModalLabel">Konfirmasi Hapus Detail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method='POST'>
                                    <div class="modal-body">
                                        <p>Anda yakin ingin menghapus data ini?</p>
                                        <input type="hidden" class="form-control" name="id" id="id-delete"/>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control typeSubmit" name="typeSubmit"/>
                                        <button class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light">Hapus Detail</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title">Detail Rujukan {{$followup->siswa_nama}}</h4>
                    <h5>{{$followup->periode_name}} - {{$followup->periode_monthName}} ({{$followup->followup}})</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Respon</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($followup_detail as $i => $data)
                                <tr>
                                    <th>{{$i+=1}}.</th>
                                    <td>{{formatTanggal($data->tgl_followup)}}</td>
                                    <td>{{$data->respon}}</td>
                                    <td>
                                        @if($data->isfinish == 0)
                                            <span class="badge badge-dark">Belum selesai</span>
                                        @else
                                            <span class="badge badge-primary">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm waves-effect waves-light ubah_followup_detail_button" data-toggle="modal" data-target="#followupDetailModal"
                                            data-id="{{$data->id}}"
                                            data-tgl_followup="{{$data->tgl_followup}}"
                                            data-respon="{{$data->respon}}"
                                            data-isfinish="{{$data->isfinish}}">Ubah</button>
                                        <button class="btn btn-danger btn-sm waves-effect waves-light hapus_followup_detail_button" data-toggle="modal" data-target="#followupDetailHapusModal" data-id="{{$data->id}}">Hapus</button>
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
<script src="{{base_url('assets/js/followup/detail.js')}}"></script>
<script >
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
});
</script>
@endsection
