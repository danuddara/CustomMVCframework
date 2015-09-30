
<?php 
                        
                        
                        $tsfield= 'familyinformation_iprofile_field_'.$field;
                        
                        $firstnamedis = 'familyinformation_iprofile_firstname_'.$field;
                        $bdaydatedis = 'familyinformation_iprofile_bdaydate_'.$field;
                        $lasttnamedis = 'familyinformation_iprofile_lastname_'.$field;
                        $genderdis= 'familyinformation_iprofile_gender_'.$field;
                       
                        $relatiohshipdis = 'familyinformation_iprofile_relationship_'.$field;
                        $isBPmemberdis='familyinformation_iprofile_isBPmember_'.$field;
                        $countrydis = 'familyinformation_iprofile_country_'.$field;
                       
                      if($$tsfield==true){ ?>
<?php if($AJAX == true){?>
        <form id="AJAXfamilyform" method="POST" action="<?php echo __BASE_URL.'iprofile/AJAXfamilyupdate';?>">
             
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('First Name');?><a class="help"></a></span><span class="form-element">
                      <input name="first-name[]" type="text" value="<?php  echo $$firstnamedis?>"/>
                      </span></li>
                    <li><span class="label"><?php echo _('Last Name');?><a class="help"></a></span><span class="form-element">
                      <input name="last-name[]" type="text" value="<?php echo $$lasttnamedis?>"/>
                      </span></li> 
                    <li><span class="label"><?php echo _('Birthday');?></span><span class="form-element">
                      
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
                      </span></li>
                      
                    <li><span class="label"><?php echo _('Gender');?></span>
                        <span class="form-element">
                             <select name="gender[]" id="gender">
                                 <option <?php if($$genderdis=='female') echo "selected='selected'";?>value ="0">female</option>
                                 <option <?php if($$genderdis=='male') echo "selected='selected'";?> value="1">male</option>
                            </select>
                        </span>
                    </li>
                    <li><span class="label"><?php echo _('Relationship');?></span>
                        <span class="form-element">
                            <select name="relationship[]" id="relationship">
                                
                                <?php $relationship = array(
                                                            '100'=>'Sister',
                                                            '101'=>'Brother',
                                                            '102'=>'Mother',
                                                            '103'=>'Father',
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
                                                            '128'=>'Wife',
                                                            '129'=>'Husband'
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
                        </span>
                    </li>
                      <?php /*<li><span class="label">BP Member<a class="help"></a></span><span class="form-element">
                      <input name="bp-member-<?php echo $field?>" type="checkbox" value="1" class="styled" <?php if($$isBPmemberdis==1)echo "checked='checked'";?> />
                      </span></li>
                    <li><span class="label">Country</span><span class="form-element">
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
                     </span></li>*/?>
                     
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
                
                   <li>
                       <input id="submitAJAX" name="AJAXFamilyinformation-submit" type="button" value="Save Change" onclick=""/>
                       <input id="cancel" name="cancel" type="button" value="Cancel" onclick=""/>
                   </li> <!--added by Pasindu--> 
                     </form>          
                   
                  </ul>
                
 <?php } 
 else
     {?>
                          
        <ul class="random-columns">
                    <li><span class="label"><?php echo _('First Name');?></span><span class="form-element">
                            <label class="display"><?php echo $$firstnamedis?></label>
                      </span></li>
                     <li><span class="label"><?php echo _('Last Name');?></span><span class="form-element">
                      <label class="display"><?php echo $$lasttnamedis?></label> 
                    <li><span class="label"><?php echo _('Birthday');?></span><span class="form-element">
                      
                            <label class="display"><?php $date = new DateTime($$bdaydatedis);echo $date->format("Y - M -d")?></label> 
                            
                      </span></li>
                    <li><span class="label"><?php echo _('Gender');?></span>
                        <span class="form-element">
                       
                                <label class="display"><?php if($$genderdis==0)echo 'female'; else echo 'male';?></label> 
                                
                            </select>
                        </span>
                    </li>
                     <li><span class="label"><?php echo _('Relationship');?></span>
                        <span class="form-element">
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
                                    
                                    echo "<label class='display'>{$name}</label> ";
                                }
                             }
                          }
                          else{
                               echo "<label class='display'></label>";}
                             ?>
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
                    <div class="section-title" style="color:#000;"><span class="delete familydelete" href="">x</span></div> 
                    <?php }?>
                 
     <?php  }
 ?>
                  
                  
                <?php 
                        }
                  ?>
        