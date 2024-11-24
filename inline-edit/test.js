jQuery(document).ready(function($) {
    $('.my-inline-text-widget').on('click', function() {
        $(this).attr('contenteditable', 'true').focus();
    });

    $('.my-inline-text-widget').on('blur', function() {
        var newText = $(this).text(); // Get the updated text
        var widgetId = $(this).closest('.elementor-widget').attr('data-id'); // Get the widget's ID

        console.log("Updated Text: " + newText); // Debugging log
        console.log("Widget ID: " + widgetId); // Debugging log

        $.ajax({
            url: myElementorWidget.ajaxurl, // Use localized AJAX URL
            method: 'POST',
            data: {
                action: 'save_inline_text',
                widget_id: widgetId,
                inline_text: newText,
                security: myElementorWidget.ajax_nonce, // Pass nonce for security
            },
            success: function(response) {
                console.log("AJAX Response:", response); // Check the response in console
                if (response.success) {
                    console.log('Text saved successfully');
                } else {
                    console.log('Error saving text: ' + response.data.message); // Check for error message
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX error:", error); // Catch AJAX errors
            }
        });
    });
});
