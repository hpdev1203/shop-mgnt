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
        <span class="text-header">CÔNG TY TNHH THỂ THAO TPU</span><br>
        <span>TPU SPORT - KHO SỈ HÀNG THỂ THAO</span><br>
        <span>218 Bà Vân Dân - Thanh Khê - Đà Nẵng</span><br>
        <span>Điện thoại: 0905.045.054</span><br>
        <h2>HÓA ĐƠN BÁN HÀNG</h2>
        <span>Ngày 30 tháng 10 năm 2024</span><br>
        <span>11:37</span>
    </div>

    <div>
        <p><b>Khách hàng:</b> Gia Tiên (Đại Lý)</p>
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
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
            <tr>
                <td>ASTRO ĐỎ - XXL</td>
                <td align='center'>3</td>
                <td align='right'>80,000</td>
                <td align='right'>240,000</td>
            </tr>
        </tbody>
    </table>

    <table class="summary">
        <tbody style="font-size: 9pt;">
            <tr>
                <td>Tổng số lượng:</td>
                <td>41</td>
            </tr>
            <tr>
                <td>Tổng tiền hàng:</td>
                <td>3,230,000</td>
            </tr>
            <tr>
                <td>Chiết khấu:</td>
                <td>258,400</td>
            </tr>
            <tr>
                <td>Thành tiền:</td>
                <td>2,971,600</td>
            </tr>
            <tr>
                <td>Nợ cũ:</td>
                <td>6,069,240</td>
            </tr>
            <tr class="total-cell">
                <td>Cần thanh toán:</td>
                <td>9,040,840</td>
            </tr>
        </tbody>
    </table>

</body>
</html>

