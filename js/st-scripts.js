(function($){
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
    function fullWidthDevider($d){
        var ww = $(window).width();
        $d.each(function(){
            var $el = $(this), ol = $el.parent().offset().left - 1;
            $el.css({'left': -ol + 'px', 'width': (ww - 1) + 'px'})
        });
    };
    function productPageCaptionHeight(){
        if($(window).width() < 768){
            $('.st-iwc-caption').attr('style', '');
            return false;
        }
        $('.st-innerrcols-wrap').each(function(){
            var h = 0, $caps = $('.st-iwc-caption', $(this));
            console.log($caps);
            if($caps.size() < 2){
                return;
            }
            $caps.each(function(){
                var ch = $(this).outerHeight();
                h = Math.max(h, ch);
            });
            if(h){
               $caps.css('min-height',  h + 'px'); 
            }
        });
    };
    $(document).ready(function(){
        var $deviders = $('.full-width-devider');
        fullWidthDevider($deviders);
        $('.st-reveal-content').on('click', function(e){
            e.preventDefault();
            $($(this).attr('href')).slideToggle(400);
        });
        if($(window).width() <= 1024){
            $('#navigation li a').off('click');
        }
        $("a[rel^='prettyPhoto'], .st-prettyPhoto").prettyPhoto({
            "deeplinking": false,
            "social_tools": ""
        });
        $('.rental-chambers .chambers-list-table .pdf a').on('click', function (e){
            e.stopPropagation();
        });
        $('.rental-chambers .chambers-list-table').on('click', function (e){
            e.preventDefault();
            var $heading = $(this), $card = $heading.next('.chambers-card');
            if($card.hasClass('hidden')){
                $heading.find('.read-more').html('Hide details<span class="dashicons dashicons-arrow-up-alt2"></span>');
            }else{
                $heading.find('.read-more').html('Reveal details<span class="dashicons dashicons-arrow-right-alt2"></span>');
            }
            $card.toggleClass('hidden');
        });
        if($(window).width() > 767){
            productPageCaptionHeight();
        }
        $(window).bind("resize", debounce(function() {
            fullWidthDevider($deviders);
            if($(window).width() <= 1024){
                $('#navigation li a').off('click');
            }
            productPageCaptionHeight();
        },250));
    });
    $(window).load(function(){
        if($(window).width() > 767){
            productPageCaptionHeight();
        }
    });
})(jQuery);