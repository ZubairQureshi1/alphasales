    var row_count = count;
    $('.btn-clone').on('click', function(e) {
        e.preventDefault();
        row_count++;
        // call
        $.ajax({
            url: '/designations/campusDepartmentsFields?count=' + row_count,
            type: 'GET',
            success: function(data) {
                $('#dynamic_data').append(data);
            }
        });
    })

    function onOrganizationCampusSelect(event) {
        let _id = $(event.target).val(),
            _row = event.target.getAttribute('data-row');
        if (_id != "") {
            $.ajax({
                url: "/campuses/campusDepartments/" + _id,
                // dataType: "json",
                type: "GET",
                success: function(data) {
                    $("#department_id_" + _row).html("");
                    var department_select = '';
                    department_select += "<div class='form-group'>";
                    department_select += "<label>Department</label>";
                    department_select += "<select class='form-control select2' required name='designation_details[" + _row + "][department_ids][]' id='department_id' multiple>";
                    jQuery.each(data.data.departments, function(index, value) {
                        department_select += "<option value='" + value.id + "'>" + value.name + "</option>";
                    });
                    department_select += "</select>";
                    department_select += "</div>";
                    $("#department_id_" + _row).html(department_select);
                    $('.select2').select2({
                        'placeholder': '--- Select Department ---',
                    });
                },
                error: function(data) {
                    swal.showValidationError(`Request failed: ${data}`)
                    alertify.error('Something went wrong.')
                }
            });
        } else {
            $("#department_id_" + _row).html("");
        }
    }

    function initials(name, target) {
        var nameArray = name.split(" ");
        var initials = '';
        if (nameArray.length === 1) {
            return nameArray[0].charAt(0) + "" + nameArray[0].charAt(1);
        } else {
            initials = nameArray[0].charAt(0);
        }
        //first word
        for (i = (nameArray.length - 1); i < nameArray.length; i++) {
            initials += nameArray[i].charAt(0);
        }
        $(target).val(initials.toUpperCase());
    }
    $(function() {
        $(document).on('click', '.btn-remove', function(event) {
            event.preventDefault();
            /* Act on the event */
            $(this).fadeOut('slow', function() {
                $(this).parent().parent().remove();
            })
        });
    })