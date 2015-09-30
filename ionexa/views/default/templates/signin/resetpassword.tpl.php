
<style>
    label{ float: left;width: 150px;}
    input{  float: left}
  
</style>
<div style="width:70%; top:10px;margin: 0 auto;position: relative">
<h2><?php echo _('Reset Password?');?></h2>

<form action="<?php echo __BASE_URL.'signin/resetnewpassword'?>" method="POST">
    <label><?php echo _('New Password');?></label><input name="newpassword" type="password" /><br/>
    <label><?php echo _('Confirm Password')?></label><input name="confirmpassword" type="password" /><br/>
    <input name="RessetPassword-submit" type="submit" value="<?php _('Submit');?>"/>
</form>
</div>