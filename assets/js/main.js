(function($) {
    "use strict";

    $(document).ready(function() {
 
        
        // Sticky header
        $(window).on("scroll", function() {
            if ($(window).scrollTop() >= 200) {
                $(".app-header").addClass("sticky-nav");
            } else {
                $(".app-header").removeClass("sticky-nav");
            }
        });

       


        
        
      

        
    });

})(jQuery);
