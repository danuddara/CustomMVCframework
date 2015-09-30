    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                         $PM=$permissionarray['sportteaminformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             if($PM==$set)
                             {
                                 $options .= "<li name='sportteaminformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='sportteaminformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                        }
                         $adminpanel='
                 <a href="'.__BASE_URL.'iprofile/edit?field=sportteaminformation#sport" class="edit">'._('Edit').'</a>
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
<div class="info-panel" id="sport">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Sports');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'sportteaminformation_iprofile_'.$field;
                        
                        $typedis = 'sportteaminformation_iprofile_type_'.$field;
                        $namedis = 'sportteaminformation_iprofile_name_'.$field;
                        $descriptiondis = 'sportteaminformation_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Sport');?><a class="help"></a></span><span class="form-element">
                      <input name="name" type="text" value="<?php echo $$typedis;?>" />
                      </span></li>
                      
                  <li><span class="label"><?php echo _('Team');?><a class="help"></a></span><span class="form-element">
                      <input name="name" type="text" value="<?php echo $$namedis;?>" />
                      </span></li>
                               
             <?php /*       <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description" cols="30" rows="3" ><?php echo $$descriptiondis;?></textarea>
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