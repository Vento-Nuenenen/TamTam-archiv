$(function () {
    $("#tablecontents").sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();
        }
    });

    function sendOrderToServer() {
        var order = [];
        var token = $('meta[name="csrf-token"]').attr('content');
        $('tr').each(function(index, element) {
            order.push({
                id: $(this).attr('data-id'),
                position: index+1
            });
        });

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "numbers/sort",
            data: {
                order: order,
                _token: token
            },
            success: function(response) {
                alert(response.status);
                if(response.status == "success") {
                    console.log(response);
                } else {
                    console.log(response);
                }
            }
        });
    }
});
