
@layout('template/back/main')

@section('scripts-css')
<style type="text/css">
    input.invalid {
        background-color: #ffdddd;
    }
    textarea.invalid{
        background-color: #ffdddd;
    }
    .tab {
        display: none;
    }
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none; 
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }
    .step.active {
        opacity: 1;
        background-color: black;
    }
    .step.finish {
        background-color: green;
    }
</style>
@endsection
@section('content')
<!--  -->

<div class="container-fluid">
    </br>

    <center><h2><font color="green"> Edit Medical Check Up Siswa</font></h2></center>
    
 
    
    </br>
    <div class="content">
    <form action="{{base_url('cetak/update_mcu')}}" method="POST" oninput="pimt.value = parseFloat((+bb.value))/ (parseFloat((+tb.value*0.01))*parseFloat((+tb.value*0.01)));"  id="regForm">
        <div class="tab">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data diri</h4>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                            <?php 
                                $tgl_lahir = $content->tgl_lahir;
                                $dateString = $tgl_lahir;
                                $dateTime = datetime::createfromformat('Y-m-d',$dateString);
                                $today = new Datetime(date('d.m.y'));
                                $diff = $today->diff($dateTime);
                                
                                $period = array();
                                $limitperiod = array();
                                $x=0;
                                foreach ($jadwal as $jadwall) {
                                    $period[$x]=$jadwall->periode_mcu;
                                    $x++;
                                }
                                $y=0;
                                foreach ($limitjadwal as $limit) {
                                    $limitperiod[$y]=$limit->jadwal_mcu;
                                    $y++;
                                }
                            ?>
                            <?php 
                                //$final = array_unique( array_merge($period, $limitperiod) );
                                $final = array_diff($period, $limitperiod);
                            ?>
                            <input type="hidden" name="jenjang" id="jenjang" value="{{$content->jenjang}}">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" name="nis"  placeholder="nis" value="{{$content->nis}}" readonly><br />
                                    <input type="hidden" class="form-control" name="idsiswa"  placeholder="urut" value="{{$content->idsiswa}}" >
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama"  placeholder="Nama Siswa" value="{{$content->nama}}" readonly><br />
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" name="kelas" placeholder="Kelas" value="{{$content->kelas}}"readonly><br />
                                    <input type="hidden" name="a" id="tgl_lahirrr" value="{{$content->tgl_lahir}}">
                                </div>
                            </div>     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin <br  /></label>
                                    <input type="text" class="form-control" name="jeniskelamin"  placeholder="Nama Siswa" value="{{$content->jenis_kelamin}}" readonly id=gender><br />
                                    <label>Periode Medical Checkup</label>
                                    <select name="jadwal_screening" class="form-control" id="peri_mcu"  onchange="umur_js()"  >
                                        @foreach ($final as $finale)
                                        <option value="{{$finale}}">
                                            {{$finale}}
                                        </option>
                                        @endforeach
                                        <option value="{{$isi_mcu->jadwal_mcu}}" selected>{{$isi_mcu->jadwal_mcu}}</option>
                                    </select><br />
 
                                    <!-- <label>Usia saat Screening</label>
                                    <input type="text" value="{{$diff->y;}} Tahun  {{$diff->m}} Bulan" class="form-control" name="tahun" placeholder="Tahun Periksa" required readonly><br /> -->
                                    <label>Usia saat Screening</label>
                                    <input type="text"  class="form-control" name="tahun" value="{{$isi_mcu->tahun_usia.' Tahun '.$isi_mcu->bulan_usia.' Bulan'}}" placeholder="Usia" required readonly id="usiaa"><br />
                                    <input type="hidden" name="tahun_usia" value="{{$isi_mcu->usia_tahun}}" id="tahun_usiaa">
                                    <input type="hidden" name="bulan_usia" value="{{$isi_mcu->usia_bulan}}" id="bulan_usiaa">
           
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="box-header with-border">
                <div id="onlysmp">

              <div class="box-header with-border">
              <h3 class="box-title"><b>Pemeriksaan Tanda Vital</b></h3>
           </div>
             <div class="form-group box-body">
              <div class="row">
                <div class="col-md-6">
                    <label>1. Tekanan Darah (mm/Hg)</label>
                    <input type="text" class="form-control" name="tekanan_darah" placeholder="Tekanan Darah" required><br />  
                </div>
                <div class="col-md-6">
                  <label>2. Denyut Nadi (permenit)</label>
                 <input type="number" class="form-control" name="denyut_nadi" required placeholder="Denyut Nadi" required><br />  
                </div>

              </div>


              <div class="row">
                <div class="col-md-6">
                    <label>3. Frekuensi pernafasan (permenit)</label>
                    <input type="number" class="form-control" name="f_nafas" required placeholder="Frekuensi pernafasan" required><br />  
                </div>
                <div class="col-md-6">
                  <label>4. Suhu (dalam &#8451;)</label>
                 <input type="number" class="form-control" name="suhu" required placeholder="Suhu" required><br />  
                </div>
              </div>
              <div class="row">
                       <div class="col-md-6">
                      <label>
                        5. Bising jantung
                      </label><br />
                      <label>
                           <input type="radio" name="bising_jantung" class="minimal" value="1" required checked="" > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                           <input type="radio" name="bising_jantung" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
 

                      </label><br /><br /><br />  
                     </div>
                     <div class="col-md-6">
                     <label>
                        6. Bising Paru
                     </label><br />
                      <label>
                      <input type="radio" name="bising_paru" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="bising_paru" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label><br /><br /><br />  
                      </div>

                    </div>              
             </div>                
              </div>
              <input type="hidden" name="kode_mcu" value="{{$isi_mcu->kode_mcu}}">
                
              <h3 class="box-title"><b>A. Pemeriksaan Status Gizi</b></h3>
           </div>
             <div class="form-group box-body">
              <div class="row">
                <div class="col-md-6">
                    <label>1. Berat Badan (kg)</label>
                    <input type="number" class="form-control" name="bb" required placeholder="Berat Badan" required id="bb" oninput="hitung_Imt()" value="{{$isi_mcu->berat_badan}}" onchange="hitung_Imt()" ><br />  
                </div>
                <div class="col-md-6">
                  <label>2. Tinggi Badan (cm)</label>
                 <input type="number" class="form-control" name="tb" required placeholder="Tinggi Badan" required id="tb" oninput="hitung_Imt()" value="{{$isi_mcu->tinggi_badan}}"><br />  
                </div>

              </div>


              <div class="row" id="notsmp">
                <div class="col-md-6">
                    <label>3. Lingkar Kepala (cm)</label>
                    <input type="number" class="form-control" value="{{$isi_mcu->lingkar_kepala}}" name="lk" required placeholder="Lingkar Kepala" required><br />  
                </div>
                <div class="col-md-6">
                  <label>4. Lingkar Lengan Atas (cm)</label>
                 <input type="number" class="form-control" value="{{$isi_mcu->lingkar_lengan_atas}}" name="lla" required placeholder="Lingkar Lengan Atas" required><br />  
                </div>

              </div>


              <div class="row" id="notsmp2">
                <div class="col-md-6">
                    <label>5. Lingkar Perut (cm)</label>
                 <input type="number" class="form-control" name="lp" required placeholder="Lingkar Perut" value="{{$isi_mcu->lingkar_perut}}" required><br /> 
                </div>
                <div class="col-md-6">
                  
                </div>

              </div>

              
               
             </div>













             <div>
                <h4><label><font color="green"><b> Kategori Status Gizi</b></font></label></h4>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>6. IMT (BB/TB<sup>2</sup>)</label>
                        <div class="row">
                          <div class="col-md-8">           
                               <input type="number" class="form-control" name="pimt"  placeholder="IMT Hitung" readonly class="target" value="{{$isi_mcu->imt}}">
                          </div>
                          <div class="col-md-4" > 
                              <p id="cek" class="form-control"></p>
                          </div>
                

                        </div>
                      <br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                        7. Status Gizi
                        </label><br />
                        
                        <label>
                        <input type="radio" name="sg" class="minimal" value="1" required <?php if ($isi_mcu->status_gizi=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Sangat Kurus &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="sg" class="minimal" value="2" required <?php if ($isi_mcu->status_gizi=='2'):echo "checked"; ?>
                          
                        <?php endif ?> >  Kurus &nbsp&nbsp&nbsp&nbsp&nbsp

                        <input type="radio" name="sg" class="minimal" value="3" required <?php if ($isi_mcu->status_gizi=='3'):echo "checked"; ?>
                          
                        <?php endif ?> > Normal &nbsp&nbsp&nbsp&nbsp&nbsp

                        <input type="radio" name="sg" class="minimal" value="4" required <?php if ($isi_mcu->status_gizi=='4'):echo "checked"; ?>
                          
                        <?php endif ?>   > Gemuk &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="sg" class="minimal" value="5" required <?php if ($isi_mcu->status_gizi=='5'):echo "checked"; ?>
                          
                        <?php endif ?>  > Sangat Gemuk &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br /><br /><br />  
                    </div>

                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <label>
                        8. TB/U (Stuning)
                      </label><br />
                      <label>
 
                          
                        
                           <input type="radio" name="stuning" class="minimal" value="1" required <?php if ($isi_mcu->stuning=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                           <input type="radio" name="stuning" class="minimal" value="2" required <?php if ($isi_mcu->stuning=='2'):echo "checked"; ?>
                          
                        <?php endif ?>> Pendek &nbsp&nbsp&nbsp&nbsp&nbsp

                      </label><br /><br /><br />  
                     </div>
                     <div class="col-md-6">
                     <label>
                        9. BB/U
                     </label><br />
                      <label>
                      <input type="radio" name="bbper_u" class="minimal" value="2"  required <?php if ($isi_mcu->bbperu=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="bbper_u" class="minimal" value="1" required <?php if ($isi_mcu->bbperu=='1'):echo "checked"; ?>
                          
                        <?php endif ?>  > Gizi Kurang &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="bbper_u" class="minimal" value="3" required <?php if ($isi_mcu->bbperu=='3'):echo "checked"; ?>
                          
                        <?php endif ?> > Gizi Lebih &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label><br /><br /><br />  
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-md-6">
                      <label>
                        10. Tanda Klinis Anemia
                      </label><br>
                       <label>
                       <input type="radio" name="anemia" class="minimal" value="1" required <?php if ($isi_mcu->tanda_klinis_anemi=='1'):echo "checked"; ?>
                          
                        <?php endif ?>  > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                       <input type="radio" name="anemia" class="minimal" value="2" required <?php if ($isi_mcu->tanda_klinis_anemi=='2'):echo "checked"; ?>
                          
                        <?php endif ?>   > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                       </label> <br>
                       <textarea name="ket_anemia" class="form-control" rows="3" cols="10" placeholder="Penjelasan. jika kosong isi dengan tanda '-' " required=""  >{{$isi_mcu->ket_tanda_anemia}}</textarea>
                       <br> 
                     </div>
                     <div class="col-md-6">
                      <input type="hidden" name="kurus" id="kuruss" value="{{$isi_mcu->kurus}}" >
                      <input type="hidden" name="batas_bawah" id="batas_bawahh" value="{{$isi_mcu->batas_bawah}}">
                      <input type="hidden" name="ideal" id="ideall" value="{{$isi_mcu->ideal}}">
                      <input type="hidden" name="batas_atas" id="batas_atass" value="{{$isi_mcu->batas_atas}}">
                      <input type="hidden" name="gemuk" id="gemukk" value="{{$isi_mcu->berlebih}}">
                  
                    
                     </div>

                    </div>            
                 </div> <!-- akhir form group -->



               </div>
               <div class="box-header with-border">
          <h3 class="box-title"><b>B. Pemeriksaan Umum</b></h3>
        </div>
        <div class="box-body">

             <div class="form-group" id="notsmp3">
            <h4><label><font color="green"><b> Kepala</b></font></label></h4>
                    <div class="row">
                       <div class="col-md-6">
                       <label>
                         1. Mata
                        </label><br />
                        <label>
                        <input type="radio" name="mata" class="minimal" value="1" required <?php if ($isi_mcu->mata=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="mata" class="minimal" value="2" required <?php if ($isi_mcu->mata=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br>
                        <textarea name="ket_mata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_mata}}</textarea>
                        <br /><br />  
                      </div>
                
                    <div class="col-md-6">                                
                      <label>
                        2. Hidung
                      </label><br />
                      <label>
                        <input type="radio" name="hidung" class="minimal" value="1"  required <?php if ($isi_mcu->hidung=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="hidung" class="minimal" value="2" required <?php if ($isi_mcu->hidung=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label> <br>
                      <textarea name="ket_hidung" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_hidung}}</textarea>
                        <br /><br />  
                    </div>

                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <label>
                  3. Rongga Mulut
                </label><br />
                <label>
                  <input type="radio" name="mulut" class="minimal" value="1" required <?php if (($isi_mcu->rongga_mulut=='1') ||($isi_mcu->rongga_mulut=='N')):echo "checked"; ?>
                          
                        <?php endif ?> > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="mulut" class="minimal" value="2" required <?php if ($isi_mcu->rongga_mulut=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Gangguan/Kelainan &nbsp&nbsp&nbsp&nbsp&nbsp
                </label> <br>
                 <textarea name="ket_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_rongga_mulut}}</textarea>
                <br /><br /> 
                     </div>
                     <div class="col-md-6">
                      
                      </div>

                    </div>
         
                </div>  <!-- akhir form group -->








                <div class="form-group" id="notsmp4">
                    <h4><label><font color="green"><b> Thorax</b></font></label></h4>
                    <div class="row">
                       <div class="col-md-6">
                       <label>
                          4. Jantung
                        </label><br />
                        <label>
                          <input type="radio" name="jantung" class="minimal" value="Normal"  required  <?php if ($isi_mcu->jantung=='Normal'):echo "checked"; ?>
                          
                        <?php endif ?> > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="radio" name="jantung" class="minimal" value="Gangguan" required  <?php if ($isi_mcu->jantung=='Gangguan'):echo "checked"; ?>
                          
                        <?php endif ?> > Gangguan &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label>
                        <br>
                         <textarea name="ket_jantung" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">-</textarea>
                        <br /><br /> 
                      </div>
                
                    <div class="col-md-6">                                
                        <label>
                          5. Paru
                        </label><br />
                        <label>
                          <input type="radio" name="paru" class="minimal" value="1" required <?php if ($isi_mcu->paru=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="radio" name="paru" class="minimal" value="2" required <?php if ($isi_mcu->paru=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Gangguan &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label>
                        <br>
                         <textarea name="ket_paru" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_paru}}</textarea>
                        <br /><br />   
                    </div>
                    
                    <div class="col-md-6">                                
                        <label>
                          6. Pemeriksaan Neurologi
                        </label><br />
                        <br>
                         <textarea name="ket_neurologi" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">-</textarea>
                        <br /><br />   
                    </div>

                  </div>
       
                </div>  <!-- akhir form group -->




                  <div class="form-group">
                    <h4><label><font color="green"><b> Kebersihan Diri</b></font></label></h4>
                    <div class="row">
                       <div class="col-md-6">
                       <label>
                  5. Rambut
                </label><br />
                <label>
                  <input type="radio" name="rambut" class="minimal" value="1"  required <?php if ($isi_mcu->rambut=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="rambut" class="minimal" value="2" required <?php if ($isi_mcu->rambut=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak Sehat/Kotor &nbsp&nbsp&nbsp&nbsp&nbsp
                </label>
                <br>
                 <textarea name="ket_rambut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_rambut}}</textarea>
                <br /><br />
                      </div>
                
                    <div class="col-md-6">                                
                      <label>
                  6. Kulit
                </label><br />
                <label>
                  <input type="radio" name="kulit" class="minimal" value="1" required <?php if ($isi_mcu->kulit=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="kulit" class="minimal" value="2" required <?php if ($isi_mcu->kulit=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak Sehat/Kotor &nbsp&nbsp&nbsp&nbsp&nbsp
                </label>
                <br>
                 <textarea name="ket_kulit" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_kulit}}</textarea>
                <br /><br /> 
                    </div>

                  </div>
                    <div id="smp2">

              
             <div class="form-group box-body">
              <div class="row">
                <div class="col-md-6">
                    <label>Kulit Bersisik</label>
                    <br />
                      <label>
                      <input type="radio" name="kulit_sisik" class="minimal" value="1" required <?php if ($isi_mcu->kulit_sisik=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="kulit_sisik" class="minimal" value="2" required <?php if ($isi_mcu->kulit_sisik=='2'):echo "checked"; ?>
                          
                        <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label><br /><br /> 
                </div>
                <div class="col-md-6">
                  <label>Kulit Ada Memar</label>
                 <br />
                      <label>
                      <input type="radio" name="kulit_memar" class="minimal" value="1" checked required><?php if ($isi_mcu->kulit_memar=='1'):echo "checked"; ?>
                          
                        <?php endif ?>  Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="kulit_memar" class="minimal" value="2" required <?php if ($isi_mcu->kulit_memar=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label><br /><br />  
                </div>

              </div>


              <div class="row">
                <div class="col-md-6">
                    <label>Kulit Ada Sayatan</label>
                    <br />
                      <label>
                      <input type="radio" name="kulit_sayatan" class="minimal" value="1"  required <?php if ($isi_mcu->kulit_sayatan=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="kulit_sayatan" class="minimal" value="2" required <?php if ($isi_mcu->kulit_sayatan=='2'):echo "checked"; ?>
                          
                        <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label><br /><br />
                </div>
                <div class="col-md-6">
                  <label>Kulit Ada Luka Koreng</label>
                 <br />
                      <label>
                      <input type="radio" name="kulit_koreng" class="minimal" value="1"  required <?php if ($isi_mcu->kulit_koreng=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="kulit_koreng" class="minimal" value="2" required <?php if ($isi_mcu->kulit_koreng=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label><br /><br /> 
                </div>
              </div>
              <div class="row">
                       <div class="col-md-6">
                      <label>
                        Kulit ada luka koreng sukar sembuh
                      </label><br />
                      <label>
                           <input type="radio" name="kulit_koreng_sukar" class="minimal" value="1" required <?php if ($isi_mcu->kulit_koreng_sukar=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                           <input type="radio" name="kulit_koreng_sukar" class="minimal" value="2" required <?php if ($isi_mcu->kulit_koreng_sukar=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
 

                      </label><br /><br /><br />  
                     </div>
                     <div class="col-md-6">
                     <label>
                        Kulit ada bekas suntikan
                     </label><br />
                      <label>
                      <input type="radio" name="kulit_suntik" class="minimal" value="1" required <?php if ($isi_mcu->kulit_suntik=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="kulit_suntik" class="minimal" value="2" required <?php if ($isi_mcu->kulit_suntik=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label><br /><br />  
                      </div>

                    </div>              
             </div>                
              </div>


                 <script type="text/javascript">

                        //var kelas = document.getElementById("kelas").value;
                        var jenjang = document.getElementById("jenjang").value;
                       //var  kelas_sub = kelas.substring(0,1);
                        //var jenjang = "<?php echo ($content->jenjang) ?>";
                        
                        if (jenjang=="44") {

                          var notsmp = document.getElementById("notsmp");
                          var notsmp2 = document.getElementById("notsmp2");
                          var notsmp3 = document.getElementById("notsmp3");
                          var notsmp4 = document.getElementById("notsmp4");
                          notsmp.remove();
                          notsmp2.remove();
                          notsmp3.remove();
                          notsmp4.remove();



                        }
                        else{
                              var esempe = document.getElementById("onlysmp");
                              var smp2 = document.getElementById("smp2");
                              var smp3 = document.getElementById("smp3");
                            //alert(jenjang);  
                        esempe.remove();
                        smp2.remove();
                        smp3.remove();

                        

                            }
                        
                    
                 </script>

                  <div class="row">
                    <div class="col-md-6">
                      <label>
                  7. Kuku
                </label><br />
                <label>
                  <input type="radio" name="kuku" class="minimal" value="1"  required <?php if ($isi_mcu->kuku=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="kuku" class="minimal" value="2" required <?php if ($isi_mcu->kuku=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Kotor/Panjang &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_kuku" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_kuku}}</textarea>
                <br /><br />
                     </div>
                     <div class="col-md-6">
                      
                      </div>

                    </div>
         
                </div>  <!-- akhir form group -->

         
        </div>
                </div> <!-- end of card body -->
            </div>
        </div>
         
         </div>


 
















  
      <!-- /.box1 -->
      
      <!-- /.box1 -->
      <div class="tab">
        <div class="card">
        <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>C. Pemeriksaan Kesehatan Gigi dan Mulut</b></h3>
        </div>
        <div class="box-body">
            
            <div class="form-group">
        <h4><label><font color="green"><b> Kesehatan Rongga Mulut</b></font></label></h4>
                    <div class="row">
                      <div class="col-md-6">
                         <label>
                  1. Celah bibir/ Langit-langit
                </label><br />
                <label>
                  <input type="radio" name="bibir" class="minimal" value="1"  required <?php if ($isi_mcu->celah_bibir=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="bibir" class="minimal" value="2" required <?php if ($isi_mcu->celah_bibir=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_bibir" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_celah_bibir}}</textarea>
                <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                  2. Luka Pada Sudut Mulut
                </label><br />
                <label>
                  <input type="radio" name="sudut_mulut" class="minimal" value="1" required <?php if ($isi_mcu->luka_sudut_mulut=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="sudut_mulut" class="minimal" value="2" required <?php if ($isi_mcu->luka_sudut_mulut=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                <textarea name="ket_sudut_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_luka_sudut_mulut}}</textarea>
                <br /><br />  
                    </div>

                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <label>
                  3. Sariawan
                </label><br />
                <label>
                  <input type="radio" name="sariawan" class="minimal" value="1"required <?php if ($isi_mcu->sariawan=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="sariawan" class="minimal" value="2" required <?php if ($isi_mcu->sariawan=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label> <br>
                 <textarea name="ket_sariawan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_sariawan}}</textarea>
                <br /><br />  
                     </div>
                     <div class="col-md-6">
                     <label>
                  4. Lidah Kotor
                </label><br />
                <label>
                  <input type="radio" name="lidah" class="minimal" value="1" required <?php if ($isi_mcu->lidah_kotor=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="lidah" class="minimal" value="2" required <?php if ($isi_mcu->lidah_kotor=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_lidah" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_lidah_kotor}}</textarea>
                <br /><br />  
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-md-6">
                      <label>
                  5. Luka Lainnya
                </label><br />
                <label>
                  <input type="radio" name="luka_lain" class="minimal" value="1" required <?php if ($isi_mcu->luka_lainnya=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="luka_lain" class="minimal" value="2" required <?php if ($isi_mcu->luka_lainnya=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_luka_lain" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_luka_lainnya}}</textarea>
                <br /><br /> 
                     </div>
                     <div class="col-md-6">
                        <label>
                          6. Masalah Lainnya
                        </label><br />
                         <textarea name="ket_masalah_lain_rongga_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_masalah_lain_rongga_mulut}}</textarea>
                        <br /><br /> 
                     </div>

                    </div>            
                 </div> <!-- akhir form group -->





                 <div class="form-group">
                    <h4><label><font color="green"><b> Kesehatan Gigi dan Gusi</b></font></label></h4>
                    <div class="row">
                       <div class="col-md-6">
                       <label>
                  6. Caries
                </label><br />
                <label>
                  <input type="radio" name="caries" class="minimal" value="1"  required <?php if ($isi_mcu->caries=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="caries" class="minimal" value="2" required <?php if ($isi_mcu->caries=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_caries" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_caries}}</textarea>
                <br /><br />
                      </div>
                
                    <div class="col-md-6">                                
                      <label>
                  7. Susunan Gigi Depan Tidak Teratur
                </label><br />
                <label>
                  <input type="radio" name="gigi_dep" class="minimal" value="1"required <?php if ($isi_mcu->gigi_dep_beraturan=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="gigi_dep" class="minimal" value="2" required <?php if ($isi_mcu->gigi_dep_beraturan=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_gigi_dep" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_gigi_dep_beraturan}}</textarea>
                <br /><br /> 
                    </div>
                    <div class="col-md-6">
                        <label style="margin-top: 5px">
                          8. Masalah Lainnya
                        </label>
                         <textarea name="ket_masalah_lain_gigi_gusi" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_masalah_lain_gigi_gusi}}</textarea>
                        <br /><br /> 
                     </div>
                     <div class="col-md-6">
                        
                     </div>

                  </div>


                 
                </div> <!-- akhir form group -->          



        </div>
        <!-- /.box-body -->
              <div class="box-header with-border">
          <h3 class="box-title"><b>D. Pemeriksaan Kesehatan</b></h3>
        </div>
        <div class="box-body">
              <div class="form-group">
        <h4><label><font color="green"><b> Penglihatan</b></font></label></h4>
                    <div class="row">
                      <div class="col-md-6">
                          <label>
                  1. Mata Luar
                </label><br />
                <label>
                  <input type="radio" name="mata_luar" class="minimal" value="1" required <?php if ($isi_mcu->mata_luar=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="mata_luar" class="minimal" value="2" required <?php if ($isi_mcu->mata_luar=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_mata_luar" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_mata_luar}}</textarea>
                <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                  2. Tajam Penglihatan
                </label><br />
                <label>
                  <input type="radio" name="penglihatan" class="minimal" value="1" checked required <?php if ($isi_mcu->tajam_penglihatan=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="penglihatan" class="minimal" value="2" required <?php if ($isi_mcu->tajam_penglihatan=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Low Vission &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="penglihatan" class="minimal" value="3" required <?php if ($isi_mcu->tajam_penglihatan=='3'):echo "checked"; ?>
                          
                        <?php endif ?> > Kebutaan &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="penglihatan" class="minimal" value="4" required <?php if ($isi_mcu->tajam_penglihatan=='4'):echo "checked"; ?>
                          
                        <?php endif ?> > Kelainan Refraksi &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_penglihatan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_tajam_penglihatan}}</textarea>
                <br /><br />  
                    </div>

                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <label>
                   3. Kacamata
                </label><br />
                <label>
                  <input type="radio" name="kacamata" class="minimal" value="1"required <?php if ($isi_mcu->kacamata=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="kacamata" class="minimal" value="2" required <?php if ($isi_mcu->kacamata=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_kacamata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_kacamata}}</textarea>
                <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                 4. Infeksi
                </label><br />
                <label>
                  <input type="radio" name="inf_mata" class="minimal" value="1" required <?php if ($isi_mcu->infeksi_mata=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="inf_mata" class="minimal" value="2" required <?php if ($isi_mcu->infeksi_mata=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_inf_mata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3" >{{$isi_mcu->ket_infeksi_mata}}</textarea>
                <br /><br />  
                    </div>
                    <div class="col-md-6">
                        <label>
                          5. Masalah Lainnya
                        </label><br />
                         <textarea name="ket_masalah_lain_penglihatan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_masalah_lain_penglihatan}}</textarea>
                        <br /><br /> 
                     </div>
                     <div class="col-md-6">
                        
                     </div>

                  </div>
         
                 </div> <!-- akhir form group -->






                <div class="form-group">
                 <h4><label><font color="green"><b> Pendengaran</b></font></label></h4>
                    <div class="row">
                      <div class="col-md-6">
                          <label>
                              5. Telinga Luar
                          </label><br />
                          <label>
                          <input type="radio" name="telinga" class="minimal" value="1" required <?php if ($isi_mcu->telinga_luar=='1'):echo "checked"; ?>
                          
                        <?php endif ?> > Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="radio" name="telinga" class="minimal" value="2" required <?php if ($isi_mcu->telinga_luar=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Infeksi &nbsp&nbsp&nbsp&nbsp&nbsp
                          </label><br>
                          <textarea name="ket_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_telinga_luar}}</textarea>
                          <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                         6. Serumen
                        </label><br />
                      <label>
                        <input type="radio" name="kot_telinga" class="minimal" value="1"  required <?php if ($isi_mcu->kotoran_telinga=='Tidak'):echo "checked"; ?>
                          
                        <?php endif ?> > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="kot_telinga" class="minimal" value="2" required <?php if ($isi_mcu->kotoran_telinga=='Ya'):echo "checked"; ?>
                          
                        <?php endif ?> > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br>
                        <textarea name="ket_kot_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_kotoran_telinga}}</textarea>
                        <br /><br />  
                    </div>

                   </div>


                   <div class="row">
                      <div class="col-md-6">
                          <label>
                              7. Infeksi
                          </label><br />
                          <label>
                          <input type="radio" name="inf_telinga" class="minimal" value="1"  required <?php if ($isi_mcu->infeksi_telinga=='1'):echo "checked"; ?>
                          
                        <?php endif ?> >Tidak&nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="radio" name="inf_telinga" class="minimal" value="2" required <?php if ($isi_mcu->infeksi_telinga=='2'):echo "checked"; ?>
                          
                        <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                          </label><br>
                          <textarea name="ket_inf_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_infeksi_telinga}}</textarea>
                          <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                         8. Tajam Pendengaran
                        </label><br />
                      <label>
                        <input type="radio" name="tajam_pendengaran" class="minimal" value="1" required <?php if ($isi_mcu->tajam_pendengaran=='1'):echo "checked"; ?>
                          
                        <?php endif ?> >Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="tajam_pendengaran" class="minimal" value="2" required <?php if ($isi_mcu->tajam_pendengaran=='2'):echo "checked"; ?>
                          
                        <?php endif ?> > Ada Gangguan &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br>
                        <textarea name="ket_tajam_pendengaran" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_tajam_pendengaran}}</textarea>
                        <br /><br />  
                    </div>
                    <div class="col-md-6">
                        <label>
                          9. Masalah Lainnya
                        </label><br />
                         <textarea name="ket_masalah_lain_pendengaran" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$isi_mcu->ket_masalah_lain_pendengaran}}</textarea>
                        <br /><br /> 
                     </div>
                     <div class="col-md-6">
                        
                     </div>

                   </div>

     
                 </div> <!-- akhir form group --> 
        </div>
        <div class="box-header with-border">
          <h3 class="box-title"> <b> E. Lainnya</b></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <label><h5>Gangguan Mental Emosional</h5></label>
                <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="mental">{{$isi_mcu->gangguan_mental}}</textarea>

            </div>


            <div class="col-md-6">
            <label><h5> Kesimpulan</h5></label>
                <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="kesimpulan">{{$isi_mcu->kesimpulan}}</textarea>                 
              
            </div>            
          </div>
          <br>

          <div class="row">
            <div class="col-md-6">
                    <label><h5>Saran  </h5></label>
                <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="saran">{{$isi_mcu->saran}}</textarea>
            

            </div>

            <div class="col-md-6">
                         
                   
                        <h4><label><font color="green"><b> Follow Up</b></font></label></h4>
                        <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="followup">{{$isi_mcu->followup}}</textarea>
                                            <input type="hidden" name="status_followup" class="minimal" value="{{$isi_mcu->status_followup}}">
                   

                    
            </div>            
          </div>  
          <br>
<!-- 
     <input type=" hidden"  class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="followup" value="{{$isi_mcu->followup}}" >
                                            <input type="hidden" name="status_followup" class="minimal" value="{{$isi_mcu->status_followup}}">
                    -->
  

        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                 <label>Lokasi Periksa</label>
                 <input type="text" class="form-control" name="lokasi" required value="{{$isi_mcu->lokasi}}" required><br />
                 <label>Tanggal Periksa</label>
                 <input type="date" class="form-control" name="tanggal" value="{{$isi_mcu->tgl_periksa}}" required placeholder="Tanggal ..." required><br />
               </div>
            </div>     
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Dokter Periksa</label>
                 <select name="dokter" class="form-control" >
                    <option value="dr. Ani" <?php if ($isi_mcu->dokter=="dr. Ani") {
                      echo "selected";
                    } ?> >dr. Ani
                    </option>
                    <option value="dr. Yuliana" <?php if ($isi_mcu->dokter=="dr. Yuliana") {
                      echo "selected";
                    } ?> >dr. Yuliana
                    </option>
                    <option value="dr. Fitri" <?php if ($isi_mcu->dokter=="dr. Fitri") {
                      echo "selected";
                    } ?> >dr. Fitri
                    </option>
                    <option value="drg. Despita" <?php if ($isi_mcu->dokter=="drg. Despita") {
                      echo "selected";
                    } ?> >drg. Despita
                    </option>
                    <option value="drg. Nur Uswatun" <?php if ($isi_mcu->dokter=="drg. Nur Uswatun") {
                      echo "selected";
                    } ?> >drg. Nur Uswatun
                    </option>
                    </select><br />
                
                <br />
                
                 
              </div>
            </div>
          </div>
      </div>  <!-- end of box -->
    </div> <!-- end of card -->
      </div>
      





      




     
        

  <div class="box-footer" align="center">
      <div style="overflow:auto;">
 <!--  <div style="float:right;">
    <div align="center" class="box-footer">
    <button type="button" id="prevBtn" onclick="nextPrev(-1)" align="center" class="btn btn-success">Previous</button>
    <button type="button" id="nextBtn" onclick="nextPrev(1)" align="center" class="btn btn-success ">Next</button>  
    </div>
    
  </div> -->
</div>

<!-- Circles which indicates the steps of the form: -->

<div style="text-align:center; margin-bottom:10px;">
   <span class="step"></span>
   <span class="step"></span>
</div>


          <div align="center" class="box-footer" >
    <button type="button" id="prevBtn" onclick="nextPrev(-1)" align="center" class="btn btn-success">Previous</button>
    <button type="button" id="nextBtn" onclick="nextPrev(1)" align="center" class="btn btn-success ">Next</button> 
                
          </div>
        </div>
</form>
  
</div>
</div>


@endsection
@section('scripts-js')
<script type="text/javascript">
    

    function hitung_Imt(){


        var bb = document.getElementById("bb").value;
        var tb = document.getElementById("tb").value;
        var jk = document.getElementById("gender").value;
        var usia= document.getElementById("usiaa").value;
        var tahun_usia_mcu  = document.getElementById("tahun_usiaa").value;
        var bulan_usia_mcu = document.getElementById("bulan_usiaa").value;


    <?php foreach ($imtdbb as $key): ?>

    if ((tahun_usia_mcu =="<?php echo $key->tahun_usia;?>") && (bulan_usia_mcu =="<?php echo $key->bulan_usia;?>")) {
      var sangat_kurus = "<?php echo($key->sangat_kurus); ?>";       
      var kurus = "<?php echo($key->kurus); ?>";
      var batas_bawah = "<?php echo($key->batas_bawah); ?>";
      var ideal = "<?php echo($key->ideal); ?>";
      var batas_atas = "<?php echo($key->batas_atas); ?>";
      var gemuk = "<?php echo($key->berlebih); ?>";
      var sangat_gemuk = "<?php echo($key->sangat_berlebih); ?>";
      // alert(kurus);


      

    }
  
    <?php endforeach ?>


        
        var imt;
        imt = (bb)/((tb*0.01)*(tb*0.01));
        // var bulan_usia = <?php Print($diff->m);  ?>;
        // var tahun_usia = <?php Print($diff->y);  ?>;
        var gender = document.getElementById("gender").value;

        // if (imt<=kurus){
        //     document.getElementById("cek").innerHTML = "kurus";
        // }else if(imt>=gemuk){
        //     document.getElementById("cek").innerHTML = "gemuk";
        // }else{
        //     document.getElementById("cek").innerHTML = "ideal";
        // };

        if (imt<=sangat_kurus) {
          document.getElementById("cek").innerHTML = " Sangat kurus";
 //         alert(imt);
        }
        else if ((sangat_kurus<imt) && (imt<=kurus)) {
          document.getElementById("cek").innerHTML = "tes";
          alert (imt);
        }
        else if ((kurus<imt)&&(imt<=batas_atas)) {
          document.getElementById("cek").innerHTML = "Ideal";

        }
        else if ((batas_atas<imt)&&(imt<sangat_gemuk)) {
          document.getElementById("cek").innerHTML = "Gemuk";
        }

        else if (imt>=sangat_gemuk) {
          document.getElementById("cek").innerHTML = "Sangat Gemuk";
        };


       
    document.getElementById("kuruss").value       = kurus;
    document.getElementById("batas_bawahh").value = batas_bawah;
    document.getElementById("ideall").value       = ideal;
    document.getElementById("batas_atass").value  = batas_atas;
    document.getElementById("gemukk").value       = gemuk;

    }

function umur_js(){

var peri_mcu      = document.getElementById("peri_mcu").value;
var tgl_lahirrr   = document.getElementById("tgl_lahirrr").value;
var tahun_mcu  = peri_mcu.substring(peri_mcu.length - 4, peri_mcu.length);
  
var birthday = new Date(tgl_lahirrr);


if (peri_mcu.includes("Januari")) {
  
  var bulan_hitung = 0;

}
else if (peri_mcu.includes("Februari")) {
var bulan_hitung = 1;
}

else if (peri_mcu.includes("Maret")) {
var bulan_hitung = 2;
}
else if (peri_mcu.includes("April")) {
var bulan_hitung = 3;
}
else if (peri_mcu.includes("Mei")) {
var bulan_hitung = 4;
}
else if (peri_mcu.includes("Juni")) {
var bulan_hitung = 5;
}
else if (peri_mcu.includes("Juli")) {
var bulan_hitung = 6;
}
else if (peri_mcu.includes("Agustus")) {
var bulan_hitung = 7;
}
else if (peri_mcu.includes("September")) {
var bulan_hitung = 8;
}

else if (peri_mcu.includes("Oktober")) {
var bulan_hitung = 9;
}
else if (peri_mcu.includes("November")) {
var bulan_hitung = 10;
}
else if (peri_mcu.includes("Desember")) {
var bulan_hitung = 11;
}
    var dobYear = birthday.getYear();
    var dobMonth = birthday.getMonth();
    var dobDate = birthday.getDate();
    
    //get the current date from the system
    var now = new Date(tahun_mcu,bulan_hitung);
    //extract the year, month, and date from current date
    var currentYear = now.getYear();
    var currentMonth = now.getMonth();
    var currentDate = now.getDate();
  
    //declare a variable to collect the age in year, month, and days
    var age = {};
    var ageString = "";
     yearAge = currentYear - dobYear;
  
    //get months
    if (currentMonth >= dobMonth)
      //get months when current month is greater
      var monthAge = currentMonth - dobMonth;
    else {
      yearAge--;
      var monthAge = 12 + currentMonth - dobMonth;
    }

    //get days
    if (currentDate >= dobDate)
      //get days when the current date is greater
      var dateAge = currentDate - dobDate;
    else {
      monthAge--;
      var dateAge = 31 + currentDate - dobDate;

      if (monthAge < 0) {
        monthAge = 11;
        yearAge--;
      }
    }
    //group the age in a single variable
    age = {
    years: yearAge,
    months: monthAge,
    days: dateAge
    };
      
      
  

    //ageyears berupa tahun
    //age month berupa bulan
   //nilai akhir berupa  variabel ageString
   document.getElementById("usiaa").value = age.years+" Tahun "+age.months+" Bulan";
     var agee = age.years.toString();
   var monthss =  age.months.toString();
   document.getElementById("tahun_usiaa").value = agee;
   document.getElementById("bulan_usiaa").value = monthss;

}
 

</script>
@endsection