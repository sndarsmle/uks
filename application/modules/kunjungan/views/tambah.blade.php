@layout('template/back/main')

@section('scripts-css')
@endsection

@section('content')
    <div class="container-fluid">
        <br/>
        <h3> {{$title}}</h3>
        <br/>
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Kunjungan</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="tanggal">Tanggal Periksa</label>
                                                <input type="date"
                                                       name="tanggal"
                                                       id="tanggal"
                                                       value="{{ $kunjungan->tgl_kunjungan ?? '' }}"
                                                       class="form-control">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="hari">Hari periksa</label>
                                                <input type="text"
                                                       id="hari"
                                                       name="hari"
                                                       value="{{ $kunjungan->hari ?? '' }}"
                                                       class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_datang">Jam Datang</label>
                                        <input type="time"
                                               step="60"
                                               class="form-control"
                                               id="jam_datang"
                                               value="{{ $kunjungan->jam_datang ?? '' }}"
                                               name="jam_datang">
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_keluar">Jam Keluar</label>
                                        <input type="time"
                                               step="60"
                                               class="form-control"
                                               id="jam_keluar"
                                               value="{{ $kunjungan->jam_keluar ?? '' }}"
                                               name="jam_keluar">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text"
                                               name="nama"
                                               id="nama"
                                               value="{{ $kunjungan->nama ?? '' }}"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <input type="text"
                                               name="kelas"
                                               id="kelas"
                                               value="{{ $kunjungan->kelas ?? '' }}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Keluhan dan Penanganan</h4>
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea
                                        type="text"
                                        class="form-control"
                                        name="keluhan"
                                        id="keluhan"
                                        placeholder="keterangan. Harap isi dengan - jika tidak ada"
                                        required rows="6">{{ $kunjungan->keluhan ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="penanganan">Penanganan</label>
                                <textarea
                                        type="text"
                                        class="form-control"
                                        name="penanganan"
                                        id="penanganan"
                                        placeholder="keterangan. Harap isi dengan - jika tidak ada"
                                        required
                                        rows="6">{{ $kunjungan->penanganan ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="hasil">Hasil</label>
                                <textarea
                                        type="text"
                                        class="form-control"
                                        name="hasil"
                                        id="hasil"
                                        placeholder="keterangan. Harap isi dengan - jika tidak ada"
                                        required
                                        rows="6">{{ $kunjungan->hasil ?? '' }}</textarea>
                            </div>
                            <button class="btn btn-success float-right"
                                    style="color:white">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection