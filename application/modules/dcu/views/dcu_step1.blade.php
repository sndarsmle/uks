@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/select2/css/select2.min.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/css/select2-bootstrap4.min.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
<style>
    #.containner {
  background-color: red;
  overflow: hidden;
  width: 100%;
 
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
</style>
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
                    <h4 class="card-title">Dental Check Up - SD Teladan</h4>
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="nav flex-column nav-pills">
                                
                                <a href="#v-pills-home" class="nav-link active show" class="nav-link">Ondotogram</a>
                                <a href="{{base_url('dcu/step2/'.$dcu->dcu_id)}}" class="nav-link">Pemerikasaan Lanjutan</a> 
                                <a href="{{base_url('dcu/step3/'.$dcu->dcu_id)}}" class="nav-link">Evaluasi</a>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <h4 class="card-title">Informasi Awal</h4>
                                <form action="{{ base_url('dcu/step1Awal/'.$dcu->dcu_id) }}" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tanggal Periksa</label>
                                                <input type="date" class="form-control" name="form_tgl" value="{{$dcu->dcu_date}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Umur Saat Periksa</label>
                                                <input type="text" class="form-control" value="{{$dcu->dcu_ageY.' Tahun '.$dcu->dcu_ageM.' Bulan'}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <button type="submit" style="color:white" class="btn btn-success">Simpan Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="card-title">Form Ondotogram</h4>
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
  <div><img src="{{base_url('assets/images/dental/normal1.png')}}" style=" max-width: 100%;max-height: 100%;">
  

</div>
    
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
<br><br>
                                        <h4 class="card-title">List Diagnosis </h4>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#basicModal" >Tambah Diagnosis</button>&nbsp&nbsp<a href="{{base_url('dcu/step2/'.$dcu->dcu_id)}}" class=" btn btn-success ">Pemeriksaan Lanjutan</a>
                                        <div id="sroll"></div>
                                        <div class="modal fade" id="basicModal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Form Tambah Periode</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="POST">
                                                    <div class="modal-body">  
                                                        <div class="form-group">
                                                            <label>Nomor Gigi</label>
                                                            <select class="form-control select4" name="form_gigi">
                                                                <option value=''> Nomor Gigi </option>
                                                                <option value='0'> Semua Gigi </option>
                                                                <option value='11'> 11 </option>
                                                                <option value='12'> 12 </option>
                                                                <option value='13'> 13 </option>
                                                                <option value='14'> 14 </option>
                                                                <option value='15'> 15 </option>
                                                                <option value='16'> 16 </option>
                                                                <option value='17'> 17 </option>
                                                                <option value='18'> 18 </option>
                                                                <option value='21'> 21 </option>
                                                                <option value='22'> 22 </option>
                                                                <option value='23'> 23 </option>
                                                                <option value='24'> 24 </option>
                                                                <option value='25'> 25 </option>
                                                                <option value='26'> 26 </option>
                                                                <option value='27'> 27 </option>
                                                                <option value='28'> 28 </option>
                                                                <option value='31'> 31 </option>
                                                                <option value='32'> 32 </option>
                                                                <option value='33'> 33 </option>
                                                                <option value='34'> 34 </option>
                                                                <option value='35'> 35 </option>
                                                                <option value='36'> 36 </option>
                                                                <option value='37'> 37 </option>
                                                                <option value='38'> 38 </option>
                                                                <option value='41'> 41 </option>
                                                                <option value='42'> 42 </option>
                                                                <option value='43'> 43 </option>
                                                                <option value='44'> 44 </option>
                                                                <option value='45'> 45 </option>
                                                                <option value='46'> 46 </option>
                                                                <option value='47'> 47 </option>
                                                                <option value='48'> 48 </option>
                                                                <option value='51'> 51 </option>
                                                                <option value='52'> 52 </option>
                                                                <option value='53'> 53 </option>
                                                                <option value='54'> 54 </option>
                                                                <option value='55'> 55 </option>
                                                                <option value='61'> 61 </option>
                                                                <option value='62'> 62 </option>
                                                                <option value='63'> 63 </option>
                                                                <option value='64'> 64 </option>
                                                                <option value='65'> 65 </option>
                                                                <option value='71'> 71 </option>
                                                                <option value='72'> 72 </option>
                                                                <option value='73'> 73 </option>
                                                                <option value='74'> 74 </option>
                                                                <option value='75'> 75 </option>
                                                                <option value='81'> 81 </option>
                                                                <option value='82'> 82 </option>
                                                                <option value='83'> 83 </option>
                                                                <option value='84'> 84 </option>
                                                                <option value='85'> 85 </option>
                                                            </select>
                                                        </div>                    
                                                        <div class="form-group">
                                                            <label>Diagnosis</label>
                                                            <!-- <input type="text" class="form-control input-default" name="form_diag"> -->
                                                            <!-- <select class="form-control select4" name="form_diag">
                                                              <option > Pilih Diagnosis </option>
                                                              <option value="Sou">Gigi Sehat, Normal, tanpa Kelainan</option>
                                                              <option value="Non">Gigi Tidak ada/tidak diketahui</option>
                                                              <option value="Une">Un-erupted</option>
                                                              <option value="Pre">Partial Erupted</option>
                                                              <option value="Imv">Impacted Visible</option>
                                                              <option value="Ano">Anomali</option>
                                                              <option value="Dia">Diastema</option>
                                                              <option value="Att">Atrisi</option>
                                                              <option value="Abr">Abarasi</option>
                                                              <option value="Car">Caries</option>
                                                              <option value="Cfr">Crown Fracture / Fraktur Mahkota</option>
                                                              <option value="Nvt">Gigi Non Vital</option>
                                                              <option value="Rrx" >Sisa Akar</option>
                                                              <option value="Mis">Gigi H</option>
                                                              
                                                            </select> -->
                                                            <select class="form-control select4" name="form_diag">
                                                              <option > Pilih Diagnosis </option>
                                                              @foreach($listdiagnose as $list)
                                                              <option value="{{$list->kode_diagnose}}">{{$list->penjelasan_diagnose}}</option>
                                                              @endforeach 
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <input type="text" class="form-control input-default" name="form_ket">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" style="color:white" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-success" value="Simpan">
                                                    </div>
                                                </form>  

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nomor Gigi</th>
                                                    <th scope="col">Diagnosis</th>
                                                    <th scope="col" style="max-width: 10%">Keterangan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($diagnosis as $i => $data)
                                                <tr>
                                                    <th>{{$i+=1}}.</th>
                                                    <td>{{$data->dcuDiag_number}}</td>
                                                    <td>{{$data->dcuDiag_diag}}</td>
                                                    <td>{{$data->dcuDiag_ket}}</td>
                                                    <td style="max-width: 10%">
                                                        <button type="button" class="btn mb-1 btn-outline-danger" data-toggle="modal" data-target="#hapusModal{{$i}}">Hapus</button>
                                                        <div class="modal fade" id="hapusModal{{$i}}">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Form Hapus Diagnosis</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">                      
                                                                        Apakah yakin menghapus Diagnosis? <b>Data yang telah dihapus tidak dapat dikembalikan</b>.
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color:white">TIDAK</button>
                                                                        <button data-id="{{$i;}}" data-uid="{{$data->dcuDiag_id}}" class="btn-hapus btn btn-danger">YAKIN</button>
                                                                    </div>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
