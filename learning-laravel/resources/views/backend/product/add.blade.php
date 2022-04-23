@extends('backend.layout.app')

@section('title', 'Product page')
@section('breadcrumd_title', 'Product')
@section('breadcrumd_title_sub', 'Add Product Data')

@section('content_app')
<div class="row">
  <div class="col">
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
    <form action="{{ route('admin.handle.add.product') }}" method="post" enctype="multipart/form-data">
      {{-- token csrf --}}
      @csrf
      <div class="form-group">
        <label> Name </label>
        <input class="form-control" name="nameProduct" />
      </div>
      <div class="form-group">
        <label> Slug </label>
        <input class="form-control" name="slugProduct" />
      </div>
      <div class="form-group">
        <label>Category</label>
       <select class="form-control" name="categoryProduct">
         @foreach($categories as $item)
         <option value="{{$item->id}}">{{$item->id.'-'.$item->name}}</option>
         @endforeach
       </select>
      </div>
      <div class="form-group">
        <label>Brand</label>
        <select class="form-control" name="brandProduct">
          @foreach($brands as $item)
          <option value="{{$item->id}}">{{$item->id.'-'.$item->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label> Description </label>
        <textarea id="editor" class="form-control" name="descProduct" rows="8"></textarea>
      </div>
      <div class="form-group">
        <label> Image Product </label>
        <input type="file" class="form-control" name="imageProduct" />
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
        <button type="submit" class="btn btn-primary my-3"> Save </button>
      </div>
    </form>
  </div>
</div>
@endsection