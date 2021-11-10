@extends('admin.layout')

@section('main')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{__('web.users')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('web.users')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @include('admin.inc.messages')
    {{-- @include('admin.inc.messages-ajax') --}}

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card-header">
                        <h3 class="card-title">{{__('web.allusers')}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-small btn-primary" data-toggle="modal" data-target="#add-modal">Add User</button>
                        </div>
                    </div>
                </div>
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    @foreach ($users as $key => $user)
                    <tbody id="users-table">
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                                @endif
                            </td>
                            
                            <td>
                                @if($user->status)

                                <span class="badge bg-success">yes</span>
                                @else

                                <span class="badge bg-danger">no</span>

                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info edit-btn" data-id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-toggle="modal" data-target="#edit-modal"><i class="fas fa-edit"></i></button>
                                <a href="{{url("dashboard/users/delete/$user->id")}}" data-name="{{$user->name}}" data-email="{{$user->email}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                <a href="{{url("dashboard/users/toggle/$user->id")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="d-flex justify-content-center my-3">

                {{$users->links()}}

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade " id="add-modal" aria-hidden="true" style="display:none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-s">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                @include('admin.inc.errors')

                <form method="POST" action="{{url("dashboard/users/store")}}" id="add-form">
                <!-- ajax -->
                {{-- <form id="add-form"> --}}

                    @csrf
                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" id="add-form-email">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="add-form-btn" form="add-form" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.inc.errors')

                <!-- form start -->
                <form method="POST" action="{{url('dashboard/users/update')}}" enctype="multipart/form-data" id="edit-form">

                    @csrf

                    <input type="hidden" name="id" id="edit-form-id">

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" id="edit-form-name">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" id="edit-form-email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
        let name = $(this).attr('data-name')
        let email = $(this).attr('data-email')

        // console.log(id, nameAr, nameEn, img);
        $('#edit-form-id').val(id)
        $('#edit-form-name').val(name)
        $('#edit-form-email').val(email)
    })
</script>

{{-- <script>
    $('#success-div').hide();
    $('#errors-div').hide();
    $('#add-form-btn').click(function(e) {
        $('#success-div').hide();
        $('#errors-div').hide();
        $('#success-div').empty();
        $('#errors-div').empty();
        e.preventDefault()
        let formData = new FormData($('#add-form')[0]);

        $.ajax({
            type: "POST",
            url: "{{route('users.store')}}",
            data: formData,
            contentType: false,
            processData: false,

            success: function(data) {
                $('#success-div').show();
                $('#success-div').text(data.success);
                $('#add-modal').modal('hide');
                // $('#users-table tbody:last-child').append("<tr><td>{{$user->name('en')}}</td><td>{{$user->name('ar')}}</td><td><img src='{{asset('$user->img')}}' height='50px'></td></tr>");
                $('#users-table').prepend("<tr><td>{{$user->id}}</td><td>{{$user->name('en')}}</td><td>{{$user->name('ar')}}</td><td><img src='{{asset('$user->img')}}' height='50px'></td><td>@if($user->active)<span class='badge bg-success'>yes</span>@else<span class='badge bg-danger'>no</span>@endif</td><td><button type='button' class='btn btn-sm btn-info edit-btn' data-id='{{$user->id}}' data-name-en='{{$user->name('en')}}' data-name-ar='{{$user->name('ar')}}' data-img='{{$user->img}}' data-toggle='modal' data-target='#edit-modal'><i class='fas fa-edit'></i></button><a href='{{url('dashboard/users/delete/$user->id')}}' data-name-en='{{$user->name('en')}}' data-name-ar='{{$user->name('ar')}}' data-img='{{$user->img}}' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a><a href='{{url('dashboard/users/toggle/$user->id')}}' class='btn btn-sm btn-secondary'><i class='fas fa-toggle-on'></i></a></td></tr>");


            },
            error: function(xhr, status, error) {
                $('#errors-div').show();
                // $('#success-div').hide();



                $.each(xhr.responseJSON.errors, function(key, item) {
                    $('#add-modal').modal('hide');
                    $('#errors-div').append("<p>" + item + "</p>");
                });
            }

        })

    })
</script> --}}
@endsection