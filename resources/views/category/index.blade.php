@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-item-center justify-content-between">
                    <div class="inline-block dashboard-text">
                        All categories
                    </div>
                    <div>
                        <a class="btn btn-warning" href="{{ route('home') }}">back</a>
                    </div>
                </div>

                <div class="card-body">
                    <category-component :categories="{{$categories}}"></category-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
