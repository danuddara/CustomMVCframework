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
                         $adddelete ='';
                     }
?> 
<div class="info-panel" id="family">
          <div class="panelcollapsed">
            <h2 class="section-title">
                <span class="title"><?php echo _('Family')?></span>
                <?php  echo $adminpanel;?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                   <?php if($fields!=null){
                      
                       
                    foreach($fields as $field=>$show)
                    {
                        $tsfield= 'familyinformation_iprofile_'.$field;
                        
                         $firstnamedis = 'familyinformation_iprofile_firstname_'.$field;
                        $bdaydatedis = 'familyinformation_iprofile_bdaydate_'.$field;
                        $lasttnamedis = 'familyinformation_iprofile_lastname_'.$field;
                        $genderdis= 'familyinformation_iprofile_gender_'.$field;
                        $relatiohshipdis = 'familyinformation_iprofile_relationship_'.$field;
                        $isBPmemberdis='familyinformation_iprofile_isBPmember_'.$field;
                        $countrydis = 'familyinformation_iprofile_country_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('First Name');?></span><span class="form-element">
                       <label class="display"><?php echo $$firstnamedis?></label>
                      </span></li>
                     <li><span class="label"><?php echo _('Last Name');?></span><span class="form-element">
                       <label class="display"><?php echo $$lasttnamedis?></label> 
                      </span></li>  
                    <li><span class="label"><?php echo _('Birthday');?></span><span class="form-element">
                      
                             <label class="display"><?php $date = new DateTime($$bdaydatedis);echo $date->format("Y - M -d")?></label>
                            
                      </span></li>
                    <li><span class="label">Gender</span>
                        <span class="form-element">
                       
                                 <label class="display"><?php echo $$genderdis?></label>
                                
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
                                    
                                    echo "<label class='display'>{$name}</label>";
                                }
                             }
                          }
                          else{
                               echo "<label class='display'></label>";}
                             ?>
                        </span>
                    </li>
                   <?php /* <li><span class="label">BP Member<a class="help"></a></span><span class="form-element">
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