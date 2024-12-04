@extends('admin_panel.layouts.app')


@section('content')



    <!-- page content -->
    @include('message')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sub-Category <small>Create</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="{{ route('subcategory.store') }}" method="POST">
                            @csrf

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input name="name" type="text" class="form-control " placeholder="Sub-Category Name">

                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Select Category
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category )
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->




    <div class="">
        <div class="clearfix"></div>

        <div class="row" style="display: block;">

            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sub-Categories<small>List</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $k=> $sub_cat)
                                    <tr>
                                        <th scope="row">{{ $k+1 }}</th>
                                        <td>{{ $sub_cat->name }}</td>
                                        <td>{{ $sub_cat->category->name }}</td>
                                        <td>
                                            <div>
                                                <form id="subcat_status{{ $sub_cat->id }}" action="{{ route('subcategory.status',$sub_cat->id) }}" method="POST">
                                                    @csrf
                                                    <div>

                                                        <input type="checkbox" onchange="document.querySelector('#subcat_status{{ $sub_cat->id }}').submit()" {{ $sub_cat->status == 'active' ? 'checked' : '' }}>
                                                        <label for="">{{ $sub_cat->status }}</label>
                                                    </div>

                                                </form>
                                            </div>
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




@endsection
