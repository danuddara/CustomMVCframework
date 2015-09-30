<!--iprofile page Js-->  
<script type="text/javascript" language="javascript" src="<?php echo $baseurl ?>js/jquery-1.4.2.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!-- Checkbox JS -->
<!--<script type="text/javascript" src="<?php echo $baseurl ?>js/custom-form-elements.js"></script>-->
<script src="<?php echo $baseurl ?>SpryAssets/SpryEffects.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo $baseurl ?>js/utils.js"></script>

<!-- Input WaterMark JS Start-->
<script type="text/javascript">
function watermark(inputId,text){
  var inputBox = document.getElementById(inputId);
    if (inputBox.value.length > 0){
      if (inputBox.value == text)
        inputBox.value = '';
    }
    else
      inputBox.value = text;
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<!-- Input WaterMark JS End -->

<script>
    $(document).ready(function(){
        
          $(".statuschange").change(function(){

                
                var userid = $(this).attr('id');
                var suspend =  $(this).val();
                console.log(suspend);
                /*var c  = confirm("Are You Sure you need to change the status?");
                if(c==true)
                    {*/
                        $.get("<?php echo __BASE_URL?>/admin/suspendedStatus",
                        {
                          uid:userid,
                          status:suspend

                        },
                        function(data,status){




                        });
                     /*}
                 else
                 {
                     $(this).val()=suspend;
                 }*/
                     
                
          });
  
    });
</script>
<style>
    th{background-color: #ccc;}
</style>