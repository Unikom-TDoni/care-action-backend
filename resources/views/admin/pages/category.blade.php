@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="md md-view-list"></i> Category</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li class="active">Category</li>
                    </ol>
                </div>
            </div>

            <div class="panel">          
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <button class="btn btn-primary" onclick="add()">Add Category <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($category as $data)
                            <tr class="gradeX">
                                <td>{{ $data->category_name }}</td>
                                <td class="actions">
                                    <button class="btn btn-icon btn-sm btn-success" onclick="edit({{ $data->id_category }})"> <i class="fa fa-edit"></i> </button> 
                                    <button class="btn btn-icon btn-sm btn-danger" onclick="deleteData({{ $data->id_category }})"> <i class="fa fa-trash"></i> </button>
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
                <h4 class="modal-title">Category</h4> 
            </div> 
            
            <form action="{{ Route('category.save') }}" method="post" enctype="multipart/form-data" id="finput">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id"> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label class="control-label">Category Name</label> 
                                <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" required> 
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label class="control-label">Icon</label> 
                                <input type="file" class="form-control" id="icon" name="icon" onchange="showIcon(this);" accept="image/*">
                                <input type="hidden" name="old_icon" id="old_icon">
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="panel panel-default" style="width: 80px;">
                                <img id="icon_src" style="width:100%"/>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close <i class="fa fa-close"></i></button> 
                    <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">Save <i class="fa fa-save"></i></button> 
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
        $("#icon").prop('required',true);
        $("#icon_src").attr("src", "");
    }

    function edit(id)
    {
        $('#edit').modal('show');
        $("#icon").prop('required',false);

        $.ajax(
        {
            url:"{{ Route('category.data') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(data)
            {
                $("#id").val(id);
                $("#name").val(data.category_name);
                $("#old_icon").val(data.icon);
                $("#icon_src").attr("src", "{{ URL::asset('images/category') }}" + "/" + data.icon);
            }
        });
    }

    function showIcon(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#icon_src')
                .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deleteData(id)
    {
        if(!confirm("Are you sure want to delete this data?")) 
        {
            return false;
        }

        $.ajax(
        {
            url: "{{ Route('category.delete') }}",
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