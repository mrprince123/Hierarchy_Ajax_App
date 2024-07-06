{/* <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>  */}

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

$(document).ready(function () {

    $("#position_id").on('change', function (e) {
        e.preventDefault();

        var roleId = $(this).val();
        console.log(roleId);

        if (roleId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/employee/specific') }}",
                method: 'GET',
                data: {
                    roleId: roleId,
                },
                success: function (data) {

                    // var jsonString = JSON.parse(data);
                    // console.log(jsonString);
                    // console.log("This is length", data.length);

                    // This is for the Inserting the Value in the Select Dropdown 
                    var option = '';
                    $.each(data, function (key, value) {
                        // console.log(key, " ", value);
                        $.each(value, function (keyy, valuee) {
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
