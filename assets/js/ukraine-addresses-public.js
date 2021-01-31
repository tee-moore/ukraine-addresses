jQuery(document).ready(function ($) {
    let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMTFjNzEwMTViOTRlY2VhZDkzNjkxODNkY2Q3NjZmMDRhZDczYTRlYWI4MWRhMjAzZjFiMGZkYzNjOTMwMjNlMzk4ZmU5NjY2ZGMyMzQxZjQiLCJpYXQiOjE2MTIwMzkxODQsIm5iZiI6MTYxMjAzOTE4NCwiZXhwIjoxNjE0NzE3NTg0LCJzdWIiOiI0Iiwic2NvcGVzIjpbIioiXX0.Si-KAQwU7dfrpSklw1nHHpzZkup92x5d_6XV1QSa7Hjx9KvuxxvkHdVWawbJsBACSTelTt08_MhmmjUy6fSnct6LkYsHSNAZcF2_mzY60VQGcYFbWfCF3lXuN6oTQstgfXiXbErsncWdWqjgJAe9db7enoN-UlQcayUD_88DcH18Rzgk4C68xQQoKbhXopyDUx9UNpO2heQy8HpXPPbkaNR8vw_2Vzz0XmydwXuqTs7Hb4xPgfWClaai3aVnhrLBM2Py806HqNyBIcAAeKJRef73K_GSo2ZE6PvKuNGT35lRT76892t3K7seCBWplnG-mCTspjUOhWXlY4i-WP_Yl-n60taDPhTYyuAnRE5ufLh-xatajcp7kVAFHUjjROhvn4yqwiy0oii3BDlpz5GG9RHQ53Pca-BQqyaSmZQQkj3CILfYvY4a9DKmDNHLzKH_TK41RhSooYAWbKNutsA_wdDhBaMjks38tZhuwZ7dJ_qbzF1zNANRkUSypJ5Mm5NJ_7nbHN0fGxrqV7U3-uWp5Ez-bmNAs_IMIs_YNpl26cWSZdkJSPg28QeCViMayoAj63SjLFB8nsT5x9N7qkp6gi9qj6qYaJxZVtJEqNDATc4N1hfFv0sheDJ_Hv_duej08lhcOm7iP8Pl1T050v3rp75XBrpsrBS9LSv5L266nus';
    let url = 'http://geo.loc:8080/api/v1/level/one';
    let currentSelect = $('#ua-select-level-one');
    let nextSelect = getNextSelect(url);
    let startReset = 0;
    let autoshow = params.autoshow;
    let captionType = params.captionType;
    let defaultTitles = {
        'ua-select-level-one': $('#ua-select-level-one option:selected').text(),
        'ua-select-level-two': $('#ua-select-level-two option:selected').text(),
        'ua-select-level-three': $('#ua-select-level-three option:selected').text(),
        'ua-select-level-streets': $('#ua-select-level-streets option:selected').text(),
        'ua-select-level-addresses': $('#ua-select-level-addresses option:selected').text(),
    };

    $('.ua-select-level').on('change', function () {
        resetAllSelects($(this));

        url = $(this).find(':selected').attr('data-url');
        if (url !== 'none') {
            nextSelect = getNextSelect(url);
            getData(url)
        } else {
            nextSelect = $('#ua-select-level-room')
        }

        setVisible(nextSelect)
    });

    function getNextSelect(url) {
        let lastSegment = getLastSegment(url);
        if (lastSegment === 'one') return $('#ua-select-level-one');
        if (lastSegment === 'two') return $('#ua-select-level-two');
        if (lastSegment === 'three') return $('#ua-select-level-three');
        if (lastSegment === 'streets') return $('#ua-select-level-streets');
        if (lastSegment === 'addresses') return $('#ua-select-level-addresses');
    }

    function getCurrentSelect(element) {
        return element.attr('id');
    }

    function getLastSegment(url) {
        let segments = url.split("/");
        let segment = segments.pop();
        if (/^\d+$/.test(segment)) {
            segment = segments.pop();
        }
        return segment;
    }

    function getData(url) {
        // for wp ajax:

        // let data = {
        //     action: 'geo_data',
        //     nonce_code : ua_ajax.nonce,
        //     url: url
        // };

        $.ajax({
            // for wp ajax:
            //url: ua_ajax.url,
            url: url,
            //data: data,
            method: 'get',
            cache: false,
            dataType: 'json',
            headers: {"Authorization": 'Bearer ' + token},
            success: function (data) {
                addOptions(nextSelect, data.data);
            }
        });
    }

    function addOptions(select, options) {
        resetSelect(select);
        for (let item of options) {
            let name = getOptionName(item);
            let option = new Option(name, name);
            let link = 'none';
            if (item.type !== 'addresses') {
                link = item.links.next
            }
            $(option).attr('data-url', link);
            select.append(option);
        }
    }

    function resetAllSelects(element) {
        currentSelect = getCurrentSelect(element);

        if (currentSelect === 'ua-select-level-one') {
            url = 'http://geo.loc:8080/api/v1/level/one';
            nextSelect = getNextSelect(url);
        }

        $('.ua-fields').each(function () {
            if (startReset === 1) {
                resetSelect($(this));
                setHidden($(this))
            }
            if ($(this).is('#' + currentSelect)) {
                startReset = 1;
            }
        });

        startReset = 0;
    }

    function resetSelect(select) {
        let title = defaultTitles[select.attr('id')];
        select.find('option').remove().end().append('<option value="0" disabled selected>' + title + '</option>');
    }

    function setVisible(select) {
        if (autoshow === '1') {
            if (captionType === 'placeholder') {
                select.removeClass('ua-hidden');
                select.addClass('ua-open');
            } else {
                select.closest('label').removeClass('ua-hidden');
                select.closest('label').addClass('ua-open');
            }
        }
    }

    function setHidden(select) {
        if (autoshow === '1') {
            if (captionType === 'placeholder') {
                select.removeClass('ua-open');
                select.addClass('ua-hidden');
            } else {
                select.closest('label').removeClass('ua-open');
                select.closest('label').addClass('ua-hidden');
            }
        }
    }

    function getOptionName(item) {
        if (item.type === 'regions') {
            name = item.name + ' ' + item.prefix;
        } else if (item.type === 'addresses') {
            name = 'number: ' + item.number + '; postcode: ' + item.postcode;
        } else {
            name = item.prefix + ' ' + item.name;
        }

        return name;
    }

    function isIterable(obj) {
        if (obj == null) {
            return false;
        }
        return typeof obj[Symbol.iterator] === 'function';
    }

    // error handler for all requests
    $.ajaxSetup({
        error: function (jqXHR, exception) {
            console.log(jqXHR)
            console.log(exception)
            if (jqXHR.status === 0) {
                console.log('Not connect. Verify Network.')
            } else if (jqXHR.status == 404) {
                console.log('Requested page not found (404).')
            } else if (jqXHR.status == 500) {
                console.log('Internal Server Error (500).')
            } else if (exception === 'parsererror') {
                console.log('Requested JSON parse failed.')
            } else if (exception === 'timeout') {
                console.log('Time out error.')
            } else if (exception === 'abort') {
                console.log('Ajax request aborted.')
            } else {
                console.log('Uncaught Error. ' + jqXHR.responseText)
            }
        }
    });

    getData(url);
});