<script src="{{base_url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{base_url('assets/plugins/toastr/js/toastr.min.js')}}"></script>
<script >
$(document).ready(function(){  
 

    $('.select4').select2({
            theme: 'bootstrap4',
        });
    

    $(".btn-hapus").on("click", function() {
        toastr.info("Permintaan sedang diproses", "Mohon Tunggu", 
            { positionClass: "toast-top-center", 
                timeOut: 5e3, 
                closeButton: !0, 
                debug: !1, 
                newestOnTop: !0, 
                progressBar: !0, 
                preventDuplicates: !0, 
                onclick: null, 
                showDuration: "600", 
                hideDuration: "1000", 
                extendedTimeOut: "1000", 
                showEasing: "swing", 
                hideEasing: "linear", 
                showMethod: "fadeIn", 
                hideMethod: "fadeOut", 
                tapToDismiss: !1 
            }); 
        var id = $(this).data("id");
        let form_id = $(this).data("uid");
        let postForm = {
            'form_id' : form_id,
        };
        $.ajax({
            url: '{{ base_url('api/dcuDiag/deleteRow')}}',
            method: 'post',
            data: postForm,
            success: function(data) {
                data = JSON.parse(data);
                if (data['status'] == 1) {
                    location.reload(true);
                } else if (data['status'] == 0) {
                    alert("Gagal mengubah data");
                }
            }
        }); 
    });
 }); 
</script>
<script type="text/javascript">
  window.scrollTo(0,document.body.scrollHeight);
  //window.scrollTo( '#sroll');
  //window.scrollTo()
</script>
@endsection
