
@extends('products.layout')
{{-- @extends('layouts.app') --}}
   
@section('cartContent')
    
<div class="row">
    @foreach($products as $product)
        <div class="col-md-4">
            <div class="single-blog">
                <div class="blog-img thumbnail">
                    <a href="skill.html">
                        <img src="{{asset('storage/products/'.$product->img)}}" alt="">
                    </a>
                </div>
                <h4>{{ $product->name }}</h4>
                <div>
                    {{$product->description}}
                </div>
                <div class="blog-meta">
                    <p><strong>Price: </strong> {{ $product->price }}$</p>
                    <div>
                        <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
    
@endsection