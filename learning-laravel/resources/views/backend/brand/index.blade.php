@extends('backend.layout.app')

{{-- truyền title --}}
{{-- @section('title', 'Brand page')
@section('breadcrumb_title', 'Brand') 
@section('breadcrumb_title_sub', 'List Brand') --}}

@section('content_app')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <h5 id="title_brand"> This is brand page !</h5>
            <div class="col-md-12">
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 pb-3" method="get"
                    action="{{ route('admin.brand') }}">
                    <div class="input-group">
                        <select class="form-control" name="choose_select" id="">
                            <option value="name">Name</option>
                            <option value="address">Address</option>
                        </select>
                        <input class="form-control" type="text" name="key" placeholder="Tìm kiếm ở đây" />
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <a href="{{ route('admin.add.brand') }}" class="btn btn-primary"> Add brand</a>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th width="10%"> Name </th>
                            <th width="30%"> Logo </th>
                            <th> Address </th>
                            <th>Desc</th>
                            <th colspan="2" class="text-center" width="5%"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($brands) > 0)
                            @foreach ($brands as $key => $item)
                                <tr id="rowBrand_{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $item->name }}</td>
                                    <td>
                                        <img class="img-fluid" width="50%" height="50%"
                                            src={{ asset('storage/images/' . $item->logo) }} />
                                    </td>
                                    <td>{{ $item->address }}</td>
                                    <td>{!! $item->description !!}</td>
                                    <td>
                                        <a class="btn btn-info"
                                            href="{{ route('admin.brand.edit', ['slug' => Str::slug($item->name, '-'), 'id' => $item->id]) }}"><i
                                                class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <button id="delete_brand_{{ $item->id }}" class="btn btn-danger"
                                            onclick="confirm('Bạn có muốn xóa không !');deleteBrand({{ $item->id }})"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <b>chưa có dữ liệu nhãn hiệu</b>
                        @endif
                    </tbody>
                </table>
                {{ $brands->links() }}
            </div>
        </div>
@endsection

    @push('javascripts')
        <script>
            function deleteBrand(id) {
                // viet ajax
                $.ajax({
                    url: "{{ route('admin.delete.brand') }}",
                    type: "POST",
                    data: {
                        id
                    },
                    beforSend: function() {
                        $('#delete_brand_' + id).text('Loading ...');
                    },
                    success: function(result) {
                        if (result.cod === 200) {
                            // xoa thanh cong
                            $('#rowBrand_' + id).hide();
                        } else {
                            alert(result.mess);
                        }
                    }
                })
            }
        </script>
    @endpush
