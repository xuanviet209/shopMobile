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
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer as $key => $item)
                        <tr id="rowCustomer_{{ $item->id }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
