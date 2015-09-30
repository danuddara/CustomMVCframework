<?php 
                  /* here doc */
                 $adminpanel= '';
                 $adddelete = '';
                     if($user=='admin')
                     {
                         $PM=$permissionarray['workinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                              if($PM==$set)
                             {
                                 $options .= "<li name='workinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='workinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                          }
                         $adminpanel='
                  <a href="'.__BASE_URL.'iprofile/edit?field=workinformation#work" class="edit">'._('Edit').'</a>
                  <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                         $adddelete ='';
                     }
?> 
<div class="info-panel" id="work">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Work');?></span>
                
                <?php  echo $adminpanel;?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    { 
                        $tsfield= 'workinformation_iprofile_'.$field;
                        
                        $employerdis = 'workinformation_iprofile_employer_'.$field;
                        $designationdis = 'workinformation_iprofile_designation_'.$field;
                        $fromdatedis = 'workinformation_iprofile_fromdate_'.$field;
                        $todatedis = 'workinformation_iprofile_todate_'.$field;
                        $countrydis = 'workinformation_iprofile_country_'.$field;
                        $Descriptiondis =  'workinformation_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Employer');?><a class="help"></a></span><span class="form-element">
                      <input name="employer" type="text" value="<?php echo $$employerdis;?>"/>
                      </span></li>
                      
                    <li><span class="label"><?php echo _('Designation');?><a class="help"></a></span><span class="form-element">
                      <input name="designation" type="text" value="<?php echo $$designationdis;?>" />
                      </span></li>
                    <li><span class="label"><?php echo _('From');?></span><span class="form-element">
                            <input type="text" name="from-date" value="<?php echo $$fromdatedis ;?>"/>
                      </span></li>
                      
                       <li><span class="label"><?php echo _('To');?></span><span class="form-element">
                               <input type="text" name="to-date" value="<?php echo $$todatedis  ;?>"/>
                      </span></li>
                       
                      <li><span class="label"><?php echo _('Country');?></span><span class="form-element">
                     
                       <?php if($countries!=null && $$countrydis!="") {
                   // print_r($countries);
                    foreach($countries as $country)
                        { 
                            $countrytemp = $country;
                    ?>     
                            <?php if( $$countrydis==$countrytemp[0]){?> <input name="country" type="text" value="<?php echo $countrytemp[1]; ?> "/>  <?php } ?>             
                  <?php } 
                  
                  }
                  else
                  {?><input name="country" type="text" value=""/><?php }?>
                     </span></li>
                         
                         
                        <?php /* <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description" cols="30" rows="3" ><?php echo $$Descriptiondis;?></textarea>
                      </span></li>*/ ?>
                  </ul>
                </li>
                  <?php 
                        }
                    }
                }?>
              </ol>
              <h2 class="section-footer"><?php echo $adddelete ?> </h2>
            </div>
          </div>
        </div>