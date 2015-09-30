    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                          $PM=$permissionarray['personinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                            if($PM==$set)
                             {
                                 $options .= "<li name='personinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='personinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                           }
                         $adminpanel='
                 <a href="'.__BASE_URL.'iprofile/edit?field=personinformation#peopleinfo" class="edit">'._('Edit').'</a>
                 <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                          $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="personadd" href="#peopleinfo" class="add">'._('Add').'</a>';
                    
                     }
?>
<form action="<?php echo __BASE_URL.'iprofile/updateorinsertPersoninformation'?>" method="POST">
<div class="info-panel editsection" id="peopleinfo">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Edit People');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'personinformation_iprofile_edit_'.$field;
                        
                        $typedis = 'personinformation_iprofile_type_'.$field;
                        $namedis = 'personinformation_iprofile_name_'.$field;
                        $descriptiondis = 'personinformation_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Type');?></span>
                        <span class="form-element">
                            <select name="type[]" id="type">
                                
                                <?php $type = array(_('Actor'),_('Singer'),_('Cook'),_('Comedian'),_('TV Personality'),_('Radio Personality'),_('Most Inspiring'),_('Sportsman'),_('Athlete'),_('Businessman'));
                                
                                foreach($type as $typeperson){
                                ?>
                                
                                <option <?php if($$typedis==$typeperson){echo "selected='selected'";}?>><?php echo $typeperson?></option>
                                
                                <?php }?>
                            </select>
                        </span>
                    </li>
                    <li><span class="label"><?php echo _('Name');?><a class="help"></a></span><span class="form-element">
                      <input name="name[]" type="text" value="<?php echo $$namedis?>" />
                      </span></li>
                    
                <?php /*      <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3" ><?php echo $$descriptiondis?></textarea>
                      </span></li> */?>
                      
                      <li><input type="hidden" name="field[]" value="<?php echo $field?>"</li>
                                     
                     
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
                <li><input name="Personinformation-submit" type="submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete?></h2>
            </div>
          </div>
        </div>
</form>