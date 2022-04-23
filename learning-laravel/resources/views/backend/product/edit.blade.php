@extends('backend.layout.app')

@section('title', 'product page')
@section('breadcrumd_title', 'Product')
@section('breadcrumd_title_sub', $infoProduct->name)

@section('content_app')
    <div class="row">
        <div class="col">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.handle.edit.product', ['id' => $infoProduct->id]) }}" method="post"
                enctype="multipart/form-data">
                {{-- token csrf --}}
                @csrf
                <div class="form-group">
                    <label> Name </label>
                    <input value="{{ $infoProduct->name }}" class="form-control" name="nameProduct" />
                </div>
                <div class="form-group">
                    <label> Slug </label>
                    <input value="{{ $infoProduct->name }}" class="form-control" name="slugProduct" />
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="categoryProduct">
                        @foreach ($categories as $item)
                            <option value="{{ $item->categories_id }}">{{ $item->categories_id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control" name="brandProduct">
                        @foreach ($brands as $item)
                            <option value="{{ $item->brands_id }}">{{ $item->brands_id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label> Description </label>
                    <textarea id="editor" class="form-control" name="descProduct" rows="8">{!! $infoProduct->description !!}</textarea>
                </div>
                <div class="form-group">
                    <label> Image Product </label>
                    <input type="file" class="form-control" name="imageProduct" />
                    <div class="my-2">
                        <img class="img-fluid" width="10%" height="10"
                            src={{ asset('storage/images/' . $infoProduct->image) }} />
                    </div>
                </div>
                <div class="form-group">
                    <label> Price </label>
                    <input class="form-control" name="priceProduct" />
                </div>
                <div class="form-group">
                    <label> Quantity </label>
                    <input class="form-control" name="quantityProduct" />
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="statusBrand">
                        <option {{ $infoProduct->status == 1 ? 'selected' : '' }} value="1"> Active </option>
                        <option {{ $infoProduct->status == 0 ? 'selected' : '' }} value="0"> Deactive </option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary my-3"> Save </button>
                </div>
          </form>
        </div>
    </div>
@endsection
