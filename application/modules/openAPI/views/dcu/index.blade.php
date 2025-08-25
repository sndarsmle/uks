@layout('template/front/main')

@section('scripts-css')

@endsection
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
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
    border-collapse: collapse;
}
td, th, tr, table
{
    border-collapse: collapse;  
}

th
{
    /* border-top: solid;*/ height: 45px;
    text-align: center;
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
.containner {
    background-color: red;
    overflow: hidden;
    width: 100%;
}

td
{
    height: 25px;
}

.gigi {
    float: left;
    background-color: blue;
    width: 60px;
    height: 50px;
}

.flex-container {
    display: flex;
    justify-content: center;
}

.flex-container > div {
    background-color: white;
    width: 30px;
    margin: 0px;
    padding: 0px;
    text-align: center;
    height: 50px;
}

.flex-container2 {
    display: flex;
    justify-content: center;
    margin: 0;
}

.flex-container2 > div {
    background-color:none;
    width: 30px;
    margin: 0px;
    padding: 0px;
    text-align: center;
    height: 15px;
    margin: 0;
}

.allblackborder
{
    border: black 1px solid;
}
.kananonly
{
    border-right: black 1px solid;
}
.top
{
    border-top: 1px solid black;
}
</style>

<div class="box">
    <div id="cetak" style="color: black; font-size: 12px;">
        <div>
        <?php 
            if ($siswa->siswa_jenjang=="44") 
            {
        ?>
            <img src="{{base_url('assets/images/headersmp.jpg')}}" alt="" width="100%" style="margin-bottom: 20px;" >
        <?php 
            } elseif($siswa->siswa_jenjang=="33"){
        ?>
            <img src="{{base_url('assets/images/headersd.jpg')}}" alt="" width="100%" style="margin-bottom: 20px;" >
        <?php 
            }else{
        ?>
            <img src="{{base_url('assets/images/headerdckbtk.jpg')}}" alt="" width="100%" style="margin-bottom: 20px;" >
        <?php 
            }
        ?>
        <br><br>
        </div>
        <div style="margin-left: 80px;margin-right:80px ">
            <div>
        <table style="border-style: solid; border-spacing: 0px;border-width: 1px">
            <tr>
                <td class="identitas" style="" >Nama</td>
                <td class="identitas">{{$siswa->siswa_nama; }}</td> 
                <td class="identitas">Jenis Kelamin</td>
                <td class="">{{$siswa->siswa_kelamin == "L" ? "Laki-Laki" : "Perempuan"}}</td>
            </tr>
            <tr>
                <td class="identitas">NIS</td>
                <td class="identitas">{{$siswa->siswa_nis;}} </td> 
                <td class="identitas">Tangal Lahir</td>
                <td class=""> {{ formatTanggal($siswa->siswa_tgl_lahir)}}</td>
            </tr>
            <tr>
                <td class="identitas">Kelas</td>
                <?php
                    $jenjang = "";
                    switch($siswa->siswa_jenjang){
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
                <td class="identitas">{{$jenjang}} - {{$siswa->kelas_tingkat;}}{{$siswa->kelas_rombel}}</td>
                <td class="identitas">Tanggal DCU</td>
                <td class="">{{formatTanggal($dcu->dcu_date)}}</td>
            </tr>
            <tr>
                <td class="identitas"> Umur   </td>
                <td class="identitas" >{{$dcu->dcu_ageY}} Tahun {{$dcu->dcu_ageM}} Bulan</td>
                <td class="identitas"></td>
                <td class="" style="border-collapse: collapse;"></td>
            </tr>
        </table>
    
        <?php 
            $coba=200; 
        ?>
    </div>
    <br>
    <b><h4>ODONTOGRAM</h4></b>
    <br>
    <div class="flex-container2">
        <div>18</div>
        <div>17</div>
        <div>16</div>
        <div>15</div>
        <div>14</div>
        <div>13</div>
        <div>12</div>
        <div>11</div>
        <div>21</div>
        <div>22</div>
        <div>23</div>
        <div>24</div>
        <div>25</div>
        <div>26</div>
        <div>27</div>
        <div>28</div>
    </div>
    <div class="flex-container">
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
    </div>
    <div class="flex-container2">
        <div>55</div>
        <div>54</div>
        <div>53</div>
        <div>52</div>
        <div>51</div>
        <div>61</div>
        <div>62</div>
        <div>63</div>
        <div>64</div>
        <div>65</div>
    </div>
    <div class="flex-container">
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
    </div>
    <div class="flex-container">
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
    </div>
    <div class="flex-container2">
        <div>85</div>
        <div>84</div>
        <div>83</div>
        <div>82</div>
        <div>81</div>
        <div>71</div>
        <div>72</div>
        <div>73</div>
        <div>74</div>
        <div>75</div>
    </div>
    <div class="flex-container">
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal2.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;"></div>
    </div>
    <div class="flex-container2">
        <div>48</div>
        <div>47</div>
        <div>46</div>
        <div>45</div>
        <div>44</div>
        <div>43</div>
        <div>42</div>
        <div>41</div>
        <div>31</div>
        <div>32</div>
        <div>33</div>
        <div>34</div>
        <div>35</div>
        <div>36</div>
        <div>37</div>
        <div>38</div>
    </div> 
    <br>
    <div>
        <b><h5>Hasil Pemeriksaan Gigi</h5></b>
        <div>
            <table style="border-collapse: collapse;font-size: 12px;" >
                <tr>
                    <th class="top" style="text-align: center;border-right: 1px solid black;border-left: 1px solid black">Nomor Gigi</th>
                    <th class="top kananonly">Diagnosis</th>
                    <th class="top kananonly" >Keterangan</th>
                </tr>
                <?php 
                    foreach ($diagnose as $diag) {
                ?>
                    <tr>
                        <td class="top" style="border-right: 1px solid black;border-left: 1px solid black">{{$diag->dcuDiag_number}}</td>
                        <td class="kananonly top">{{$diag->dcuDiag_diag}}</td>
                        <td class="kananonly top">{{$diag->dcuDiag_ket}}</td>
                    </tr>
                <?php 
                    } 
                ?>
                    <tr>
                        <td class="allblackborder"></td>
                        <td class="kananonly" style="border-bottom: 1px solid black; border-top: black 1px solid"></td>
                        <td class="kananonly" style="border-bottom: 1px solid black; border-top: black 1px solid"></td>
                    </tr>
                </table>
            </div>
            <br>
        <div>
            <b><h5>Status OHIS &nbsp: <?php if ($detail->dcuDetail_ohis_status=="1") {
                        echo "Baik";
                    } else if ($detail->dcuDetail_ohis_status=="2") {
                        echo "Sedang";
                    } else {
                        echo "Buruk";
                    }
                ?>
                </h5>
            </b>
        </div>
        <br>
        <b><h5>Keterangan </h5></b>
        <div style="width: 100%;border: 1px solid black; height: 120px; padding: 12px;x">
            <p>{{$detail->dcuDetail_Kettambahan}}</p>
        </div>             
        <br><br>
        <table>
            <tr>
                <td></td>
                <td >Sleman, {{formatTanggal($dcu->dcu_date)}}</td>
                </tr>
            <tr>
                <td></td>
                <td> Pemeriksa </td>
            </tr>      
            <tr>
                <td></td>
                <td >
                    @if($dokter)
                        <img src="{{base_url().$dokter->dokter_signature}}?v=2" style="max-width:4cm ;max-height: 2cm">
                    @else
                        <p class="text-center">-</p>
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="border: none;text-align:center" width="4" colspan="1" >{{$dokter ? $dokter->dokter_fullname : "Dokter tidak ditemukan"}}</td>
            </tr>  
        </table>
    </div>
</div>
<br>
@if($dokter)
    <center><button class="btn btn-primary" onclick="myFunction()">Generate PDF</button> </center>
@else
    <center><button class="btn btn-danger" disabled>Proses Belum Selesai</button> </center>
@endif
<br><br>
<script type="text/javascript">
    function myFunction(){
        const invoice = this.document.getElementById("cetak");
        var opt = {
            margin: 0 ,
            filename: "Dental-{{$siswa->siswa_nama}}_{{$dcu->periode_monthName}}_{{$dcu->periode_year}}.pdf",
            image: { 
                type: "jpeg", 
                quality: 0.98 
            },
            html2canvas: { 
                scale: 2 
            },
            jsPDF: { 
                unit: "in", 
                format: "legal", 
                orientation: "portrait"
            }
        };
        html2pdf().from(invoice).set(opt).save();  
    }
</script>
@endsection