@extends('Layout.app')

@push('title')
    <title>Assign To Form</title>
@endpush

@section('components')
    <div class="w-2/3 m-auto">

        @if (session('emp_error_msg'))
            <p id="emp_error_msg" class="text-center mt-5 mb-5 text-red-500 font-semibold p-2 m-2 rounded-xl bg-red-100">
                {{ session('emp_error_msg') }}
            </p>
        @endif

        @if (session('new_assign'))
            <p id="new_assign_message"
                class="text-center mt-5 mb-5 text-teal-500 font-semibold p-2 m-2 rounded-xl bg-teal-100">
                {{ session('new_assign') }}
            </p>
        @endif

        <form class="flex flex-col bg-teal-100 gap-2 p-2 rounded-xl mb-10 mt-10" action="{{ url('/assign/post') }}"
            method="post">
            @csrf
            <h1 class="font-bold text-center text-teal-500 text-2xl">Assign Employee Under To</h1>
            {{-- Get all the Employee Data  --}}
            @error('employee_id')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <select class="p-2 rounded-xl" required name="employee_id">
                <option value="">Select Employee</option>
                @foreach ($employee as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>

            {{-- Get the Role Here --}}
            @error('position_id')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror

            <select class="p-2 rounded-xl" required name="position_id" id="position_id">
                <option value="">Assign Under the Position of</option>

                @foreach ($role as $item)
                    <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                @endforeach
            </select>

            {{-- Now Pass the Role Name here to get the empoyee of this role only --}}
            {{-- Now show the Name of the Employee hows position is passed above.  --}}
            @error('under_employee_id')
                <p class="text-red-500 text-center">{{ $message }}</p>
            @enderror
            <select class="p-2 rounded-xl" required name="under_employee_id" id="employee">
                <option value="">Assing Under the Specific People</option>
            </select>

            <input class="p-2 rounded-xl bg-teal-500 text-white font-bold text-center" type="submit"
                value="Assing Employee">
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    {{-- <script type="text/javascript" src="{{ asset('js/assign.js') }}"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {

            $("#position_id").on('change', function(e) {
                e.preventDefault();

                var roleId = $(this).val();
                console.log(roleId);

                if (roleId) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ url('/employee/specific') }}',
                        method: 'GET',
                        data: {
                            roleId: roleId,
                        },
                        success: function(data) {

                            // var jsonString = JSON.parse(data);
                            // console.log(jsonString);
                            // console.log("This is length", data.length);

                            // This is for the Inserting the Value in the Select Dropdown 
                            var option = '';
                            $.each(data, function(key, value) {
                                // console.log(key, " ", value);
                                $.each(value, function(keyy, valuee) {
                                    console.log("This is the Name ", valuee[
                                        'name']);
                                    console.log("This is the Id ", valuee[
                                        'id']);

                                    option += '<option value="' + valuee['id'] +
                                        '">' + valuee['name'] + '</option>';
                                })
                            });
                            // $('#employee').append(option);
                            $('#employee').html(option);

                            // console.log(data);
                        }
                    });
                };

            });

        });
    </script>

    <script>
        // when New Role has been assigned.
        var message = document.getElementById('new_assign_message');
        setTimeout(() => {
            // Remove the Message after 3 Seconds\
            message.style.display = "none";
            console.log("Hide is working");
        }, 5000);


        // To show the Same Employee Assign Error
        var newErrorMsg = document.getElementById('emp_error_msg');
        setTimeout(() => {
            newErrorMsg.style.display = 'none';
            console.log("Show Error Message is working");
        }, 5000);
    </script>
@endsection
