@extends('layouts.app')

@section('contents')
<div class="text-center">
    <h2 class="text-black">Nursery Students Registration Form</h2>
</div>


<form action="{{ isset($product) ? route('products.update', $product->id) : route('products.savenursery') }}" method="post"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="tab" value="lkg">
    <div class="row">
        <div class="col-12 text-black ">
            <div class="card shadow mb-4">
                <div class="card-body">
                    {{-- image of the students --}}
                    <label class="" for="student_image">Student Image</label>
                    <div>
                        <img id="student_image_preview_nursery"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxZKIR5mxVGbVJGkgmBNY5RwVWN9HVgLwV6w&amp;usqp=CAU"
                        alt="Default Image" style=" height: 180px; width:180px ">
                        <input type="file" name="student_image" accept="image/*" onchange="showFile_nursery(event)">
                    </div>



                    {{-- Name of the applicant --}}
                    <div class="mt-10 text-black">
                        <h5>Name of the Applicant</h5>
                        <div class="form-group md:flex gap-6">
                            <div class="first_name md:w-1/2">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control w-full" name="first_name"
                                    value="{{ isset($product) ? $product->first_name : '' }}">
                                    @error('first_name')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="last_name md:w-1/2">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ isset($product) ? $product->last_name : '' }}" >
                                     @error('last_name')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>


                    {{-- date of birth --}}
                    <div class="form-group ">
                        <div class="dob">
                            <label for="item_code">Date of Birth</label>
                            <input type="date" class="form-control" name="dob"
                                value="{{ isset($product) ? $product->dob : '' }}" >
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
                                        {{ isset($product) && $product->gender === 'male' ? 'checked' : '' }} >
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

                            <select class="form-control" name="academic_year" id="academic_year"  value="{{ isset($product) ? $product->academic_year : '' }}">
                                <?php foreach ($academicYears as $year): ?>
                                <option value="<?php echo $year; ?>" <?php echo $year === $currentYear . '-' . ($currentYear + 1) ? 'selected' : ''; ?>><?php echo $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                      
                    </div>


                    {{-- Grade --}}
                    <div class="form-group ">
                        <div class="grade">
                            <label for="item_code">Grade</label>
                            <input type="text" class="form-control" id="grade" name="grade"
                                value="{{ isset($product) ? $product->grade : '' }}" >
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
                                value="{{ isset($product) ? $product->language : '' }}">
                                @error('language')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>


                    {{-- Details of Sibling --}}
                    <div class="form-group">
                        <div class="sibling_details">
                            <label for="sibling_details">Details of sibling:</label>
                            <textarea class="form-control" id="sibling_details" name="sibling_details" rows="5" ></textarea>
                        </div>
                    </div>





                    {{-- parents Information --}}
                    <h5>parents Information</h5>
                    <div class="mt-10">
                        <div class="form-group md:flex items-center">
                            <label for="fathers_name" class="md:w-1/6 w-full">Fathers Name</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="fathers_name" name="fathers_name"
                                    value="{{ isset($product) ? $product->fathers_name : '' }}" >
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
                                    value="{{ isset($product) ? $product->fathers_qualification : '' }}" >
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="fathers_email_details" class="md:w-1/6 w-full">Fathers Email</label>
                            <div class="md:w-5/6">
                                <input type="email" class="form-control" id="fathers_email_details"
                                    name="fathers_email_details"
                                    value="{{ isset($product) ? $product->fathers_email_details : '' }}">
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="fathers_contact_details" class="md:w-1/6">Fathers Phone Number</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="fathers_contact_details"
                                    name="fathers_contact_details"
                                    value="{{ isset($product) ? $product->fathers_contact_details : '' }}" >
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
                                    value="{{ isset($product) ? $product->fathers_occupation : '' }}">
                            </div>
                        </div>
                    </div>



                    {{-- Mothers Information --}}
                    <div class="mt-10">
                        <div class="form-group md:flex items-center">
                            <label for="mothers_name" class="md:w-1/6">Mothers Name</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="mothers_name" name="mothers_name"
                                    value="{{ isset($product) ? $product->mothers_name : '' }}" >
                                    @error('fathers_contact_details')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="mothers_qualification" class="md:w-1/6">Mothers Qualification</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="mothers_qualification"
                                    name="mothers_qualification"
                                    value="{{ isset($product) ? $product->mothers_qualification : '' }}" >
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="mothers_email_details" class="md:w-1/6">Mothers Email</label>
                            <div class="md:w-5/6">
                                <input type="email" class="form-control" id="mothers_email_details"
                                    name="mothers_email_details"
                                    value="{{ isset($product) ? $product->mothers_email_details : '' }}">
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="mothers_contact_details" class="md:w-1/6">Mothers Phone Number</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="mothers_contact_details"
                                    name="mothers_contact_details"
                                    value="{{ isset($product) ? $product->mothers_contact_details : '' }}" >
                            </div>
                        </div>
                        <div class="form-group md:flex items-center">
                            <label for="mothers_occupation" class="md:w-1/6">Mothers Occupation</label>
                            <div class="md:w-5/6">
                                <input type="text" class="form-control" id="mothers_occupation"
                                    name="mothers_occupation"
                                    value="{{ isset($product) ? $product->mothers_occupation : '' }}" >
                            </div>
                        </div>
                    </div>

                    {{-- address --}}
                    <div>
                        <div class="bg-primary text-light" style="padding: 10px;">Residential Address:</div>
                        <div class="form-group">
                            <textarea class="form-control" id="address" name="address" rows="6" 
                                style="vertical-align: top; text-align: left;">{{ isset($product) ? $product->address : '' }}</textarea>
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
                                        {{ isset($product) && $product->gender === 'cash' ? 'checked' : '' }}>
                                    Cash
                                </label>
                                <label>
                                    <input type="radio" id="Cash" name="payment_details" value="check" 
                                        {{ isset($product) && $product->gender === 'check' ? 'checked' : '' }}>
                                    Check
                                </label>
                                <label>
                                    <input type="radio" id="card" name="payment_details" value="card" 
                                        {{ isset($product) && $product->gender === 'card' ? 'checked' : '' }}>
                                    Card
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- footer section --}}
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary" style="
                    width: 200px;
                ">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function showFile_nursery(event) {
      const input = event.target;
      if (input.files && input.files[0]) {
        const reader = new FileReader();
    
        reader.onload = function() {
          const preview = document.getElementById('student_image_preview_nursery');
          preview.src = reader.result;
        };
    
        reader.readAsDataURL(input.files[0]);
      }
    }
    </script>
@endsection