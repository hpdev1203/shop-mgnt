<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Bán Hàng</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DejaVu+Sans&display=swap');
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            width: 700px;
            margin: 0 auto;
        }
        .invoice-header {
            text-align: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
        .invoice-header h2 {
            margin: 5px 0;
        }
        .invoice-details, .summary {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-details th, .invoice-details td, .summary th, .summary td {
            border: 1px solid black;
            padding: 8px;
           
        }
        .summary {
            margin-top: 20px;
        }
        .summary td {
            text-align: right;
        }
        .total-cell {
            font-weight: bold;
        }
        .text-header{
            font-weight: bold;
            font-size: 30px;
        }
        .rowitem tr{
            height:22px;
        }
        .summary tr{
            height:22px;
        }

    </style>
</head>
<body>

    <div class="invoice-header">
        <span class="text-header">Gia Tiền Sport</span><br>
        <span>{{$title}}</span><br>
        <span>{{$address}}</span><br>
        <span>Hostline: {{$hotline}}</span><br>
        <h2>HÓA ĐƠN BÁN HÀNG</h2>
        <span>{{$date_now}}</span><br>
        <span>{{$time}}</span>
    </div>

    <div>
        <p><b>Khách hàng:</b> {{$username}}</p>
    </div>

    <table class="invoice-details" >
        <thead>
            <tr>
                <th>TÊN HÀNG HÓA</th>
                <th>SL</th>
                <th>ĐƠN GIÁ</th>
                <th>THÀNH TIỀN</th>
            </tr>
        </thead>
        <tbody style="font-size: 9pt;" class="rowitem">
            @foreach ($orderDetails as $detail)
            <tr>
                <td>{{$detail['name']}}</td>
                <td align='center'>{{$detail['quantity']}}</td>
                <td align='right'>{{number_format($detail['price'], 0, ',', '.')}}</td>
                <td align='right'>{{number_format($detail['total'], 0, ',', '.')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary">
        <tbody style="font-size: 9pt;">
            <tr>
                <td>Tổng số lượng:</td>
                <td>{{$total_quantity}}</td>
            </tr>
            <tr>
                <td>Tổng tiền hàng:</td>
                <td>{{number_format($total_price, 0, ',', '.')}}</td>
            </tr>
            <tr>
                <td>Chiết khấu ({{$discount_percent}}%):</td>
                <td>{{number_format($discount, 0, ',', '.')}}</td>
            </tr>
            <tr>
                <td>Thành tiền:</td>
                <td>{{number_format($total_price - $discount, 0, ',', '.')}}</td>
            </tr>
            <tr>
                <td>Nợ cũ:</td>
                <td>{{number_format($totalUnpaid_user, 0, ',', '.')}}</td>
            </tr>
            <tr class="total-cell">
                <td>Cần thanh toán:</td>
                <td>{{number_format($total_price - $discount + $totalUnpaid_user, 0, ',', '.')}}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>

