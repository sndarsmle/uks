@layout('template/back/main')

@section('scripts-css')

@endsection
@section('content')
<div class="container-fluid">
    </br>
    <h3> {{$title}}</h3></br>
    @if(isset($role) && $role != 3)
    <h3> Daftar Tunggu Medical Checkup</h3></br>
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <a href="{{base_url('mcu/reservasi?key=22')}}" class="stretched-link">
                    <center>
                    <img class="img-fluid" style="margin:20px;" width="200" src="https://ppdb.sekolahteladan.sch.id/assets/img/logo_dc.png" alt="">
                    </center>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <a href="{{base_url('mcu/reservasi?key=33')}}" class="stretched-link">
                    <center>
                    <img class="img-fluid" style="margin:20px;" width="200" src="https://ppdb.sekolahteladan.sch.id/assets/img/logo_sd.png" alt="">
                    </center>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <a href="{{base_url('mcu/reservasi?key=44')}}" class="stretched-link">
                    <center>
                    <img class="img-fluid" style="margin:20px;" width="200" src="https://ppdb.sekolahteladan.sch.id/assets/img/logo_smp.png" alt="">
                    </center>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <a href="{{base_url('mcu/reservasi?key=55')}}" class="stretched-link">
                    <center>
                    <img class="img-fluid" style="margin:20px;" width="200" src="https://ppdb.sekolahteladan.sch.id/assets/img/logo_sma.png" alt="">
                    </center>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection