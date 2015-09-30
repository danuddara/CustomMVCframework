<?php 
                  /* here doc */
                 $adminpanel= '';
                 $addphoto = '';
                 
                 
                     if($user=='admin')
                     {
                         $PM=$permissionarray['basicinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                             if($PM==$set)
                             {
                                 $options .= "<li name='basicinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='basicinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                         }
                          $adminpanel=
                         '<a href="'.__BASE_URL.'iprofile/edit?field=basicinformation#BasicInformation" class="edit">'._('Edit').'</a>
                          
                          <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                          </div>
                          ';
                          
                          $addphoto = '<a href="#" class="photo">Add Profile Photo</a>';
                          
                     }
?>
<div class="info-panel"  id="BasicInformation">


          <div class="width1-left profile-photo"><span class="section-title"> <?php echo $addphoto?></span><img src="<?php echo $baseurl?>images/profile-photo-avatar.jpg" alt="profile image avatar" /></div>
          <div class="width3-right form-panel"> 
              <span class="section-title"> 
                  <strong><?php echo _('Basic Information');?></strong>
                <?php echo $adminpanel;?>
              </span>
            <dl class="two-columns">
                 <?php if($fields!=null){?>
                    
                 
              <?php  if($basicinformation_iprofile_fname_1==true) { ?>
                  <dt><?php echo _('First Name');?></dt>
                  <dd>
                    <input name="first-name" type="text" value="<?php echo $basicinformation_iprofile_fname;?>"/>
                  </dd>
              <?php }
              if($basicinformation_iprofile_lname_1==true){
              ?>
              <dt><?php echo _('Last Name');?></dt>
              <dd>
                <input name="last-name" type="text" value="<?php echo $basicinformation_iprofile_lname;?>"/>
              </dd>
              <?php }
              if($basicinformation_iprofile_gender_1==true){
              ?>
              <dt><?php echo _('Gender'); ?></dt>
              <dd>
                <input name="gender" type="text" value="<?php echo $basicinformation_iprofile_gender; ?>" />
            
             
              
              </dd>
              <?php }
               if($basicinformation_iprofile_country_1==true){
              ?>
              <dt><?php echo _('Country you live'); ?></dt>
              <dd>
                
                <?php if($countries!=null) {
                   // print_r($countries);
                    foreach($countries as $country)
                        { 
                            $countrytemp = $country;
                    ?>     
                            <?php if($basicinformation_iprofile_country==$countrytemp[0]){?> <input name="country" type="text" value="<?php echo $countrytemp[1]; ?> "/>  <?php } ?>             
                  <?php } }?>
              </dd>
              <?php }
          
               if($basicinformation_iprofile_email_1==true){
              ?>
              <dt><?php echo _('e-mail'); ?></dt>
              <dd>
                <input name="email" type="text" value="<?php echo $basicinformation_iprofile_email; ?>" />
              </dd>
              <?php }?>
              <dt></dt>
             <!-- <dd class="two-columns">
                <input name="state" type="text" />
                <input name="city" type="text" />
                <label for="text"></label>
              </dd>-->
            </dl>
              
              <?php } /*} } }*/?>
          </div>
        </div>