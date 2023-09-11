<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        /* CSS untuk menggaya tabel */
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        /* tr:nth-child(even) {
            background-color: #f2f2f2;
        } */

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 style="text-align: center;">Laporan Transaksi Tanggal : {{ date('Y F d') }}</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Pegawai</th>
                    <th>Member</th>
                    <th>Outlet</th>
                    <th>Paket</th>
                    <th>Total Harga Paket</th>
                    <th>Total</th>
                    <th>Tgl Masuk</th>
                    <th>Batas Waktu</th>
                    <th>Tgl Bayar</th>
                    <th>Status Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ( $generate as $generate )
                <tr>
                    <td>{{ $no++ }}.</td>
                    <td>{{ $generate->id_transaksi }}</td>
                    <td>{{ $generate->username_user }}</td>
                    <td>{{ $generate->member }}</td>
                    <td>{{ $generate->outlet }}</td>
                    <td>{{ $generate->paket }}</td>
                    <td>{{ $generate->total_harga_paket }}</td>
                    {{-- <td>
                        @foreach (explode('.',$generate->nama_paket) as $item)
                            {{ $item }}
                        @endforeach
                    </td> --}}
                    {{-- <td>
                        @foreach ($generate as $item)
                            {{ $item->nama_paket }}
                        @endforeach
                    </td> --}}
                    <td>{{ $generate->total }}</td>
                    <td>{{ $generate->tgl_masuk }}</td>
                    <td>{{ $generate->batas_waktu_bayar }}</td>
                    <td>{{ $generate->tgl_bayar }}</td>
                    <td>{{ $generate->status_pembayaran }}</td>
                    <td>{{ $generate->status }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
