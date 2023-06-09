@extends('layouts.app')

@section('title', 'Student Registration Form')

@section('contents')
    <div class="card shadow mb-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header py-3 flex justify-between">
            <h6 class="m-0 font-weight-bold text-primary">Manage Students</h6>
            <a href="{{ route('products.add') }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Students</a>
        </div>
        <div class="card-body">
            <div class="mb-3 flex items-center">
                <form action="{{ route('products.search') }}" method="GET" class="w-full">
                    <div class="flex items-center">
                        <input type="text"
                            class="rounded-l-lg w-full py-2 px-4 border border-gray-300 focus:outline-none focus:border-indigo-500"
                            placeholder="Search by student name" name="student_name" value="{{ old('student_name') }}">
                        <select
                            class="rounded-l-lg w-full py-2 px-4 border border-gray-300 focus:outline-none focus:border-indigo-500"
                            name="category">
                            <option value="">Select category</option>
                            <option value="nursery">Nursery</option>
                            <option value="lkg">LKG</option>
                            <option value="ukg">UKG</option>
                        </select>
                        <select
                            class="rounded-l-lg w-full py-2 px-4 border border-gray-300 focus:outline-none focus:border-indigo-500"
                            name="academic_year">
                            <option value="">Select academic year</option>
                            @for ($year = date('Y'); $year >= 1992; $year--)
                                <option value="{{ $year }}-{{ $year + 1 }}">
                                    {{ $year }}-{{ $year + 1 }}</option>
                            @endfor
                        </select>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg"
                            type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="flex flex-wrap justify-between mb-3">
                @if (!isset($noDataFoundMessage))
                    <div>
                        <a href="{{ route('products.export-excel', ['student_name' => request()->input('student_name'), 'category' => request()->input('category'), 'academic_year' => request()->input('academic_year')]) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2 text-xs">
                            <i class="fas fa-file-excel mr-1"></i>Export to Excel
                        </a>
                        <a href="{{ route('products.export-pdf', ['student_name' => request()->input('student_name'), 'category' => request()->input('category'), 'academic_year' => request()->input('academic_year')]) }}"
                            class="bg-red-500 hover:bg-indigo-700 text-white font-bold py-1 px-2 rounded text-xs">
                            <i class="fas fa-file-pdf mr-1"></i>Export to PDF
                        </a>
                    </div>
                @endif
            </div>
            <div class="table-responsive">
                @if (isset($noDataFoundMessage))
                    <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                        </svg>
                        <p>{{ $noDataFoundMessage }}</p>
                    </div>
                @else
                    <table class="table-auto w-full border-collapse">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2">Action</th>
                                <th class="px-4 py-2">Student Image</th>
                                <th class="px-4 py-2">First Name</th>
                                <th class="px-4 py-2">Last Name</th>
                                <th class="px-4 py-2">Date of Birth</th>
                                <th class="px-4 py-2">Gender</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @foreach ($data as $row)
                                <tr>
                                    <td class="px-4 py-2">
                                        <div>
                                            <a href="{{ route('products.edit', ['category'=>$row->category,'id'=>$row->id]) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i> 
                                            </a>
                                            <a href="#" class="btn btn-danger" onclick="deleteProduct({{ $row->id }})">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>

                                    <td class="px-4 py-2">
                                        @if ($row->student_image)
                                            <img src="{{ asset('student_Photos/' . $row->student_image) }}"
                                                alt="Student Image" width="100">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $row->first_name }}</td>
                                    <td class="px-4 py-2">{{ $row->last_name }}</td>
                                    <td class="px-4 py-2">{{ date('d-m-Y', strtotime($row->dob)) }}</td>
                                    <td class="px-4 py-2">{{ strtoupper($row->gender) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-4">
                @if (request()->has('student_name') || request()->has('category') || request()->has('academic_year'))
                    {{ $data->appends(['student_name' => request()->input('student_name'), 'category' => request()->input('category'), 'academic_year' => request()->input('academic_year')])->links() }}
                @else
                    {{ $data->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection


<script>
    function deleteProduct(productId) {
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('products.delete', '') }}/" + productId;
            }
        });
    }
</script>

