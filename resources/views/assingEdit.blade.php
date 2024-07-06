@extends('Layout.app')

@push('title')
    <title>Assign Edit Data</title>
@endpush

@section('components')
    <h1 class="text-center font-semibold text-2xl p-4 text-teal-500">Assign Edit Page</h1>
    <div class="w-2/3 flex gap-2 m-auto">


        {{-- To show the previous original data  --}}
        <div class="bg-teal-50 shadow-xl p-2 m-2 w-1/2 rounded-xl">
            <h2 class="text-center font-semibold text-2xl text-teal-500">Current Data</h2>

            <label class="font-semibold mt-4 text-teal-500">Id</label>
            <p class="">
                {{ $assign->id }}
            </p>
            <label class="font-semibold mt-4 text-teal-500">Employee Id</label>
            <p class="">
                @php
                    $employee = App\Models\Employee::find($assign->employee_id);
                @endphp
                {{ $employee->name }}
            </p>
            <label class="font-semibold mt-4 text-teal-500">Position Id</label>
            <p class="">
                @php
                    $role = App\Models\Role::find($assign->position_id);

                @endphp
                {{ $role->role_name }}
            </p>
            <label class="font-semibold mt-4 text-teal-500">Under Which Employee</label>
            <p class="">
                @php
                    $employee = App\Models\Employee::find($assign->under_employee_id);
                @endphp
                {{ $employee->name }}
            </p>
        </div>

        {{-- To show the form to edit with the new Data  --}}
        <div class="bg-teal-50 shadow-xl p-2 m-2 w-1/2 rounded-xl">
            <h2 class="text-center font-semibold text-2xl text-teal-500">Want to Edit</h2>
            <form action="{{ url('/assign/update/' . $assign->id) }}" method="post" class="flex flex-col">
                @csrf
                @method('PUT')

                <label for="employee_id" class="font-semibold mb-2 mt-1">Employee Id</label>
                <select name="employee_id" id="" class="p-2 rounded-xl">
                    @foreach ($allEmployee as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                <label for="position_id" class="font-semibold mb-2 mt-1">Employee Role</label>
                <select name="position_id" id="role_id" class="p-2 rounded-xl">
                    <option value="">Select the Employee Role</option>
                    @foreach ($editRole as $item)
                        <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                    @endforeach
                </select>

                <label for="under_employee_id" class="font-semibold mb-2 mt-1">Under Whome You want to assign</label>
                <select name="under_employee_id" class="p-2 rounded-xl" id="under_employee_id">
                    <option value="">Select the Employee Role</option>
                </select>

                <input type="submit" class="p-2 rounded-xl bg-teal-500 text-white font-bold text-center mt-2"
                    value="Update the Assigned Employee Role">
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // var id = 4;
            $('#role_id').on('change', function(e) {
                id = $(this).val();
                console.log(id);

                $.ajax({
                    url: '{{ url('/employee/specific') }}',
                    method: "GET",
                    data: {
                        roleId: id
                    },
                    success: function(data) {
                        console.log(data);

                        let option = '';

                        $.each(data, function(key, value) {
                            $.each(value, function(keyy, valuee) {
                                option += "<option value=' " + valuee['id'] +
                                    " '> " +
                                    valuee['name'] + "</option>"
                            });
                        });

                        $('#under_employee_id').html(option);

                        // set the data into the next dropdown.
                    }
                });
            })
        });
    </script>
@endsection
