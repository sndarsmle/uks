@layout('template/back/main')

@section('scripts-css')

@endsection
@section('content')
<?php var_dump($basicsiswa); ?>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
  <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

 <style type="text/css">
 
 
table{
  border-color: black;
  width: 100%;
 
  border-spacing: 0px;

}
td,th {
  padding-left: 10px;
}
.identitas
{
  border-right: solid;
  /*padding: 8px;*/
  padding-left: 10px;
  border-width: 1px
}

* {
  border width: 1px;
  border-spacing: 0px;
}

th
{
  border-top: solid;
}
.kiri{
  border-left: solid;
  border-right: solid;
  border-width: 1px

}
.bukankiri
{
  border-right: solid;
  border-width: 1px
}

 </style>



<div class="box">

<?php 
$i=0;
//$grafikimt=0;
$grafikimt = array();
$grafiktgl =array();
$kurus = array();
$ideal = array();
$berlebih = array();
foreach ($grafik as $graph ) {
  // $grafikimt[$i]=$graph->imt;
  // $i++;
  $grafikimt[$i]= $graph->imt;
  $grafiktgl[$i]= $graph->jadwal_mcu;
  $kurus[$i]= $graph->kurus;
  $ideal[$i]= $graph->ideal;
  $berlebih[$i]= $graph->berlebih;  
  $i++;
  
};
$imtlaporan = $content[0]->imt;
$limitlaporan= $content[0]->jadwal_mcu;

$limit=0;
while ( $grafiktgl[$limit]!= $limitlaporan) {
  $limit++;
}


 ?>

<div id="cetak" style="color: black; font-size: 12px;">

<div>


<?php if ($basicsiswa[0]->siswa_jenjang=="44") {?>
  <img src="{{base_url('assets/images/headersmp.jpg')}}" alt="" width="100%" style="margin-bottom: 20px;" >

  <?php 
  
} elseif($basicsiswa[0]->siswa_jenjang=="33"){?>
<img src="{{base_url('assets/images/headersd.jpg')}}" alt="" width="100%" style="margin-bottom: 20px;" >
  <?php 
  
}
else{?>
<img src="{{base_url('assets/images/headerdckbtk.jpg')}}" alt="" width="100%" style="margin-bottom: 20px;" >
  <?php 

}

 ?>

<?php if ($basicsiswa[0]->siswa_jenjang=="44") {
?>

<?php  } ?>
    <br><br>
  </div>
<div style="margin-left: 80px;margin-right:80px ">
  
  <div>

<table style="border-style: solid; border-spacing: 0px;border-width: 1px">
    <tr style=>
    <td class="identitas" style="" >Nama</td>
    <td class="identitas">{{$basicsiswa[0]->siswa_nama; }}</td> 
    <td class="identitas">Jenis Kelamin</td>
    <td class=""><?php if ($basicsiswa[0]->siswa_kelamin=="L") {
      # code...
      echo "Laki-Laki";
    } 
    else
    {
      echo "Perempuan";
    }

      ?></td>
  </tr>
 
  <tr>
    <td class="identitas">NIS</td>
    <td class="identitas">{{$basicsiswa[0]->siswa_nis;}} </td> 
    <td class="identitas">Tangal Lahir</td>
    <td class=""> <?php echo $tanggal_lhr; ?></td>
  </tr>
  <tr>
    <td class="identitas">Kelas</td>
    <?php
        $jenjang = "";
        switch($basicsiswa[0]->siswa_jenjang){
          case 11:
            $jenjang = "KB";
            break;
          case 22:
            $jenjang = "TK";
            break;
          case 33:
            $jenjang = "SD";
            break;
          case 44:
            $jenjang = "SMP";
            break;
        }
    ?>
    <td class="identitas">{{$jenjang}} - {{$basicsiswa[0]->siswa_kelas;}}</td>
    <td class="identitas">Tanggal MCU</td>
    <td class=""><?php echo $tanggal_mcu;?></td>
  </tr>
  <tr>
    <td class="identitas"> Umur   </td>
    <td class="identitas" >{{$basicsiswa[0]->siswa_umurT}} Tahun {{$basicsiswa[0]->siswa_umurB}} Bulan</td>
    <td class="identitas"></td>
    <td class="" style="border-collapse: collapse;"></td>
  </tr>
</table>
    
    <?php $coba=200; 


    ?>
  </div>
 
<center>

