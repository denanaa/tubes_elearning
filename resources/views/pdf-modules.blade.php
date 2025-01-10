<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Modul</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Modul</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name Category</th>
                <th>Modul Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $index => $modul)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $modul->category->name }}</td>
                    <td>{{ $modul->name_module }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
