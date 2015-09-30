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
<form name="basicinformation" action="<?php echo __BASE_URL.'iprofile/setBasicinformation'?>" method="POST">
<div class="info-panel editsection" id="BasicInformation">
          <div class="width1-left profile-photo"><span class="section-title"> <?php echo $addphoto?> </span><img src="<?php echo $baseurl?>images/profile-photo-avatar.jpg" alt="profile image avatar" /></div>
          <div class="width3-right form-panel"> <span class="section-title"> <strong><?php _('Edit Basic Information');?></strong> 
                 <?php echo $adminpanel;?>
                
              </span>
              <dl class="two-columns">
           <?php if($fields!=null){?>
                    
                 
              <?php  if($basicinformation_iprofile_edit_fname_1==true) { ?>
                  <dt><?php echo _('First Name');?></dt>
                  <dd>
                    <input name="first-name" type="text" value="<?php echo $basicinformation_iprofile_fname;?>"/>
                  </dd>
              <?php }
              if($basicinformation_iprofile_edit_lname_1==true){
              ?>
              <dt><?php echo _('Last Name');?></dt>
              <dd>
                <input name="last-name" type="text" value="<?php echo $basicinformation_iprofile_lname;?>"/>
              </dd>
              <?php }
              if($basicinformation_iprofile_edit_gender_1==true){
              ?>
              <dt><?php echo _('Gender'); ?></dt>
              <dd>
                
             <select name="gender">
                  <option <?php if($basicinformation_iprofile_gender=='female') echo "selected='selected'";?>value ="0">female</option>
                  <option <?php if($basicinformation_iprofile_gender=='male') echo "selected='selected'";?> value="1">male</option>
              </select>
              </dd>
              <?php }
               if($basicinformation_iprofile_edit_country_1==true){
              ?>
              <dt><?php echo _('Country you live');?></dt>
              <dd>
                
                
                <select id="countrySelect"  name="countrySelect">
                
                 <?php if($countries!=null) {
                   // print_r($countries);
                    foreach($countries as $country)
                        { 
                            $countrytemp = $country;
                    ?>     
                           <option <?php if($basicinformation_iprofile_country==$countrytemp[0]){echo "selected='selected'";}?> value="<?php echo $countrytemp[0]; ?>"><?php echo $countrytemp[1]; ?></option>
                
                  <?php }
                
                }
                ?>
                </select>
              </dd>
              <?php }?>
              <dt></dt>
             <!-- <dd class="two-columns">
                <input name="state" type="text" />
                <input name="city" type="text" />
                <label for="text"></label>
              </dd>-->
            </dl>
              <dl><input name="Basicinformation-submit"type="submit" value="<?php echo _('Save Change');?>"/></dl> <!--added by Pasindu-->
              <?php } /*} } }*/?>
            </dl>
          </div>
        </div>
    
    </form>
