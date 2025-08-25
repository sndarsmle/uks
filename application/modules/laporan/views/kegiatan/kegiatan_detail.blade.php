@layout('template/back/main')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@section('scripts-css')

@endsection
@section('content')
<div class="container-fluid">
    </br>
    <h3>{{ $title }}</h3>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if($kegiatan == "MCU")
                    <div class="row float-right">
                        <div class="col-12">
                            <button class="btn btn-primary waves-effect waves-light export_rmcu_admin_button">
                                <i class="fa fa-download"></i>
                                Export ke Excel
                            </button>
                        </div>
                    </div>
                    @endif
                    <h4 class="card-title">Daftar Riwayat {{ formatKegiatan($kegiatan) }}</h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Jadwal {{ $kegiatan }}</th>
                                    <th scope="col" style="text-align: center;"> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $i => $data)
                                <tr>
                                    <td><b>{{ $i += 1 }}</b></td>
                                    <td>{{ $data->siswa_nama }}</td>
                                    <td>{{ $data->siswa_nis }}</td>
                                    <td>{{ $data->periode_monthName }} {{ $data->periode_year }}</td>
                                    <td>
                                        @if($kegiatan == "MCU")
                                            @if($data->mcu_isfinish or $data->dokter_id)
                                            <a href="{{ base_url('cetakdoc/precetakmcu/' . $data->mcu_id) }}"
                                               class="btn btn-success" style="color:white">
                                                <i class="fa fa-file"></i>
                                                Lihat
                                            </a>
                                            @else
                                            <span class="badge badge-warning">Belum Selesai</span>
                                            @endif

                                            @if($level == '33')
                                            <a href="{{ base_url('mcu/SD/step1/' . $data->mcu_id) }}"
                                               class="btn btn-primary"
                                               style="color:white">
                                                <i class="fa fa-edit"></i>
                                                Ubah Data
                                            </a>
                                            @elseif($level == '44')
                                            <a href="{{ base_url('mcu/SMP/step1/' . $data->mcu_id) }}"
                                               class="btn btn-primary"
                                               style="color:white">
                                                <i class="fa fa-edit"></i>
                                                Ubah Data
                                            </a>
                                            @elseif($level == '55')
                                            <a href="{{ base_url('mcu/SMA/step1/' . $data->mcu_id) }}"
                                               class="btn btn-primary"
                                               style="color:white">
                                                <i class="fa fa-edit"></i>
                                                Ubah Data
                                            </a>
                                            @elseif($level == '22' || $level == '11')
                                            <a href="{{ base_url('mcu/dckbtk/step1/' . $data->mcu_id) }}"
                                               class="btn btn-primary"
                                               style="color:white">
                                                <i class="fa fa-edit"></i>
                                                Ubah Data
                                            </a>
                                            @endif
                                            
                                        @elseif($kegiatan == "DCU")
                                            @if($data->dcu_isfinish or $data->dokter_id)
                                            <a href="{{ base_url('cetakdoc/precetakdcu/' . $data->dcu_id) }}"
                                               class="btn btn-success"
                                               style="color:white">
                                                <i class="fa fa-file"></i>
                                                Lihat
                                            </a>
                                            @else
                                            <span class="badge badge-warning">Belum Selesai</span>
                                            @endif
                                            <a href="{{ base_url('dcu/step1/' . $data->dcu_id) }}"
                                               class="btn btn-primary"
                                               style="color:white">
                                                <i class="fa fa-edit"></i>
                                                Ubah Data
                                            </a>
                                        @endif
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
<script src="{{base_url('assets/js/report/rmcu_admin.js')}}"></script>
<script >
    
$(document).ready(function(){
    let table = $("#table").DataTable({
        "pageLength": 50,
    });
});
</script>
@endsection