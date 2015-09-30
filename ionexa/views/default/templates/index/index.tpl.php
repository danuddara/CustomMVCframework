
<form name="Signup"action="<?php echo __BASE_URL.'signup/verify'?>" method="POST">

      <div id="home-banner-text" class="left"><img src="<?php echo $baseurl?>images/home-banner-text.png" width="380" height="166" alt="Inteligent Information changing the way you live" /></div>
      <div id="signup-form" class="right">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h2><?php echo _('Sign up.')?></h2>
              <h5><?php echo _('It is free.')?></h5></td>
          </tr>
          <tr>
            <td><input id="firstName" name="firstName"  type="text" value="<?php echo _('First Name'); ?>" onfocus="watermark('firstName',<?php echo _('First Name'); ?>);" onblur="watermark('firstName','First Name');"  /></td>
          </tr>
          <tr>
            <td><input id="lastName" name="lastName"  type="text" value="<?php echo _('Last Name'); ?>" onfocus="watermark('lastName',<?php echo _('Last Name'); ?>);" onblur="watermark('lastName','Last Name');"  /></td>
          </tr>
          <tr>
            <td><input id="email" name="email"  type="text" value="<?php echo _('E-Mail'); ?>" onfocus="watermark('email','<?php echo _('E-Mail'); ?>');" onblur="watermark('email','E-Mail');"  /></td>
          </tr>
          <tr>
            <td><input id="email2" name="email2" autocomplete="off"  type="text" value="<?php echo _('Re-enter E-Mail'); ?>" onfocus="watermark('email2',<?php echo _('Re-enter E-Mail'); ?>);" onblur="watermark('email2','Re-enter E-Mail');"  /></td>
          </tr>
          <tr>
           <?php /*<td><input id="password" name="password"   type="text" value="New Password" onfocus="watermark('password','New Password');" onblur="watermark('password','New Password');"  /></td> */?>
          </tr>
          <tr>
            <td><select id="countrySelect"  name="countrySelect">
                <option selected="selected"><?php echo _('Re-enter E-Mail'); ?></option>
                
                <?php if($countries!=null) {
                   // print_r($countries);
                    foreach($countries as $country)
                        { 
                            $countrytemp = $country;
                    ?>     
                           <option value="<?php echo $countrytemp[0]; ?>"><?php echo $countrytemp[1]; ?></option>
                
                  <?php }
                
                }
                ?>
              </select></td>
          </tr>
          <tr>
            <td>
             <span class="gender female">
              <input id="female" name="female"  type="checkbox" value="0" class="styled" onclick="unCheck(this, 'male');" />
              <?php echo _('Female') ;?></span>
             <span class="gender male">
              <input id="male" name="male"  type="checkbox" value="1" class="styled" onclick="unCheck(this, 'female');" />
              <?php echo _('Male') ;?></span></td>
          </tr>
          <tr>
            <td><span class="birth-day-select">Birthday
              <select name="birthMonth" id="birthMonth">
                  
                    <?php 
                    
                    $months = array(
                                       /* $translator->_('Jan'),
                                        $translator->_('Feb'),
                                        $translator->_('Mar'),
                                        $translator->_('Apr'),
                                        $translator->_('May'),
                                        $translator->_('Jun'),
                                        $translator->_('Jul'),
                                        $translator->_('Aug'),
                                        $translator->_('Sep'),
                                        $translator->_('Oct'),
                                        $translator->_('Nov'),
                                        $translator->_('Dec')*/
                            
                                        _('january'),
                                        _('february'),
                                        _('march'),
                                        _('april'),
                                        _('may'),
                                        _('june'),
                                        ('july'),
                                        _('august'),
                                        _('september'),
                                        _('october'),
                                        _('november'),
                                        _('december')
                                    );
                     foreach($months as $key=>$month)
                             {
                               
                                        $key++;
                                        echo "<option value={$key}>{$month}</option>";
                                    
                             }
                    ?>  
              </select>
              <select name="birthDay" id="birthDay">
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
              </select>
              <select name="birthYear" id="birthYear">
                 <?php 
                 $year = new DateTime("now");
                 $y= $year->format('Y') - 13;
                 $old = $y - 90; // generate years for 90 years
                 
                 for($y;$y>$old;$y--)
                 {?>
                <option><?php echo $y ?></option>
                <?php } ?>
              </select>
              </span></td>
          </tr>
         
          <tr>
              <td>
                  <script type="text/javascript">
                     var RecaptchaOptions = {
                        theme : 'white',
                        tabindex : 1

                     };
                    </script>
                    
             <?php 
             $publickey= "6LdiJOMSAAAAAIOD6S3M0c9Y8t_S3jolOWqcJ__-"; /*private key is in signinController.php*/
             
               echo recaptcha_get_html($publickey);

             ?>
                  
              </td>
          </tr>
          <tr>
            <td><span class="terms">I have read and accepted IONEXA <a href="#">terms and conditions </a></span></td>
          </tr>
          <tr>
              <td><a class="button"><input name="Signup-submit" type="submit" value="SIGN UP"/></a></td>
          </tr>
        </table>
      </div>
 
</form>