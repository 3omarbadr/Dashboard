@extends('products.layout')
@section('cartContent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Payment Methods</div>

                <div class="card-body">
                    <form class="validation" method="POST" action="{{ route('payment.process') }}" novalidate="">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="hidden" name="amount" value="{{$amount}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 custom-radio">
                                <input name="PaymentMethodId" type="radio" value="2">
                                <label>Visa</label>
                            </div>
                            <div class="col-md-6 custom-radio">
                                <input name="PaymentMethodId" type="radio" value="2">
                                <label>Master Card</label>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Name On Card</label>
                                    <input type="text" class="form-control" id="cc-name">
                                    <small class="text-muted">Full Name As Displayed On Card</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Credit Card Number</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Expiration</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>CVV</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