//
//
// jQuery(document).ready(function($) {
//     // create references to the 3 dropdown fields for later use.
//
//     var $makes_dd = $('[name="makes"]');
//     var $models_dd = $('[name="models"]');
//     var $years_dd = $('[name="years"]');
//
//
//     // run the populate_fields function, and additionally run it every time a value changes
//
//     populate_fields();
//     $('select').change(function() {
//         populate_fields();
//     });
//
//     function populate_fields() {
//
//         var data = {
//
//             // action needs to match the action hook part after wp_ajax_nopriv_ and wp_ajax_ in the server side script.
//
//             'action' : 'cf7_populate_values',
//
//             // pass all the currently selected values to the server side script.
//
//             'make' : $makes_dd.val(),
//             'model' : $models_dd.val(),
//             'year' : $years_dd.val()
//         };
//
//         // call the server side script, and on completion, update all dropdown lists with the received values.
//
//         $.post('/wp-admin/admin-ajax.php', data, function(response) {
//             all_values = response;
//
//             $makes_dd.html('').append($('<option>').text(' -- choose make -- '));
//             $models_dd.html('').append($('<option>').text(' -- choose model  -- '));
//             $years_dd.html('').append($('<option>').text(' -- choose year -- '));
//
//             $.each(all_values.makes, function() {
//                 $option = $("<option>").text(this).val(this);
//                 if (all_values.current_make == this) {
//                     $option.attr('selected','selected');
//                 }
//                 $makes_dd.append($option);
//             });
//             $.each(all_values.models, function() {
//                 $option = $("<option>").text(this).val(this);
//                 if (all_values.current_model == this) {
//                     $option.attr('selected','selected');
//                 }
//                 $models_dd.append($option);
//             });
//             $.each(all_values.years, function() {
//                 $option = $("<option>").text(this).val(this);
//                 if (all_values.current_year == this) {
//                     $option.attr('selected','selected');
//                 }
//                 $years_dd.append($option);
//             });
//         },'json');
//     }
// });