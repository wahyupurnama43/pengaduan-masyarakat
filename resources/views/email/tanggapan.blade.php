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

    <h2>HTML Table</h2>

    <table>
        <tr>
            <th>Petugas</th>
            <th>Tanggapan</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>{{ $tanggapan->user->nama }}</td>
            <td>{{ $tanggapan->tanggapan }}</td>
            <td>{{ $tanggapan->status_tanggapan }}</td>
        </tr>
      
    </table>

</body>

</html>
