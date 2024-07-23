<!-- resources/views/orders/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Order {{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInput = document.getElementById('quantity');
            const totalPriceSpan = document.getElementById('total-price');
            const pricePerUnit = parseFloat('{{ $product->price }}');

            quantityInput.addEventListener('input', function () {
                const quantity = parseInt(quantityInput.value, 10) || 0;
                const totalPrice = (pricePerUnit * quantity);
                totalPriceSpan.textContent = `$${totalPrice}`;
            });

            // Initialize total price on page load
            quantityInput.dispatchEvent(new Event('input'));
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Order {{ $product->name }}</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" class="form-control @error('quantity') is-invalid @enderror">
                @error('quantity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label for="total-price">Total Price:</label>
                <span id="total-price">$0.00</span>
            </div>

                <button type="submit" class="btn btn-primary">Place Order</button>
                <a class="cancel" href="{{ route('products.index') }}">Cancel</a>
        </form>
    </div>
</body>
</html>
