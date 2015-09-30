<?php 
                  /* here doc */
                 $adminpanel= '';
                 $adddelete = '';
                     if($user=='admin')
                     {
                          $PM=$permissionarray['workinformation_iprofile'];
                         $levels = array('PUBLIC','FAMILY','FRIEND','OEO');
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
                         $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="workplaceadd" href="#work" class="add">'._('Add').'</a>';
                     }
?> 

<form action="<?php echo __BASE_URL.'iprofile/updateorinsertworkinformation'?>" method="POST">
<div class="info-panel editsection" id="work">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Edit Work');?></span>
                <?php  echo $adminpanel;?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                      //print_r($fields);
                    foreach($fields as $field=>$show)
                    {
                       
                        $tsfield= 'workinformation_iprofile_edit_'.$field;
                        
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
                      <input name="employer[]" type="text" value="<?php echo $$employerdis;?>" />
                      </span></li>
                      
                    <li><span class="label"><?php echo _('Designation');?><a class="help"></a></span><span class="form-element">
                      <input name="designation[]" type="text" value="<?php echo $$designationdis;?>" />
                      </span></li>
                    <li><span class="label"><?php echo _('From');?></span><span class="form-element">
                    
                            <select name="from-date[]" id="bday-date">
                                 <?php 
                                 if($$fromdatedis==''){$$fromdatedis='01-01-2000';}

                                 $bday=explode('-',$$fromdatedis);

                                 for($i=1;$i<32;$i++){  ?>

                                      <option <?php if($i==$bday[2]){echo "selected='selected'";} echo '>'.$i; ?></option>
                                <?php } ?>
                            </select>
                             <select name="from-month[]" id="bday-month">

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
                              <select name="from-year[]" id="bday-year">
                                     <?php 
                                  $year = new DateTime("now");
                                 $y= $year->format('Y');
                                 $old = $y - 90; // generate years for 90 years

                                     for($y;$y>$old;$y--)
                                     {?>
                                    <option <?php if($y==$bday[0]){echo "selected='selected'";}?>><?php echo $y ?></option>
                                    <?php } ?>
                              </select>
                      </span></li>
                      
                       <li><span class="label"><?php echo _('To');?></span><span class="form-element">
                     
                             <select name="to-date[]" id="bday-date">
                                 <?php 
                                 if($$todatedis==''){$$todatedis='01-01-2000';}

                                 $bday=explode('-',$$todatedis);

                                 for($i=1;$i<32;$i++){  ?>

                                      <option <?php if($i==$bday[2]){echo "selected='selected'";} echo '>'.$i; ?></option>
                                <?php } ?>
                            </select>
                             <select name="to-month[]" id="bday-month">

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
                              <select name="to-year[]" id="bday-year">
                                     <?php 
                                  $year = new DateTime("now");
                                 $y= $year->format('Y');
                                 $old = $y - 90; // generate years for 90 years

                                     for($y;$y>$old;$y--)
                                     {?>
                                    <option <?php if($y==$bday[0]){echo "selected='selected'";}?>><?php echo $y ?></option>
                                    <?php } ?>
                              </select>     
                               
                               
                      </span></li>
                       
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
                         
                         
                        <?php /* <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3" >php echo  $$Descriptiondis;</textarea>
                      </span></li> */ ?>
                      <li><input type="hidden" name="field[]"  value="<?php echo $field?>" /></li>
                  </ul>
                </li>
                  <?php 
                        }
                    }
                }?>
               
              </ol>
                  <li><input name="Workinformation-submit" type="submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete ?>  </h2>
            </div>
          </div>
        </div>
    </form>