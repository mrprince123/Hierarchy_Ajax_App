<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

$(document).ready(function () {

    // This is for the Team Leader
    $('.one_tl').on('click', function (e) {
        e.preventDefault();

        var id = $(this).attr('id');
        console.log(id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('/assign/specific') }}",
            method: "GET",
            data: {
                roleId: id
            },
            success: function (data) {
                console.log("Team Leader ", data);

                $('#tl_data').empty();

                // This is for the Inserting the Value in the Select Dropdown 
                var div = '';
                $.each(data, function (key, value) {
                    // console.log("First", key, " ", value);
                    $.each(value, function (keyy, valuee) {
                        // console.log("Second", keyy, ' ', valuee);
                        $.each(valuee, function (keyyy, valueee) {
                            // console.log("Third", keyyy, ' ',
                            // valueee);
                            div +=
                                "<div id='one_tl_data' name=" +
                                valueee['id'] +
                                " class='p-2 m-2 one_tl_data bg-teal-100 rounded-xl shadow-xl' >";
                            div +=
                                "<img class='h-32 w-32 object-cover rounded-xl' src='storage/" +
                                valueee['profile_pic'] +
                                "' alt='Employee Image' >";
                            div +=
                                "<p class='text-teal-500 font-bold text-sm text-center' >" +
                                valueee['name'] + "</p>";
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
    $('#tl_data').on('click', '.one_tl_data', function (e) {
        e.preventDefault();

        // Here I have add the on click on the div to get the value of the name attribute. 

        // $('.one_tl_data').on('click', function(e) {
        // e.preventDefault();
        var tmId = $(this).attr('name');

        console.log(tmId);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('/assign/teamMember/') }}",
            method: "GET",
            data: {
                teamMemberId: tmId
            },
            success: function (data2) {
                console.log("TM Data", data2);

                // This is for the Inserting the Value in the Select Dropdown 
                var divv = '';
                $.each(data2, function (key, value) {
                    // console.log(key, " ", value);
                    $.each(value, function (keyy, valuee) {
                        // console.log(keyy, " ", valuee);
                        $.each(valuee, function (keyyy,
                            valueee) {
                            divv +=
                                "<div id='one_tl' name=" +
                                valueee['id'] +
                                " class='p-2 m-2 bg-teal-100 flex flex-col items-center rounded-xl shadow-xl'>";
                            divv +=
                                "<img class='h-32 w-32 object-cover rounded-xl' src='storage/" +
                                valueee[
                                'profile_pic'] +
                                "' alt='Employee Image' >";

                            divv +=
                                "<p class='text-teal-500 font-bold text-sm text-center' >" +
                                valueee['name'] +
                                "</p>";
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