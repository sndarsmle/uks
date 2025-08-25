@layout('template/back/main')

@section('scripts-css')

@endsection
@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
  <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <style>
        table {
          border-color: black;
          width: 100%;
          border-spacing: 0px;
        }
        td,th {
          padding-left: 10px;
        }
        .identitas {
          border-right: solid;
          padding-left: 10px;
          border-width: 1px
        }
        * {
          border-width: 1px;
          border-spacing: 0px;
          border-collapse: collapse;
        }
        td, th, tr, table {
          border-collapse: collapse;
        }
        th {
            height: 45px;
            text-align: center;
        }
        .kiri {
          border-left: solid;
          border-right: solid;
          border-width: 1px

        }
        .bukankiri {
          border-right: solid;
          border-width: 1px
        }
        .containner {
          background-color: red;
          overflow: hidden;
          width: 100%;
        }
        td {
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
          background-color:transparent;
          width: 30px;
          margin: 0px;
          padding: 0px;
          text-align: center;
          height: 15px;
        }
        .allblackborder {
          border: black 1px solid;

        }
        .kananonly {
          border-right: black 1px solid;
        }
        .top {
          border-top: 1px solid black;
        }
 </style>
<div class="box">
<div id="cetak" style="color: black; font-size: 12px;">
    <div>
        @if($siswa->siswa_jenjang=="55")
            <img src="{{ base_url('assets/images/headersma.jpg') }}" alt="" width="100%" style="margin-bottom: 20px;">
        @elseif($siswa->siswa_jenjang=="44")
            <img src="{{ base_url('assets/images/headersmp.jpg') }}" alt="" width="100%" style="margin-bottom: 20px;">
        @elseif($siswa->siswa_jenjang=="33")
            <img src="{{ base_url('assets/images/headersd.jpg') }}" alt="" width="100%" style="margin-bottom: 20px;">
        @else
            <img src="{{ base_url('assets/images/headerdckbtk.jpg') }}" alt="" width="100%" style="margin-bottom: 20px;">
        @endif
        <br><br>
  </div>
