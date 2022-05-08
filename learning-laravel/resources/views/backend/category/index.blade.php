@extends('backend.layout.app')

{{--truyền title--}}
{{-- @section('title','Category page')
@section('breadcrumb_title','Category') 
@section('breadcrumb_title_sub','List Category')  --}}

@section('content_app')
<div class="row">
    <div class="col-xl-12 col-md-12">
    <h5 id="title_category"> This is category page !</h5>
    <a href="{{ route('admin.add.category') }}" class="btn btn-primary">Add Category</a>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 pb-3" method="get" action="">
      <div class="input-group">
          <input class="form-control" type="text" name="key" placeholder="Tìm kiếm ở đây" />
          <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
      </div>
    </form>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>STT</th>
            <th>Name</th>
            <th>ParentId</th>
            <th>Description</th>
            <th colspan="2" class="text-center"> Action </th>
          </tr>
        </thead>
        <tbody>
         @foreach($categories as $key => $item)
          <tr id="rowCategory_{{ $item->id }}">
            <td>{{ $key + 1 }}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->parentId}}</td>
            <td>{!! $item->description !!}</td>
            <td>
              <a class="btn btn-info" href="{{route('admin.category.edit',['slug' => Str::slug($item->name, '-'),'id'=> $item->id])}}"><i class="fas fa-edit"></i></a>
            </td>
            <td>
              <button id="delete_category_{{ $item->id }}" class="btn btn-danger" onclick="confirm('Bạn có muốn xóa không !'); deleteCategory({{ $item->id }})"> <i class="fas fa-trash"></i></button>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      {{ $categories->links() }}
    </div>
  </div>
@endsection

@push('javascripts')
  <script>
    function deleteCategory(id) {
      // viet ajax
      $.ajax({
        url: "{{ route('admin.delete.category') }}",
        type: "POST",
        data : { id },
        beforSend: function() {
          $('#delete_category_'+id).text('Loading ...');
        },
        success: function(result) {
          if(result.cod === 200){
            // xoa thanh cong
            $('#rowCategory_'+id).hide();
          } else {
            alert(result.mess);
          }
        }
      })
    }
  </script>
@endpush