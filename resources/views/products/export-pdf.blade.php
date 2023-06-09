<html>
<head>
    <link rel="stylesheet" href="{{ public_path('css/custom.css')}}">
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                {{-- <th>Class</th>
                <th>Payment Terms</th>
                <th>Validity</th>
                <th>Currency</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $stud)     
            <tr>
                <td>{{$stud->first_name}}</td>
                <td>{{$stud->last_name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>