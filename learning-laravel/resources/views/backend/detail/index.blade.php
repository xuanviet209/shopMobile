@extends('backend.layout.app')

@section('content_app')
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="col-md-5">
            <div class="input-group">
                <select class="form-control" name="choose_select" id="">
                    <option value="name">Name</option>
                    <option value="address">Address</option>
                </select>
                <input class="form-control" type="text" name="key" placeholder="Tìm kiếm ở đây" />
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
            {{-- <a href="{{url('admin/print_order')}}">In đơn hàng</a> --}}
        </div>
        <table class="table mt-3">
            <thead>
                <tr>
                    {{-- <th scope="col">STT</th> --}}
                    <th scope="col">id_Đơn hàng</th>
                    <th scope="col">id_Sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ngày mua</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_detail as $key => $item)
                    <tr id="rowCustomer_{{ $item->id }}">
                        {{-- <td>{{ $key + 1 }}</td> --}}
                        <td>{{ $item->orders_id }}</td>
                        <td>{{ $item->products_id }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $order_detail->links() }}
    </div>
</div>
@endsection