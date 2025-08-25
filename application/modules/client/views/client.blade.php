@layout('template/front/main')

@section('scripts-css')
@endsection

@section('content')
    <div class="container-fluid">
        <br/>
        <br/>
        <div class="text-center">
            <h2> Selamat Datang UKS Sekolah Teladan Yogyakarta</h2>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <a href="{{ base_url('admin') }}" class="stretched-link">
                        <div class="text-center">
                            <br/>
                            <br/>
                            <br/>
                            <h2>Login Perawat</h2>
                            <br/>
                            <br/>
                            <br/>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <a href="{{ base_url('dokter') }}" class="stretched-link">
                        <div class="text-center">
                            <br/>
                            <br/>
                            <br/>
                            <h2>Login Dokter</h2>
                            <br/>
                            <br/>
                            <br/>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts-js')
@endsection
