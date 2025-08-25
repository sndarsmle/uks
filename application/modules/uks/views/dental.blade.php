@layout('template/back/main')

@section('scripts-css')

@endsection
@section('content')

              <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Dental Check Up</b></h3>

          
        </div>
        <!--Start FORM -->
  <form action="inputdental" method="post">
        <!-- SELECT2 EXAMPLE -->
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            
            
          </div>
        </div>

         
        <div class="tab">
          
        
      </div>
        
        <!-- /.box-header -->
       
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
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" name="nis"  placeholder="nis" value="{{$content->nis}}" readonly><br />
                                    <input type="hidden" class="form-control" name="idsiswa"  placeholder="urut" value="{{$content->idsiswa}}" >
                                    <input type="hidden" class="form-control" name="kelas"   value="{{$content->kelas}}" >
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama"  placeholder="Nama Siswa" value="{{$content->nama}}" readonly><br />
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" name="kelas" placeholder="Kelas" value="{{$content->kelas}}"readonly><br />
                                 
                                </div>
                            </div>     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin <br  /></label>
                                    <input type="text" class="form-control" name="jeniskelamin"  placeholder="Nama Siswa" value="{{$content->jenis_kelamin}}" readonly id=gender><br />
                                    <label>Periode Medical Checkup</label>
                                    <select name="periode_pemeriksaan_dental" class="form-control" id="peri_mcu" onchange="umur_js()" >
                                        @foreach ($final as $finale)
                                        <option value="{{$finale}}">
                                            {{$finale}}
                                        </option>
                                        @endforeach
                                    </select><br />
 
                                    <!-- <label>Usia saat Screening</label>
                                    <input type="text" value="{{$diff->y;}} Tahun  {{$diff->m}} Bulan" class="form-control" name="tahun" placeholder="Tahun Periksa" required readonly><br /> -->
                                   
           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  <?php  $idd = date("mdYHis"); ?>
                  <input type="hidden" name="id_pemeriksaan" value="{{$idd}}">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>A. Pemeriksaan Gigi</b></h3>
        </div>
          <div align="center" class="form-group">
                <img src="{{base_url('assets/images/gigi.png')}}" alt="Odontogram" style="width: 100%;height: auto;max-width: 800px">
            
              </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dynamic_field">
              <tr>
                <td style="width: 15%"><input type="text" name="nomorgigi[]" placeholder="Nomor Gigi" class="form-control name_list" /></td>
                <td style="width: 30%"><input type="text" name="diagnosis[]" class="form-control name_list" placeholder="Diagnosis"></td>
                <td style="width: 40%"> <input type="text" name="rujukan[]" placeholder="rujukan Tindakan" class="form-control name_list"></td>
                <td style="width: 15%"><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
              </tr>
            </table>
            <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
            
          </div>

        <div class="box-body">
          <!--<font color="red"><b><i>Beri tanda centang pada kotak sesuai keadaan anak, bila jawban "YA", isilah masalahnya.</i></b></font><br /><b>Apakah Anak Memiliki:</b><br /><br /> -->
          <div class="">
            

              <!-- START FORM ADD -->
    <div class="panel-body">


        
        <div class="control-group text-center">
            <br>
            
        </div>
        
        <!-- Copy Fields -->
        
<!-- <script type="text/javascript">
    $(document).ready(function() {
      $(".multiple").click(function(){ 
          var html = $(".copy").html();
          $(".after-multiple").after(html);
      });
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
</script> -->
              <!-- END FORM ADD -->

              <!-- START PERTANYAAN 1 -->
              <label>Oklusi</label>
              <textarea style="width: 85%" type="text" class="form-control" name="oklusi" required placeholder="keterangan. Harap isi dengan - jika tidak ada" required rows="3"></textarea>
                 <br />
              <!-- END PERTANYAAN 1 -->
              <!-- START PERTANYAAN 2 -->
              <label>Mukosa</label>
              <textarea type="text" class="form-control" name="mukosa" required placeholder="keterangan  Harap isi dengan - jika tidak ada" required rows="3" style="width: 85%" >  </textarea>
                 <br />
              <!-- END PERTANYAAN 2 -->
              <!-- START PERTANYAAN 3,4,5 -->
              
                <table>
                  <tr>
                    <td class="form-group   ">D: &nbsp&nbsp&nbsp&nbsp&nbsp</td>
                    <td> <input type="text" class="form-control"  name="d"  placeholder="Decay" ></div></td> 
                    <td class="form-group   "> &nbsp&nbsp&nbspM: &nbsp&nbsp&nbsp&nbsp&nbsp</td>
                    <td> <input type="text" class="form-control"  name="m"  placeholder="Missing" ></div></td>
                    <td class="form-group"> &nbsp&nbsp&nbspF: &nbsp&nbsp&nbsp&nbsp&nbsp</td>
                    <td> <input type="text" class="form-control"  name="f"  placeholder="Filled" ></div></td>
                  </tr>
                  </tr>


                  </tr>
                </table>



               <br><br><br>
        <!-- /.box-body -->
      </div>
      <!-- /.box1 -->
     
      <!-- /.box1 -->

      <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                 <label>Tanggal Periksa</label>
                 <input type="date" class="form-control" name="tanggal" required placeholder="Tanggal ..." required><br />
               </div>
            </div>     
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Dokter Periksa</label>
                 <input type="text" class="form-control" name="dokter" placeholder="Nama Dokter Periksa ..." required><br />
                </label>
                <br />
                
                 
              </div>
            </div>
          </div>
        </div>


                      <div class="box-footer">
          <div align="center" class="box-footer">
                <a href="i_1_odt.php" class="btn btn-danger">Kembali</a>
                <button class="btn btn-success"> Submit</button>                
          </div>
        </div>
                  </form>


        
<script type="text/javascript">
    // $(document).ready(function() {
    //   $(".add-more").click(function(){ 
    //       var html = $(".copy").html();
    //       $(".after-add-more").after(html);
    //   });
    //   $("body").on("click",".remove",function(){ 
    //       $(this).parents(".control-group").remove();
    //   });
    // });
$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;
    $('#dynamic_field').append('<tr id="row'+i+'">  <td style="width: 15%"><input type="text" name="nomorgigi[]" placeholder="Nomor Gigi" class="form-control name_list" /></td><td style="width: 30%"><input type="text" name="diagnosis[]" class="form-control name_list" placeholder="Diagnosis"></td><td style="width: 40%"> <input type="text" name="rujukan[]" placeholder="rujukan Tindakan" class="form-control name_list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
  });
  
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
  });
  
  // $('#submit').click(function(){   
  //  $.ajax({
  //    url:"name.php",
  //    method:"POST",
  //    data:$('#add_name').serialize(),
  //    success:function(data)
  //    {
  //      alert(data);
  //      $('#add_name')[0].reset();
  //    }
  //  });
  // });
  
});

</script> -->


        <!--END FORM -->
        <!-- /.box-body -->
        <div class="box-footer">
          <b><i><font color="red"> Apabila terdapat masalah pada sistem, dapat menghubungi Staff IT Sekolah Teladan Yogyakarta.</font></i></b>
        </div>
        <!-- /.box-footer-->
      </div>

@endsection