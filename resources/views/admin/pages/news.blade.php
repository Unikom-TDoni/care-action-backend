@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="fa fa-newspaper-o"></i> News</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li class="active">News</li>
                    </ol>
                </div>
            </div>

            <div class="panel">          
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <td class="actions">
                                    <a href="{{ url('admin/news/add') }}" class="btn btn-primary">Add News <i class="fa fa-plus"></i></a>
                                </td>
                            </div>
                        </div>
                    </div>
                         
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ Route('news') }}" class="form-inline" role="form" style="float: right;">
                                <div class="form-group">
                                    <label>Date Start</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start" value="{{ $date_start }}">
                                </div>
                                
                                <div class="form-group">
                                    <label>Date End</label>
                                    <input type="date" class="form-control" id="date_end" name="date_end" value="{{ $date_end }}">
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" id="filter" name="filter">
                                        <option value="0" {{ ($filter==0)?"selected":"" }}>All Category</option>

                                        @foreach($category as $data)
                                        <option value="{{ $data->id_category }}" {{ ($data->id_category==$filter)?"selected":"" }}>{{ $data->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-inverse waves-effect waves-light m-l-10"><i class="fa fa-search"> Search</i></button>
                            </form>
                        </div>
                    </div>

                    <hr>
                    
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Created</th>
                                <th>Creator</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Recommended</th>
                                <th></th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($news as $data)
                            <tr class="gradeX">
                                <td>{{ date("d-m-Y H:i", strtotime($data->created_at)) }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->category->category_name }}</td>
                                <td>
                                    <input type="checkbox" data-toggle="toggle" value="rec{{ $data->id_news }}" onchange="setIsRecommended({{ $data->id_news }}, this.checked)" {{($data->is_recommended)?"checked":""}}>
                                </td>
                                <td class="actions">
                                    <a href="{{ url('admin/news/detail/'.$data->id_news) }}" class="btn btn-icon btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    <button class="btn btn-icon btn-sm btn-danger" onclick="deleteData({{ $data->id_news }})"> <i class="fa fa-trash"></i> </button>
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

  
<script>
    function setIsRecommended(id, is_recommended)
    { 
        $.ajax(
        {
            url: "{{ Route('news.recommended') }}",
            type: 'POST',
            data: 
            {
                id: id,
                recommended: (is_recommended)?1:0,
                _token: '{{csrf_token()}}'
            },
            success: function (response)
            {
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
            url: "{{ Route('news.delete') }}",
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