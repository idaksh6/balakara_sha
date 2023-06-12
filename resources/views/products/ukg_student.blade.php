@extends('layouts.app')

@section('contents')
<div class="text-center">
    <h2 class="text-black">UKG Students Registration Form</h2>
</div>


@if ($message = Session::get('success'))

<div class="container-fluid pt-2">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="myAlertCloseButton">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

@endif

<form id="myForm" action="{{ isset($product) ? route('products.update', $product->id) : route('products.saveukg') }}"
    method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="tab" value="ukg">
    <div class="row">
        <div class="col-12 text-black ">
            <div class="card shadow mb-4">
                <div class="card-body">
                    {{-- image of the students --}}
                    <div class="flex flex-col md:items-start items-center md:justify-start justify-center">
                        <label class="" for="student_image_ukg">Student Image</label>
                        <div>

                            <label for="student_image_upload">
                                <img id="student_image_preview_ukg"
                                    src="{{ isset($product) && $product->student_image ? asset('student_Photos/'.$product->student_image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_RlT-ytB9A_TQFLKMqVYpdJiiRbckTCThmw&usqp=CAU' }}"
                                    alt="Default Image" style="height: 100px; width: 100px; cursor: pointer;object-fit:contain;">
                            </label>
                            <input id="student_image_upload_ukg" type="file" name="student_image" accept="image/*"
                                style="display: none" onchange="showFile_ukg(event)">
                        </div>
                    </div>



                    {{-- Name of the applicant --}}
                    <div class="mt-10 text-black">
                        <h5>Name of the Applicant</h5>
                        <div class="form-group md:flex gap-6">
                            <div class="first_name md:w-1/2">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control w-full" name="first_name"
                                    value="{{ old('first_name', isset($product) ? $product->first_name : '') }}">
                                @error('first_name')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="last_name md:w-1/2">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ old('last_name', isset($product) ? $product->last_name : '') }}">
                                @error('last_name')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- date of birth --}}
                    <div class="form-group">
                        <div class="dob">
                            <label for="item_code">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                value="{{ old('dob',isset($product) ? $product->dob : '') }}">
                            @error('dob')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- gender --}}
                    <div class="form-group">
                        <div class="gender">
                            <label for="gender">Gender</label>
                            <div>
                                <label>
                                    <input type="radio" id="gender_male" name="gender" value="male"
                                        {{ (isset($product) && $product->gender === 'male' ? 'checked' : '') }}>
                                    Male
                                </label>
                                <label>
                                    <input type="radio" id="gender_female" name="gender" value="female"
                                        {{ isset($product) && $product->gender === 'female' ? 'checked' : '' }}>
                                    Female
                                </label>
                            </div>
                            @error('gender')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    {{-- academic year --}}

                    <div class="form-group">
                        <div class="academic_year">
                            <label for="academic_year">Academic Year</label>
                            <?php
                                $currentYear = date('Y');
                                $startYear = 1992;
                                
                                $academicYears = [];
                                for ($year = $startYear; $year <= $currentYear; $year++) {
                                    $academicYears["$year-" . ($year + 1)] = "$year-" . ($year + 1);
                                }
                                ?>

                            <select class="form-control" name="academic_year" id="academic_year"
                                value="{{ isset($product) ? $product->academic_year : '' }}">
                                <?php foreach ($academicYears as $year): ?>
                                <option value="<?php echo $year; ?>"
                                    <?php echo $year === $currentYear . '-' . ($currentYear + 1) ? 'selected' : ''; ?>>
                                    <?php echo $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>


                    {{-- Grade --}}
                    <div class="form-group ">
                        <div class="grade">
                            <label for="item_code">Grade</label>
                            <input type="text" class="form-control" id="grade" name="grade"
                                value="{{ old('grade',isset($product) ? $product->grade : '') }}">
                            @error('grade')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Language spoken --}}
                    <div class="form-group ">
                        <div class="language">
                            <label for="language">Language Spoken:</label>
                            <input type="text" class="form-control" id="language" name="language"
                                value="{{ old('language',isset($product) ? $product->language : '') }}">
                            @error('language')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    {{-- Details of Sibling --}}
                    <div class="form-group">
                        <div class="sibling_details">
                            <label for="sibling_details">Details of sibling:</label>
                            <textarea class="form-control" id="sibling_details" name="sibling_details"
                                rows="5">{{ old('sibling_details',isset($product) ? $product->sibling_details : '') }}</textarea>
                        </div>
                    </div>





                    {{-- parents Information --}}
                    <h5>parents Information</h5>
                    <div class="mt-10">
                        <div class="form-group md:flex items-center">
                            <label for="fathers_name" class="md:w-1/6">Fathers Name</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="fathers_name" name="fathers_name"
                                    value="{{ old('fathers_name', isset($product) ? $product->fathers_name : '') }}">
                                @error('fathers_name')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="fathers_qualification" class="md:w-1/6">Fathers Qualification</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="fathers_qualification"
                                    name="fathers_qualification"
                                    value="{{ old('fathers_qualification',isset($product) ? $product->fathers_qualification : '') }}">
                                @error('fathers_qualification')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="fathers_email_details" class="md:w-1/6">Fathers Email</label>
                            <div class="md:w-5/6">
                                <input type="email" class="form-control" id="fathers_email_details"
                                    name="fathers_email_details"
                                    value="{{ old('fathers_email_details', isset($product) ? $product->fathers_email_details : '') }}">

                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="fathers_contact_details" class="md:w-1/6">Fathers Phone Number</label>
                            <div class="md:w-5/6">
                                <input type="number" class="form-control" id="fathers_contact_details"
                                    name="fathers_contact_details"
                                    value="{{ old('fathers_contact_details',isset($product) ? $product->fathers_contact_details : '') }}">
                                @error('fathers_contact_details')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="fathers_occupation" class="md:w-1/6">Fathers Occupation</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="fathers_occupation"
                                    name="fathers_occupation"
                                    value="{{ old('fathers_occupation',isset($product) ? $product->fathers_occupation : '') }}">
                                @error('fathers_occupation')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- Mothers Information --}}
                    <div class="mt-10">
                        <div class="form-group md:flex items-center">
                            <label for="mothers_name" class="md:w-1/6">Mothers Name</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="mothers_name" name="mothers_name"
                                    value="{{ old('mothers_name', isset($product) ? $product->mothers_name : '') }}">
                                @error('mothers_name')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="mothers_qualification" class="md:w-1/6">Mothers Qualification</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="mothers_qualification"
                                    name="mothers_qualification"
                                    value="{{ old('mothers_qualification',isset($product) ? $product->mothers_qualification : '') }}">
                                @error('mothers_qualification')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="mothers_email_details" class="md:w-1/6">Mothers Email</label>
                            <div class="md:w-5/6">
                                <input type="email" class="form-control" id="mothers_email_details"
                                    name="mothers_email_details"
                                    value="{{ old('mothers_email_details', isset($product) ? $product->mothers_email_details : '') }}">

                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="mothers_contact_details" class="md:w-1/6">Mothers Phone Number</label>
                            <div class="md:w-5/6">
                                <input type="number" class="form-control" id="mothers_contact_details"
                                    name="mothers_contact_details"
                                    value="{{ old('mothers_contact_details',isset($product) ? $product->mothers_contact_details : '') }}">
                                @error('mothers_contact_details')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="mothers_occupation" class="md:w-1/6">mothers Occupation</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="mothers_occupation"
                                    name="mothers_occupation"
                                    value="{{ old('mothers_occupation',isset($product) ? $product->mothers_occupation : '') }}">
                                @error('mothers_occupation')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- address --}}
                    <div>
                        <div class="bg-primary text-light" style="padding: 10px;">Residential Address:</div>
                        <div class="form-group">
                            <textarea class="form-control" id="address" name="address" rows="6"
                                style="vertical-align: top; text-align: left;">{{ old('address',isset($product) ? $product->address : '') }}</textarea>
                            @error('address')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- payment details --}}
                    <div class="form-group">
                        <div class="payment_details  md:d-flex">
                            <div>
                                <label for="payment_details">Payment Details</label>
                            </div>
                            <div class="pl-2">
                                <label>
                                    <input type="radio" id="cash" name="payment_details" value="cash"
                                        {{ isset($product) && $product->payment_details === 'cash' ? 'checked' : '' }}>
                                    Cash
                                </label>
                                <label>
                                    <input type="radio" id="Cash" name="payment_details" value="check"
                                        {{ (isset($product) && $product->payment_details === 'check' ? 'checked' : '') }}>
                                    Check
                                </label>
                                <label>
                                    <input type="radio" id="card" name="payment_details" value="card"
                                        {{ isset($product) && $product->payment_details === 'card' ? 'checked' : '' }}>
                                    Card
                                </label>
                            </div>
                            @error('payment_details')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- footer section --}}
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <button id='submitButton' type="submit" class="btn btn-primary" style="
                    width: 200px;
                ">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function showFile_ukg(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var img = document.getElementById("student_image_preview_ukg");
        img.src = reader.result;
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

var imageUpload = document.getElementById("student_image_upload_ukg");
var imagePreview = document.getElementById("student_image_preview_ukg");

imagePreview.onclick = function(e) {
    e.preventDefault(); // Prevents the default behavior of the label
    imageUpload.click();
};

/////////DOB JS/////////////////
var today = new Date().toISOString().split('T')[0];
document.getElementById('dob').setAttribute('max', today);

document.getElementById('dob').addEventListener('change', function() {
    var selectedDate = new Date(this.value);
    if (selectedDate > new Date()) {
        var afterDays = prompt('Please enter the number of days after today:');
        if (afterDays !== null) {
            var newDate = new Date();
            newDate.setDate(newDate.getDate() + parseInt(afterDays));
            this.value = newDate.toISOString().split('T')[0];
        }
    }
});
</script>

@endsection