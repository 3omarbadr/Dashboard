
@include('livewire.create')

<!-- Main content -->
<div class="content col-md-12">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @if (session()->has('msg'))
                <div class="alert alert-success">
                    {{session('msg')}}
                </div>
                @endif
                <div class="card-body">
                    <h3 class="card-title">{{__('web.allproducts')}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-small btn-primary" data-toggle="modal"
                            data-target="#addproductModal">Add New Product</button>
                    </div>
                </div>
            </div>
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        {{-- <th>img</th> --}}
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach ($data as $product)
                <tbody id="products-table">
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        {{-- <td>
                            <img src="{{Storage::disk('cats')->url($product->img)}}" height="50px">
                        </td> --}}

                        <td>{{$product->price}}</td>

                        <td>
                            <button type="button" class="btn btn-sm btn-info edit-btn" data-id="{{$product->id}}"
                                data-name="{{$product->name}}" data-img="{{$product->img}}" data-toggle="modal"
                                data-target="#edit-modal"><i class="fas fa-edit"></i></button>
                            <a href="{{url("dashboard/products/delete/$product->id")}}" data-name="{{$product->name}}"
                                data-img="{{$product->img}}" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>