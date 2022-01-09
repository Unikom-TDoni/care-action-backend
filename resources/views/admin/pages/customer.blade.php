@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="fa fa-user"></i> Customer</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li class="active">Customer</li>
                    </ol>
                </div>
            </div>

            <div class="panel">          
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Birthdate</th>
                                <th>Gender</th>
                                <th>Weight</th>
                                <th>Height</th>
                                <th></th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($customer as $data)
                            <tr class="gradeX">
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ ($data->birthdate!="")?date("d-m-Y", strtotime($data->birthdate)):"" }}</td>
                                <td>{{ $data->gender }}</td>
                                <td>{{ $data->weight }} kg</td>
                                <td>{{ $data->height }} cm</td>
                                <td>    
                                    <button class="btn btn-icon btn-sm btn-success" onclick="detail('{{ $data->id }}')"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end: page -->
            </div> <!-- end Panel -->
        </div>
    </div>
  </div> 
  
  <div id="detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Customer</h4> 
            </div> 
            <div class="modal-body">
                <form class="form-horizontal" role="form">  
                    <div class="row">
                        <center>
                            <div class="panel panel-default" style="width: 120px;">
                                <img id="picture_src" style="width:100%"/>
                            </div>
                        </center>
                    </div>
                    
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="name"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="email"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Birthdate</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="birthdate"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gender</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="gender"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Weight</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="weight"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Height</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="height"></p>
                            </div>
                        </div>  
                    </div>
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Registration Time</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="created_at"></p>
                            </div>
                        </div>  
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div><!-- /.modal -->

<script>
    function detail(id)
    {
        $('#detail').modal('show');
    
        $.ajax(
        {
            url:"{{ Route('customer.data') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(value)
            {
                date_tl = new Date(value.birthdate);
                date_td = new Date(value.created_at);

                var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                birthdate   = (value.birthdate !== null)?date_tl.getDate() + " " + months[date_tl.getMonth()] + " " + date_tl.getFullYear():"";
                created_at  = date_td.getDate() + " " + months[date_td.getMonth()] + " " + date_td.getFullYear() + " " + date_td.getHours() + ":" + date_td.getMinutes();

                $("#name").html(value.name);
                $("#email").html(value.email);
                $("#birthdate").html(birthdate);
                $("#gender").html(value.gender);
                $("#weight").html(value.weight + " kg");
                $("#height").html(value.height + " cm");
                $("#created_at").html(created_at);
                $('#picture_src').attr("src", "{{ URL::asset('images/customer') }}" + "/" + value.picture);
            }
        });
    }
</script>
@endsection