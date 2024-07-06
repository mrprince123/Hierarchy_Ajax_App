<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

$(document).ready(function () {
    // var id = 4;
    $('#role_id').on('change', function (e) {
        id = $(this).val();
        console.log(id);

        $.ajax({
            url: "{{ url(' / employee / specific') }}",
            method: "GET",
            data: {
                roleId: id
            },
            success: function (data) {
                console.log(data);

                let option = '';

                $.each(data, function (key, value) {
                    $.each(value, function (keyy, valuee) {
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
