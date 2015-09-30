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
                          $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="educationplaceadd" href="#education" class="add">'._('Add').'</a>';
                    
                     }
?> 
<form action="<?php echo __BASE_URL.'iprofile/updateorinserteducationinformation'?>" method="post">
<div class="info-panel editsection" id="education">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Edit Education');?></span>
                <?php  echo $adminpanel; ?>
            </h2>
              <div class="panelcontent">
              <ol class="multiple-records">
                   <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                       
                        $tsfield= 'educationinformation_iprofile_edit_'.$field;
                        
                        $typedis = 'educationinformation_iprofile_type_'.$field;
                        $name = 'educationinformation_iprofile_name_'.$field;
                        $graduatedon = 'educationinformation_iprofile_graduatedon_'.$field;
                        $description  = 'educationinformation_iprofile_description_'.$field;
                        $countrydis = 'educationinformation_iprofile_country_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                   <li><span class="label"><?php echo _('Type')?></span>
                        <span class="form-element">
                            <select name="type[]" id="type">
                            <?php $types=array('High School','University','College','Other');
                                    foreach($types as $key=>$type)
                                    {
                                    ?>
                            <option <?php
                                        if($$typedis==$type)
                                        {
                                            echo "selected='selected'";
                                        }
                                    
                                    ?>
                            ><?php echo $type?></option>
                               <?php }
                                    
                                    ?>
                            
                            </select>
                        </span>
                    </li>
                    <li><span class="label"><?php echo _('Name');?><a class="help"></a></span><span class="form-element">
                      <input name="name[]" type="text" value="<?php echo $$name?>" />
                      </span></li>
                    <li><span class="label"><?php echo _('Graduated On');?></span><span class="form-element">
                      
                   <select name="graduation-date[]" id="bday-date">
                     <?php 
                     if($$graduatedon==''){$$graduatedon='01-01-2000';}
                     
                     $bday=explode('-',$$graduatedon);
                     
                     for($i=1;$i<32;$i++){  ?>
                        
                          <option <?php if($i==$bday[2]){echo "selected='selected'";} echo '>'.$i; ?></option>
                    <?php } ?>
                  </select>
                         <select name="graduation-month[]" id="bday-month">
                      
                    <?php $bmonth =$bday[1];
                    
                    $months = array(_('January'),_('February'),_('March'),_('April'),_('May'),_('June'),_('July'),_('August'),_('September'),_('October'),_('November'),_('December'));
                     foreach($months as $key=>$month)
                             {
                                if(($bmonth-1)==$key)
                                {
                                    $key++;
                                    echo "<option value={$key} selected='selected'>{$month}</option>";
                                }
                                else
                                    {
                                        $key++;
                                        echo "<option value={$key}>{$month}</option>";
                                    }
                             }
                    ?>  
                    
                  </select>
                  <select name="graduation-year[]" id="bday-year">
                     <?php 
                  $year = new DateTime("now");
                 $y= $year->format('Y') - 13;
                 $old = $y - 90; // generate years for 90 years
                 
                     for($y;$y>$old;$y--)
                     {?>
                    <option <?php if($y==$bday[0]){echo "selected='selected'";}?>><?php echo $y ?></option>
                    <?php } ?>
                  </select>
                      
                      </span></li>
                    
                  <?php /*  <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3"><?php echo $$description?></textarea>
                      </span></li>*/?>
                      
                       <li><span class="label"><?php echo _('Country');?></span><span class="form-element">
                     
                      
                          <select id="countrySelect"  name="countrySelect[]">
                
                 <?php if($countries!=null) {
                   // print_r($countries);
                    foreach($countries as $country)
                        { 
                            $countrytemp = $country;
                    ?>     
                           <option <?php if($$countrydis==$countrytemp[0]){echo "selected='selected'";}?> value="<?php echo $countrytemp[0]; ?>"><?php echo $countrytemp[1]; ?></option>
                
                  <?php }
                
                }
                ?>
                </select>
                     </span></li>
                       <li><input type="hidden" name="field[]" value="<?php echo $field?>"/></li>
                    <?php /*    <li><span class="label">Check Box</span><span class="form-element">
                      <input name="check-box" type="checkbox" value="Like" class="styled" />
                      Select or Not </span></li>
                    <li><span class="label">Radio Button</span><span class="form-element">
                      <input name="radio" type="radio" value="" />
                      Yes </span></li>
                    <li><span class="label">Text Area</span><span class="form-element">
                      <textarea name="textarea" cols="30" rows="3" ></textarea>
                      </span></li>*/ ?>
                      
                      
                       
                       
                  </ul>
                </li>
             
                   <?php 
                        }
                    }
                }?>
               
              </ol>
                  <li><input type="submit" name="Educationinformation-submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete ?> </h2>
            </div>
          </div>
        </div>
    </form>