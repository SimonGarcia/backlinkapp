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
                    Add new subcategory
                    <form class="mt-4" action="{{ route('subcategory.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select category</label>
                        <select name="category_id" id="exampleFormControlSelect1" class="class form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <label for="subcategory">Enter a subcategory</label>
                        <input class="form-control" type="text" name="subcategoryname">
                        @error('subcategoryname')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Submit the subcategory</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
