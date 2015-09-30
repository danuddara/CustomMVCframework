
</head>
<body>

<div id="wrapper">
  <div id="container">
    <div id="header">
      <div class="branding left">
        <div id="logo-container"><img src="<?php echo $baseurl ?>/images/ionexa-logo.png" width="58" height="69" alt="Ionexa - Information Architecture for Next Generation" /></div>
        <h1>Ionexa</h1>
        <h5>
       <?php echo _('Information Architecture for Next Generation'); _('no_records_found')?>
        </h4>
      </div>
      <div class="header-right-section right">
        <div class="lang-selct-container right"><span class="label">Select Language</span><span class="language">English</span></div>
        <div class="signin-container right">
          <?php if(!isset($_SESSION['Userid'])){?>  
          <form id="Signin" action="<?php echo __BASE_URL.'signin/verify'?>" method="POST" >
           
          <input id="inputUserName" name="SigninUsername"   type="text" value="Enter User Name..." onfocus="watermark('inputUserName','Enter User Name...');" onblur="watermark('inputUserName','Enter User Name...');"  />
          <input id="inputpassword" name="SigninPassword"  type="password" value="Enter Password" onfocus="watermark('inputpassword','Enter Password');" onblur="watermark('inputpassword','Enter Password');"  />
          <!--<input id="inputPassword"   type="text" value="Enter Password" onfocus="watermark('inputPassword','Enter Password...');" onblur="watermark('inputPassword','Enter Password...');"  />--> 
         
          <a class="button"><input type="submit" name="Signin-submit" value="Sign In"/></a>
          </form>
             <?php }?>
        </div>
        
        <div class="forgot-pass right">
            
             <?php 
             /*
              *  $_SESSION['User'] is the session that we used to set the forms
              */
             if(!isset($_SESSION['Userid'])){?>  
            <span class="keep-me-logged">
          <input name="logged" type="checkbox" value="" class="styled" />
          Keep me Logged in</span><span class="forgot-pass"><a href="<?php echo __BASE_URL.'signin/passwordrecovery' ;?>"><?php echo _('Forgot Your Password');?></a></span>
          <?php  } 
          else { ?>
           <span class="forgot-pass"><a href="<?php echo __BASE_URL.'signin/logout' ;?>"><?php echo _('Log Out')?></a></span>
           <?php }?>
        </div>
          
          
      </div>
       
      <div id="nav" class="left">
        <ul>
          <li><a class="people" href="#"><span><?php echo _('People'); ?></span></a></li>
          <li><a  class="people" href="#"><span><?php echo _('Beautiful People'); ?></span></a></li>
          <li><a href="#" class="people"><span><?php echo _('Marriage Proposals') ?></span></a></li>
          <li><a href="#" class="people"><span><?php echo _('Friends Corner')?></span></a></li>
          <!--<li><a href="#" class="food"><span>Food</span></a></li>
          <li><a href="#" class="products"><span>Products</span></a></li>
          <li><a href="#" class="services"><span>Services</span></a></li>-->
        </ul>
      </div>
    </div>
          <div id="main-content">