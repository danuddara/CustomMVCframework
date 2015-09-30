<!-- default CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>css/bridge.css" />
<style>
/*
Message Alert Styles
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
    
    background:#eee;
    /* styling of the dialog box, i have a fixed dimension for this demo */
    width:960px;
    
    /* make sure it has the highest z-index */
    position:absolute;
    z-index:5000;
    /* hide it by default */
    display:none;
    
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