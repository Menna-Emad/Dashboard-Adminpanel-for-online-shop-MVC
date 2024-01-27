@extends('layouts.parent')

@section('title', 'create product')
{{-- method =post
    action= 127.0.0.1.8000/dashboard/products/store
    store product:1)validate 2)upload image 3)insert 4)direct to page --}}

@section('content')
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @include('admin.includes.message')
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-6">
                <label for="name_en">Name En</label>
                <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ old('name_en') }}">
            </div>


            <div class="col-6">
                <label for="name_ar">Name Ar</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ old('name_ar') }}">
            </div>
        </div>

        <div class="form-row">
            <div class="col-4">
                <label for="Price">Price</label>
                <input type="number" name="price" id="price" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ old('price') }}">
            </div>

            <div class="col-4">
                <label for="Code">Code</label>
                <input type="number" name="code" id="code" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ old('code') }}">
            </div>

            <div class="col-4">
                <label for="Quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ old('quantity') }}">
            </div>
        </div>

        <div class="form-row">
            <div class="col-4">
                <label for="Status">Status</label>
                <select name="status" id="Status" class="form-control">
                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                    <option {{ old('status') == 0 ? 'selected' : '' }}value="0">Not Active</option>
                </select>
            </div>

            <div class="col-4">
                <label for="Brands">Brands</label>
                <select name="brand_id" id="Brands" class="form-control">
                    @foreach ($brands as $brand)
                        <option {{ old('btand_id') == $brand->id ? 'selected' : '' }}value="{{ $brand->id }}">
                            {{ $brand->name_en }}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-4">
                <label for="category_id">Categories</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option
                            {{ old('category_id') == $category->id ? 'selected' : '' }}value="{{ $category->id }}">
                            {{ $category->name_en }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-4">
                <label for="subcategory_id">Subcategories</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control">
                    @foreach ($subcategories as $subcategory)
                        <option
                            {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}value="{{ $subcategory->id }}">
                            {{ $subcategory->name_en }}</option>
                    @endforeach
                </select>
            </div>


        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="desc_en">Desc En</label>
                <textarea name="desc_en" id="desc_en" cols="30" rows="10" class="form-control">{{ old('desc_en') }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="col-6">
                <label for="desc_ar">Desc ar</label>
                <textarea name="desc_ar" id="desc_ar" cols="30" rows="10" class="form-control">{{ old('desc_ar') }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="col-12">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
        </div>

        <div class="form-row my-3">
            <div class="col-2">
                <button class="btn btn-primary" name="page" value="index">Create</button>
            </div>

            <div class="col-2">
                <button class="btn btn-dark" name="page" value="back">Create & return</button>
            </div>
        </div>


    </form>
@endsection
