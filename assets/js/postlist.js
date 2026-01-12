jQuery(document).ready(function ($) {
    let offset = $('.trad-post-list').length;
    const button = $('.trad-load-more-button');

    button.on('click', function () {
        const btn = $(this);
        const category = btn.data('category');
        const limit = parseInt(btn.data('limit'));

        btn.text('Loading...').prop('disabled', true);

        $.ajax({
            url: trad_ajax_obj.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'trad_load_more_posts',
                security: trad_ajax_obj.nonce,
                category: category,
                offset: offset,
                limit: limit
            },
            success: function (response) {
                if (response.success && response.data.html) {
                    $('.trad-product-display').append(response.data.html);
                    offset += response.data.count;

                    if (response.data.has_more) {
                        btn.text('Load More').prop('disabled', false);
                    } else {
                        btn.remove();
                    }
                } else {
                    btn.text('No more posts');
                }
            },
            error: function () {
                btn.text('Error. Try again').prop('disabled', false);
            }
        });
    });
});