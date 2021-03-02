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
                        <a class="btn btn-warning" href="{{ route('home') }}">back</a>
                    </div>
                </div>

                <div class="card-body">
                    Add new category
                    <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="form-group mt-4">
                        <label for="category">Enter a category</label>
                        <input class="form-control" type="text" name="categoryname">
                        @error('categoryname')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Submit the category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
