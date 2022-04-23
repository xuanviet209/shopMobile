@extends('backend.layout.app')
@section('content_app')
<div class="row">
    <div class="col-xl-12 col-md-12">
      {{-- <h5 id="title_brand"> This is brand page !</h5> --}}
      <div class="col-md-12">
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 pb-3" method="get" action="{{route('admin.user')}}">
      <div class="input-group">
         <select class="form-control" name="choose_select" id="">
           <option value="name">Name</option>
           <option value="address">Address</option>
         </select>
          <input class="form-control" type="text" name="" placeholder="Tìm kiếm ở đây" />
          <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
      </div>
    </form>
      <a href="" class="btn btn-primary"> Add User</a>
    <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th> # </th>
            <th> Username </th>
            <th>Password</th>
            <th>Email</th>
            <th>Phone</th>
            <th width="50%">Fullname</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Birthday</th>
            <th width="">Avatar</th>
            <th colspan="2" class="text-center" width="5%"> Action </th>
          </tr>
        </thead>
        <tbody>
          {{-- @if(count($brands) > 0) --}}
            @foreach($users as $key => $item)
            <tr id="">
              <td>{{$key+1}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->password}}</td>
              <td>{{$item->email}}</td>
              <td>{{$item->phone}}</td>
              <td>{{$item->fullname}}</td>
              <td>{{$item->address}}</td>
              <td>{{$item->gender}}</td>
              <td>{{$item->birthday}}</td>
              <td>
                <img class="img-fluid" width="50%" height="50%" src= />
              </td>
              <td>
                <a class="btn btn-info" href=""><i class="fas fa-edit"></i></a>
              </td>
              <td>
                <button id="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
              </td>
            </tr>
            @endforeach
          {{-- @else
            <b>chưa có dữ liệu nhãn hiệu</b>
          @endif --}}
        </tbody>
      </table>
      {{-- {{ $brands->links() }} --}}
    </div>
  </div>
@endsection