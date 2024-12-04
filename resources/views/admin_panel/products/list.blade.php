@extends('admin_panel.layouts.app')



@section('content')
    <!-- page content -->
    @include('message')
    <div class="">
        <div class="clearfix"></div>

        <div class="row" style="display: block;">

            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Products<small>List</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $k=> $product)
                                    <tr>
                                        <th scope="row">{{ $k+1 }}</th>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->discount_price }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->subCategory->name }}</td>
                                        <td>
                                            <img src="{{ asset($product->image) }}" height="100", width="100">
                                        </td>
                                        <td>
                                            <form id="product_status{{ $product->id }}" action="{{ route('product.status',$product->id) }}" method="POST">
                                                @csrf
                                                <div>
                                                    <input onchange="document.querySelector('#product_status{{ $product->id }}').submit()" type="checkbox" {{ $product->status == 'active' ? 'checked' : '' }} >
                                                    <label for="">{{ $product->status }}</label>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <div>
                                                <a class="btn btn-info btn-sm" href="#"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- /page content -->
@endsection
