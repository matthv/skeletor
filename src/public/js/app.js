$(function() {
    $(document).on('click', '.remove-item', function(event) {
        if (window.confirm('Etes-vous certain ?')) {
            var self = $(this);
            var href = $(this).attr('data-href');
            if(href !== undefined){
                var request = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: href,
                    method: 'DELETE',
                });
                request.done(function() {
                    self.closest('.form-child').remove();
                });
                request.fail(function(jqXHR, textStatus) {
                    console.log(textStatus);
                });
            }
            else {
                $(this).closest('.form-child').remove();
            }
        }
        return event.preventDefault();
    });

    /**
     * summernote
     */
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
});


