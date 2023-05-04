function changeSpecificAttributes() {

    var category = $('#productType').val();
    
    $.ajax(
        {
            url: "app/controllers/get-attributes",
            type: "POST",
            data: {category: category},
            success: function(result){
                $("#productAttributes").html(result);
            }
        }
    );
}

$(document).ready(function(){

    $("#product_form").on('submit',function(e) {

        e.preventDefault();
        var sku = $("#sku").val();
        var name = $("#name").val();
        var price = $("#price").val();
        var productType = $("#productType").val();
        var attributes = document.getElementsByName('attributes[]');
        
        let attributesArray = [null];
        for (var i=0; i<=attributes.length-1; i++) {
            attributesArray[i] = attributes[i].value;
        }
        
        $.ajax(
            {
                url: 'app/views/add-product',
                method: "POST",
                data: {
                    sku: sku,
                    name: name,
                    price: price,
                    category: productType,
                    attributes: attributesArray
                },
                success: function(response){
                    $("#form-message").html(response);

                    if(response.indexOf('Product added') >= 0){
                        window.location = '/';
                    }
                },
                dataType: 'text'
            }
        );
    });
});