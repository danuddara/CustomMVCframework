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
                          $adddelete ='';
                    
                     }
?>
<div class="info-panel" id="destination">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Travel Destinations');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'destinationsinformation_iprofile_'.$field;
                        
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
               <?php /*       <li><span class="label">Type</span>
                        <span class="form-element">
                            <input type="text" value="<?php echo $$typedis?>"/>
                        </span>
                    </li> */?>
                   
                    
                    <li><span class="label"><?php echo _('Country');?><a class="help"></a></span><span class="form-element">
                      <input name="country" type="text"
                             
                             value="<?php if($countries!=null) {
                                   // print_r($countries);
                                    foreach($countries as $country)
                                        { 
                                            $countrytemp = $country;
                                   if($$countrydis==$countrytemp[0]){echo $countrytemp[1];} 

                                   }

                                }
                                ?>"
                             />
                      </span></li>
                      <li><span class="label"><?php echo _('City');?><a class="help"></a></span><span class="form-element">
                              <input name="city" type="text" value="<?php echo $$citydis?>"/>
                      </span></li>
                    <li><span class="label"><?php echo _('GeoTag');?><a class="help"></a></span><span class="form-element">
                      <input name="geotag" type="text" value="<?php echo $$geotagdis?>" />
                      </span></li>
              <?php /*        <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description" cols="30" rows="3" ><?php echo $$descriptiondis?></textarea>
                      </span></li> */?>
                      
                 
                                     
                     
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