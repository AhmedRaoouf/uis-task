<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Product Catalog</h1>

        <!-- Search Form -->
        @if ($products)
            <form action="{{ route('products.index') }}" method="GET" class="d-flex mb-4">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        @endif

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h2>
                            <p class="card-text">Price: ${{ $product->price }}</p>
                            <p class="card-text">Category: {{ $product->category }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('orders.create', $product->id) }}" class="btn btn-primary">Order</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
        <div>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">All orders</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-PPQ6J5DgM6NmrD8B6HJmtFJFLORP2j8KvTtKoA6tHlTc57tnl1HfIMj35IhCT6zF" crossorigin="anonymous"></script>
</body>
</html>
