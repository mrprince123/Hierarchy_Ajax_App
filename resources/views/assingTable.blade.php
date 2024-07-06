@extends('Layout.app')

@push('title')
    <title>Assign Table Data</title>
@endpush

@section('components')
    @if (session('assign_role_delete'))
        <p id="assign_role_delete"
            class="text-center w-2/3 m-auto mt-5 mb-5 text-teal-500 font-semibold p-2 rounded-xl bg-teal-100">
            {{ session('assign_role_delete') }}
        </p>
    @endif

    <h1 class="text-center text-teal-500 m-2 p-2 font-semibold text-xl mt-10 mb-10">Assign Table Data</h1>

    <div class="relative overflow-x-auto mb-10">
        <table class="w-2/3 m-auto text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
            <thead id="head_assign_table" class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Employee Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Position
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Under Whome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    @forelse ($assign as $item)
                <tr>
                    <td class="px-6 py-4">
                        {{ $item->id }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $employee = App\Models\Employee::find($item->employee_id);
                        @endphp
                        {{ $employee->name }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $role = App\Models\Role::find($item->position_id);

                        @endphp
                        {{ $role->role_name }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $employee = App\Models\Employee::find($item->under_employee_id);
                        @endphp
                        {{ $employee->name }}
                    </td>
                    <td class="px-6 py-4 flex gap-2 items-center justify-center">
                        <a href="{{ url('/assign/edit/' . $item->id) }}"
                            class="bg-teal-500 text-white p-2 w-16 text-center rounded-lg font-semibold">Edit</a>
                        {{-- Delete is Done  --}}
                        <form action="{{ url('/assign/delete/' . $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit"
                                class="bg-teal-100 text-teal-500 w-16  p-2 rounded-lg font-semibold cursor-pointer"
                                value="Delete">
                        </form>
                    </td>
                </tr>
            @empty
                <p class="text-center font-semibold">No Assign Data Found!!</p>
                <script>
                    var assignTableHeader = document.getElementById('head_assign_table');
                    assignTableHeader.style.display = "none";
                </script>
                @endforelse
                </tr>

            </tbody>
        </table>
    </div>


    <script>
        var message = document.getElementById('assign_role_delete');

        setTimeout(() => {
            // Remove the Message after 3 Seconds\
            message.style.display = "none";
            console.log("Hide is working");
        }, 5000);
    </script>
@endsection
