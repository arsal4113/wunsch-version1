<div id="back-to-top-control" class="hidden">
    <?= $this->Html->image('back-up-icon.svg', ['id' => 'back-to-top-icon']) ?>
</div>

<script>
    (function ($) {
        $(window).scroll(function(){
        var scrolled = $(window).scrollTop(); 
        if ( scrolled >= 300 && !$('#filter').hasClass('filter-shown') ) {
            $('#back-to-top-control').removeClass('hidden');
        } else {
            $('#back-to-top-control').addClass('hidden');
        }
        });
        $('#back-to-top-control').on('click', function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
    })(jQuery);
</script>