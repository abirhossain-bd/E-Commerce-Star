@if ($products_eight->count() > 0)
    @foreach ($products_eight as $product)
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="d-flex flex-column h-100 rounded position-relative fruite-item">
            <!-- Image Section -->
            <div class="fruite-img">
                <img src="{{ asset($product->image) }}"
                    class="img-fluid w-100 rounded-top"
                    style="height: 250px; object-fit: cover;">
            </div>

            <!-- Subcategory Badge -->
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                style="top: 10px; left: 10px;">
                {{ $product->subCategory->name }}
            </div>

            <!-- Content Section -->
            <div
                class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column flex-grow-1">
                <h4 class="mb-3">{{ $product->name }}</h4>

                <!-- Description with Scrollbar -->
                <p
                    style="height: 60px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #ccc #f1f1f1; padding-right: 10px;">
                    {{ $product->description }}
                </p>

                <!-- Price and Button -->
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }}</p>
                    <a href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary">
                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                        cart
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else

    <h6 class="text-danger">Product is not available!</h6>

@endif
