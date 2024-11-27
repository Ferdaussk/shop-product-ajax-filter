jQuery(document).ready(function ($) {
    // Fetch attributes for min, max price, and currency
    var maxPriceFilter = $(".shop-products-filter").attr("max-price-filter");
    var minPriceFilter = $(".shop-products-filter").attr("min-price-filter");
    var priceCurrency = $(".shop-products-filter").attr("filter-price-currency");
    $("#price-slider").slider({
        range: true,
        min: parseFloat(minPriceFilter), 
        max: parseFloat(maxPriceFilter),
        values: [parseFloat(minPriceFilter), parseFloat(maxPriceFilter)], 
        slide: function (event, ui) {
            $("#min_price").val(ui.values[0]);
            $("#max_price").val(ui.values[1]);
            $("#price-range-display").text(
                "Min: " + priceCurrency + " " + ui.values[0] +
                " - Max: " + priceCurrency + " " + ui.values[1]
            );
            triggerFilter(); 
        }
    });

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
                $("#filtered-products").html('<div class="loading-spinner"></div>');
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


document.addEventListener('DOMContentLoaded', function() {
    const productLinks = document.querySelectorAll('.woocommerce-LoopProduct-link');
    productLinks.forEach(function(link) {
        const title = link.querySelector('.woocommerce-loop-product__title');
        const price = link.querySelector('.price');
        const starRating = link.querySelector('.star-rating');
        if (title && price) {
            const wrapper = document.createElement('div');
            wrapper.classList.add('product-title-price-wrapper');
            wrapper.appendChild(title);
            wrapper.appendChild(price);
            if (starRating) {
                wrapper.appendChild(starRating);
            }
            link.appendChild(wrapper);
        }
    });
});

