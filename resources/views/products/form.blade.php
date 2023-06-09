@extends('layouts.app')

@section('contents')
<div class="text-center">
    <h2 class="text-black">Student Registration Form</h2>
</div>


<div class="flex flex-col">
    <ul class="flex ">
        <li class="tab-menu-item px-4 w-1/3 text-center font-bold text-black  py-2 bg-gray-200 cursor-pointer" onclick="openTab(event, 'lkg' )" style="border: 1px solid black;">LKG</li>
        <li class="tab-menu-item px-4 w-1/3 text-center font-bold text-black  py-2 bg-gray-200 cursor-pointer" onclick="openTab(event, 'ukg')" style="border: 1px solid black;">UKG</li>
        <li class="tab-menu-item px-4 w-1/3 text-center font-bold text-black  py-2 bg-gray-200 cursor-pointer" onclick="openTab(event, 'nursery')" style="border: 1px solid black;">NURSERY</li>
    </ul>

    <div class="tab-content mt-4" id="lkg">
        <!-- Content for Tab 1 -->
        <input type="hidden" name="tab" value="lkg">
        @include('products.lkg_student');
        
    </div>

    <div class="tab-content mt-4" id="ukg">
        <!-- Content for Tab 2 -->
            <input type="hidden" name="tab" value="ukg">
            @include('products.ukg_student');
        </form>
    </div>

    <div class="tab-content mt-4" id="nursery">
        <!-- Content for Tab 3 -->
        <input type="hidden" name="tab" value="nursery">
        @include('products.nursery_student');
    </div>
</div>

<script>
    function openTab(event, tabName) {
        // Get all elements with class "tab-menu-item" and remove the "active" class
        const tabMenuItems = document.getElementsByClassName("tab-menu-item");
        for (let i = 0; i < tabMenuItems.length; i++) {
            tabMenuItems[i].classList.remove("active");
        }

        // Add the "active" class to the clicked tab menu item
        event.currentTarget.classList.add("active");

        // Get all elements with class "tab-content" and hide them
        const tabContents = document.getElementsByClassName("tab-content");
        for (let i = 0; i < tabContents.length; i++) {
            tabContents[i].style.display = "none";
        }

        // Show the corresponding tab content based on the clicked tab menu item
        const activeTabContent = document.getElementById(tabName);
        activeTabContent.style.display = "block";

        // Update the hidden input value to reflect the current tab
        const hiddenInput = document.querySelector('input[name="tab"]');
        hiddenInput.value = tabName;
    }
</script>

@endsection
