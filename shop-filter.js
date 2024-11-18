jQuery(document).ready(function($) {
    // Get the value of the custom data attribute
    var slideMargin = $(".bwdtbt-for-all-owlCarousel").attr("bwdtbt-data-margin");

    console.log(slideMargin); // Check the value in the console
});

jQuery(document).ready(function ($) {
    var slideMargin = $(".bwdtbt-for-all-owlCarousel").attr("bwdtbt-data-margin");
    var priceCurrency = $(".bwdtbt-for-all-owlCarousel").attr("filter-price-currency");
    // Price slider
    $("#price-slider").slider({
        range: true,
        min: 0,
        max: slideMargin,
        values: [0, slideMargin],
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
