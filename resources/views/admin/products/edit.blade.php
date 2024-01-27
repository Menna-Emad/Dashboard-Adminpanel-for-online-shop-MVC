@extends('layouts.parent')

@section('title', 'edit product')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('admin.includes.message')
        </div>
        {{-- /ha3ml pass route parameter ely hwa el id fe el action 3lshan fe el route bb3t id  --}}
        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-6">
                    <label for="name_en">Name En</label>
                    <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $product->name_en }}">
                    @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-6">
                    <label for="name_ar">Name Ar</label>
                    <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                        aria-describedby="helpId">
                    @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-4">
                    <label for="Price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $product->price }}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="Code">Code</label>
                    <input type="number" name="code" id="code" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $product->code }}">
                    @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="Quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $product->quantity }}">
                    @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-4">
                    <label for="Status">Status</label>
                    <select name="status" id="Status" class="form-control">
                        <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active</option>
                        <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="Brands">Brands</label>
                    <select name="brand_id" id="Brands" class="form-control">
                        @foreach ($brands as $brand)
                            <option {{ $product->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">
                                {{ $brand->name_en }}</option>
                        @endforeach
                    </select>
                    @error('brands')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="subcategory_id">Subcategories</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                        @foreach ($subcategories as $subcategory)
                            <option {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}
                                value="{{ $subcategory->id }}">{{ $subcategory->name_en }}</option>
                        @endforeach
                    </select>
                    @error('subcategory_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="desc_en">Desc</label>
                    <textarea name="desc_en" id="desc_en" cols="30" rows="10" class="form-control">{{ $product->id }}</textarea>
                </div>
                @error('desc_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="col-12">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="col-4">
                    <img src="{{ url('dist/img/products/' . $product->image) }}" alt="{{ $product->name_en }}"
                        class="w-100">
                </div>
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="col-2">
                    <button class="btn btn-warning" name="page" value="index"> Update </button>
                </div>
            </div>


        </form>
    </div>
@endsection
