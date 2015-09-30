    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                          $PM=$permissionarray['destinationsinformation_iprofile'];
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
                  <a href="'.__BASE_URL.'iprofile/edit?field=destinationsinformation#destination" class="edit">'._('Edit').'</a>
                 <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                          $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="destinationadd" href="#destination" class="add">'._('Add').'</a>';
                    
                     }
?>
<form action="<?php echo __BASE_URL.'iprofile/updateorinsertDestinationsinformation'?>" method="POST">
<div class="info-panel editsection" id="destination">
          <div class="panelcollapsed" >
            <h2 class="section-title"><span class="title"><?php echo _('Edit Travel Destinations');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
             <div class="panelcontent" >
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'destinationsinformation_iprofile_edit_'.$field;
                        
                        $namedis = 'destinationsinformation_iprofile_name_'.$field;
                        $typedis = 'destinationsinformation_iprofile_type_'.$field;
                        $countrydis = 'destinationsinformation_iprofile_country_'.$field;
                        $citydis = 'destinationsinformation_iprofile_city_'.$field;
                        $geotagdis = 'destinationsinformation_iprofile_geotag_'.$field;
                        $descriptiondis='destinationsinformation_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Name');?><a class="help"></a></span><span class="form-element">
                      <input name="name[]" type="text" value="<?php echo $$namedis?>"/>
                      </span></li>
                 <?php /*   <li><span class="label">Type</span>
                        <span class="form-element">
                            <select name="type[]" id="type">
                                
                                <?php $types = array(
                                                'Romantic getaways',
                                                'Beaches',
                                                'Water Falls'
                                                );
                                
                                foreach($types as $type)
                                    {
                                ?>
                                
                                <option <?php if($$typedis==$type){echo "selected='selected'";}?>><?php echo $type;?></option>
                                
                                <?php 
                                    }
                                    ?>
                            </select>
                        </span> 
                    </li>*/?>
                   
                    
                    <li><span class="label"><?php echo _('Country');?><a class="help"></a></span><span class="form-element">
                      <select id="destinationcountry" name="country[]">
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
                    <li><span class="label"><?php echo _('City');?><a class="help"></a></span><span class="form-element">
                      <select id="destinationstates" name="city[]">
                          
                          <option value="1">colombo</option>
                          <option value="2">galle</option>
                          <option value="3">Kandy</option>
                      </select>
                      </span></li>  
                    <li><span class="label"><?php echo _('GeoTag');?><a class="help"></a></span><span class="form-element">
                      <input name="geotag[]" type="text" value="<?php echo $$geotagdis;?>" />
                      </span></li>
              <?php /*        <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3" ><?php echo $$descriptiondis;?></textarea>
                      </span></li> */?>
                      
                      <li><input name="field[]" type="hidden" value="<?php echo $field;?>"/></li>
                                     
                     
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
              <li><input name="Destinationinformation-submit" type="submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete?></h2>
            </div>
          </div>
        </div>
    </form>