@extends('layouts.app')

@section('title', 'Dashboard - Pioneer Marine Service')

@section('contents')
<div class="bg-white shadow-md rounded-lg p-6">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-blue-500 text-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-center">Total Enquiries</h2>
        {{-- <p class="text-gray-100 text-4xl font-bold text-center"><span class="mr-2"><i class="fas fa-file-alt"></i></span>{{$totalCount}}</p> --}}
    </div>
    <div class="bg-green-500 text-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-center">Approved Quotation</h2>
        {{-- <p class="text-gray-100 text-4xl font-bold text-center"><span class="mr-2"><i class="fas fa-thumbs-up"></i></span>{{$approvedCount}}</p> --}}
    </div>
    <div class="bg-red-500 text-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-center">Rejected Quotation</h2>
        {{-- <p class="text-gray-100 text-4xl font-bold text-center"><span class="mr-2"><i class="fas fa-thumbs-down"></i></span>{{$rejectCount}}</p> --}}
    </div>
    <div class="bg-yellow-500 text-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-center">Pending Quotation</h2>
        {{-- <p class="text-gray-100 text-4xl font-bold text-center"><span class="mr-2"><i class="fas fa-pause-circle"></i></span>{{$pendingCount}}</p> --}}
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
                <th class="px-4 py-2">Enquiry Number</th>
                <th class="px-4 py-2">Customer</th>
                <th class="px-4 py-2">Vessel Name</th>
                <th class="px-4 py-2">Port</th>
                <th class="px-4 py-2">Class</th>
              </tr>
            </thead>
            
            <tbody>
              {{-- @foreach ($recentEnquiries as $recentEnquiry)
              <tr class="bg-white">
                <td class="px-4 py-2">{{$recentEnquiry->enquiry_no}}</td>
                <td class="px-4 py-2">{{$recentEnquiry->customer}}</td>
                <td class="px-4 py-2">{{$recentEnquiry->vessel_name}}</td>
                <td class="px-4 py-2">{{$recentEnquiry->port}}</td>
                <td class="px-4 py-2">{{$recentEnquiry->class}}</td>
              </tr>
              @endforeach --}}
            </tbody>
          </table>
          
      </div>
  </div>
</div>
@endsection
