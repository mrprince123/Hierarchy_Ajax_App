@extends('Layout.app')


@push('title')
    <title>Admin Home</title>
@endpush

@section('components')
    @if (session('update_emp'))
        <p id="update_emp" class="text-center mt-5 mb-5 text-teal-500 font-semibold p-2 m-2 rounded-xl bg-teal-100">
            {{ session('update_emp') }}
        </p>
    @endif

    @if (session('new_emp'))
        <p id="new_emp" class="text-center mt-5 mb-5 text-teal-500 font-semibold p-2 m-2 rounded-xl bg-teal-100">
            {{ session('new_emp') }}
        </p>
    @endif

    <div class="w-2/3 m-auto grid grid-cols-4 gap-4 mb-10 mt-10">

        @forelse ($employees as $item)
            <div class="p-2 m-2 bg-teal-100 rounded-xl w-full flex flex-col">
                <img class="w-full rounded-xl h-64 object-cover" src="{{ asset('storage/' . $item->profile_pic) }}"
                    alt="">
                <p class="font-bold text-teal-500 m1-2 mt-2 text-lg">{{ $item->name }}</p>
                <p>Email : {{ $item->email }}</p>
                <p>Phone No : {{ $item->mobile_number }}</p>
                @php
                    $position = App\Models\Role::find($item->roles_id);
                @endphp
                <p>Role : {{ $position->role_name }}</p>
                <a href="{{ url('/employee/one/' . $item->id) }}"
                    class="bg-teal-500 p-2 rounded-xl text-center mt-2 text-white font-semibold w-full">View
                    Full Details</a>
            </div>
        @empty
        
            <p>No Employee Found</p>
        @endforelse
    </div>

    <div class="flex justify-center items-center mb-10">
        {!! $employees->withQueryString()->links() !!}
    </div>


    <script>
        var message = document.getElementById('new_emp');
        var UpdateMessage = document.getElementById('update_emp');

        setTimeout(() => {
            // Remove the Message after 3 Seconds\
            UpdateMessage.style.display = "none";
            message.style.display = "none";
            console.log("Hide is working");
        }, 5000);
    </script>

    {{-- JQuery CDN  --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endsection
