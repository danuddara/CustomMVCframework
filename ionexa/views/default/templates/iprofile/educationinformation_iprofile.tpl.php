    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                         $PM=$permissionarray['educationinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                             if($PM==$set)
                             {
                                 $options .= "<li name='destinationsinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='destinationsinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                          
                         }
                         $adminpanel='
                  <a href="'.__BASE_URL.'iprofile/edit?field=educationinformation#education" class="edit">'._('Edit').'</a>
                  <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                          $addelete ='';
                    
                     }
?>
<div class="info-panel" id="education" >
          <div class="panelcollapsed" >
            <h2 class="section-title"><span class="title"><?php echo _('Education');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'educationinformation_iprofile_'.$field;
                        
                        $type = 'educationinformation_iprofile_type_'.$field;
                        $name = 'educationinformation_iprofile_name_'.$field;
                        $graduatedon = 'educationinformation_iprofile_graduatedon_'.$field;
                        $description  = 'educationinformation_iprofile_description_'.$field;
                        $countrydis = 'educationinformation_iprofile_country_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Type');?></span>
                        <span class="form-element">
                            <input name="type" type="text" value="<?php echo $$type  ?>"/>
                            
                        </span>
                    </li>
                    <li><span class="label"><?php echo _('Name');?><a class="help"></a></span><span class="form-element">
                      <input name="name" type="text" value="<?php echo $$name?>" />
                      </span></li>
                    <li><span class="label"><?php echo _('Graduated On');?></span><span class="form-element">
                      <input type="text" name="bday-date" id="bday-date" value ="<?php echo $$graduatedon;?>"/>
                        
                      </span></li>
                    
                   <?php /*  <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description" cols="30" rows="3" ><?php echo $$description;  ?></textarea>
                      </span></li>*/?>
                      
                 
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
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
              <h2 class="section-footer"></h2>
            </div>
          </div>
        </div>