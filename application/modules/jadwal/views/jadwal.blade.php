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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal" style="float:right;">Tambah Jadwal</button>
                    <h4 class="card-title">Daftar Jadwal TES</h4>
                    <div class="modal fade" id="basicModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Tambah Jadwal</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="penjadwalan/inputjadwal" method="POST">
                                    <div class="modal-body">                      
                                        <div class="form-group">
                                            <label>Jadwal Input</label>
                                            <input type="date" class="form-control" name="form_nama_jadwal" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jadwal Mulai</label>
                                            <input type="date" class="form-control" name="form_jadwal_mulai" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jadwal Selesai</label>
                                            <input type="date" class="form-control" name="form_jadwal_selesai" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
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
                                    <th scope="col">Jadwal Input</th>
                                    <th scope="col">Jadwal Mulai</th>
                                    <th scope="col">Jadwal Selesai</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($jadwal as $i => $jad)
                                <tr>
                                    <th>{{$i+=1}}.</th>
                                    <td>{{$jad->fminggu_jadwal}}</td>
                                    <td>{{$jad->fminggu_mulai}}</td>
                                    <td>{{$jad->fminggu_selesai}}</td>
                                    <td>{{ $jad->minggu_active == 0 ? '<span class="badge badge-dark">Disable</span>' : '<span class="badge badge-success">Active</span>' }}</td>
                                    <td>
                                        <a href="{{base_url('jadwal/status/'.$jad->minggu_id.'/'.$jad->minggu_active)}}" class="btn mb-1 btn-outline-info">Active/Disable</a>
                                        <button type="button" class="btn mb-1 btn-outline-secondary" data-toggle="modal" data-target="#ubahModal{{$i}}">Ubah</button>
                                        <div class="modal fade" id="ubahModal{{$i}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Form Ubah Jadwal</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">                      
                                                        <div class="form-group">
                                                            <label>Jadwal Input</label>
                                                            <input type="date" class="form-control" value="{{$jad->minggu_jadwal}}" id="nama_jadwal{{$i}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Mulai</label>
                                                            <input type="date" class="form-control" value="{{$jad->minggu_mulai}}" id="jadwal_mulai{{$i}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Selesai</label>
                                                            <input type="date" class="form-control" value="{{$jad->minggu_selesai}}" id="jadwal_selesai{{$i}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button data-id="{{$i;}}" data-uid="{{$jad->minggu_id}}" class="btn-ubah btn btn-primary">Save changes</button>
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
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
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    $(".btn-ubah").click(function() {
        var id = $(this).data("id");
        let uid = $(this).data("uid");
        let postForm = {
            'form_nama_jadwal' : document.getElementById('nama_jadwal'+id).value,
            'form_jadwal_mulai' : document.getElementById('jadwal_mulai'+id).value,
            'form_jadwal_selesai' : document.getElementById('jadwal_selesai'+id).value,
            'form_id' : uid,
        };
            $.ajax({
            url: '{{ base_url('api/jadwal/update/')}}',
            method: 'post',
            data: postForm,
            success: function(data) {
                data = JSON.parse(data);
                if (data['status'] == 1) {
                    location.reload(true);
                } else if (data['status'] == 0) {
                    alert("Gagal mengubah data");
                }
            }
        }); 
    });
});
</script>
@endsection
