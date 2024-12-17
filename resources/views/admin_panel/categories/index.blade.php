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
                        <h2>Category <small>Create</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input name="name" type="text" class="form-control " placeholder="Category Name">

                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Image
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <img id="cat_img" src="{{ asset('uploads/default/defaultimg.png') }}" alt="" style="height: 120px; widht:100%; object-fit:contain; border-radius:30px; margin: 10px 0;">

                                    <input onchange="document.querySelector('#cat_img').src=window.URL.createObjectURL(this.files[0])" name="image" type="file" class="form-control ">

                                    @error('image')
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
                        <h2>Categories<small>List</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $k=> $category)
                                    <tr>
                                        <th scope="row">{{ $k+1 }}</th>
                                        <td>
                                            <img src="{{ asset($category->image) }}" alt="" style="height: 80px; width:100px">


                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div>
                                                <form id="cat_status{{ $category->id }}" action="{{ route('category.status',$category->id) }}" method="POST">
                                                    @csrf
                                                    <div>

                                                        <input type="checkbox" onchange="document.querySelector('#cat_status{{ $category->id }}').submit()" {{ $category->status == 'active' ? 'checked' : '' }}>
                                                        <label for="">{{ $category->status }}</label>
                                                    </div>

                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-arround">
                                                <a class="btn btn-info btn-sm" href="{{ route('category.edit', $category->id) }}"><i class="fa fa-edit"></i></a>

                                                <form action="{{ route('category.delete',$category->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

                                                </form>
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
