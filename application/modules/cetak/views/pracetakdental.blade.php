@layout('template/back/main')

@section('scripts-css')

@endsection
@section('content')
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
  padding: 8px;
  padding-left: 10px;
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

}
.bukankiri
{
  border-right: solid;
}

 </style>



<div class="box">




<div id="cetak" style="color: black">
  <div>
<table style="border-style: solid; border-spacing: 0px">
    <tr style=>
    <td class="identitas" style="" >Nama</td>
    <td class="identitas">{{$basicsiswa[0]->nama; }}</td> 
    <td class="identitas">Jenis Kelamin</td>
    <td class=""><?php if ($basicsiswa[0]->jenis_kelamin=="L") {
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
    <td class="identitas">{{$basicsiswa[0]->nis;}} </td> 
    <td class="identitas">Kelas</td>
    <td class="identitas">{{$basicsiswa[0]->kelas;}}</td>
  </tr>
  

</table>
    
    <?php $coba=200; 


    ?>
  </div>
<br><br><br><br><br>
<center>

<p> <b> <h4>HASIL PEMERIKSAAN MEDICAL CHECK UP</h4> </b></p> 
</center> 

    
    <br>
 <h3>A.Grafik IMT </h3><center>
<div id="curve_chart" style="width: 900px; height: 500px"></div>
</center>

  <div>
    <h3> B. Hasil Medical Checkup</h3> 
    <br>



  </div>




</div> <!-- akhir div cetak -->
</div>


<!-- onclick="myFunction()" -->
<h1>sini</h1>
<button id='btn' onclick="tes()">Generate PDF</button>
<script type="text/javascript">


function myFunction(){
            const invoice = this.document.getElementById("cetak");
            // console.log(invoice);
            // console.log(window);
            var opt = {
                margin: 1,
                filename: 'myfile.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(invoice).set(opt).save();
         alert("tes");
}

function tes()
{
  alert("testing");
}







</script>

@endsection