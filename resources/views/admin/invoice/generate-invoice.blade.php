<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->id }}</title>
    <style>
        body {
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            color: #002349;
            margin: 0;
            padding: 20px;
        }

        .invoice-container {
            max-width: 94%;
            background: #ffffff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

   

        .card-header h2 {
            color: #002349;
        }

        .card-header p {
            color: #002349;
        }

        .invoice-details,
        .user-details,
        .order-details {
            margin-bottom: 25px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 18px;
        }

        .invoice-details h3,
        .user-details h3,
        .order-details h3 {
            color: #002349;
            margin-top: 0;
        }

        .line {
            border-bottom: 2px solid #002349;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            padding: 10px;
        }

        th,
        td {
            border: 1px solid #002349;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #002349;
            color: #ffffff;
            font-weight: bold;
        }

        td {
            background-color: #ffffff;
        }

        .total {
            font-weight: bold;
            background: #f1f1f1;
        }

        .text-center {
            text-align: center;
            font-weight: bold;
            margin-top: 25px;
            color: #002349;
        }

        .product-color {
            font-size: 12px;
            color: #002349;
        }

        .float-end {
            float: right;
            margin-top: -40px;
            text-align: right;
        }

        /* Responsive Design */
  

       
    </style>
</head>

<body>
    <div class="invoice-container">

   
        <div class="card-header">
            <h2>{{ $appSetting->website_name }}
                <div class="line"></div><br>
            </h2>
            <p class="float-end">
                Invoice ID: {{ $order->id }}<br>
                Date: {{ date('d/m/Y') }}
            </p>
        </div><br>
        

        <div class="row">
            <div class="col-md-12">
                <!-- Order Details -->
                <div class="invoice-details">
                    <h3>Order Details</h3>
                    <div class="line"></div>
                    <p><strong>Order ID :</strong> {{ $order->id }}</p>
                    <p><strong>Tracking No. :</strong> {{ $order->tracking_no }}</p>
                    <p><strong>Ordered Date :</strong> {{ $order->created_at->format('d-m-Y h:i A') }}</p>
                    <p><strong>Payment Mode :</strong> {{ $order->payment_mode }}</p>
                    <p><strong>Order Status :</strong> {{ $order->status_message }}</p>
                </div>

                <!-- User Details -->
                <div class="user-details">
                    <h3>User Details</h3>
                    <div class="line"></div>
                    <p><strong>Full Name :</strong> {{ $order->fullname }}</p>
                    <p><strong>Email :</strong> {{ $order->email }}</p>
                    <p><strong>Phone :</strong> {{ $order->phone }}</p>
                    <p><strong>Address :</strong> {{ $order->address }}</p>
                    <p><strong>Pin Code :</strong> {{ $order->pincode }}</p>
                </div>

                <!-- Order Items -->
                <div class="order-details">
                    <h3>Order Items</h3>
                    <div class="line"></div>

                <div class=" col-md-12 p-5">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        @php $totalPrice = 0; @endphp
                        @foreach ($order->oredrItems as $orderItems)
                            <tr>
                                <td>{{ $orderItems->id }}</td>
                                <td>{{ $orderItems->product->name }}
                                    @if($orderItems->productColor && $orderItems->productColor->color)
                                        <br><small class="product-color">Color: {{ $orderItems->productColor->color->name }}</small>
                                    @endif
                                </td>
                                <td>₹{{ $orderItems->price }}</td>
                                <td>{{ $orderItems->quantity }}</td>
                                <td>₹{{ $orderItems->quantity * $orderItems->price }}</td>
                                @php $totalPrice += $orderItems->quantity * $orderItems->price; @endphp
                            </tr>
                        @endforeach
                        <tr class="table-light">
                            <td colspan="4" class="fw-bold text-end">Total Amount:</td>
                            <td class="fw-bold text-center">₹{{ $order->original_price }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="fw-bold text-success text-end">You saved on this order:</td>
                            <td class="fw-bold text-center text-primary">
                                <span class="fw-bold text-danger">-₹{{ $order->discount_price }}</span>
                            </td>
                        </tr>
                        <tr class="table-dark text-white">
                            <td colspan="4" class="fw-bold text-end">Your Final Amount:</td>
                            <td class="fw-bold text-center">₹{{ $order->total_amount }}</td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>

        <p class="text-center">Thank you for shopping with Green Grovenest!</p>
    </div>
</body>

</html>
