$(document).ready(function() {
    $('.nav-link-collapse').on('click', function() {
        $('.nav-link-collapse').not(this).removeClass('nav-link-show');
        $(this).toggleClass('nav-link-show');
    });

    if (jQuery().multiselect) {
        $(document).ready(function() {
            $('#class_id').multiselect();
            $('#day_id').multiselect();
        });
    }

    $(document).on("click", ".att-checkbox", function() {
        const date = $(this).attr('date');
        const id = $(this).attr('id');
        const val = $(this).is(":checked");
        const year = $("#selected_year_id").val();
        const month = $("#selected_month_id").val();
        const class_id = $("#selected_class_id").val();


        $.ajax({
            url: "/students/attendance",
            type: "post",
            dataType: 'json',
            data: { date, year, month, class_id, student_id: id, mark_attendance: true, att_status: val ? 1 : 0 },
            success: function(response) {
                if (response.success == "1") {
                    location.reload();
                }
                // You will get response from your PHP page (what you echo or print)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    });

    $(document).on("click", ".staff-att-checkbox", function() {
        const date = $(this).attr('date');
        const id = $(this).attr('id');
        const val = $(this).is(":checked");
        const year = $("#selected_year_id").val();
        const month = $("#selected_month_id").val();


        $.ajax({
            url: "/users/attendance",
            type: "post",
            dataType: 'json',
            data: { date, year, month, user_id: id, mark_attendance: true, att_status: val ? 1 : 0 },
            success: function(response) {
                if (response.success == "1") {
                    location.reload();
                }
                // You will get response from your PHP page (what you echo or print)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    })


});