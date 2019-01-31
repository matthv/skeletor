<form method="POST" id="form-destroy">
    @method('DELETE')
    @csrf
</form>
<script>
    $(function(){
        /**
         * Delete Model
         */
        $(document).on('click', 'a.delete', function(e){
            var self = $(this);
            var formDestroy = $('#form-destroy');
            e.preventDefault();
            if (window.confirm('Etes-vous certain ?')) {
                formDestroy.attr('action', self.attr('href'))
                formDestroy.submit();
            }
        });
    });
</script>