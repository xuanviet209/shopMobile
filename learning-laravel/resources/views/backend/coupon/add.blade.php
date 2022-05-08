@extends('backend.layout.app')

@section('title', 'Category page')
@section('breadcrumd_title', 'Category')
@section('breadcrumd_title_sub', 'Add Category Data')

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
      <form action="{{route('admin.handle.add.coupon')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Tên mã giảm giá</label>
          <input class="form-control" name="coupon_name" />
        </div>
        <div class="form-group">
          <label>Mã giảm giá</label>
          <input class="form-control" name="coupon_code" />
        </div>
        <div class="form-group">
          <label>Số lượng mã</label>
          <input class="form-control" name="coupon_time" />
        </div>
        <div class="form-group">
          <label>Tính năng mã</label>
          <select name="coupon_condition" id="" class="form-control">
            <option value="0">---Chọn---</option>
            <option value="1">Giảm theo %</option>
            <option value="2">Giảm theo tiền</option>
          </select>
        </div>
        <div class="form-group">
          <label>Nhập số % hoặc tiền giảm</label>
          <input class="form-control" name="coupon_number" />
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary my-3"> Save </button>
        </div>
      </form>
    </div>
  </div>
@endsection