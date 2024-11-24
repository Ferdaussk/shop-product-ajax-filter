jQuery(document).ready(function ($) {
    // Detect changes in contenteditable fields
    $(".repeater-item").on("input", function () {
        let newText = $(this).text();
        let index = $(this).data("index");

        // Store changes in an object to save on publish
        if (!window.repeaterChanges) {
            window.repeaterChanges = {};
        }
        window.repeaterChanges[index] = newText;
    });

    // Listen for the publish/update button click in the editor
    window.elementor.on("document:save", function () {
        if (window.repeaterChanges) {
            $.ajax({
                url: ajaxurl, // Elementor provides this
                type: "POST",
                data: {
                    action: "save_inline_repeater_on_publish",
                    changes: window.repeaterChanges,
                },
                success: function (response) {
                    console.log("Changes saved successfully!");
                    window.repeaterChanges = {}; // Clear changes after saving
                },
                error: function () {
                    console.log("Failed to save changes.");
                },
            });
        }
    });
});



jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/inline_repeater_widget.default', function ($scope) {
        console.log("Inline Repeater Widget Loaded!");

        let $items = $scope.find(".repeater-item[contenteditable='true']");

        if ($items.length > 0) {
            $items.on("input", function () {
                let $this = jQuery(this);
                let newValue = $this.text();
                let settingKey = $this.data("setting");

                console.log("Inline Edit Detected:");
                console.log("New Value:", newValue);
                console.log("Setting Key:", settingKey);

                // Update Elementor model
                if (elementor.settings.page) {
                    elementor.settings.page.model.set(settingKey, newValue);

                    // Refresh control UI
                    elementor.settings.page.trigger('change:' + settingKey);

                    console.log("Updated Model:", elementor.settings.page.model.get(settingKey));
                }
            });
        } else {
            console.log("No inline elements found.");
        }
    });
});



