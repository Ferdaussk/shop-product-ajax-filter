jQuery(document).ready(function ($) {
    // Default to grid view
    $('#filtered-products').addClass('grid-view');

    // Toggle between grid and list views
    $('input[name="view_style"]').on('change', function () {
        const view = $(this).val();

        if (view === 'grid') {
            $('#filtered-products').removeClass('list-view').addClass('grid-view');
        } else if (view === 'list') {
            $('#filtered-products').removeClass('grid-view').addClass('list-view');
        }
    });
});
