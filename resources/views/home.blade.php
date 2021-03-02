@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-item-center justify-content-between">
                    <div class="inline-block dashboard-text">
                        {{ __('Dashboard') }}
                    </div>
                    <div>
                        <form class="inline-block" method="POST" action="{{ route('logout')}}">
                            @csrf
                            <button class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    {{ __('You are logged in!') }}
                    <div class="d-flex align-items-between">
                        <a class="btn btn-success w-50 m-1" href="{{ route('category.create')}}">Add new category</a>
                        <a class="btn btn-success w-50 m-1" href="{{ route('category.index')}}">Show categories</a>
                    </div>
                    <div class="d-flex align-items-between">
                        <a class="btn btn-success w-50 m-1" href="{{ route('subcategory.create')}}">Add new subcategory</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
