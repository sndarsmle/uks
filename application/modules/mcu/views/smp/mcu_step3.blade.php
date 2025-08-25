@layout('template/back/main')

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
          <h4 class="card-title">Informasi Siswa</h4>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>NIS</label>
                <input type="text" class="form-control" value="{{$siswa->siswa_nis}}" readonly>
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" value="{{$siswa->siswa_nama}}" readonly>
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <input type="text" class="form-control" value=" {{ $siswa->siswa_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}" readonly>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Tgl Lahir</label>
                <input type="date" class="form-control" value="{{$siswa->siswa_tgl_lahir}}" readonly>
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <input type="text" class="form-control" value="{{formatJenjang($siswa->siswa_jenjang).' - '.$siswa->siswa_kelas}}" readonly>
              </div>
              <div class="form-group">
                <label>Umur Hari Ini</label>
                <input type="text" class="form-control" value="{{$siswa->siswa_umurT.' Tahun '.$siswa->siswa_umurB.' Bulan'}}" readonly>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="tahun_usia" id="tahun_usiaa" value="{{$siswa->siswa_umurT}}">
  <input type="hidden" name="bulan_usia" id="bulan_usiaa" value="{{$siswa->siswa_umurB}}">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{$mcu->periode_name != "SCR" ? "Medical Check Up" : "Screening"}} - SMP Teladan</h4>
          <form action="" method="post">
            <div class="row">
              <div class="col-md-4 col-lg-3">
                <div class="nav flex-column nav-pills">
                  <a href="{{base_url('mcu/SMP/step1/'.$mcu->mcu_id)}}" class="nav-link">Tanda Vital</a>
                  <a href="{{base_url('mcu/SMP/step2/'.$mcu->mcu_id)}}" class="nav-link">Status Gizi</a>
                  <a href="#v-pills-home" class="nav-link active show" class="nav-link">Kebersihan diri</a>
                  <a href="{{base_url('mcu/SMP/step4/'.$mcu->mcu_id)}}" class="nav-link">Kesehatan Rongga Mulut</a>
                  <a href="{{base_url('mcu/SMP/step5/'.$mcu->mcu_id)}}" class="nav-link">Penglihatan dan Pendengaran</a>
                  <a href="{{base_url('mcu/SMP/step6/'.$mcu->mcu_id)}}" class="nav-link">Lainnya</a>
                    @if($role == 3)
                        <a href="{{base_url('mcu/SMP/evaluasi/'.$mcu->mcu_id)}}" class="nav-link">Evaluasi</a>
                    @endif
                </div>
              </div>
              <div class="col-md-8 col-lg-9">
                <div class="tab-content">
                  <div class="form-group">
                    <h4><label>
                        <font><b> Kebersihan Diri</b></font>
                      </label></h4>
                    <div class="row">
                      <div class="col-md-6">
                        <label>
                          1. Rambut
                        </label><br />
                        <label>
                          <input type="checkbox" class=" chb1 minimal" name="rambut" value="1" <?php if ($bersih->rambut == '1' || $bersih->rambut == '') : echo "checked"; ?><?php endif ?>> Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="checkbox" class="chb1 minimal" name="rambut" value="2" <?php if ($bersih->rambut == '2') : echo "checked"; ?> <?php endif ?>> Tidak Sehat/Kotor &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label>
                        <br>
                        <!-- 
                 <textarea name="ket_rambut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /> --><br />
                      </div>

                      <div class="col-md-6">
                        <label>2. Kulit Bercak, Keputihan,kemerahan/kehitaman

                        </label><br />
                        <label>
                          <input type="checkbox" class=" chb2 minimal" name="kulit" class="minimal" value="1" <?php if ($bersih->kulit == '1' || $bersih->kulit == '') : echo "checked"; ?> <?php endif ?>> Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="checkbox" class=" chb2 minimal" name="kulit" class="minimal" value="2" <?php if ($bersih->kulit == '2') : echo "checked"; ?> <?php endif ?>> Tidak Sehat/Kotor &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label>
                        <br>
                        <textarea required name="ket_kulit" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3" required="">{{$bersih->ket_kulit}}</textarea>
                        <!--  <br /> --><br />
                      </div>

                    </div>

                    <div id="smp2">


                      <div class="form-group box-body">
                        <div class="row">
                          <div class="col-md-6">
                            <label>3. Kulit Bersisik</label>
                            <br />
                            <label>
                              <input type="checkbox" class=" chb3 minimal" name="kulit_sisik" class="minimal" value="1" <?php if ($bersih->kulit_sisik == '1' || $bersih->kulit_sisik == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                              <input type="checkbox" class=" chb3 minimal" name="kulit_sisik" class="minimal" value="2" <?php if ($bersih->kulit_sisik == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                            </label><br /><br />
                          </div>
                          <div class="col-md-6">
                            <label>4. Kulit Ada Memar</label>
                            <br />
                            <label>
                              <input type="checkbox" class=" chb4 minimal" name="kulit_memar" class="minimal" value="1" <?php if ($bersih->kulit_memar == '1' || $bersih->kulit_memar == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                              <input type="checkbox" class=" chb4 minimal" name="kulit_memar" class="minimal" value="2" <?php if ($bersih->kulit_memar == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                            </label><br /><br />
                          </div>

                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <label>5. Kulit Ada Sayatan</label>
                            <br />
                            <label>
                              <input type="checkbox" class=" chb5 minimal" name="kulit_sayat" class="minimal" value="1" <?php if ($bersih->kulit_sayat == '1' || $bersih->kulit_sayat == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                              <input type="checkbox" class=" chb5 minimal" name="kulit_sayat" class="minimal" value="2" <?php if ($bersih->kulit_sayat == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                            </label><br /><br />
                          </div>
                          <div class="col-md-6">
                            <label>6. Kulit Ada Luka Koreng</label>
                            <br />
                            <label>
                              <input type="checkbox" class=" chb6 minimal" name="kulit_koreng" class="minimal" value="1" <?php if ($bersih->kulit_koreng == '1' || $bersih->kulit_koreng == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                              <input type="checkbox" class=" chb6 minimal" name="kulit_koreng" class="minimal" value="2" <?php if ($bersih->kulit_koreng == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                            </label><br /><br />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <label>
                              7. Kulit ada luka koreng sukar sembuh
                            </label><br />
                            <label>
                              <input type="checkbox" class=" chb7 minimal" name="kulit_koreng_sukar" class="minimal" value="1" <?php if ($bersih->kulit_koreng_sukar == '1' || $bersih->kulit_koreng_sukar == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                              <input type="checkbox" class=" chb7 minimal" name="kulit_koreng_sukar" class="minimal" value="2" <?php if ($bersih->kulit_koreng_sukar == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp


                            </label><!-- <br /><br /> --><br />
                          </div>
                          <div class="col-md-6">
                            <label>
                              8. Kulit ada bekas suntikan
                            </label><br />
                            <label>
                              <input type="checkbox" class=" chb8 minimal" name="kulit_suntik" class="minimal" value="1" <?php if ($bersih->kulit_suntik == '1' || $bersih->kulit_suntik == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                              <input type="checkbox" class=" chb8 minimal" name="kulit_suntik" class="minimal" value="2" <?php if ($bersih->kulit_suntik == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                            </label><br /><!-- <br />   -->
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <label>
                          9. Kuku
                        </label><br />
                        <label>
                          <input type="checkbox" class=" chb9 minimal" name="kuku" class="minimal" value="1" <?php if ($bersih->kuku == '1' || $bersih->kuku == '') : echo "checked"; ?><?php endif ?>> Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="checkbox" class=" chb9 minimal" name="kuku" class="minimal" value="2" <?php if ($bersih->kuku == '2') : echo "checked"; ?> <?php endif ?>> Kotor/Panjang &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br>
                        <!--  <textarea name="ket_kuku" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /> --><br />
                      </div>
                      <div class="col-md-6">

                      </div>

                    </div>

                  </div>

                  <input type="submit" style="color:white" class="btn btn-success" value="Simpan & Lanjut" />
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
<script>
  $(document).ready(function() {
    $(".chb1").change(function() {
      $(".chb1").prop('checked', false);
      $(this).prop('checked', true);
    });
    $(".chb2").change(function() {
      $(".chb2").prop('checked', false);
      $(this).prop('checked', true);
    });
    $(".chb3").change(function() {
      $(".chb3").prop('checked', false);
      $(this).prop('checked', true);
    });
    $(".chb4").change(function() {
      $(".chb4").prop('checked', false);
      $(this).prop('checked', true);
    });
    $(".chb5").change(function() {
      $(".chb5").prop('checked', false);
      $(this).prop('checked', true);
    });
    $(".chb6").change(function() {
      $(".chb6").prop('checked', false);
      $(this).prop('checked', true);
    });
    $(".chb7").change(function() {
      $(".chb7").prop('checked', false);
      $(this).prop('checked', true);
    });
    $(".chb8").change(function() {
      $(".chb8").prop('checked', false);
      $(this).prop('checked', true);
    });
    $(".chb9").change(function() {
      $(".chb9").prop('checked', false);
      $(this).prop('checked', true);
    });
  });
</script>
@endsection