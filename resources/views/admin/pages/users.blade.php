@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="fa fa-users"></i> Users</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li class="active">Users</li>
                    </ol>
                </div>
            </div>

            <div class="panel">          
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <button class="btn btn-primary" onclick="add()">Add User <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($user as $data)
                            
                            <tr class="gradeX">
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->name }}</td>
                                <td class="actions">
                                    <button class="btn btn-icon btn-sm btn-success" onclick="edit({{ $data->id }})"> <i class="fa fa-edit"></i> </button> 
                                    <button class="btn btn-icon btn-sm btn-danger" onclick="deleteData({{ $data->id }})"> <i class="fa fa-trash"></i> </button>
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
  
  <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Users</h4> 
            </div> 
            
            <form action="{{ Route('users.save') }}" method="post" enctype="multipart/form-data" id="finput">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id"> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label class="control-label">Username</label> 
                                <input type="text" class="form-control" id="username" name="username" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Name</label> 
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Password</label> 
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Confirm Password</label> 
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div> 
                        </div> 
                    </div> 
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close <i class="fa fa-close"></i></button> 
                    <button type="button" id="submit" class="btn btn-primary waves-effect waves-light" onclick="save()">Save <i class="fa fa-save"></i></button> 
                </div> 
            </form>
        </div> 
    </div>
</div><!-- /.modal -->

<script>
    function add()
    {
        $('#edit').modal('show');
        $('#finput')[0].reset();
    }

    function edit(id)
    {
        $('#edit').modal('show');

        $.ajax(
        {
            url:"{{ Route('users.data') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(value)
            {
                $("#id").val(id);
                $("#username").val(value.username);
                $("#name").val(value.name);
                $("#password").val('');
                $("#confirm_password").val('');
            }
        });
    }

    function save()
    {
        if($("#username").val() == "")
        {
            alert("Please fill out Username field!");
            return false;
        }
        
        if($("#name").val() == "")
        {
            alert("Please fill out Name field!");
            return false;
        }

        if($("#id").val() == "" && $("#password").val() == "")
        {
            alert("Please fill out Password field!");
            return false;
        }
        
        if($("#password").val() != $("#confirm_password").val())
        {
            alert("Confirm Password didn't match!");
            return false;
        }

        $.ajax(
        {
            url: "{{ Route('users.save') }}",
            type: 'POST',
            data: 
            {
                id: $("#id").val(),
                username: $("#username").val(),
                name: $("#name").val(),
                password: $("#password").val(),
                _token: '{{csrf_token()}}'
            },
            success: function (response)
            {
                if(response.status != "OK")
                {
                    alert(response.message);
                    return false;
                }
                else
                {
                    swal({
                        title: "Success!",
                        text: "Data created successfully!",
                        type: "success"
                    }, function() {
                        location.reload();
                    });
                }
            }
        });
        
        return false;
    }

    function deleteData(id)
    {
        if(!confirm("Are you sure want to delete this data?")) 
        {
            return false;
        }

        $.ajax(
        {
            url: "{{ Route('users.delete') }}",
            type: 'POST',
            data: 
            {
                id: id,
                _token: '{{csrf_token()}}'
            },
            success: function (response)
            {
                swal({
                    title: "Success!",
                    text: "Data deleted successfully!",
                    type: "success"
                }, function() {
                    location.reload();
                });
            }
        });
        
        return false;
    }
</script>
@endsection