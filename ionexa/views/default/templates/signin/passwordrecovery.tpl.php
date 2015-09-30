<div style="width:70%; top:10px;margin: 0 auto;position: relative">
<h2><?php echo _('Forgot Password?');?></h2>
<p><?php echo sprintf(_("Don't worry we'll help you to get back into your account,%s simply enter the email and submit the form below.%s Follow the instructions given in your mail."),'<br/>');?></p>
<br/>
<form action="<?php echo __BASE_URL.'signin/sendrecoverymail'?>" method="POST">
    <input name="email" type="text" />
    <input name="Recovery-submit" type="submit" value="<?php echo _('Submit');?>"/>
</form>
</div>