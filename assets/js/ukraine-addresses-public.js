jQuery(document).ready(function($) {
    // create references to the 3 dropdown fields for later use.

    var $makes_dd = $('[name="makes"]');
    var $models_dd = $('[name="models"]');
    var $years_dd = $('[name="years"]');


    // run the populate_fields function, and additionally run it every time a value changes

    populate_fields();
    $('select').change(function() {
        populate_fields();
    });

    function populate_fields() {

        var data = {

            // action needs to match the action hook part after wp_ajax_nopriv_ and wp_ajax_ in the server side script.

            'action' : 'cf7_populate_values',

            // pass all the currently selected values to the server side script.

            'make' : $makes_dd.val(),
            'model' : $models_dd.val(),
            'year' : $years_dd.val()
        };

        // call the server side script, and on completion, update all dropdown lists with the received values.

        $.post('/wp-admin/admin-ajax.php', data, function(response) {
            all_values = response;

            $makes_dd.html('').append($('<option>').text(' -- choose make -- '));
            $models_dd.html('').append($('<option>').text(' -- choose model  -- '));
            $years_dd.html('').append($('<option>').text(' -- choose year -- '));

            $.each(all_values.makes, function() {
                $option = $("<option>").text(this).val(this);
                if (all_values.current_make == this) {
                    $option.attr('selected','selected');
                }
                $makes_dd.append($option);
            });
            $.each(all_values.models, function() {
                $option = $("<option>").text(this).val(this);
                if (all_values.current_model == this) {
                    $option.attr('selected','selected');
                }
                $models_dd.append($option);
            });
            $.each(all_values.years, function() {
                $option = $("<option>").text(this).val(this);
                if (all_values.current_year == this) {
                    $option.attr('selected','selected');
                }
                $years_dd.append($option);
            });
        },'json');
    }
});