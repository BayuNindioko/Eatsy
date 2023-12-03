<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <h2>Laporan</h2>

    <table>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Nama Item</th>
            <th>Item Dipesan</th>
            <th>Harga Total</th>
        </tr>
        <tr>
            <?php $no = 1; ?>
            @foreach ($data['salesData'] as $report)
        <tr>
            <td>
                <?php echo $no++; ?>
            </td>
            <td>{{ Carbon::parse($data['startDate'])->format('d-m-Y') }} Sampai
                {{ Carbon::parse($data['endDate'])->format('d-m-Y') }}</td>
            <td>{{ $report['name'] }}</td>
            <td>{{ $report['total_quantity'] }}</td>
            <td>{{ $report['total_price'] }}</td>
        </tr>
        @endforeach
        <td colspan="4">Total Pemasukan</td>
        <td>{{ $data['totalIncome'] }}</td>
        </tr>
        <tr>
            <td colspan="4">Jumlah Terjual</td>
            <td>{{ $data['totalItemsSold'] }}</td>
        </tr>
    </table>

</body>

</html>
