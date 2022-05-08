@extends('backend.layout.app')

@section('content_app')
<div class="row">
    <div class="col-xl-12 col-md-12">
    <h5 id="title_category">Mã giảm giá</h5>
    <a href="{{ route('admin.add.coupon') }}" class="btn btn-primary">Thêm mã giảm giá</a>
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
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng mã</th>
            <th>Điều kiện giảm giá</th>
            <th>Số giảm</th>
            <th> Action </th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $item)
          <tr id="rowCoupon_{{ $item->coupon_id }}">
            <td>{{ $key+1 }}</td>
            <td>{{ $item->coupon_name }}</td>
            <td>{{ $item->coupon_code }}</td>
            <td>{{ $item->coupon_time }}</td>
            <td>
              <?php 
                if($item->coupon_condition ==1){
                ?>
                Giảm theo %
                <?php 
                  }else{
                ?>
                Giảm theo tiền
                <?php
                  }
                ?>
            </td>
            <td>
              <?php 
                if($item->coupon_condition ==1){
                ?>
                Giảm {{ $item->coupon_number }} %
                <?php 
                  }else{
                ?>
                Giảm {{ $item->coupon_number }} $
                <?php
                  }
                ?>
            </td>
            <td>
              <button id="delete_coupon_{{ $item->coupon_id}}" class="btn btn-danger" onclick="confirm('Bạn có muốn xóa mã này không !'); deleteCoupon({{ $item->coupon_id }})"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('javascripts')
  <script>
    function deleteCoupon(coupon_id) {
      // viet ajax
      $.ajax({
        url: "{{ route('admin.delete.coupon') }}",
        type: "POST",
        data : { coupon_id },
        beforSend: function() {
          $('#delete_coupon_'+ coupon_id).text('Loading ...');
        },
        success: function(result) {
          if(result.cod === 200){
            // xoa thanh cong
            $('#rowCoupon_'+coupon_id).hide();
          } else {
            alert(result.mess);
          }
        }
      })
    }
  </script>
@endpush