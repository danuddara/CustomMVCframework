<?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                          $PM=$permissionarray['personalinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                             if($PM==$set)
                             {
                                 $options .= "<li name='personalinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='personalinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                        }
                         $adminpanel='
                 <a href="'.__BASE_URL.'iprofile/edit?field=personalinformation#personalinfo" class="edit">'._('Edit').'</a>
                   <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                          $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a href="#" class="add">'._('Add').'</a>';
                    
                     }
?>



<div class="info-panel" id="personalinfo">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Personal Information'); ?></span>
            <?php  echo $adminpanel; ?>
            
            </h2>
                
                <div class="panelcontent">
                    
              <ul class="random-columns">
              <?php if($fields!=null){?>    
                   
               <?php  if($personalinformation_iprofile_secondaryemail_1==true) {/* ?>    
               <li><span class="label">Secondary e-mail</span><span class="form-element">
                  <input name="secondary-email" type="text" value="<?php echo $personalinformation_iprofile_secondarayemail;?>" />
                  </span></li>
               <?php */}
              if($personalinformation_iprofile_address_1==true){
              /*?>
                <li><span class="label">Address</span><span class="form-element">
                  <input name="address" type="text" value="<?php echo $personalinformation_iprofile_address;?>"/>
                  </span></li>
                <?php */}
              if($personalinformation_iprofile_city_1==true){
             /* ?>   
                  
                <li><span class="label">City</span><span class="form-element">
                      <?php if($cities!=null && $personalinformation_iprofile_city!="" ) {
                   
                    foreach($cities  as $city)
                        { 
                            $citytemp = $city;
                    ?>     
                           <?php if($personalinformation_iprofile_city==$citytemp[0]){?><input name="city" type="text"   value="<?php echo $citytemp[1]; ?>"/><?php }?>           
                  <?php }
                
                }
                else
                {?><input name="city" type="text"   value=""/><?php }?>   
                 
                  </span></li>
                  
                 <?php */}
              if($personalinformation_iprofile_state_1==true){
              ?> 
                <li><span class="label"><?php echo _('State/City');?></span><span class="form-element">
                        
                         <?php if($states!=null && $personalinformation_iprofile_state!="") {
                   
                  
                    foreach($states  as $state)
                        { 
                            $statetemp = $state;
                    ?>     
                           <?php if($personalinformation_iprofile_state==$statetemp[0]){?><input name="state" type="text" value="<?php echo $statetemp[1]; ?>"/><?php }?>           
                  <?php }
                
                }
                else 
                  {?><input name="state" type="text" value=""/><?php }?>
                        
                  
                  </span></li>
                     
                 <?php }
              if($personalinformation_iprofile_zipcode_1==true){/*
              ?> 
                <li><span class="label">Zip Code</span><span class="form-element">
                  <input name="zip-code" type="text" value="<?php echo $personalinformation_iprofile_zipcode;?>"/>
                  </span></li>
                   <?php */}
              if($personalinformation_iprofile_homecountry_1==true){
              ?>     
               
                <li><span class="label"><?php echo _('Home Country');?></span><span class="form-element">
                        
               <?php if($countries!=null && $personalinformation_iprofile_homecountry!="") {
                   // print_r($countries);
                    foreach($countries as $country)
                        { 
                            $countrytemp = $country;
                    ?>     
                            <?php if($personalinformation_iprofile_homecountry==$countrytemp[0]){?> <input name="home-country" type="text" value="<?php echo $countrytemp[1]; ?> "/>  <?php } ?>             
                  <?php } 
                  
                  }
                  else
                  {?><input name="home-country" type="text" value=""/><?php }?>
                  
                   </span></li>
                     <?php }
              if($personalinformation_iprofile_bday_1==true){
              ?>
                <li><span class="label"><?php echo _('Birthday');?></span><span class="form-element">
                     <input name="bday-date" type="text" value="<?php echo $personalinformation_iprofile_bday;?>" />
                     
                
                  </span></li>
                  
                     <?php }
              if($personalinformation_iprofile_relationshipstatus_1==true){
              ?>   
                  <li>
                      <span class="label"><?php echo _('Relationship Status');?></span>
                      <span class="form-element">
                          
                             <?php $select =$personalinformation_iprofile_relationshipstatus;
                             
                             $relationships = array('Single','Married','Engaged','Widowed','Divorced','Separated','In-a-Relationship');
                             foreach($relationships as $key=>$name)
                             {
                                 
                                 if(($key)==($select)) /*== will be case sensetive*/
                                 {
                                     echo "<input name='relationshipstatus' type='text' value='{$name}'/>";
                                 }
                                 
                                     
                             }
                        ?>     
                        
                      </span>
                  </li>
                       <?php }
              if($personalinformation_iprofile_height_1==true){
              ?> 
                  <li><span class="label"><?php echo _('Height');?></span><span class="form-element">
                  <input name="height" type="text" value="<?php echo $personalinformation_iprofile_height; ?>"/>
                  </span></li>
                      <?php }
              if($personalinformation_iprofile_weight_1==true){
              ?> 
                  <li><span class="label"><?php echo _('Weight');?></span><span class="form-element">
                  <input name="weight" type="text" value="<?php echo $personalinformation_iprofile_weight; ?>" />
                  </span></li>
                 <?php 
                 
                    }                 
            }
                 ?> 
                  
               <?php /*<li><span class="label">Check Box</span><span class="form-element">
                  <input name="check-box" type="checkbox" value="Like" class="styled" />
                  Select or Not </span></li>
                <li><span class="label">Radio Button</span><span class="form-element">
                  <input name="radio" type="radio" value="" />
                  Yes </span></li>
                <li><span class="label">Text Area</span><span class="form-element">
                  <textarea name="textarea" cols="30" rows="3" ></textarea>
                  </span></li>*/?>
              </ul>
            </div>
          </div>
        </div>