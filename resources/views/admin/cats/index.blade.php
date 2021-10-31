@extends('admin.layout')

@section('main')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{__('web.cats')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('web.cats')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @include('admin.inc.messages')

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card-header">
                        <h3 class="card-title">{{__('web.allcats')}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-small btn-primary" data-toggle="modal" data-target="#add-modal">Add Category</button>
                        </div>
                    </div>
                </div>
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name (en)</th>
                            <th>Name (ar)</th>
                            <th>img</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach ($cats as $cat)
                    <tbody>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cat->name('en')}}</td>
                            <td>{{$cat->name('ar')}}</td>
                             <td>
                                <img src="{{asset("/cats/$cat->img")}}" height="50px">
                            </td>
                            <td>
                                @if($cat->active)

                                <span class="badge bg-success">yes</span>
                                @else

                                <span class="badge bg-danger">no</span>

                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info edit-btn"  data-id="{{$cat->id}}" data-name-en="{{$cat->name('en')}}" data-name-ar="{{$cat->name('ar')}}" data-img="{{$cat->img}}" data-toggle="modal" data-target="#edit-modal"><i class="fas fa-edit"></i></button>
                                <a href="{{url("dashboard/cats/delete/$cat->id")}}" data-name-en="{{$cat->name('en')}}" data-name-ar="{{$cat->name('ar')}}" data-img="{{$cat->img}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                <a href="{{url("dashboard/cats/toggle/$cat->id")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="d-flex justify-content-center my-3">

                {{$cats->links()}}

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade " id="add-modal" aria-hidden="true" style="display:none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                @include('admin.inc.errors')

                <form method="POST" action="{{url("dashboard/cats/store")}}" enctype="multipart/form-data" id="add-form">

                    @csrf
                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name (en)</label>
                                <input type="text" name="name_en" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name (ar)</label>
                                <input type="text" name="name_ar" class="form-control">
                            </div>
                        </div>
                        <div class=" offset-3 col-6">
                            <div class="form-group">
                                <label>File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="img" class="custom-file-input">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="add-form" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade " id="edit-modal" aria-hidden="true" style="display:none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            @include('admin.inc.errors')

                <!-- form start -->
                <form method="POST" action="{{url('dashboard/cats/update')}}" enctype="multipart/form-data" id="edit-form">

                    @csrf

                    <input type="hidden" name="id" id="edit-form-id">

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name (en)</label>
                                <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name (ar)</label>
                                <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
                            </div>
                        </div>
                        <div class=" offset-3 col-6">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="img" id="edit-form-img">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('scripts')
<script>
    $('.edit-btn').click(function() {
        // e.preventDefult()
        let id = $(this).attr('data-id')
        let nameEn = $(this).attr('data-name-en')
        let nameAr = $(this).attr('data-name-ar')
        let img = $(this).attr('data-img')

        // console.log(id, nameAr, nameEn, img);
        $('#edit-form-id').val(id)
        $('#edit-form-name-en').val(nameEn)
        $('#edit-form-name-ar').val(nameAr)
        // $('#edit-form-img').val(img)
    })
</script>
@endsection