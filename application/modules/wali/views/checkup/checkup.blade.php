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
                    <a href="{{base_url('wali/checkup_periode/')}}" type="button" class="btn btn-primary float-right"><span><i class="ti-angle-double-left align-middle"></i> </span> Kembali ke menu Periode</a>
                    <h4 class="card-title">Daftar Pemeriksaan Siswa Kelas {{$kelas_tingkat}}{{$kelas_rombel}} Periode {{$periode->name}} {{formatTanggal($periode->date)}}</h4>
                    <div class="modal fade" id="checkupModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Pemeriksaan</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label>Kuku</label>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kuku" id="kukuChoice1" value="1">
                                                    <label class="form-check-label" for="kukuChoice1">Bersih</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kuku" id="kukuChoice2" value="0">
                                                    <label class="form-check-label" for="kukuChoice2">Kotor</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <textarea name="ket_kuku" id="ket_kuku" cols="21" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label>Telinga</label>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="telinga" id="telingaChoice1" value="1">
                                                    <label class="form-check-label" for="telingaChoice1">Bersih</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="telinga" id="telingaChoice2" value="0">
                                                    <label class="form-check-label" for="telingaChoice2">Kotor</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <textarea name="ket_telinga" id="ket_telinga" cols="21" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label>Mulut</label>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mulut" id="mulutChoice1" value="1">
                                                    <label class="form-check-label" for="mulutChoice1">Bersih</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mulut" id="mulutChoice2" value="0">
                                                    <label class="form-check-label" for="mulutChoice2">Kotor</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <textarea name="ket_mulut" id="ket_mulut" cols="21" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label>Hidung</label>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="hidung" id="hidungChoice1" value="1">
                                                    <label class="form-check-label" for="hidungChoice1">Bersih</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="hidung" id="hidungChoice2" value="0">
                                                    <label class="form-check-label" for="hidungChoice2">Kotor</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <textarea name="ket_hidung" id="ket_hidung" cols="21" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label>Kulit</label>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kulit" id="kulitChoice1" value="1">
                                                    <label class="form-check-label" for="kulitChoice1">Bersih</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kulit" id="kulitChoice2" value="0">
                                                    <label class="form-check-label" for="kulitChoice2">Kotor</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <textarea name="ket_kulit" id="ket_kulit" cols="21" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" name="id" id="id"/>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control typeSubmit" name="typeSubmit"/>
                                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary">Simpan</button>
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
                                    <th scope="col">NIS</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($checkup as $i => $data)
                                <tr>
                                    <td><b>{{$i+=1}}</b></td>
                                    <td>{{$data->siswa_nis}}</td>
                                    <td>{{$data->siswa_nama}}</td>
                                    <td>
                                        <button class="btn btn-info ubah_checkup_button" data-toggle="modal" data-target="#checkupModal"
                                            data-id="{{$data->id}}"
                                            data-kuku="{{$data->kuku}}"
                                            data-ket_kuku="{{$data->ket_kuku}}"
                                            data-telinga="{{$data->telinga}}"
                                            data-ket_telinga="{{$data->ket_telinga}}"
                                            data-mulut="{{$data->mulut}}"
                                            data-ket_mulut="{{$data->ket_mulut}}"
                                            data-hidung="{{$data->hidung}}"
                                            data-ket_hidung="{{$data->ket_hidung}}"
                                            data-kulit="{{$data->kulit}}"
                                            data-ket_kulit="{{$data->ket_kulit}}">Pemeriksaan</button>
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
<script src="{{base_url('assets/js/checkup/checkup.js')}}"></script>
<script >
    $(document).ready(function(){
        var table = $("#table").DataTable({
            "pageLength": 50,
        });
        
    });
</script>
@endsection