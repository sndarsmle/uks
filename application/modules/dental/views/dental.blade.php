@layout('template/back/main')

@section('scripts-css')
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
                    <h4 class="card-title">Data Dental Checkup Perperiode</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Periode</th>
                                    <th>Jumlah Data</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($summary as $i => $data)
                                <tr>
                                    <th>{{$i+=1}}.</th>
                                    <td>{{$data->periode_mcu}}</td>
                                    <td>{{$data->jumlah_data}}</td>
                                    <td><a href="{{base_url('dental/detail/'.$data->id)}}" class="btn mb-1 btn-info float-right">Detail</a></td>
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
@endsection

@section('scripts-js')
<script >
    $(document).ready(function(){  

    }); 
</script>
@endsection