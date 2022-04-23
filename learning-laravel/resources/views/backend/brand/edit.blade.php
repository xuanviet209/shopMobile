@extends('backend.layout.app')

@section('title', 'brand page')
@section('breadcrumd_title', 'Brand')
@section('breadcrumd_title_sub', $info->name)

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
    <form action="{{ route('admin.handle.edit.brand',['id' => $info->id]) }}" method="post" enctype="multipart/form-data">
      {{-- token csrf --}}
      @csrf
      <div class="form-group">
        <label> Name </label>
        <input value="{{ $info->name }}" class="form-control" name="nameBrand" />
      </div>
      <div class="form-group">
        <label> Address </label>
        <input value="{{ $info->address }}" class="form-control" name="addBrand" />
      </div>
      <div class="form-group">
        <label> Logo </label>
        <input type="file" class="form-control" name="logoBrand" />
        <div class="my-2">
          <img class="img-fluid" width="10%" height="10" src={{ asset('storage/images/'.$info->logo) }} />
        </div>
      </div>
      <div class="form-group">
        <label> Description </label>
        <textarea id="editor" class="form-control" name="descBrand" rows="8">{!! $info->description !!}</textarea>
      </div>
      <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="statusBrand">
          <option {{ $info->status == 1 ? "selected" : "" }} value="1"> Active </option>
          <option {{ $info->status == 0 ? "selected" : "" }} value="0"> Deactive </option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary my-3"> Save </button>
      </div>
      
    </form>
  </div>
</div>
@endsection