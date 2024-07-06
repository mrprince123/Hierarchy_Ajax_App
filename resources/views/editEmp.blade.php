@extends('Layout.app')

@push('title')
    <title>Edit Employee Form</title>
@endpush

@section('components')
    <div class="w-2/3 m-auto">

        <form class="flex flex-col bg-teal-100 gap-2 p-2 rounded-xl mb-10 mt-10"
            action="{{ url('/employee/update/' . $emp->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1 class="font-bold text-center text-teal-500 text-2xl">Employee Form</h1>
            <label for="" class="font-semibold">Name</label>
            <input class="p-2 rounded-xl" required type="text" name="name" value="{{ $emp->name }}"
                placeholder="Name">
            @error('name')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <label for="email" class="font-semibold">Email</label>
            <input class="p-2 rounded-xl" required type="email" name="email" value="{{ $emp->email }}"
                placeholder="Email">
            @error('email')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <label for="profile_pic" class="font-semibold">Profile Picture</label>
            <img class="p-2 rounded-xl h-96 object-cover w-full" id="profilePic"
                src="{{ asset('storage/' . $emp->profile_pic) }}" alt="">
            <input onchange="onFileSelected(event)" class="p-2 rounded-xl" required type="file" name="profile_pic">
            @error('profile_pic')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <label for="mobile_number" class="font-semibold">Phone Number</label>
            <small>Format : 663-423-3232</small>
            <input class="p-2 rounded-xl" required type="tel" pattern="[6-9]{3}-[0-9]{3}-[0-9]{4}"
                value="{{ $emp->mobile_number }}" name="mobile_number" placeholder="Phone Number">
            @error('mobile_number')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <label for="parents_name" class="font-semibold">Parents Name</label>
            <input class="p-2 rounded-xl" required type="text" value="{{ $emp->parents_name }}" name="parents_name"
                placeholder="Parents Name">
            @error('parents_name')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <label for="adhar_number" class="font-semibold">Adhar Number</label>
            <small>Format : 2323-4223-3232</small>
            <input class="p-2 rounded-xl" required pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" type="tel"
                value="{{ $emp->adhar_number }}" name="adhar_number" placeholder="Adhar Number">
            @error('adhar_number')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <label for="date_of_birth" class="font-semibold">Date of Birth</label>
            <input id="dob_input" class="p-2 rounded-xl" min="1970-01-01" max="2006-01-01" required type="date"
                name="date_of_birth" onchange="myFun()" placeholder="Date of Birth">
            @error('date_of_birth')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <div class="p-2 rounded-xl" class="flex items-center gap-2">
                <label for="gender" class="font-semibold">Gender : </label>
                <input required type="radio" name="gender" value="male">
                Male
                <input required type="radio" name="gender" value="female">
                Female
            </div>
            @error('gender')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror
            <label for="emergency_contact_no" class="font-semibold">Emergency Contact No</label>
            <small>Format : 663-423-3232</small>
            <input class="p-2 rounded-xl" required type="tel" pattern="[6-9]{3}-[0-9]{3}-[0-9]{4}"
                name="emergency_contact_no" value="{{ $emp->emergency_contact_no }}" placeholder="Emergency Contact No">
            @error('emergency_contact_no')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <label for="age" class="font-semibold">Age</label>
            <input class="p-2 rounded-xl" max="80" min="18" required readonly type="text" id="age"
                value="{{ $emp->age }}" name="age" placeholder="Age">
            @error('age')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <label for="highest_qualification" class="font-semibold">Your Qualification</label>
            <select class="p-2 rounded-xl" name="highest_qualification">
                <option value="">Select Your Qualification</option>
                <option value="10th">10th</option>
                <option value="12th">12th</option>
                <option value="ug">Under Graduation</option>
                <option value="pg">Post Graduation</option>
            </select>
            @error('highest_qualification')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror
            {{-- Fetch the role Data and Show in Select Option  --}}
            <label for="roles_id" class="font-semibold">Role</label>
            <select class="p-2 rounded-xl" name="roles_id">
                <option value="">Select the Roles</option>
                @foreach ($roles as $item)
                    <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                @endforeach
            </select>
            @error('roles_id')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror
            <label for="current_address" class="font-semibold">Current Address</label>
            <textarea class="p-2 rounded-xl" required name="current_address" cols="30" rows="10"
                placeholder="Current Address">{{ $emp->current_address }}</textarea>
            @error('current_address')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror
            <label for="parmanent_address" class="font-semibold">Parmanent Address</label>
            <textarea class="p-2 rounded-xl" required name="parmanent_address" cols="30" rows="10"
                placeholder="Parmanent Address">{{ $emp->parmanent_address }}</textarea>
            @error('parmanent_address')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror
            <input class="p-2 rounded-xl bg-teal-500 text-white font-bold text-center" required type="submit"
                value="Update Employee Data">
        </form>
    </div>

    {{-- JQuery CDN  --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="{{asset('js/editEmp.js')}}"></script>
@endsection
