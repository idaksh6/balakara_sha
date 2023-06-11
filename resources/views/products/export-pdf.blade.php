<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Student Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Dob</th>
                <th>Gender</th>
                <th>Academic Year</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $stud)
            <tr>
                <td><img src="{{ $stud->student_image }}" alt="Student Image"></td>
                <td>{{strtoupper($stud->first_name)}}</td>
                <td>{{strtoupper($stud->last_name)}}</td>
                <td>{{strtoupper($stud->dob)}}</td>
                <td>{{strtoupper($stud->gender)}}</td>
                <td>{{strtoupper($stud->academic_year)}}</td>
                <td>{{strtoupper($stud->category)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
