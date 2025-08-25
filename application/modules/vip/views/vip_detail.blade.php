@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{base_url('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #46cd93;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
                    <form action="" method="post">
                        <label class="switch float-right">
                            <input type="checkbox" name="form_status" class="status" {{$api->client_status == 1 ? 'checked' : ''}}>
                            <span class="slider round"></span>
                        </label>
                        <h4 class="mt-0 header-title">Informasi API</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Client</label>
                                    <input type="text" class="form-control" name="form_client" value="{{$api->client}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Token Access  <a class="btn btn-success btn-sm renew" style="color:white;">Renew token</a></label>
                                    <input type="text" class="form-control" value="{{$api->client_token}}" id="token" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>IP/Domain</label>
                                    <input type="text" class="form-control" name="form_clientip" value="{{$api->client_ip}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="form_clientdesc" cols="30" rows="3">{{$api->client_description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-right">Simpan Data</button>
                    </form>
                </div>
            </div>
        <div>
    </div>
</div>
@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{base_url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".renew").click(function() {
            let postForm = {
                'form_id' : '{{$api->client_id}}',
            };
            $.ajax({
                url: '{{ base_url('openAPI/Privateee/newToken')}}',
                method: 'post',
                data: postForm,
                success: function(data) {
                    data = JSON.parse(data);
                    if (data['status'] == 200) {
                        document.getElementById("token").value = data['newToken'];
                    } else if (data['status'] == 0) {
                        alert("Gagal mengubah data");
                    }
                }
            }); 
        });
        $(".status").change(function() {
            var status = {{$api->client_status}};

            if(this.checked) {
                status = 1;
            } else {
                status = 0;
            }

            var id = '{{$api->client_id}}';
            
            let postForm = {
                'form_status' : status,
                'form_id' : id,
            };
            $.ajax({
                url: '{{ base_url('openAPI/Privateee/updateStatus')}}',
                method: 'post',
                data: postForm,
                success: function(data) {
                    data = JSON.parse(data);
                    if (data['status'] == 200) {
                        location.reload(true);
                    } else if (data['status'] == 0) {
                        alert("Gagal mengubah data");
                    }
                }
            }); 
        });
    });
</script>
@endsection