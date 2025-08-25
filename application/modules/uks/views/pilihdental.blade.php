@layout('template/back/main')

@section('scripts-css')

@endsection
@section('content')


<!-- CSS -->

 <!-- Default box -->
      <div class="box">
        <center><h2><font color="green"> Dental Check Up Siswa</font></h2></center>
        <br>
        <div class="box-header with-border">
        <!-- =============== START ================== -->
                        <!-- =============== END ================== -->

          <h3 class="box-title"><b>Masukkan NIS Peserta Didik</b></h3>

          
        </div>
        <!--Start FORM -->
<!-- coba fajar -->
 
<form action="dental" method="post">
<div class="container">

<div class="panel panel-default">
<div class="panel-body">
  <div class="form-group">

    <div>
  <select id='searchSiswa' class="form-control select4" name="siswa">
                                <option value='0'> Masukan NIS atau Nama </option>
                            </select>
 </div>
  </div>
</div>
</div>


</div> 


    


         
          <div align="center" class="box-footer">
                <button type="submit" class="btn btn-primary">Cek</button>
          </div>
        </div>
                
            </form>
        <!--END FORM -->

@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script >
    $(document).ready(function() {
        $('.select4').select2({
            theme: 'bootstrap4',
        });
        $("#searchSiswa").select2({
            theme: "bootstrap4",
            ajax: { 
                url: '{{base_url('api/siswa/liveSearch')}}',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                processResults: function (response) {
                    return {
                    results: response
                    };
                },
                cache: true
            }
        });
    });
</script>
@endsection