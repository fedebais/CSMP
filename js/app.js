var isMobile = false;


(function( $ ) {
    "use strict";
     
    $(function() {

		/*====================================================================================*/ 
		/*  MOBILE DETECT                                                                     */
		/*====================================================================================*/

        if (navigator.userAgent.match(/Android/i) || 
            navigator.userAgent.match(/webOS/i) ||
            navigator.userAgent.match(/iPhone/i) || 
            navigator.userAgent.match(/iPad/i)|| 
            navigator.userAgent.match(/iPod/i) || 
            navigator.userAgent.match(/BlackBerry/i)) {                 
            isMobile = true;            
        }


    });

}(jQuery));