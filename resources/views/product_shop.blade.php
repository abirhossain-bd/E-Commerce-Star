@if ($products->count() > 0)
    @foreach ($products as $product)
        <div class="col-md-6 col-lg-6 col-xl-4">
            <div class="rounded position-relative fruite-item">
                <div class="fruite-img">
                    <img src="{{ asset($product->image) }}" class="img-fluid w-100 rounded-top"
                        style="height: 200px; object-fit: cover;">
                </div>
                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                    {{ $product->subCategory->name }}</div>
                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4 style="height: 25px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $product->title }}
                    </h4>
                    <p
                        style="height: 60px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #ccc #f1f1f1; padding-right: 10px;">
                        {{ $product->description }}
                    </p>
                    <div class="d-flex justify-content-between flex-lg-wrap">
                        <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }}</p>
                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
<div class="col-md-6 col-lg-6 col-xl-4">
    <img style="height: 200px; margin-top:200px" src="{{ asset('img/no_prod_found.png') }}" alt="">
</div>
@endif



@php
    $currentPage = request()->get('page', 1);
    $offset = ($currentPage - 1) * $perpage;
    $productsOnPage = array_slice($products->toArray(), $offset, $perpage);
@endphp

<div class="col-12">
    <div class="pagination d-flex justify-content-center mt-5">
        <!-- Previous Button -->
        @if ($products->currentPage() > 1)
            <a href="?page={{ $products->currentPage() - 1 }}" class="rounded">&laquo;</a>
        @else
            <a href="#" class="rounded disabled">&laquo;</a>
        @endif

        <!-- Page Numbers -->
        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <a href="?page={{ $i }}" class="rounded {{ $i == $products->currentPage() ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor

        <!-- Next Button -->
        @if ($products->currentPage() < $products->lastPage())
            <a href="?page={{ $products->currentPage() + 1 }}" class="rounded">&raquo;</a>
        @else
            <a href="#" class="rounded disabled">&raquo;</a>
        @endif
    </div>
</div>
