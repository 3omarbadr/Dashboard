@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2> Show cat</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('cats.index') }}"> Back</a>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Name:</strong>
{{ $cat->name }}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Details:</strong>
{{ $cat->detail }}
</div>
</div>
</div>
@endsection
<p class="text-center text-primary"><small>Tutorial by rscoder.com</small></p>