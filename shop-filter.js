
jQuery(document).ready(function ($) {
    var maxPriceFilter = $(".shop-products-filter").attr("max-price-filter");
    // var minPriceFilter = $(".shop-products-filter").attr("min-price-filter");
    var priceCurrency = $(".shop-products-filter").attr("filter-price-currency");
    // Price slider
    $("#price-slider").slider({
        range: true,
        min: 0,
        max: maxPriceFilter,
        values: [0, maxPriceFilter],
        slide: function (event, ui) {
            $("#min_price").val(ui.values[0]);
            $("#max_price").val(ui.values[1]);
            $("#price-range-display").text("Min: " + priceCurrency+" "+ui.values[0] + " - Max: " + priceCurrency+" "+ui.values[1]);
            triggerFilter();
        }
    });

    // Trigger filter on form field changes, including search input
    $("#filter-form input, #filter-form select").on("change input", function () {
        triggerFilter();
    });

    function triggerFilter() {
        var filterData = $("#filter-form").serialize();
        
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: "POST",
            data: filterData + "&action=filter_products",
            beforeSend: function () {
                $("#filtered-products").html('<p>Loading...</p>');
            },
            success: function (response) {
                $("#filtered-products").html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", error);
                console.log("Response: ", xhr.responseText);
            },
        });
    }
});
