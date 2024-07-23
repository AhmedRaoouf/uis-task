<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Orders</h1>
        <div class="product-list">
            @foreach($orders as $order)
                <div class="product-item">
                    <p><strong>Product:</strong> {{ $order->product->name }}</p>
                    <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                    <p><strong>Total Price:</strong> {{ $order->total_price }}</p>
                    <p><strong>Status:</strong> {{ $order->status }}</p>
                    <p><strong>Created at:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y, g:i a') }}</p>

                    <!-- Form to update the order status -->
                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="mt-2">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label">Update Status:</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update Status</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $orders->links() }}
        </div>
        <div>
            <a href="{{ url('/') }}" class="btn btn-primary" >Products</a>
        </div>

    </div>
</body>
</html>
