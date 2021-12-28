@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="fa fa-newspaper-o"></i> News</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li><a href="{{ Route('news') }}">News</a></li>
                        <li class="active">{{ $proses }}</li>
                    </ol>
                </div>
            </div>

            <div class="panel col-md-12">
                <div class="panel-body">
                    <form action="{{ Route('news.save') }}" method="post" enctype="multipart/form-data" id="finput">
                        {{ csrf_field() }}
                        <input type="hidden" id="id" name="id" value="{{ !isset($data)?'':$data->id_news }}">
                        
                        <center>
                            <div class="panel panel-default" style="width: 500px;">
                                <img id="thmb_src" src="{{ !isset($data)?'':URL::asset('images/news').'/'.$data->thumbnail }}" style="width:100%"/>
                            </div>
                        </center>

                        <div class="form-group">
                            <label>Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" value="{{ !isset($data)?'':$data->thumbnail }}" onchange="showThumbnail(this);" {{ !isset($data)?"required":"" }} accept="image/*"/>
                            <input type="hidden" name="old_thumbnail" id="old_thumbnail" value="{{ !isset($data)?'':$data->thumbnail }}">
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label>Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ !isset($data)?'':$data->title }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label>Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">--Select Category--</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c->id_category }}" {{ ($c->id_category==(!isset($data)?'':$data->id_category))?"selected":"" }}>{{ $c->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="wysihtml5 form-control" rows="22" id="content" name="content" required>{{ !isset($data)?'':$data->content }}</textarea>
                        </div>

                        <center>
                            <button type="submit" id="submit" class="btn btn-primary">Save <i class="fa fa-save"></i></button> 
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showThumbnail(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#thmb_src')
                .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection