@extends('admin_panel.layouts.app')


@section('content')
    <!-- page content -->
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Product <small>Create</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="{{ route('offer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Title
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input name="title" type="text" class="form-control ">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Offer
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input name="offer" type="text" class="form-control ">
                                    @error('offer')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>



                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Category
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select name="category_id" class="form-control" >
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $catgory )
                                            <option value="{{ $catgory->id }}">{{ $catgory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Sub-Category
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select name="subcategory_id" class="form-control">
                                        <option value="">Select Sub-Category</option>
                                        @foreach ($subcategories as $sub_cat )
                                            <option value="{{ $sub_cat->id }}" class="data_category_options" data-category_id="{{ $sub_cat->category_id }}" style="display: none">{{ $sub_cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Image
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input name="image" type="file" class="form-control ">
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
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
@endsection

@push('scripts')

    <script>
        $('select[name=category_id]').change(function(){
            var category_id = $(this).val();
            $('.data_category_options').hide();
            $('.data_category_options[data-category_id='+ category_id +']').show();
        });
    </script>

@endpush
