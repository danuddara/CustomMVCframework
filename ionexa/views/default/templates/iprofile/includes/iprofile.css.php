<!-- iprofile page css-->  
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>css/bridge.css" />
<link href="<?php echo $baseurl ?>css/panels.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>css/custom.css" />
<style>
    .Privacyselect
    {
         border: 1px solid #B5B2FF;
         color: #666666;
         display: inline;
        font-size: 11px;
      
        line-height: 160%;
        margin-bottom: 2%;
        padding: 0.6% 0.2%;
        margin-left: 5px;
        
    }
    .family{
        
    }
    
    .display{
        color: #254EA2;
    display: block;
    margin-top: 5px;
    position: relative;
    }
    
    .delete:hover{ cursor: pointer}
    
    .loading{ 
        width: 100%;
        height:50px;
        background-image: url( '<?php echo $baseurl ?>images/loading.gif');
        background-repeat: no-repeat;
        background-position: center;
        display: none;
        
    }
    
  .editsection{ background-color: #E4E2FF} 
    /* .editsection .section-title:hover{ background-color: #E4E2;}*/
    
    
 /*drop down*/
.dropdown
{
color: #555;

width: 100px;
height: 17px;
text-align:left;
position: relative;
float:left;
}
.dropdown:hover
{
    cursor: pointer;
}

.dropdown a{ }

.submenu
{
background: #fff;
position: absolute;
top: -12px;
left: -20px;
z-index: 100;

display: none;
margin-left: 20px;
padding: 40px 0 0px;
border-radius: 6px;
box-shadow: 0 2px 8px rgba(0, 0, 0, 0.45);
}
.dropdown li a
{
color: #555555;
display: block;
font-family: arial;
font-weight: bold;
margin: 4px 0 2px;
cursor: pointer;
text-decoration:none;
width:60px;
}

.dropdown li a:hover
{
background:#155FB0;
color: #FFFFFF;
text-decoration: none;
}

.dropdown .active
{
  background:#155FB0;
color: #FFFFFF;
text-decoration: none;  
}/*
a.account 
{
 
font-size: 11px;
line-height: 16px;
color: #555;
position: absolute;
z-index: 110;
display: block;
padding: 11px 0 0 20px;
height: 28px;
width: 121px;
margin: -11px 0 0 -10px;
text-decoration: none;
background: url(icons/arrow.png) 116px 17px no-repeat;
cursor:pointer
 
}
 /*
a.security
{
    
font-size: 11px;
line-height: 16px;
color: #555;
position: absolute;
z-index: 110;
display: block;
padding: 11px 0 0 20px;
height: 28px;
width: 121px;
margin: -11px 0 0 -10px;
text-decoration: none;
background: url(icons/arrow.png) 116px 17px no-repeat;
cursor:pointer;
 
}
*/
a.securityhaeding{
         
    display: block;position: absolute;
    margin: 8px 15px 5px 8px;
    background-position: 0 -26px;
}
.root
{
list-style:none;
margin:0px;
padding:0px;
font-size: 11px;

border-top:1px solid #dedede;
}
 /*eof drop down*/
</style>

<!-- Latest compiled and minified CSS -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css"/>


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
