<Script>
(function($) {
    // Register block preview template
    wp.blocks.registerBlockPreviewTemplate('your/block/name', {
        category: 'common',
        title: 'Custom Block Preview',
        edit: function() {
            return '<div class="quik-buy-now-button-custom-block -preview">Preview Content Here</div>';
        },
    });
})(jQuery);
</Script>