<div style="margin-left: 80px;margin-right:80px ">
    <div>
        <table style="border-style: solid; border-spacing: 0px;border-width: 1px">
            <tr style=>
                <td class="identitas">Nama</td>
                <td class="identitas">
                    {{ $siswa->siswa_nama }}
                </td>
                <td class="identitas">Jenis Kelamin</td>
                <td class="">
                    {{ $siswa->siswa_kelamin == "L" ? "Laki-Laki" : "Perempuan" }}
                </td>
            </tr>
            <tr>
                <td class="identitas">NIS</td>
                <td class="identitas">
                    {{ $siswa->siswa_nis }}
                </td>
                <td class="identitas">Tangal Lahir</td>
                <td class="">
                    {{ $tanggal_lhr  }}
                </td>
            </tr>
            <tr>
                <td class="identitas">Kelas</td>
                    <?php
                        $jenjang = "";
                        switch($siswa->siswa_jenjang) {
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
                <td class="identitas">
                    {{ $jenjang }} - {{ $siswa->siswa_kelas }}
                </td>
                <td class="identitas">Tanggal DCU</td>
                <td class="">
                    {{ $tanggal_dcu }}
                </td>
            </tr>
            <tr>
                <td class="identitas"> Umur   </td>
                <td class="identitas">
                    {{ $siswa->siswa_umurT }} Tahun {{ $siswa->siswa_umurB }} Bulan
                </td>
                <td class="identitas"></td>
                <td style="border-collapse: collapse;"></td>
            </tr>
        </table>
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
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;">
    <!--  <?php $limit=count($diagnose);
    for ($i=0; $i <$limit ; $i++) {
    if ($diagnose[$i]->dcuDiag_number=="14") { ?>
    <img src="{{base_url('assets/images/dental/normal1red.png')}}" style=" max-width: 100%;max-height: 100%;">
    <?php  $i=$limit;}
    else {?>
    <img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;">
    <?php }
    } ?> -->
    </div>
    <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
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
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
    </div>
    <div class="flex-container">
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
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
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal2.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
        <div><img src="{{ base_url('assets/images/dental/normal1.png') }}" style=" max-width: 100%;max-height: 100%;"></div>
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
            <th class="top"  style="text-align: center;border-right: 1px solid black;border-left: 1px solid black">Nomor Gigi</th>
            <th class="top kananonly">Diagnosis</th>
            <th class="top kananonly" >Keterangan</th>
            </tr>
            @foreach($diagnose as $diag)
                <tr>
                    <td class="top" style="border-right: 1px solid black;border-left: 1px solid black">
                        {{ $diag->dcuDiag_number }}
                    </td>
                    <td class="kananonly top">
                        {{ $diag->penjelasan_diagnose }}
                    </td>
                    <td class="kananonly top">
                        {{ $diag->dcuDiag_ket }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="allblackborder"></td>
                <td class="kananonly" style="border-bottom: 1px solid black; border-top: black 1px solid"></td>
                <td class="kananonly" style="border-bottom: 1px solid black; border-top: black 1px solid"></td>
            </tr>
      </table>
    </div>
    <br>
    <div>
        <b>
            <h5>Status OHIS &nbsp:
                @if($content[0]->dcuDetail_ohis_status=="1")
                    Baik
                @elseif($content[0]->dcuDetail_ohis_status=="2")
                    Sedang
                @else
                    Buruk
                @endif
            </h5>
        </b>
    </div>
        <br>
        <b><h5>Keterangan </h5></b>
        <div style="width: 100%;border: 1px solid black; height: 120px; padding: 12px;">
            <p>{{ $content[0]->dcuDetail_Kettambahan }}</p>
        </div>
        <br><br>
        <table class="d-flex justify-content-end align-items-center text-center">
            <tr>
                <td class="px-3">Sleman, {{ $tanggal_dcu }}</td>
            </tr>
            <tr>
                <td class="px-3">Pemeriksa</td>
            </tr>
            <tr>
                <td>
                    @if($dokter)
                        <img src="{{base_url().$dokter->dokter_signature}}?v=2" style="max-width:4cm ;max-height: 2cm">
                    @else
                        <p class="text-center">-</p>
               @endif
                </td>
            </tr>
            <tr>
                <td class="px-3" style="border: none;">
                    {{$dokter ? $dokter->dokter_fullname : "Dokter tidak ditemukan"}}
                </td>
            </tr>
        </table>
    </div>
</div>
</div> <!-- akhir div cetak -->
</div>
    <br>
    @if($dokter)
        <center><button class="btn btn-primary" onclick="myFunction()">Generate PDF</button> </center>
    @else
        <center><button class="btn btn-danger" disabled>Proses Belum Selesai</button> </center>
    @endif
    <br><br>
@endsection

@section('scripts-js')
    <script type="text/javascript">
        function myFunction(){
            // document.getElementById("chart").style.display = "none";
            // document.getElementById("chart2").style.display = "block"
            // document.getElementById("curve_chart").style.maxWidth = "100px";
            // document.getElementById('curve_chart').style.maxWidth = "700px";
            // document.getElementById("curve_chart").style.display = "none";
            // document.getElementById("curve_chart").style.display = "none";
            // document.getElementById("curve_chart2").style.width = "700px";
            // console.log(invoice);
            // console.log(window);
            const invoice = this.document.getElementById("cetak");
            let opt = {
                margin: 0 ,
                filename: "Dental - {{ $siswa->siswa_nama }} {{ $content[0]->periode_monthName }} {{ $content[0]->periode_year }}.pdf",
                image: { type: "jpeg", quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: "in", format: "legal", orientation: "portrait"  }
            };
            html2pdf().from(invoice).set(opt).save();
        }
    </script>
@endsection