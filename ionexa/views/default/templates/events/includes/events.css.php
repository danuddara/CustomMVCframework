<!-- iprofile page css-->  
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>css/bridge.css" />
<link href="<?php echo $baseurl ?>css/panels.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>css/custom.css" />
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<style>
    #create_event
    {
        width: 480px;
        clear: both;
    }
    #create_event input
    {
       
    }
    #create_event label
    {
        float: left;
        width: 100px;
    }
    
.two-columns dt {
    width: 25%;
}

.event-calendar
{
    width: 100%;
    margin: 0 auto;
    clear: both;
    margin-bottom: 10px;
    
}
.event-calendar h1,h2,h3
{
      font-size: 1em;
    margin: 28px 0 5px;
    text-align: center;
    width: 100%;
}
.event-calendar, .event-calendar tr,.event-calendar td,.event-calendar th
{
    border: 1px solid #444444;
    text-align: center;
    font-size: 12px;
    
}
span.form-element
{
    margin: 10px 0;
}

.invite-friends
{
    width: 260px;
    clear: both;
    height: 170px;
    overflow: auto;
    margin: 10px 0;
}
</style>


<style>
/*
Message Alert Styles this was in the iprofile. use central file to access this.
*/

#dialog-overlay {
    /* set it to fill the whil screen */
    width:100%;
    height:100%;
    
    /* transparency for different browsers */
    filter:alpha(opacity=50);
    -moz-opacity:0.5;
    -khtml-opacity: 0.5;
    opacity: 0.5;
    background:#000;
    /* make sure it appear behind the dialog box but above everything else */
    position:absolute;
    top:0; left:0;
    z-index:3000;
    /* hide it by default */
    display:none;
}
#dialog-box {
    
    /* css3 drop shadow */
    -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    -moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    
    /* css3 border radius */
    -moz-border-radius: 5px;
-webkit-border-radius: 5px;
    
   /* background:#eee;
    /* styling of the dialog box, i have a fixed dimension for this demo 
    width:960px;
    
    /* make sure it has the highest z-index 
    position:absolute;
    z-index:5000;
    /* hide it by default 
    display:none;*/
   
    background: none repeat scroll 0 0 #EEEEEE;
    display: none;
    left: 50%;
    margin-left: -480px;
    margin-top: -100px;
    position: absolute;
    top: 50%;
    width: 960px;
    z-index: 5000;
    
}
#dialog-box .dialog-content {
    /* style the content */
    background: none repeat scroll 0 0 #fff;
    color: #666666;
    font-family: arial;
    font-size: 11px;
    margin: 20px auto;
    padding: 10px;
    position: relative;
    text-align: left;
    width: 90%;
    margin-top: 10px;
}
a.button {
    /* styles for button */
    margin:10px auto 0 auto;
    text-align:center;
    display: block;
    width:50px;
    padding: 5px 10px 6px;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    line-height: 1;
    
    /* button color */
    background-color: #e33100;
    
    /* css3 implementation :) */
    /* rounded corner */
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    
    /* drop shadow */
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
    
    /* text shaow */
    text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
    border-bottom: 1px solid rgba(0,0,0,0.25);
    position: relative;
    cursor: pointer;
    
}
a.button:hover {
    background-color: #c33100;    
}
/* extra styling */
#dialog-box .dialog-content p {
    font-weight:700; margin:0;
}
#dialog-box .dialog-content ul {
    margin:10px 0 10px 20px;
    padding:0;
    height:50px;
}




</style>
