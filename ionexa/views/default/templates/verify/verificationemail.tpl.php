<?php
if($activated==true){
?>
<H1><?php echo _('Your account Has been Activated successfully!.');?></H1>
<p><?php echo _('Please Enter your Password for Our Account');?></p>
<style>
    label{ float: left;width: 150px;}
    input{  float: left}
  
</style>
<div style="width:70%; top:10px;margin: 0 auto;position: relative">
<h2><?php echo _('Reset Password?');?></h2>

<form action="<?php echo __BASE_URL.'signin/newpassword'?>" method="POST">
    <label><?php echo _('New Password');?></label><input name="newpassword" type="password" /><br/>
    <label><?php echo _('New Password');?></label><input name="confirmpassword" type="password" /><br/>
    <input name="Password-submit" type="submit" value="<?php _('Submit');?>"/>
</form>
</div>
<?php }
else if($activated==false){
  ?>
<H1><?php echo _('Sorry!! We could not activate your account!.')?></H1>

<?php  
}
?>

