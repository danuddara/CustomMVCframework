<?php 
                  /* here doc */
                 $adminpanel= '';
                 $adddelete = '';
                     if($user=='admin')
                     {
                       $PM=$permissionarray['familyinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                            if($PM==$set)
                             {
                                 $options .= "<li name='familyinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='familyinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                         }
                         $adminpanel='
                  <a href="'.__BASE_URL.'iprofile/edit?field=familyinformation#family" class="edit">'._('Edit').'</a>
                  <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                         $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="familyadd" href="#family" class="add">'._('Add').'</a>';
                     }
?> 
<?php if($field=='familyy_1'){?>
<form id="familyform" method="POST" action="<?php echo __BASE_URL.'iprofile/updateorinsertfamilyinformation';?>">
    <?php }?>
<div class="info-panel editsection" id="family">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Edit Family');?></span>
                
                
                <?php echo $adminpanel; ?>
            </h2>
              <div class="panelcontent" >
              <ol class="multiple-records">
                  
                   <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        
                        $tsfield= 'familyinformation_iprofile_edit_'.$field;
                        
                        $firstnamedis = 'familyinformation_iprofile_firstname_'.$field;
                        $bdaydatedis = 'familyinformation_iprofile_bdaydate_'.$field;
                        $lasttnamedis = 'familyinformation_iprofile_lastname_'.$field;
                        $genderdis= 'familyinformation_iprofile_gender_'.$field;
                        $relatiohshipdis = 'familyinformation_iprofile_relationship_'.$field;
                        $isBPmemberdis='familyinformation_iprofile_isBPmember_'.$field;
                        $countrydis = 'familyinformation_iprofile_country_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li <?php if($field=='familyy_1'){?>class="submit"<?php }else {echo "class='family'";}?>>
                  <ul class="random-columns">
                    
              <li><span class="label"><?php echo _('First Name');?></span><span class="form-element">
                      <?php if($field!='familyy_1'){?>
                       <label class="display"><?php echo $$firstnamedis?></label>
                       <?php }
                       else{
                       ?>
                        <input name="first-name[]" type="text" value="<?php  echo $$firstnamedis?>"/>
                        <?php }?>
                      </span></li>
                     <li><span class="label"><?php echo _('Last Name');?></span><span class="form-element">
                             <?php if($field!='familyy_1'){?>
                       <label class="display"><?php echo $$lasttnamedis?></label> 
                       <?php }else{?>
                            <input name="last-name[]" type="text" value="<?php echo $$lasttnamedis?>"/>
                           <?php } ?>
                      </span></li>  
                    <li><span class="label"><?php echo _('Birthday');?></span><span class="form-element">
                       <?php if($field!='familyy_1'){?>
                             <label class="display"><?php $date = new DateTime($$bdaydatedis);echo $date->format("Y - M -d")?></label>
                            <?php }
                            else{?>
                                <select name="bday-date[]" id="bday-date">
                     <?php 
                     if($$bdaydatedis==''){$$bdaydatedis='01-01-2000';}
                     $bday=explode('-',$$bdaydatedis);
                     
                     for($i=1;$i<32;$i++){  ?>
                        
                          <option <?php if($i==$bday[2]){echo "selected='selected'";} echo '>'.$i; ?></option>
                    <?php } ?>
                  </select>
                  <select name="bday-month[]" id="bday-month">
                      
                    <?php $bmonth =$bday[1];
                    
                    $months = array('January','February','March','April','May','June','July','August','September','October','November','December');
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
                  <select name="bday-year[]" id="bday-year">
                     <?php 
                  $year = new DateTime("now");
                 $y= $year->format('Y') - 13;
                 $old = $y - 90; // generate years for 90 years
                 
                     for($y;$y>$old;$y--)
                     {?>
                    <option <?php if($y==$bday[0]){echo "selected='selected'";}?>><?php echo $y ?></option>
                    <?php } ?>
                  </select>
                            <?php }
                            ?>
                      </span></li>
                    <li><span class="label"><?php echo _('Gender');?></span>
                        <span class="form-element">
                       <?php if($field!='familyy_1'){?>
                                 <label class="display"><?php echo $$genderdis?></label>
                                <?php }else
                                {?>
                                    <select name="gender[]" id="gender">
                                 <option <?php if($$genderdis=='female') echo "selected='selected'";?>value ="0">female</option>
                                 <option <?php if($$genderdis=='male') echo "selected='selected'";?> value="1">male</option>
                            </select>
                                <?php }?>
                            
                        </span>
                    </li>
                     <li><span class="label"><?php echo _('Relationship');?></span>
                        <span class="form-element">
                            <?php if($field!='familyy_1'){?>   
                          <?php $relationship = array(
                                                            '100'=>_('Sister'),
                                                            '101'=>_('Brother'),
                                                            '102'=>_('Mother'),
                                                            '103'=>_('Father'),
                                                            /*'104'=>'Daughter',
                                                            '105'=>'Son',
                                                            '106'=>'Aunt',
                                                            '107'=>'Uncle',
                                                            '108'=>'Niece',
                                                            '109'=>'Nephew',
                                                            '110'=>'Cousin(Male)',
                                                            '111'=>'Cousin(female)',
                                                            '112'=>'Grandmother',
                                                            '113'=>'Grandfather',
                                                            '114'=>'Granddaughter',
                                                            '115'=>'Grandson',
                                                            '116'=>'Stepsister',
                                                            '117'=>'Stepbrother',
                                                            '118'=>'Stepmother',
                                                            '119'=>'Stepfather',
                                                            '120'=>'Stepdaughter',
                                                            '121'=>'Stepson',
                                                            '122'=>'Sister-in-law',
                                                            '123'=>'Brother-in-law',
                                                            '124'=>'Mother-in-law',
                                                            '125'=>'Father-in-law',
                                                            '126'=>'Daughter-in-law',
                                                            '127'=>'Son-in-law',*/
                                                            '128'=>_('Wife'),
                                                            '129'=>_('Husband')
                                                            );
                          if($$relatiohshipdis!='')
                          {
                            foreach($relationship as $key=>$name)
                             {
                                if(($$relatiohshipdis)==$key)
                                {
                                   
                                    echo "<label class='display'>{$name}</label>";
                                   
                                   
                                }
                             }
                          }
                          else{
                                   
                                      echo "<label class='display'></label>";
                                    
                                     
                              }
                             ?>
                            <?php } else { ?>
                                 <select name="relationship[]" id="relationship">
                                
                                <?php $relationship = array(
                                                            '100'=>'Sister',
                                                            '101'=>'Brother',
                                                            '102'=>'Mother',
                                                            '103'=>'Father',
                                                            '104'=>'Daughter',
                                                            '105'=>'Son',
                                                            '106'=>'Aunt',
                                                            '107'=>'Uncle',
                                                            '108'=>'Niece',
                                                            '109'=>'Nephew',
                                                            '110'=>'Cousin(Male)',
                                                            '111'=>'Cousin(female)',
                                                            '112'=>'Grandmother',
                                                            '113'=>'Grandfather',
                                                            '114'=>'Granddaughter',
                                                            '115'=>'Grandson',
                                                            '116'=>'Stepsister',
                                                            '117'=>'Stepbrother',
                                                            '118'=>'Stepmother',
                                                            '119'=>'Stepfather',
                                                            '120'=>'Stepdaughter',
                                                            '121'=>'Stepson',
                                                            '122'=>'Sister-in-law',
                                                            '123'=>'Brother-in-law',
                                                            '124'=>'Mother-in-law',
                                                            '125'=>'Father-in-law',
                                                            '126'=>'Daughter-in-law',
                                                            '127'=>'Son-in-law'
                                                            );
                            foreach($relationship as $key=>$name)
                             {
                                if(($$relatiohshipdis)==$key)
                                {
                                    
                                    echo "<option value={$key} selected='selected'>{$name}</option>";
                                }
                                else
                                    {
                                        
                                        echo "<option value={$key}>{$name}</option>";
                                    }
                             }
                                ?>
                               
                           
                            </select>
                                <?php } ?>
                        </span>
                    </li>
                    <?php /*<li><span class="label">BP Member<a class="help"></a></span><span class="form-element">
                      <input name="bp-member-<?php echo $field?>" type="checkbox" value="1" class="styled" <?php if($$isBPmemberdis==1)echo "checked='checked'";?> />
                      </span></li>
                    <li><span class="label">Country</span><span class="form-element">
                      
                       <?php if($countries!=null && $$countrydis!="") {
                   // print_r($countries);
                    foreach($countries as $country)
                        { 
                            $countrytemp = $country;
                    ?>     
                            <?php if( $$countrydis==$countrytemp[0]){?> <label class="display"><?php echo $countrytemp[1]; ?></label>  <?php } ?>             
                  <?php } 
                  
                  }
                  else
                  {?><label class="display"></label><?php }?>
                     </span></li>*/?>
                     <li><input type="hidden" name="field[]" value="<?php echo $field?>"/></li> 
                    
                  </ul>
                    <?php if($field!='familyy_1'){?>
                    <div class="section-title" style="color:#000;"><span class="delete familydelete " href="">x</span></div> 
                    <?php }?>
                </li>
             
                
                      
                 
                <?php 
                        }
                    }
                }?>
               
              
              </ol>
                <?php if($field=='familyy_1'){?>
                 <li><input name="Familyinformation-submit"type="submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
                  <?php }?>
              <h2 class="section-footer"><?php echo $adddelete ?>  </h2>
            </div>
          </div>
        </div>
    
    <?php /*</form>*/?>