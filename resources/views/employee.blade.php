@extends('Layout.app')

@push('title')
    <title>Employee Form</title>
@endpush

@section('components')
    <div class="w-2/3 m-auto">

        <form class="flex flex-col bg-teal-100 gap-2 p-2 rounded-xl mb-10 mt-10" action="{{ url('/employee/post') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="font-bold text-center text-teal-500 text-2xl">Employee Form</h1>
            <label for="" class="font-semibold">Name</label>
            <input class="p-2 rounded-xl @error('name')
            border border-red-500
    @enderror"
                value="{{ old('name') }}" type="text" name="name" placeholder="Name">
            @error('name')
                <p class="text-red-500">{{ $message }}</p>
            @enderror

            <label for="email" class="font-semibold">Email</label>
            <input class="p-2 rounded-xl @error('email')
                border border-red-500
        @enderror"
                value="{{ old('email') }}" type="email" name="email" placeholder="Email">
            @error('email')
                <p class="text-red-500">{{ $message }}</p>
            @enderror

            <label for="profile_pic" class="font-semibold">Profile Picture</label>
            <input class="p-2 rounded-xl " type="file" name="profile_pic">
            @error('profile_pic')
                <p class="text-red-500">{{ $message }}</p>
            @enderror

            <label for="mobile_number" class="font-semibold">Phone Number</label>
            <input class="p-2 rounded-xl @error('mobile_number')
            border border-red-500 @enderror"
                id="mobile_number" value="{{ old('mobile_number') }}" onchange="myPhoneCount()" maxlength="12"
                onkeydown="myInputFun()" name="mobile_number" placeholder="Phone Number">
            <p id="phone_error_text" class="text-red-500 text-center"></p>
            @error('mobile_number')
                <p id="phone_message" class="text-red-500 ">{{ $message }}</p>
            @enderror

            <label for="parents_name" class="font-semibold">Parents Name</label>
            <input class="p-2 rounded-xl @error('parents_name')
            border border-red-500
    @enderror"
                value="{{ old('parents_name') }}" type="text" name="parents_name" placeholder="Parents Name">
            @error('parents_name')
                <p class="text-red-500">{{ $message }}</p>
            @enderror

            <label for="adhar_number" class="font-semibold">Adhar Number</label>
            <small>Format : 2323-4223-3232</small>
            <input class="p-2 rounded-xl" value="{{ old('adhar_number') }}" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}"
                type="tel" name="adhar_number" placeholder="Adhar Number">
            @error('adhar_number')
                <p class="text-red-500">{{ $message }}</p>
            @enderror

            <label for="date_of_birth" class="font-semibold">Date of Birth</label>
            <input id="dob_input"
                class="p-2 rounded-xl @error('date_of_birth')
            border border-red-500
    @enderror"
                min="1970-01-01" max="2006-01-01" type="date" name="date_of_birth" onchange="myFun()"
                placeholder="Date of Birth">
            @error('date_of_birth')
                <p class="text-red-500">{{ $message }}</p>
            @enderror

            <div class="p-2 rounded-xl" class="flex items-center gap-2">
                <label for="gender" class="font-semibold">Gender : </label>
                <input type="radio" name="gender" value="male" checked>
                Male
                <input type="radio" name="gender" value="female">
                Female
            </div>
            @error('gender')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            <label for="emergency_contact_no" class="font-semibold">Emergency Contact No</label>
            <input id="emergency_number" class="p-2 rounded-xl @error('emergency_contact_no')
            border border-red-500
    @enderror"
                 value="{{ old('emergency_contact_no') }}" maxlength="12" name="emergency_contact_no"
                 onchange="myEmergencyPhoneCount()" onkeydown="myEmerFun()"  placeholder="Emergency Contact No">
            <p id="emergency_error_text" class="text-red-500 text-center"></p>
            @error('emergency_contact_no')
                <p class="text-red-500">{{ $message }}</p>
            @enderror

            <label for="age" class="font-semibold">Age</label>
            <input class="p-2 rounded-xl @error('age')
            border border-red-500
    @enderror"
                value="{{ old('age') }}" max="80" min="18" readonly type="text" id="age"
                name="age" placeholder="Age">
            @error('age')
                <p class="text-red-500">{{ $message }}</p>
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
                <p class="text-red-500">{{ $message }}</p>
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
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            <label for="current_address" class="font-semibold">Current Address</label>
            <textarea class="p-2 rounded-xl @error('current_address')
            border border-red-500
    @enderror"
                value="{{ old('current_address') }}" name="current_address" cols="30" rows="10"
                placeholder="Current Address"></textarea>
            @error('current_address')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            <label for="parmanent_address" class="font-semibold">Parmanent Address</label>
            <textarea class="p-2 rounded-xl @error('parmanent_address')
            border border-red-500
    @enderror"
                value="{{ old('parmanent_address') }}" name="parmanent_address" cols="30" rows="10"
                placeholder="Parmanent Address"></textarea>
            @error('parmanent_address')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input class="p-2 rounded-xl bg-teal-500 text-white font-bold text-center" type="submit"
                value="Add New Employee">
        </form>
    </div>

    {{-- JQuery CDN  --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/employee.js') }}"></script>
@endsection
