<div class="coupon">
  <div class="container">
    <h3>Mã khuyến mãi từ V|Camera</h3>
  </div>
  <div class="container" style="background-color:white">
    <h2>
      <b>
        <i>
          @if($coupon['coupon_condition'] ==1)
            Giảm {{ $coupon['coupon_number'] }}%
          @else
            Giảm {{ $coupon['coupon_number'] }} $
          @endif
            cho tổng đơn hàng đặt mua
        </i>
      </b>
    </h2>
    <p>Quý khách nhanh tay mua hàng tại shop mã giảm giá còn {{ $coupon['coupon_time'] }} mã</p>
  </div>
  <div class="container">
    <p>Sử dụng mã sau: <span class="promo">{{ $coupon['coupon_code'] }}</span></p>
    <p class="expire">Hạn: 10 ngày tính từ ngày gửi  </div>
</div>

<style>
  .coupon {
  border: 5px dotted #bbb; /* Dotted border */
  width: 80%;
  border-radius: 15px; /* Rounded border */
  margin: 0 auto; /* Center the coupon */
  max-width: 600px;
}

.container {
  padding: 2px 16px;
  background-color: #f1f1f1;
}

.promo {
  background: #ccc;
  padding: 3px;
}

.expire {
  color: red;
}

</style>