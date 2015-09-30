    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                         $PM=$permissionarray['affiliationinformation_iprofile'];
                         $levels = array('PUBLIC','FAMILY','FRIEND','OEO');
                         $options = '';
                         foreach($levels as $set)
                         {
                             if($PM==$set)
                             {
                                 $options .= "<li name='affiliationinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='affiliationinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                         }
                         $adminpanel='
                  <a href="'.__BASE_URL.'iprofile/edit?field=affiliationinformation#affiliation" class="edit">'._('Edit').'</a>
                  <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>

                  ';
                          $adddelete ='';
                    
                     }
?>
<div class="info-panel" id="affiliation">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Affiliation'); ?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'affiliationinformation_iprofile_'.$field;
                        
                        $typedis = 'affiliationinformation_iprofile_type_'.$field;
                        $name = 'affiliationinformation_iprofile_name_'.$field;
                        $descriptiondis= 'affiliationinformation_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Type');?></span>
                        <span class="form-element">
                            <input type="text" name="type" value="<?php echo $$typedis?>"/>
                         
                        </span>
                    </li>
                    <li><span class="label"><?php echo _('Name');?><a class="help"></a></span><span class="form-element">
                      <input name="name" type="text" value="<?php echo $$name?>" />
                      </span></li>
                    
                    <li><span class="label"><?php echo _('Description');?></span><span class="form-element">
                      <textarea name="Description" cols="30" rows="3" ><?php echo $$descriptiondis?></textarea>
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