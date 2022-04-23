@extends('backend.layout.app')

@section('title', 'category page')
@section('breadcrumd_title', 'Category')
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
    <form action="{{ route('admin.handle.edit.category',['id' => $info->id]) }}" method="post" enctype="multipart/form-data">
      {{-- token csrf --}}
      @csrf
      <div class="form-group">
        <label> Name </label>
        <input value="{{ $info->name }}" class="form-control" name="nameCategory" />
      </div>
      <div class="form-group">
        <label> ParentId </label>
        <input value="{{ $info->parentId }}" class="form-control" name="parentIdCategory" />
      </div>
      <div class="form-group">
        <label> Description </label>
        <textarea id="editor" class="form-control" name="descCategory" rows="8">{!! $info->description !!}</textarea>
      </div>
      <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="statusCategory">
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