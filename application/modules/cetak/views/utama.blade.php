@layout('template/back/main')

@section('scripts-css')

@endsection
@section('content')
<style type="text/css">
  
  .menu{
    width: 400px;
    height: 115px;
    margin: 5px;
    font-size: 20px;
  }

</style>
<div> <center> <h3>  SILAHKAN PILIH DOKUMEN YANG INGIN ANDA CETAK </h3></center></div>
<div style="">
  <center>
  <a href=" cetak/pnmcu">
    <button class=" btn btn-danger menu"> Medical Checkup</button>
  </a>
   <a href="cetak/mcu_periode">
    <button class=" btn btn-danger menu" >Medical Checkup Periode</button>
  </a>
  <br>
   <a href="cetak/pndental">
    <button class=" btn btn-danger menu"> Dental</button>
  </a>
  
   <a href="cetak/Kunjungan_bulanan">
    <button class=" btn btn-danger menu" > Kunjungan</button>
  </a>
  

  </center>
</div>
@endsection