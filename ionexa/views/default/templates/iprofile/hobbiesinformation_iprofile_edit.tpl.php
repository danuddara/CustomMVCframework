    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                         $PM=$permissionarray['hobbiesinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                           if($PM==$set)
                             {
                                 $options .= "<li name='hobbiesinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='hobbiesinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                        }
                         $adminpanel='
                  <a href="'.__BASE_URL.'iprofile/edit?field=hobbiesinformation#hobbies" class="edit">'._('Edit').'</a>
                   <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                          $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="hobbieadd" href="#hobbies" class="add">'._('Add').'</a>';
                    
                     }
?>
<form  action="<?php echo __BASE_URL.'iprofile/updateorinserthobbieinformation'?>" method="POST">
<div class="info-panel editsection" id="hobbies">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Edit Hobbies and Interests');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                    
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'hobbiesinformation_iprofile_edit_'.$field;
                        
                        $namedis = 'hobbiesinformation_iprofile_name_'.$field;
                        $typedis = 'hobbiesinformation_iprofile_type_'.$field;
                        $descriptiondis='hobbiesinformation_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                        <li><span class="label"><?php echo _('Name');?><a class="help"></a></span><span class="form-element">
                      <input name="name[]" type="text" value="<?php echo $$namedis;?>" />
                      </span></li>
                    <li><span class="label"><?php echo _('Category');?></span>
                        <span class="form-element">
                            <input name="type[]" type="text" value="<?php echo $$typedis;?>" />
                        </span>
                    </li>
                                     
                    <?php /*<li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3" ><?php echo $$descriptiondis;?></textarea>
                      </span></li>*/?>
                      
                      <li><input type="hidden" name="field[]" value="<?php echo $field?>"/></li>
                                     
                     
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
              <li><input type="submit" name="Hobbiesinformation-submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete?></h2>
            </div>
          </div>
        </div>
    </form>