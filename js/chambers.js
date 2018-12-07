
(function($){ 

    $(document).ready(function(){

        var chambersEls = document.getElementsByClassName( 'read-more' ),
            max = chambersEls.length;
            stateHidden = "Reveal details";
            HTMLReveal = 'Reveal details<span class="dashicons dashicons-arrow-right-alt2"></span>';
            HTMLHide = 'Hide details<span class="dashicons dashicons-arrow-up-alt2"></span>';

        // add event listeners 
        for( var i = 0; i < max; i++ ) {

            chambersEls[i].addEventListener( 'click', toggleCardView, false );

        }        

        
        function toggleCardView ( e ) {

            e.preventDefault();
    
            // Safari gets upset if you click the span and breaks everything
            // So we're just checking to see exactly which element was clicked
            if ( e.target.nodeName == 'SPAN') {
                objectClicked = this;
            } else {
                objectClicked = e.target;
            }


            // now hide and reveal the chamber card as required
            if ( objectClicked.innerText == stateHidden ) {
                objectClicked.innerHTML = HTMLHide;
            } else {
                objectClicked.innerHTML = HTMLReveal;
            }

            objectClicked.parentElement.nextElementSibling.classList.toggle ( 'hidden' );
    

            // check to see if this is the last chamber in the list, as we don't want a bottom blue border on the last chamber
            // if it isn't the last element, then add a blue border
            if ( objectClicked.parentElement.nextElementSibling.nextElementSibling ) {
                objectClicked.parentElement.nextElementSibling.nextElementSibling.classList.toggle ( 'chambers-list-hide-top-border' );
            }
 
        }

    });

})(jQuery);
