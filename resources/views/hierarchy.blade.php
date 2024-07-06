@extends('Layout.app')

@push('title')
    <title>
        Company Hierarchy</title>
@endpush

@section('components')
    <div class="mb-10 mt-10">
        <div class="flex justify-center">
            @forelse ($assign as $item)
                {{-- To show the Data of the Floor Manager  --}}
                <div id="{{ $item->id }}"
                    class="bg-teal-100 p-2 m-2 one_tl text-center rounded-xl shadow-xl cursor-pointer hover:shadow-2xl hover:bg-teal-200">
                    <img class="h-32 w-32 object-cover rounded-xl" src="{{ asset('storage/' . $item->profile_pic) }}"
                        alt="">
                    <p class="text-teal-500 font-bold mt-2 text-sm">{{ $item->name }}</p>
                    @php
                        $position = App\Models\Role::find($item->roles_id);
                    @endphp
                    <p class="font-semibold mt-2 text-sm">Role : {{ $position->role_name }}</p>
                    <p id="id_val" class="font-bold">Emp Id : {{ $item->id }}</p>
                </div>
            @empty
                <p>No Data Found</p>
            @endforelse

        </div>

    </div>

    <h1 class="text-4xl text-center" id="tl_arrow">&darr;</h1>
    <div>
        {{-- To show the Data of the Team Leader  --}}

        <div id="tl_data" class="m-2 p-2 tl_data flex justify-center">
            {{-- Insert the TL Data here  --}}
        </div>
    </div>
    <h1 class="text-4xl text-center" id="tm_arrow">&darr;</h1>
    <div>
        {{-- To show the Data of the Team Member  --}}

        <div id="tm_data" class="m-2 p-2 flex justify-center">
            {{-- Insert the TM Data here  --}}
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // This is the TL and TM arrow
            $('#tl_arrow').hide();
            $('#tm_arrow').hide();

            // This is for the Team Leader
            $('.one_tl').on('click', function(e) {
                e.preventDefault();

                // This is to show the TL arrow
                $('#tl_arrow').show();

                var id = $(this).attr('id');
                // console.log(id);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/assign/specific') }}",
                    method: "GET",
                    data: {
                        roleId: id
                    },
                    success: function(data) {
                        console.log("Team Leader ", data);

                        $('#tl_data').empty();

                        // This is for the Inserting the Value in the Select Dropdown 
                        var div = '';
                        $.each(data, function(key, value) {
                            $.each(value, function(keyy, valuee) {
                                $.each(valuee, function(keyyy, valueee) {
                                    div +=
                                        "<div id='one_tl_data' name=" +
                                        valueee['id'] +
                                        " class='p-2 m-2 one_tl_data bg-teal-100 rounded-xl shadow-xl cursor-pointer hover:shadow-2xl hover:bg-teal-200'>";
                                    div +=
                                        "<img class='h-32 w-32 object-cover rounded-xl' src='storage/" +
                                        valueee['profile_pic'] +
                                        "' alt='Employee Image' >";
                                    div +=
                                        "<p class='text-teal-500 font-bold text-sm text-center' >" +
                                        valueee['name'] + "</p>";

                                    if (valueee['roles_id'] == 1) {
                                        div +=
                                            "<p class=' font-bold text-sm text-center' >Role : FM</p>";
                                    } else if (valueee['roles_id'] ==
                                        2) {
                                        div +=
                                            "<p class=' font-bold text-sm text-center' >Role : TL</p>";
                                    } else if (valueee['roles_id'] ==
                                        3) {
                                        div +=
                                            "<p class=' font-bold text-sm text-center' >Role : TM</p>";
                                    } else if (valueee['roles_id'] ==
                                        4) {
                                        div +=
                                            "<p class=' font-bold text-sm text-center' >Role : Trainee</p>";
                                    };
                                    div +=
                                        "<p class='font-bold text-center' > Emp Id : " +
                                        valueee['id'] + "</p>";
                                    div += "</div>";
                                });
                            });
                        });
                        $('#tl_data').html(div); // Setting up the Team leader data
                    }
                });
            });


            // This is for the Team Member
            $('#tl_data').on('click', '.one_tl_data', function(e) {
                e.preventDefault();

                // This is to show the TM Arrow
                $('#tm_arrow').show();


                // Here I have add the on click on the div to get the value of the name attribute. 
                var tmId = $(this).attr('name');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/assign/teamMember/') }}",
                    method: "GET",
                    data: {
                        teamMemberId: tmId
                    },
                    success: function(data2) {
                        console.log("TM Data", data2);

                        // This is for the Inserting the Value in the Select Dropdown 
                        var divv = '';
                        $.each(data2, function(key, value) {
                            $.each(value, function(keyy, valuee) {
                                $.each(valuee, function(keyyy,
                                    valueee) {
                                    divv +=
                                        "<div id='one_tl' name=" +
                                        valueee['id'] +
                                        " class='p-2 m-2 bg-teal-100 flex flex-col items-center rounded-xl shadow-xl cursor-pointer hover:shadow-2xl hover:bg-teal-200'>";
                                    divv +=
                                        "<img class='h-32 w-32 object-cover rounded-xl' src='storage/" +
                                        valueee[
                                            'profile_pic'] +
                                        "' alt='Employee Image' >";
                                    divv +=
                                        "<p class='text-teal-500 font-bold text-sm text-center' >" +
                                        valueee['name'] +
                                        "</p>";
                                    if (valueee['roles_id'] == 1) {
                                        divv +=
                                            "<p class=' font-bold text-sm text-center' >Role : FM</p>";
                                    } else if (valueee['roles_id'] ==
                                        2) {
                                        divv +=
                                            "<p class=' font-bold text-sm text-center' >Role : TL</p>";
                                    } else if (valueee['roles_id'] ==
                                        3) {
                                        divv +=
                                            "<p class=' font-bold text-sm text-center' >Role : TM</p>";
                                    } else if (valueee['roles_id'] ==
                                        4) {
                                        divv +=
                                            "<p class=' font-bold text-sm text-center' >Role : Trainee</p>";
                                    };

                                    divv +=
                                        "<p class='font-bold text-center' > Emp Id : " +
                                        valueee['id'] +
                                        "</p>";
                                    divv += "</div>";
                                });
                            });
                        });
                        $('#tm_data').html(divv); // Setting up the Team leader data
                    }
                });

            });
        });
    </script>

    {{-- <script type="text/javascript" src="{{ asset('js/hierarchy.js') }}"></script> --}}
@endsection
