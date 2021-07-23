$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#OptionsCollapse').collapse('show');

    $('.option-value').select2({
        placeholder: "Select your values",
        tags: true,
        tokenSeparators: [',', ' '],
        theme: "flat"
    });


    $('#hasOptions').click(function (event) {
        $('#OptionsCollapse').collapse('show');
        console.log("Show Variants");
    });

    $('#hasNoOptions').click(function (event) {
        $('#OptionsCollapse').collapse('hide');
        console.log("Hide Variants");
    });

    $('#add-options').click((event) => {
        let count = $('.option-value').length;
        $('#options-div').append(`<div class="row align-items-center mt-2">
                                      <div class="col">
                                          <input type="text" class="form-control option-name" placeholder="Enter the Option Name">
                                      </div>
                                      <div class="col">
                                          <select class="option-value" id="options-${count+1}" multiple="multiple"></select>
                                      </div>
                                  </div>`);
        $('.option-value').select2({
            placeholder: "Select your values",
            tags: true,
            tokenSeparators: [',', ' '],
            theme: "flat"
        });
    });

    $('#generate-variants').click((event) => {
        $('#generated-variants').removeClass('d-none');

        let optionNames = [],
            optionValues = [],
            columnData = [],
            data = [],
            temp = [],
            json = {},
            string = '';

        $('.option-name').each((i, obj) => {
            if ($(obj).val() != "") {
                optionNames.push($(obj).val());
            }
        });

        $('.option-value').each((i, obj) => {
            if ($(obj).val().length >= 1) {
                optionValues.push($(obj).val());
            }
        });

        columnData.push({
            'data': 'SKU'
        });

        console.log(optionNames);

        optionNames.forEach(optionName => {
            columnData.push({
                'data': optionName
            })
            string += '<td>' + optionName + '</td>';
        });
        $('#generated-variants-table > thead').empty();
        $('#generated-variants-table > thead').append(
            `<tr>
                <td>SKU</td>
                ${string}
                <td>Exclude</td>
             </tr>`
        );

        columnData.push({
            data: 'Exclude',
            render: function (data, type, row) {
                return '<input type="checkbox" class="exclude-checkboxes" data-element="' + data + '">'
            }
        })

        let variants = getVariants(optionValues);

        variants.forEach((variant, index) => {
            json = {}
            json['SKU'] = variant;
            temp = variant.split('-');
            temp.forEach((val, iter) => {
                json[optionNames[iter]] = val;
            });
            json['Exclude'] = variant;
            data.push(json);
        });

        if ($('#generated-variants-table > tbody').length) {
            window.datatable.destroy();
        }

        console.log("DATA: ", data);
        console.log("ColumnData: ", columnData);

        window.datatable = $('#generated-variants-table').DataTable({
            data: data,
            searching: false,
            paging: false,
            info: false,
            columns: columnData
        });

        $('#saveToDatabase').removeClass('d-none');

    });

    $('#saveToDatabase').click((event) => {
        let name = $('#item-name').val();
        let hasOptions = ($("input[type='radio'][name='radio-options']:checked").attr('id') == "hasOptions") ? true : false;

        let optionValues = [],
            optionNames = [];

        $('.option-name').each((i, obj) => {
            if ($(obj).val() != "") {
                optionNames.push($(obj).val());
            }
        });

        $('.option-value').each((i, obj) => {
            if (obj.length >= 1) {
                optionValues[i] = {
                    'name': optionNames[i],
                    'values': $(obj).val()
                }
            }
        });
        let variants = window.datatable.data().toArray();

        variants.forEach((variant, index) => {
            if ($("input[type='checkbox'][data-element=" + variant['SKU'] + "]:checked").length) {
                variants[index]['Exclude'] = true;
            } else {
                variants[index]['Exclude'] = false;
            }
        });

        let data = {
            name: name,
            hasOptions: hasOptions,
            options: optionValues,
            variants: variants,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        console.log(data);
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: "/saveOrder",
            data: data,
            success: function (data) {
                console.log(data);
                $('.toast').toast('show');
                setTimeout(() => {
                    $('.toast').toast('hide');
                }, 2000);
            }
        });
    });

    function getVariants(arr) {
        let sep = '-',
            newArr = []
        if (arr.length == 2) {
            arr[0].forEach(ele1 => {
                arr[1].forEach(ele2 => {
                    newArr.push(ele1 + sep + ele2)
                })
            });
            return newArr;
        } else {
            arr[0].forEach(ele1 => {
                arr[1].forEach(ele2 => {
                    newArr.push(ele1 + sep + ele2)
                })
            });

            arr[0] = newArr
            arr.splice(1, 1)
            return getVariants(arr)
        }
    }
});
