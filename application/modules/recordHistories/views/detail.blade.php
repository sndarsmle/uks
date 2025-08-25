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
                        <h4 class="card-title">Daftar Riwayat MCU - September 2025</h4>
                        <div class="table-responsive" >
                            <table class="table table-bordered table-hover" id="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col" style="text-align: center;"> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="sorting_1"><b>1</b></td>
                                    <td>Ocean Zuhudya Tranggana</td>
                                    <td>0011240030</td>
                                    <td>Mei 2025</td>
                                    <td>
                                        <a href="#" class="btn btn-success" style="color:white">
                                            <i class="fa fa-file"></i>
                                            Lihat
                                        </a>
                                        <!---
                                        Hide this button when period is not active
                                        -->
                                        <a href="#" class="btn btn-primary" style="color:white">
                                            <i class="fa fa-edit"></i>
                                            Ubah Data
                                        </a>
                                        <!---
                                        Hide this button when period is not active
                                        -->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="sorting_1"><b>2</b></td>
                                    <td>Alexandre Kevin Gaffi Ramadhan</td>
                                    <td>0011240005</td>
                                    <td>Mei 2025</td>
                                    <td>
                                        <a href="#" class="btn btn-success" style="color:white">
                                            <i class="fa fa-file"></i>
                                            Lihat
                                        </a>
                                        <!---
                                        Hide this button when period is not active
                                        -->
                                        <a href="#" class="btn btn-primary" style="color:white">
                                            <i class="fa fa-edit"></i>
                                            Ubah Data
                                        </a>
                                        <!---
                                        Hide this button when period is not active
                                        -->
                                    </td>
                                </tr>
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