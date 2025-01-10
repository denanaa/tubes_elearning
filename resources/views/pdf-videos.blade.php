<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Video</title>
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
        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Data Video</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Module</th>
                <th>Title</th>
                <th>Link</th>
                <th>Thumbnail</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $index => $video)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $video->module->name_module }}</td>
                    <td>{{ $video->title_video }}</td>
                    <td>{{ $video->link_video }}</td>
                    <td>
                        @if ($video->thumbnail_video)
                            <img src="{{ public_path('storage/' . $video->thumbnail_video) }}" alt="Thumbnail">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $video->description_video }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