<p> <b> <h4>HASIL PEMERIKSAAN MEDICAL CHECK UP</h4> </b></p> 
</center> 
<br>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        

        var data = google.visualization.arrayToDataTable([


         
          ['Year', 'IMT SISWA', 'KURUS',  'BERLEBIH'],
          <?php 

          for ($i=0; $i <$limit ; $i++) {?> 
            
            ['<?php echo($grafiktgl[$i]); ?>',  <?php echo $grafikimt[$i]; ?>, <?php echo $kurus[$i]; ?>,    <?php echo $berlebih[$i]; ?>],
          <?php }

           ?>
           ['<?php echo($limitlaporan); ?>',  <?php echo $imtlaporan; ?>,   <?php echo $content[0]->kurus; ?>, <?php echo $content[0]->batas_atas; ?>]
        ]);

        var options = {
          title: 'PERKEMBANGAN IMT SISWA',
          curveType: 'line',
          chartArea : { left: "5%" },
        legend: { position: 'bottom', textStyle: { fontSize:12 }},
        // width: 810,
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        //var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart2'));


        chart.draw(data, options);
        //chart2.draw(data, options);
      }
    </script>
    
 <p style="font-size: 18px;"><b> A.Grafik IMT</b></p> 
 <center>
<div id="curve_chart" style="width: 100%; height: 200px ;padding-left:0px; width: 800px"></div>
</center>


  <div>
    <p style="font-size: 18px"> <b> B. Hasil Medical Checkup </b></p>
    <table style="width:100%;padding: 5px;border-width: 1px;" >
      <tr style="border-bottom: solid;border-width: 1px">
        <th class="kiri">URAIAN PEMERIKSAAN</th>
        <th class="bukankiri">HASIL</th>
        <th class="bukankiri">UNIT</th>
        <th class="bukankiri">NILAI RUJUKAN</th>
        <th class="bukankiri">KETERANGAN</th>
      </tr>
      <tr>
        <td class="kiri"> <b>Pemeriksaan Status Gizi</b></td>
        <td  class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Berat Badan</td>
        <td class="bukankiri"> {{$content[0]->bb}}</td>
        <td class="bukankiri">kg</td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Tinggi Badan</td>
        <td class="bukankiri"> {{$content[0]->tb}}</td>
        <td class="bukankiri">cm</td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Lingkar Kepala</td>
        <td class="bukankiri"> {{$content[0]->lk}}</td>
        <td class="bukankiri">cm</td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Lingkar Lengan</td>
        <td class="bukankiri"> {{$content[0]->lla}}</td>
        <td class="bukankiri">cm</td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Lingkar Perut</td>
        <td class="bukankiri"> {{$content[0]->lp}}</td>
        <td class="bukankiri">cm</td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>
      <tr>
        <td class="kiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>
      <tr>
        <td class="kiri"><b>Kategori Status Gizi</b></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">IMT</td>
        <td class="bukankiri"> {{$content[0]->imt}}</td>
        <td class="bukankiri">kg/㎡</td>
        <td class="bukankiri">{{$content[0]->kurus}} - {{$content[0]->batas_atas}}</td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Status Gizi</td>
        <td class="bukankiri"> <?php if ($content[0]->status_gizi=="1") {
          echo "Sangat Kurus";
        }
        elseif ($content[0]->status_gizi=="2") {
           echo "Kurus";
         }
         elseif ($content[0]->status_gizi=="3") {
           echo "Normal";
         }elseif ($content[0]->status_gizi=="4") {
           echo "Gemuk";
         }elseif ($content[0]->status_gizi=="5") {
           echo "Sangat Gemuk";
         } ?>
           
         </td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Normal</td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Stunting</td>
        <td class="bukankiri"> <?php if ($content[0]->stun=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?> </td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri"> <b>Pemeriksaan Langit-Langit Mulut</b> </td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Celah Bibir/Langit-Langit</td>
        <td class="bukankiri"><?php if ($content[0]->bibir=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Luka Pada Sudut Mulut</td>
        <td class="bukankiri"> <?php if ($content[0]->sudut_mulut=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri"><!-- {{$content[0]->ket_luka_sudut_mulut}} --></td>
      </tr>

      <tr>
        <td class="kiri">Sariawan</td>
        <td class="bukankiri"> <?php if ($content[0]->sariawan=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Lidah Kotor</td>
        <td class="bukankiri"> <?php if ($content[0]->lidah=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri"><!-- {{$content[0]->ket_lidah_kotor}} --></td>
      </tr>

      <tr>
        <td class="kiri">Luka Lainnya</td>
        <td class="bukankiri"><?php if ($content[0]->luka_lain=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri">{{$content[0]->ket_masalah_lain_rongga_mulut}}</td>
      </tr>

      <tr style="margin-top: 10px">
        <td class="kiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>
      <tr>
        <td class="kiri"><b> Pemeriksaam  Kesehatan Gigi dan Gusi</b></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Caries</td>
        <td class="bukankiri"><?php if ($content[0]->caries=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri"><?php if ($jenjang!="SMP") {
          echo $content[0]->ket_caries;
        } ?></td>
      </tr>

      <tr style="margin-top: 10px">
        <td class="kiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri"><b> Pemeriksaam  Kesehatan Penglihatan</b></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Tajam Penglihatan</td>
        <td class="bukankiri"><?php if ($content[0]->penglihatan=="1") {
          echo "Normal";
        } elseif($content[0]->penglihatan=="2"){echo "Low Vission";}
        elseif ($content[0]->penglihatan=="3") {
           echo "Kebutaan";
         }
         elseif ($content[0]->penglihatan=="4") {
          echo "Kelainan Refraksi";
         } ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Normal</td>
        <td class="bukankiri">{{$content[0]->ket_tajam_penglihatan}}</td>
      </tr>

      <tr>
        <td class="kiri">Pemakaian Kacamata</td>
        <td class="bukankiri"><?php if ($content[0]->kacamata=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri">{{$content[0]->ket_kacamata}}</td>
      </tr>

     <tr style="margin-top: 10px">
        <td class="kiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>
      <tr>
        <td class="kiri"><b> Pemeriksaam  Pendengaran</b></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
      </tr>

      <tr>
        <td class="kiri">Serumen/ Kotoran Telinga</td>
        <td class="bukankiri"><?php if ($content[0]->kotoran_telinga=="2") {
          echo "Ya";
        } else{echo "Tidak";} ?></td>
        <td class="bukankiri"></td>
        <td class="bukankiri">Tidak</td>
        <td class="bukankiri">{{$content[0]->ket_kotoran_telinga}}</td>
      </tr>

      <tr style="margin:20px ;border-bottom:  solid;border-width: 1px">
        <td class="kiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        <td class="bukankiri"></td>
        
      </tr>

      <tr >
        <td class="kiri" colspan="5" > <h5> Kesimpulan dan Saran</h5></td>
     
      </tr>

      <tr style="height: 40px;">
        <td style="word-break: break-all;" colspan="5" class="kiri"> 
          <?php

            if ($content[0]->kesimpulan!="-") {
              # code...
              echo "Kesimpulan : ";echo $content[0]->kesimpulan;
            }?><br><?php 

            if ($content[0]->saran!="-") {
              # code...
              echo "Saran : ";echo $content[0]->saran;
            }
           ?>
        </td>
        
      </tr>

      <tr style="margin:20px ;border-bottom:  solid;border-width: 1px">
        <td colspan="5" class="kiri"></td>
  
        
      </tr>

      <tr >
        <td class="kiri" colspan="5"> <h5> Follow Up</h5></td>
     
      </tr>

      <tr style="height: 40px; border-bottom: solid;border-width: 1px" >
        <td style="word-break: break-all;" colspan="5" class="kiri"> 
          <?php

            if ($content[0]->followup!="-") {
              # code...
              echo $content[0]->followup;
            }

           
           ?>
        </td>
        
      </tr>


      <tr>
        <td class="kiri" style="border: none;" colspan="5"> 
          Catatan : Data diatas diambil saat pelaksanaan MCU
          
        </td>

      </tr>

      <tr>
       <td class="kiri" style="border: none;" colspan="5"> 
          
          
       </td>
      </tr>

    </table>

    <table>
    <tr>
       <td></td>

       <td >{{$content[0]->lokasi}},  {{$tanggal_mcu}} </td>
      </tr>
      
      <tr>
       <td></td>

       <td> Pemeriksa </td>
      </tr>      
      <tr>
            <td></td>
          <td > <img src="{{base_url('assets/images/ttd/ttddrani.jpg')}}?v=2" style="max-width:4cm ;max-height: 2cm"></td>
      </tr>
      <tr>
        <td></td>
       <td style="border: none;text-align:center" width="4" colspan="1" >{{$content[0]->dokter}}</td>
      </tr>  
    </table>
  </div>



</div>
</div> <!-- akhir div cetak -->
</div>



<br><br><br>
<center><button onclick="myFunction()">Generate PDF</button> </center>
<script type="text/javascript">
 

function myFunction(){
              // document.getElementById("chart").style.display = "none";
              // document.getElementById("chart2").style.display = "block"
            // document.getElementById("curve_chart").style.maxWidth = "100px";
            // document.getElementById('curve_chart').style.maxWidth = "700px";
            //document.getElementById("curve_chart").style.display = "none";
            //document.getElementById("curve_chart").style.display = "none";
            //document.getElementById("curve_chart2").style.width = "700px";
            const invoice = this.document.getElementById("cetak");

            // console.log(invoice);
            // console.log(window);
            var opt = {
                margin: 0 ,
                filename: "{{$basicsiswa[0]->nama; }}-{{$tanggal_mcu}}.pdf",
                image: { type: "jpeg", quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: "in", format: "legal", orientation: "portrait"  }
            };
            html2pdf().from(invoice).set(opt).save();

         
}









</script>

@endsection