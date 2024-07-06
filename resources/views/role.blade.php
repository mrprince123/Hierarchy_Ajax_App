@extends('Layout.app')

@push('title')
    <title>Role Form</title>
@endpush

@section('components')
    <div class="w-2/3 m-auto">

        @if (session('new_role'))
            <p id="new_role_msg" class="text-center mt-5 mb-5 text-teal-500 font-semibold p-2 m-2 rounded-xl bg-teal-100">
                {{ session('new_role') }}
            </p>
        @endif

        <form class="flex flex-col bg-teal-100 gap-2 p-2 rounded-xl mb-10 mt-10" action="{{ url('/role/post') }}"
            method="post">
            @csrf
            <h1 class="font-bold text-center text-teal-500 text-2xl">Role</h1>

            <label for="role_name" class="font-semibold">Role Name</label>
            <input class="p-2 rounded-xl" required type="text" name="role_name" placeholder="Role Name">
            @error('role_name')
                <p class="text-center text-red-500">{{ $message }}</p>
            @enderror
            <label for="role_priority" class="font-semibold">Role Priority</label>
            <input class="p-2 rounded-xl" min="1" max="30" required type="number" name="role_priority"
                placeholder="Role Priority">
            @error('role_priority')
                <p class="text-center text-red-500">{{ $message }}</p>
            @enderror
            <input class="p-2 rounded-xl bg-teal-500 text-white font-bold text-center" required type="submit"
                value="Add New Role">
        </form>
    </div>

    <script>
        var message = document.getElementById('new_role_msg');
        setTimeout(() => {
            // Remove the Message after 3 Seconds\
            message.style.display = "none";
            console.log("Hide is working");
        }, 5000);
    </script>
@endsection
