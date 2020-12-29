$(document).ready(function() {
    $('#lecturer_datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": $("#lecturer_datatable").attr("url"),
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "nic_no" },
            { "data": "email_address" },
            { "data": "phone_number" },
            { "data": "modified_at" },
            {
                "data": null,
                className: "center",
                render: function(data, type) {
                    let content = "";
                    content = '<div class="btn-group" role="group" aria-label="Action Button">';
                    if (data.edit)
                        content += '<a href="/lecturers/edit/' + data.id + '" class="btn btn-info btn-sm">Edit</a>';

                    if (data.view)
                        content += '<a href="/lecturers/view/' + data.id + '" class="btn btn-success btn-sm">View</a>';

                    if (data.delete)
                        content += '<a href="/lecturers/delete/' + data.id + '" id="' + data.id + '" class="btn btn-danger btn-sm deleteRecord">Delete</a>';
                    content += '</div>';
                    return content;
                }
            }
        ]
    });


    $('#users_datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": $("#users_datatable").attr("url"),
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "user_role" },
            { "data": "modified_at" },
            {
                "data": null,
                className: "center",
                render: function(data, type) {
                    let content = "";
                    content = '<div class="btn-group" role="group" aria-label="Action Button">';
                    if (data.edit)
                        content += '<a href="/users/edit/' + data.id + '" class="btn btn-info btn-sm">Edit</a>';

                    if (data.delete)
                        content += '<a href="/users/delete/' + data.id + '" id="' + data.id + '" class="btn btn-danger btn-sm deleteRecord">Delete</a>';
                    content += '</div>';
                    return content;
                }
            }
        ]
    });




    $('#subject_datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": $("#subject_datatable").attr("url"),
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "code" },
            { "data": "modified_at" },
            {
                "data": null,
                className: "center",
                render: function(data, type) {
                    let content = "";
                    content = '<div class="btn-group" role="group" aria-label="Action Button">';
                    if (data.edit)
                        content += '<a href="/subjects/edit/' + data.id + '" class="btn btn-info btn-sm">Edit</a>';

                    if (data.view)
                        content += '<a href="/subjects/view/' + data.id + '" class="btn btn-success btn-sm">View</a>';

                    if (data.delete)
                        content += '<a href="/subjects/delete/' + data.id + '" id="' + data.id + '" class="btn btn-danger btn-sm deleteRecord">Delete</a>';
                    content += '</div>';
                    return content;
                }
            }
        ]
    });


    $('#student_datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": $("#student_datatable").attr("url"),
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "nic_no" },
            { "data": "gurdian_name" },
            { "data": "modified_at" },
            {
                "data": null,
                className: "center",
                render: function(data, type) {
                    let content = "";
                    content = '<div class="btn-group" role="group" aria-label="Action Button">';
                    if (data.edit)
                        content += '<a href="/students/edit/' + data.id + '" class="btn btn-info btn-sm">Edit</a>';

                    if (data.view)
                        content += '<a href="/students/view/' + data.id + '" class="btn btn-success btn-sm">View</a>';

                    if (data.payment)
                        content += '<a href="/students/payment/' + data.id + '" class="btn btn-success btn-sm">Add Fee</a>';

                    if (data.delete)
                        content += '<a href="/students/delete/' + data.id + '" id="' + data.id + '" class="btn btn-danger btn-sm deleteRecord">Delete</a>';
                    content += '</div>';
                    return content;
                }
            }
        ]
    });


    $('#class_datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": $("#class_datatable").attr("url"),
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "class_name" },
            { "data": "class_code" },
            { "data": "subject_name" },
            { "data": "lecturer_name" },
            { "data": "modified_at" },
            {
                "data": null,
                className: "center",
                render: function(data, type) {
                    let content = "";
                    content = '<div class="btn-group" role="group" aria-label="Action Button">';
                    if (data.edit)
                        content += '<a href="/classess/edit/' + data.id + '" class="btn btn-info btn-sm">Edit</a>';

                    if (data.view)
                        content += '<a href="/classess/view/' + data.id + '" class="btn btn-success btn-sm">View</a>';

                    if (data.delete)
                        content += '<a href="/classess/delete/' + data.id + '" id="' + data.id + '" class="btn btn-danger btn-sm deleteRecord">Delete</a>';
                    content += '</div>';
                    return content;
                }
            }
        ]
    });



    $('#transaction_datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": $("#transaction_datatable").attr("url"),
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "type" },
            { "data": "title" },
            { "data": "amount" },
            { "data": "modified_at" },
            {
                "data": null,
                className: "center",
                render: function(data, type) {
                    let content = "";
                    content = '<div class="btn-group" role="group" aria-label="Action Button">';
                    if (data.edit)
                        content += '<a href="/cafeteria/edit/' + data.id + '" class="btn btn-info btn-sm">Edit</a>';

                    if (data.view)
                        content += '<a href="/cafeteria/view/' + data.id + '" class="btn btn-success btn-sm">View</a>';

                    if (data.delete)
                        content += '<a href="/cafeteria/delete/' + data.id + '" id="' + data.id + '" class="btn btn-danger btn-sm deleteRecord">Delete</a>';
                    content += '</div>';
                    return content;
                }
            }
        ]
    });

});