<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
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
</style>

<table>
    <thead>
        <tr>
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
            <td>{{$stud->first_name}}</td>
            <td>{{$stud->last_name}}</td>
            <td>{{$stud->dob}}</td>
            <td>{{$stud->gender}}</td>
            <td>{{$stud->academic_year}}</td>
            <td>{{$stud->category}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
