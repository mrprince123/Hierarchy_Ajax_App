@extends('Employee.Layout.app')

@push('title')
    <title>Full Employee</title>
@endpush

@section('components')
    <div class="w-2/3 m-auto mb-10 mt-10">
        <div class="p-2 m-2 bg-teal-50 rounded-xl shadow-xl w-full flex gap-2">

            <div class="w-1/3 p-4">
                <img class="w-full rounded-xl h-96 object-cover" src="{{ asset('storage/' . $employee->profile_pic) }}"
                    alt="">
            </div>

            <div class="w-2/3 font-medium p-4">

                <p class="font-semibold text-teal-500 mt-4 text-xl">{{ $employee->name }}</p>
                @php
                    $position = App\Models\Role::find($employee->roles_id);
                @endphp

                @switch($position->role_name)
                    @case('Operation Head')
                        <p>Operation Head</p>
                    @break

                    @case('HR (Admin)')
                        <p>Hiring Manager (Admin)</p>
                    @break

                    @case('HR (Jobs)')
                        <p>Hiring Manager (Jobs)</p>
                    @break

                    @case('DO')
                        <p>Director of Operations</p>
                    @break

                    @case('PM')
                        <p>Project Manager</p>
                    @break

                    @case('FM')
                        <p>Floor Manager</p>
                    @break

                    @case('STL')
                        <p>Senior Team Leader</p>
                    @break

                    @case('ATL')
                        <p>Associate Team Leader</p>
                    @break

                    @case('TL')
                        <p>Team Leader</p>
                    @break

                    @case('STM')
                        <p>Senior Team Member</p>
                    @break

                    @case('TM')
                        <p>Team Member</p>
                    @break

                    @case('ATM')
                        <p>Associate Team Member</p>
                    @break

                    @case('Trainee')
                        <p>Trainee</p>
                    @break

                    @default
                        <p>Role Not Provided</p>
                @endswitch

                <p class="mt-5">Email : {{ $employee->email }}</p>
                <p>Phone No : {{ $employee->mobile_number }}</p>


                <p>Gender: {{ $employee->gender }}</p>
                <p>Age: {{ $employee->age }}</p>
                <p>Aadhar Number :{{ $employee->adhar_number }}</p>
                <p>Current Address : {{ $employee->current_address }}</p>
                <p>Parmanent Address : {{ $employee->parmanent_address }}</p>
                <p>Emergency Contact No : {{ $employee->emergency_contact_no }}</p>
                <p>Highest Qualification : {{ $employee->highest_qualification }}</p>
                <p>Employee Joined At : @php
                    echo substr($employee->created_at, 0, 10);
                @endphp</p>

            </div>
        </div>
    </div>
@endsection
