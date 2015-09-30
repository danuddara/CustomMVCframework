<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!--script type="text/javascript" language="javascript" src="<?php echo $baseurl ?>js/jquery-1.4.2.js"></script>-->

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!-- Checkbox JS -->
<!--<script type="text/javascript" src="<?php echo $baseurl ?>js/custom-form-elements.js"></script>-->
<script src="<?php echo $baseurl ?>SpryAssets/SpryEffects.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo $baseurl ?>js/utils.js"></script>



<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<script>
/*the Alertbox this was also in the iprofile js. so create custom external file.*/
    $(document).ready(function () {
         if ($('#dialog-box').is(':hidden')) popup();        
        // if user clicked on button, the overlay layer or the dialogbox, close the dialog    
        $('a.btn-ok, #dialog-overlay, #dialog-box').click(function () {        
            $('#dialog-overlay, #dialog-box').hide();     
            $('#dialog-message').empty();
            $('body').css('overflow','auto');
            return false;
        });
        
        // if user resize the window, call the same function again
        // to make sure the overlay fills the screen and dialogbox aligned to center    
        $(window).resize(function () {
            
            //only do it if the dialog box is not hidden
            if ($('#dialog-box').is(':hidden')) popup();        
        });    
        
        
    });
    //Popup dialog
    function popup(message) {
        
        if(!$('#dialog-message').html()=='')
            {
                // get the screen height and width
                var maskHeight = $(window).height();
                var maskWidth = $(window).width();

                $('body').css('height',maskHeight+'px');
                $('body').css('overflow','hidden');

                // calculate the values for center alignment
                var dialogTop = (maskHeight/3) - ($('#dialog-box').height());
                var dialogLeft = (maskWidth/2) - ($('#dialog-box').width()/2);

                // assign values to the overlay and dialog box
                $('#dialog-overlay').show();
                $('#dialog-box').show();

                // display the message
               
            }
                
    }
</script>

<script>
    $(document).ready(function () {
        $(".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true });
    });
    
</script>