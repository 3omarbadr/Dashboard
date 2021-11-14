<div>
    @include('livewire.create')
    @include('livewire.update')
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
                            data-target="#add-product">Add New Product</button>
                            <a class="btn btn-small btn-dark" href="{{route('cart')}}" >Add To Cart</a>
                    </div>
                </div>
                
            </div>
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>img</th>
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
                        <td>
                            <img src="{{asset('storage/products/'.$product->img)}}" height="50px">
                        </td>

                        <td>{{$product->price}}</td>

                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#update-product" wire:click.prevent='edit({{$product->id}})'>Edit</button>
                            <button type="button" class="btn btn-sm btn-danger" wire:click.prevent='delete({{$product->id}})'>Delete</button>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
</div>