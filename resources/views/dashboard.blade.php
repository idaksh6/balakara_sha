@extends('layouts.app')

@section('title', 'Dashboard - BALAKARA SHARADHE')

@section('contents')
<div class="bg-white shadow-md rounded-lg p-6">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-blue-500 text-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-center">Total Students</h2>
        <p class="text-gray-100 text-4xl font-bold text-center"><span class="mr-2"></span>{{ $totalStudents }}</p>
    </div>
    <div class="bg-green-500 text-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-center">LKG Students</h2>
        @foreach($categoryCounts as $category)
            @if($category->category === 'lkg')
                <p class="text-gray-100 text-4xl font-bold text-center"><span class="mr-2"></span>{{ $category->count }}</p>
            @endif
        @endforeach
    </div>
    <div class="bg-red-500 text-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-center">UKG Students</h2>
        @foreach($categoryCounts as $category)
            @if($category->category === 'ukg')
                <p class="text-gray-100 text-4xl font-bold text-center"><span class="mr-2"></i></span>{{ $category->count }}</p>
            @endif
        @endforeach
    </div>
    <div class="bg-yellow-500 text-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-center">NURSERY Students</h2>
        @foreach($categoryCounts as $category)
            @if($category->category === 'nursery')
                <p class="text-gray-100 text-4xl font-bold text-center"><span class="mr-2"></span>{{ $category->count }}</p>
            @endif
        @endforeach
    </div>
  </div>
</div>


<div class="mt-8 mb-4">
  <div class="bg-white shadow-md rounded-lg p-6">
      <h2 class="text-xl font-semibold mb-4">Recently Registerd Students</h2>
      <div class="overflow-x-auto">
        <table class="w-full border-collapse table-auto">
            <thead class="bg-gray-200">
              <tr>
                                <th class="px-4 py-2">Student Image</th>
                                <th class="px-4 py-2">First Name</th>
                                <th class="px-4 py-2">Last Name</th>
                                <th class="px-4 py-2">Date of Birth</th>
                                <th class="px-4 py-2">Gender</th>
                                <th class="px-4 py-2">Category</th>
                
              </tr>
            </thead>
            
            <tbody>
            @foreach ($data as $row)
                                <tr>
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
                                    <td class="px-4 py-2">{{ strtoupper($row->category) }}</td>
                                </tr>
                            @endforeach
            </tbody>
          </table>
          
      </div>
      <div class="mt-4">
    @if ($data->total() > 0)
        {{ $data->appends(request()->except('page'))->links() }}
    @endif
</div>

  </div>
</div>


@endsection
