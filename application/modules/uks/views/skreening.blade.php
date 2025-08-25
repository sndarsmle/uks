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
<div class="container-fluid">
    </br>
    <center><h2><font color="green"> Screening Siswa</font></h2></center>
    
     

    </br>
    <div class="content">
    <form action="inputscreening" method="post" oninput="pimt.value = parseFloat((+bb.value))/ (parseFloat((+tb.value*0.01))*parseFloat((+tb.value*0.01)));"  id="regForm">
      <div style="padding-top: 0px;">
        <div class="">

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
                                
                              ?>
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
                                    <label>Periode  Screening</label>
                                    <select name="jadwal_screening" class="form-control" id="peri_mcu" onchange="umur_js()" >
                                        @foreach ($jadwal as $jadwale)
                                        <option value="{{$jadwale->periode_mcu}}">
                                            {{$jadwale->periode_mcu}}
                                        </option>
                                        @endforeach
                                    </select><br />
 
                                    <!-- <label>Usia saat Screening</label>
                                    <input type="text" value="{{$diff->y;}} Tahun  {{$diff->m}} Bulan" class="form-control" name="tahun" placeholder="Tahun Periksa" required readonly><br /> -->
                                    <label>Usia saat Screening</label>
                                    <input type="text"  class="form-control" name="tahun" placeholder="Usia" required readonly id="usiaa"><br />
                                    <input type="hidden" name="polo" id="bolo" value="abogoboga">
                                    <input type="hidden" name="tahun_usia" id="tahun_usiaa" value="5">
                                    <input type="hidden" name="bulan_usia" id="bulan_usiaa" value="6">
           
                                </div>
                            </div>
                        </div>
                    </div>
              <div id="onlysmp">

              <div class="box-header with-border">
              <h3 class="box-title"><b>Pemeriksaan Tanda Vital</b></h3>
           </div>
             <div class="form-group box-body">
              <div class="row">
                <div class="col-md-6">
                    <label>1. Tekanan Darah (mm/Hg)</label>
                    <input type="number" class="form-control" name="tekanan_darah" placeholder="Tekanan Darah" required><br />  
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
            <div class="box-header with-border">
              <h3 class="box-title"><b>A. Pemeriksaan Status Gizi</b></h3>
           </div>
             <div class="form-group box-body">
              <div class="row">
                <div class="col-md-6">
                    <label>1. Berat Badan (kg)</label>
                    <input type="number" class="form-control" name="bb" required placeholder="Berat Badan" required id="bb" oninput="hitung_Imt()"><br />  
                </div>
                <div class="col-md-6">
                  <label>2. Tinggi Badan (cm)</label>
                 <input type="number" class="form-control" name="tb" required placeholder="Tinggi Badan" required id="tb" oninput="hitung_Imt()"><br />  
                </div>

              </div>


              <div class="row">
                <div class="col-md-6">
                    <label>3. Lingkar Kepala (cm)</label>
                    <input type="number" class="form-control" name="lk" required placeholder="Lingkar Kepala" required><br />  
                </div>
                <div class="col-md-6">
                  <label>4. Lingkar Lengan Atas (cm)</label>
                 <input type="number" class="form-control" name="lla" required placeholder="Lingkar Lengan Atas" required><br />  
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <label>5. Lingkar Perut (cm)</label>
                 <input type="number" class="form-control" name="lp" required placeholder="Lingkar Perut" required><br /> 
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
                               <input type="number" class="form-control" name="pimt"  placeholder="IMT Hitung" readonly class="target">
                          </div>
                          <div class="col-md-4" > 
                              <p id="cek" class="form-control">coba</p>
                          </div>
                

                        </div>
                      <br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                        7. Status Gizi
                        </label><br />
                        <label>
                        <input type="radio" name="sg" class="minimal" value="1" required > Sangat Kurus &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="sg" class="minimal" value="2" required > Kurus &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="sg" class="minimal" value="3" required  checked> Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="sg" class="minimal" value="4" required > Gemuk &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="sg" class="minimal" value="5" required > Sangat Gemuk &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br /><br /><br />  
                    </div>

                  </div>


                  <div class="row">
                       <div class="col-md-6">
                      <label>
                        8. TB/U (Stuning)
                      </label><br />
                      <label>
                           <input type="radio" name="stun" class="minimal" value="1" required checked > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                           <input type="radio" name="stun" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                           

                      </label><br /><br /><br />  
                     </div>
                     <div class="col-md-6">
                     <label>
                        9. BB/U
                     </label><br />
                      <label>
                      <input type="radio" name="bbper_u" class="minimal" value="2" checked required > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="bbper_u" class="minimal" value="1" required > Gizi Kurang &nbsp&nbsp&nbsp&nbsp&nbsp
                      <input type="radio" name="bbper_u" class="minimal" value="3" required > Gizi Lebih &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label><br /><br /><br />  
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-md-6">
                      <label>
                        10. Tanda Klinis Anemia
                      </label><br>
                       <label>
                       <input type="radio" name="anemia" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                       <input type="radio" name="anemia" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                       </label> <br>
                       <textarea name="ket_anemia" class="form-control" rows="3" cols="10" placeholder="Penjelasan. jika kosong isi dengan tanda '-' " required=""></textarea>
                       <br> 
                     </div>
                     <div class="col-md-6">
                      <input type="hidden" name="kurus" id="kuruss" value="">
                      <input type="hidden" name="batas_bawah" id="batas_bawahh">
                      <input type="hidden" name="ideal" id="ideall">
                      <input type="hidden" name="batas_atas" id="batas_atass">
                      <input type="hidden" name="gemuk" id="gemukk">
                  
                     </div>

                    </div>            
                 </div> <!-- akhir form group -->

                 <script type="text/javascript">
                        var kelas = document.getElementById("kelas").value;
                        kelas_sub = kelas.substring(0,1);
                        if (kelas_sub=="7") {}
                        else if(kelas_sub=="8") 
                          {

                          }
                        else if (kelas_sub=="9") {}
                        else{
                              var esempe = document.getElementById("onlysmp");
                        esempe.remove();
                            }
                        
                    
                 </script>

               </div>
           <div class="box-header with-border">
          <h3 class="box-title"><b>B. Pemeriksaan Umum</b><br></h3>

        </div>
        <div class="box-body">

             <div class="form-group">
            <h4><label><font color="green"><b> Kepala</b></font></label></h4>
                    <div class="row">
                       <div class="col-md-6">
                       <label>
                         1. Mata
                        </label><br />
                        <label>
                        <input type="radio" name="mata" class="minimal" value="1" checked required > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="mata" class="minimal" value="2" required > Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br>
                        <textarea name="ket_mata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                        <br /><br />  
                      </div>
                
                    <div class="col-md-6">                                
                      <label>
                        2. Hidung
                      </label><br />
                      <label>
                        <input type="radio" name="hidung" class="minimal" value="1" checked required > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="hidung" class="minimal" value="2" required > Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                      </label> <br>
                      <textarea name="ket_hidung" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                        <br /><br />  
                    </div>

                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <label>
                  3. Rongga Mulut
                </label><br />
                <label>
                  <input type="radio" name="mulut" class="minimal" value="Normal" checked required > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="mulut" class="minimal" value="Gangguan/Kelainan" required > Gangguan/Kelainan &nbsp&nbsp&nbsp&nbsp&nbsp
                </label> <br>
                 <textarea name="ket_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br /> 
                     </div>
                     <div class="col-md-6">
                      
                      </div>

                    </div>
         
                </div>  <!-- akhir form group -->








                <div class="form-group">
                    <h4><label><font color="green"><b> Thorax</b></font></label></h4>
                    <div class="row">
                       <div class="col-md-6">
                       <label>
                          4. Jantung
                        </label><br />
                        <label>
                          <input type="radio" name="jantung" class="minimal" value="Normal" checked required > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="radio" name="jantung" class="minimal" value="Gangguan" required > Gangguan &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label>
                        <br>
                         <textarea name="ket_jantung" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                        <br /><br /> 
                      </div>
                
                    <div class="col-md-6">                                
                        <label>
                          5. Paru
                        </label><br />
                        <label>
                          <input type="radio" name="paru" class="minimal" value="1" checked required > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="radio" name="paru" class="minimal" value="2" required > Gangguan &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label>
                        <br>
                         <textarea name="ket_paru" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                        <br /><br />   
                    </div>
                    
                    <div class="col-md-6">                                
                        <label>
                          6. Pemeriksaan Neurologi
                        </label><br />
                        <br>
                         <textarea name="ket_neurologi" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
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
                  <input type="radio" name="rambut" class="minimal" value="1" checked required > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="rambut" class="minimal" value="2" required > Tidak Sehat/Kotor &nbsp&nbsp&nbsp&nbsp&nbsp
                </label>
                <br>
                 <textarea name="ket_rambut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />
                      </div>
                
                    <div class="col-md-6">                                
                      <label>
                  6. Kulit
                </label><br />
                <label>
                  <input type="radio" name="kulit" class="minimal" value="1" checked required > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="kulit" class="minimal" value="2" required > Tidak Sehat/Kotor &nbsp&nbsp&nbsp&nbsp&nbsp
                </label>
                <br>
                 <textarea name="ket_kulit" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br /> 
                    </div>

                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <label>
                  7. Kuku
                </label><br />
                <label>
                  <input type="radio" name="kuku" class="minimal" value="1" checked required > Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="kuku" class="minimal" value="2" required > Kotor/Panjang &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_kuku" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />
                     </div>
                     <div class="col-md-6">
                      
                      </div>

                    </div>
         
                </div>  <!-- akhir form group -->

         
        </div>
           </div> <!-- end of card body -->

            </div> <!-- end of card -->
        </div>
        </div>
      </div>


         
         </div>





      <div class="tab">
        <div class="card-body">



        <div class="box card">
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
                  <input type="radio" name="bibir" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="bibir" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_bibir" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                  2. Luka Pada Sudut Mulut
                </label><br />
                <label>
                  <input type="radio" name="sudut_mulut" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="sudut_mulut" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                <textarea name="ket_sudut_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />  
                    </div>

                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <label>
                  3. Sariawan
                </label><br />
                <label>
                  <input type="radio" name="sariawan" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="sariawan" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label> <br>
                 <textarea name="ket_sariawan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />  
                     </div>
                     <div class="col-md-6">
                     <label>
                  4. Lidah Kotor
                </label><br />
                <label>
                  <input type="radio" name="lidah" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="lidah" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_lidah" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />  
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-md-6">
                      <label>
                  5. Luka Lainnya
                </label><br />
                <label>
                  <input type="radio" name="luka_lain" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="luka_lain" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_luka_lain" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br /> 
                     </div>
                     <div class="col-md-6">
                        <label>
                          6. Masalah Lainnya
                        </label><br />
                         <textarea name="ket_masalah_lain_rongga_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
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
                  <input type="radio" name="caries" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="caries" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_caries" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />
                      </div>
                
                    <div class="col-md-6">                                
                      <label>
                  7. Sususnan Gigi Depan Tidak Teratur
                </label><br />
                <label>
                  <input type="radio" name="gigi_dep" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="gigi_dep" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_gigi_dep" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br /> 
                    </div>
                    <div class="col-md-6">
                        <label>
                          8. Masalah Lainnya
                        </label><br />
                         <textarea name="ket_masalah_lain_gigi_gusi" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                        <br /><br /> 
                     </div>
                     <div class="col-md-6">
                        
                     </div>

                  </div>


                 
                </div> <!-- akhir form group -->          



        </div>
        <!-- /.box-body -->
      </div>  
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
                  <input type="radio" name="mata_luar" class="minimal" value="1" checked required > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="mata_luar" class="minimal" value="2" required > Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_mata_luar" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                  2. Tajam Penglihatan
                </label><br />
                <label>
                  <input type="radio" name="penglihatan" class="minimal" value="1" checked required > Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="penglihatan" class="minimal" value="2" required > Low Vission &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="penglihatan" class="minimal" value="3" required > Kebutaan &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="penglihatan" class="minimal" value="4" required > Kelainan Refraksi &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_penglihatan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />  
                    </div>

                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <label>
                   3. Kacamata
                </label><br />
                <label>
                  <input type="radio" name="kacamata" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="kacamata" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_kacamata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                 4. Infeksi
                </label><br />
                <label>
                  <input type="radio" name="inf_mata" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="radio" name="inf_mata" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                </label><br>
                 <textarea name="ket_inf_mata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3" ></textarea>
                <br /><br />  
                    </div>
                    <div class="col-md-6">
                        <label>
                          5. Masalah Lainnya
                        </label><br />
                         <textarea name="ket_masalah_lain_penglihatan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
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
                          <input type="radio" name="telinga" class="minimal" value="1" checked required > Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="radio" name="telinga" class="minimal" value="2" required > Infeksi &nbsp&nbsp&nbsp&nbsp&nbsp
                          </label><br>
                          <textarea name="ket_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                          <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                         6. Serumen
                        </label><br />
                      <label>
                        <input type="radio" name="kot_telinga" class="minimal" value="1" checked required > Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="kot_telinga" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br>
                        <textarea name="ket_kot_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                        <br /><br />  
                    </div>

                   </div>


                   <div class="row">
                      <div class="col-md-6">
                          <label>
                              7. Infeksi
                          </label><br />
                          <label>
                          <input type="radio" name="inf_telinga" class="minimal" value="1" checked required >Tidak&nbsp&nbsp&nbsp&nbsp&nbsp
                          <input type="radio" name="inf_telinga" class="minimal" value="2" required > Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                          </label><br>
                          <textarea name="ket_inf_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                          <br /><br />  
                      </div>
                
                    <div class="col-md-6">
                        <label>
                         8. Tajam Pendengaran
                        </label><br />
                      <label>
                        <input type="radio" name="tajam_pendengaran" class="1" value="Normal" checked required >Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="radio" name="tajam_pendengaran" class="2" value="Ada Gangguan" required > Ada Gangguan &nbsp&nbsp&nbsp&nbsp&nbsp
                        </label><br>
                        <textarea name="ket_tajam_pendengaran" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
                        <br /><br />  
                    </div>
                    <div class="col-md-6">
                        <label>
                          9. Masalah Lainnya
                        </label><br />
                         <textarea name="ket_masalah_lain_pendengaran" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea>
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
                <label><h5> Pemeriksaan Tulang belakang</h5></label>
                <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." required="" name="tulang_belakang"></textarea>

            </div>

            <div class="col-md-6">
                              <label><h5>Gangguan Mental Emosional</h5></label>
                <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="mental"></textarea>
              
            </div>            
          </div>
          <br>

          <div class="row">
            <div class="col-md-6">
                <label><h5> Kesimpulan</h5></label>
                <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="kesimpulan"></textarea>

            </div>

            <div class="col-md-6">
                              <label><h5>Saran  </h5></label>
                <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="saran"></textarea>
              
            </div>            
          </div>  
          <br>


          <div class="row">
            <div class="col-md-6">
                 <h4><label><font color="green"><b> Follow Up</b></font></label></h4>
                <textarea class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="kesimpulan_akr"></textarea>

            </div>

            <div class="col-md-6">
                          
            </div>            
          </div> 


        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                 <label>Lokasi Periksa</label>
                 <input type="text" class="form-control" name="lokasi" required value="Sleman" required><br />
                 <label>Tanggal Periksa</label>
                 <input type="date" class="form-control" name="tanggal" required placeholder="Tanggal ..." required><br />
               </div>
            </div>     
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Dokter Periksa</label>
                 <input type="text" class="form-control" name="dokter" placeholder="Nama Dokter Periksa ..."><br />
                </label>
                <br />
                
                 
              </div>
            </div>
          </div>   
    </div> <!-- end of card body -->
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
    // function nilai_imt() {
    //     var imt = document.getElementById("pimt").value;
    //     if (imt<25){
    //         document.getElementById("cek").innerHTML = "kurus";
    //     }else if(imt>=30){
    //         document.getElementById("cek").innerHTML = "gemuk";
    //     }else{
    //         document.getElementById("cek").innerHTML = "ideal";
    //     }
    //     alert( "Handler for .change() called." );
    // }

    function hitung_Imt(){
        var bb = document.getElementById("bb").value;
        var tb = document.getElementById("tb").value;
        var jk = document.getElementById("gender").value;
        var usia= document.getElementById("usiaa").value;
        var tahun_usia_mcu  = document.getElementById("tahun_usiaa").value;
        var bulan_usia_mcu = document.getElementById("bulan_usiaa").value;


    <?php foreach ($imtdbb as $key): ?>

    if ((tahun_usia_mcu =="<?php echo $key->tahun_usia;?>") && (bulan_usia_mcu =="<?php echo $key->bulan_usia;?>")) {

      var kurus = "<?php echo($key->kurus); ?>";
      var batas_bawah = "<?php echo($key->batas_bawah); ?>";
      var ideal = "<?php echo($key->ideal); ?>";
      var batas_atas = "<?php echo($key->batas_atas); ?>";
      var gemuk = "<?php echo($key->berlebih); ?>";

    }
  
    <?php endforeach ?>


        
        var imt;
        imt = (bb)/((tb*0.01)*(tb*0.01));
        // var bulan_usia = <?php Print($diff->m);  ?>;
        // var tahun_usia = <?php Print($diff->y);  ?>;
        var gender = document.getElementById("gender").value;

        if (imt<=kurus){
            document.getElementById("cek").innerHTML = "kurus";
        }else if(imt>=gemuk){
            document.getElementById("cek").innerHTML = "gemuk";
        }else{
            document.getElementById("cek").innerHTML = "ideal";
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

   //alert( document.getElementById("tahun_usiaa").value);
}
 

</script>
@endsection
