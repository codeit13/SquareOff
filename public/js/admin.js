$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: "/getData",
        data: {
            id: $('#order-id').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (resp) {
            orderData = resp[0];
            console.log(orderData);

            let optionNames = [],
                optionValues = [],
                columnData = [],
                data = [],
                temp = [],
                json = {},
                string = '';

                orderData['options'].forEach(ele => {
                    optionNames.push(ele['name']);
                    optionValues.push(ele['values']);
                });

            columnData.push({
                'data': 'SKU'
            });

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
                    console.log(data);
                    let values = data.split('^');
                    if(values[1] == 'true') {
                        return '<input type="checkbox" class="exclude-checkboxes" data-element="' + values[0] + '" checked>'
                    } else {
                        return '<input type="checkbox" class="exclude-checkboxes" data-element="' + values[0] + '">'
                    }
                    
                }
            })

            let variants = orderData['variants'];

            variants.forEach((variant, index) => {
                json = {};
                for(var key in variant) {
                        json[key] = variant[key];
                }
                json['Exclude'] = json['SKU'] + '^' + json['Exclude'];
                data.push(json);
            });

            if ($('#generated-variants-table > tbody').length) {
                window.datatable.destroy();
            }

            window.datatable = $('#generated-variants-table').DataTable({
                data: data,
                searching: false,
                paging: false,
                info: false,
                columns: columnData
            });

            $('#saveToDatabase').removeClass('d-none');

        }
    });

    $('#saveToDatabase').click((event) => {
        let variants = window.datatable.data().toArray();

        variants.forEach((variant, index) => {
            if ($("input[type='checkbox'][data-element=" + variant['SKU'] + "]:checked").length) {
                variants[index]['Exclude'] = true;
            } else {
                variants[index]['Exclude'] = false;
            }
        });

        let data = {
            id: $('#order-id').val(),
            variants: variants,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        console.log(data);
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: "/updateOrder",
            data: data,
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    });
});
