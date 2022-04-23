@extends('backend.layout.app')

@section('title', 'Brand page')
@section('breadcrumd_title', 'Brand')
@section('breadcrumd_title_sub', 'Add Brand Data')

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
            <form action="{{ route('admin.handle.add.brand') }}" method="post" enctype="multipart/form-data">
                {{-- token csrf --}}
                @csrf
                <div class="form-group">
                    <label> Name </label>
                    <input class="form-control" name="nameBrand" />
                </div>
                <div class="form-group">
                    <label> Address </label>
                    <input class="form-control" name="addBrand" />
                </div>
                <div class="form-group">
                    <label> Logo </label>
                    <input type="file" class="form-control" name="logoBrand" />
                </div>
                <div class="form-group">
                    <label> Description </label>
                    <textarea id="editor" class="form-control" name="descBrand" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary my-3"> Save </button>
                </div>

            </form>
        </div>
    </div>
@endsection
