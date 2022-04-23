@extends('backend.layout.app')

@section('title', 'Category page')
@section('breadcrumd_title', 'Category')
@section('breadcrumd_title_sub', 'Add Category Data')

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
      <form action="{{route('admin.handle.add.category')}}" method="post" enctype="multipart/form-data">
        {{-- token csrf --}}
        @csrf
        <div class="form-group">
          <label> Name </label>
          <input class="form-control" name="nameCategory" />
        </div>
        <div class="form-group">
          <label> ParentID </label>
          <input class="form-control" name="parentIdCategory" />
        </div>
        <div class="form-group">
          <label> Description </label>
          <textarea id="editor" class="form-control" name="descCategory" rows="10"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary my-3"> Save </button>
        </div>
      </form>
    </div>
  </div>
@endsection