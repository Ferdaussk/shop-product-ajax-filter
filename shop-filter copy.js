jQuery(document).ready(function ($) {
    $("#price-slider").slider({
        range: true,
        min: 0,
        max: 1000,
        values: [0, 1000],
        slide: function (event, ui) {
            $("#min_price").val(ui.values[0]);
            $("#max_price").val(ui.values[1]);
            $("#price-range-display").text("Min: " + ui.values[0] + " - Max: " + ui.values[1]);
        }
    });

    $("#min_price").val($("#price-slider").slider("values", 0));
    $("#max_price").val($("#price-slider").slider("values", 1));

    $("#filter-button").on("click", function () {
        var filterData = $("#filter-form").serialize();
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: "POST",
            data: filterData + "&action=filter_products",
            success: function (response) {
                $("#filtered-products").html(response);
            },
        });
    });
});
