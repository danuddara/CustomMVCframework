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

<script type="text/javascript">
    $(document).ready(function(){
        
     
        
        
        $("#StateSelect").change(function(){
      
      var stateid;
      stateid  = $('#StateSelect').val();
      
      
    $.get("<?php echo __BASE_URL?>/iprofile/getcities",
    {
      stateidd:stateid
     
    },
    function(data,status){
      
      
      
        $('#cities').html(data);
    });
    
        
  });
  
  $("#destinationcountry").change(function(){
      
      var countryid;
      countryid  = $('#destinationcountry').val();
      
      
    $.get("<?php echo __BASE_URL?>/iprofile/getstates",
    {
      countryidd:countryid
     
    },
    function(data,status){
      
      
      
        $('#destinationstates').html(data);
    });
    
   }); 
  
});
</script>

<script type="text/javascript">
    
 function submitAJAX()
    {
      var thissecc = $('.submit');
      var thissecc = $(this);
                   console.log(thissecc);
       
       
        console.log( $("#AJAXfamilyform").serialize());
        $.post("<?php echo __BASE_URL.'iprofile/AJAXfamilyupdate';?>", $("#AJAXfamilyform").serialize(),
        function(data)
               {
                    thissecc.fadeOut();
                    thissecc.empty();
                    thissecc.append(data);
                    thissecc.fadeIn();
                    
                    thissecc.removeClass().addClass('family');
                    
                    
                  //$('.multiple-records').eq(0).append(data);//just applied
                  
               }

    );
    }
    
    
    
    $(document).ready(function(){
        
        
        $('#submitAJAX').live('click',function()
        {
            var thissecc = $(this).parent().parent().parent();
                   console.log(thissecc);


                    console.log( $(this).parent().parent().serialize());
                    $.post("<?php echo __BASE_URL.'iprofile/AJAXfamilyupdate';?>", $(this).parent().parent().serialize(),
                    function(data)
                           {
                                thissecc.fadeOut();
                                thissecc.empty();
                                thissecc.append(data);
                                thissecc.fadeIn();
                                
                                thissecc.removeClass('submit').addClass('family');
                                
                                
                              //$('.multiple-records').eq(0).append(data);//just applied

                           }

                );
        });
        
        $('#cancel').live('click',function()
        {
             var thissecc = $(this).parent().parent().parent();
             thissecc.fadeOut();
             thissecc.empty();
             thissecc.remove();
        });
        
        $('#familyadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=family",
               function(data)
               {
                  
                  
                  
                 $('.multiple-records').eq(0).append(data);//just applied
                 $('#AJAXfamilyform').wrap('<li class="submit" />');
                  
               }
            );
        });
        
       $('.familydelete').live('click',function(e){
           
           //$(".family").undelegate();
       
        
       
        var section = $(this).parent().parent();
        console.log(section);
        section.undelegate();
        
        var fid = $(this).parent().parent().find('input[type=hidden]').val();
           
           console.log(fid);
           $.get("<?php echo __BASE_URL?>/iprofile/AJAXdeleteFamilymember",
           {
               
               familyid : fid
               
           },
               function(data)
               {
                    
                    if(data==1)
                        {
                            
                            section.fadeOut();
                            section.remove();
                            section.removeClass('family');
                        }
                  //$('.multiple-records').eq(0).append(data);//just applied
                  
               }
            );
                
                return false;
            
       });
        
        $('.family').live('click',function()
        {  
            $(this).css('display','block');
           
            
           console.log($(this));
           var thissec = $(this);
            
            
           var fid = $(this).find('input[type=hidden]').val();
           console.log(fid);
           thissec.fadeOut();
            thissec.empty();
            thissec.addClass('loading');
            $('.loading').fadeIn();
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield",
           {
               sectionid : 'family',
               familyid : fid
               
           },
               function(data)
               {
                    
                    
                   
                    
                    
                    thissec.removeClass('loading');
                    thissec.append(data);
                    thissec.fadeIn(150);
                    
                     thissec.removeClass('family').addClass('submit');
                     $('.submit').unbind('click'); 
                     
                  //$('.multiple-records').eq(0).append(data);//just applied
                  
               }
            );
                
            
        });
        
        
        
          $('#educationplaceadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=edu",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(1).append(data);//just applied
                  
               }
            );
        });
        
           $('#workplaceadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=work",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(2).append(data);//just applied
                  
               }
            );
        });
        
           $('#affiliationadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=affiliation",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(3).append(data);//just applied
                  
               }
            );
        });
        
             $('#hobbieadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=hobbieadd",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(4).append(data);//just applied
                  
               }
            );
        });
        
        
               $('#bookadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=book",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(5).append(data);//just applied
                  
               }
            );
        });
       
       
                 $('#movieadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=entertain",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(6).append(data);//just applied
                  
               }
            );
        });
        
          $('#Musicbandadd').click(function()
        {
           
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=musicbandadd",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(7).append(data);//just applied
                  
               }
            );
        });
        
        
           $('#destinationadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=destination",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(8).append(data);//just applied
                  
               }
            );
        });
        
          $('#foodadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=food",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(9).append(data);//just applied
                  
               }
            );
        });
        
        
            $('#sportadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=sport",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(10).append(data);//just applied
                  
               }
            );
        });
        
              $('#personadd').click(function()
        {
            
           $.get("<?php echo __BASE_URL?>/iprofile/returnformfield?sectionid=person",
               function(data)
               {
                   var id= $(this).parent().parent().html();
                  
                  console.log(id);
                  $('.multiple-records').eq(11).append(data);//just applied
                  
               }
            );
        });
        
        
    });
    
</script>

<script>
 $(document).ready(function(){
     
     
     
      $(".Privacyselect").change(function(){
          
        var section  = $(this).attr('name');
        var acess = $(this).val();
         
         $.get("<?php echo __BASE_URL?>/iprofile/updateprivacysection",
            {
              Resource:section,
              Access:acess

            },
            function(data,status){



              
            });
         
         
         
      });
     
     
     
 });
</script>


<script type="text/javascript" >
$(document).ready(function()
{

$(".account").click(function(e)
{
   
    $(this).css('z-index', '110');
    var X=$(this).attr('id');
    if(X==1)
    {
    $(this).parent().find(".submenu").hide();
    $(this).attr('id', '0');
    $(this).css('z-index','0');
    
    }
    else
    {
    $(this).parent().find(".submenu").show();
    $(this).attr('id', '1');
    }
 e.stopImmediatePropagation();
});





//Mouse click on my account link
$(".account").mouseup(function()
{
return false
});

$(".submenu li").mouseup(function(e)
{
    var thiss = $(this);
    console.log($(this).attr('id'));
     var section  = thiss.attr('name');
        var acess = thiss.attr('id');
         
         $.get("<?php echo __BASE_URL?>/iprofile/updateprivacysection",
            {
              Resource:section,
              Access:acess

            },
            function(data,status){

                thiss.parent().find('li').find('a').removeClass('active'); 
                
                
                
                thiss .find('a').addClass('active ');
                   
              
            });
 e.stopImmediatePropagation();
});

//Document Click
$(document).mouseup(function()
{
$(".submenu").hide();
$(".account").attr('id', '');
$(".account").css('z-index','0');
});
});
</script>


<script>
/*the Alertbox*/
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