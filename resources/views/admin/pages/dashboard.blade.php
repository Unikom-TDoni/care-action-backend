@extends('admin.layouts.layout')

@section('content')
<div class="content-page">
  <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="md md-dashboard"></i> Dashboard</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Dashboard</a></li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <span class="mini-stat-icon bg-info"><i class="md md-view-list"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter">{{ $total_category }}</span>
                            Total Category
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <span class="mini-stat-icon bg-purple"><i class="fa fa-newspaper-o"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter">{{ $total_news }}</span>
                            Total News
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <span class="mini-stat-icon bg-success"><i class="fa fa-user"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter">{{ $total_customer }}</span>
                            Total Customer
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <span class="mini-stat-icon bg-primary"><i class="fa fa-users"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter">{{ $total_user }}</span>
                            Total Users
                        </div>
                    </div>
                </div>
            </div> 
            <!-- End row-->

            <div class="panel panel-default">    
                <div class="panel-heading">
                    <h3 class="panel-title">Today's News</h3>
                </div>      
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Created</th>
                                <th>Creator</th>
                                <th>Title</th>
                                <th>Category</th>
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
                                <td class="actions">
                                    <a href="{{ url('admin/news/detail/'.$data->id_news) }}" class="btn btn-icon btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div style="float: right">
                        <a href="{{ Route('news') }}" class="btn btn-icon btn-sm btn-primary">SEE ALL NEWS <i class="fa fa-arrow-right"></i></i></a>
                    </div>
                </div>
                <!-- end: page -->
            </div> <!-- end Panel -->
        </div>
    </div>
</div>
@endsection