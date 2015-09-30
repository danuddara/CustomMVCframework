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
                          $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="affiliationadd" href="#affiliation" class="add">'._('Add').'</a>';
                    
                     }
?>
<form action="<?php echo __BASE_URL.'iprofile/updateorinsertAffiliationinformation'?>" method="POST">
<div class="info-panel editsection" id="affiliation">
          <div class="panelcollapsed" >
            <h2 class="section-title"><span class="title"><?php echo _('Edit Affiliation')?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent" >
              <ol class="multiple-records ">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        $tsfield= 'affiliationinformation_iprofile_edit_'.$field;
                        
                        $typedis = 'affiliationinformation_iprofile_type_'.$field;
                        $name = 'affiliationinformation_iprofile_name_'.$field;
                        $descriptiondis= 'affiliationinformation_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Type')?></span>
                        <span class="form-element">
                           <select name="type[]" id="type">
                            <?php $types=array('Religious','Political','Clubs','Societies','Organizations');
                                    foreach($types as $key=>$type)
                                    {
                                    ?>
                            <option <?php
                                        if($$typedis==$type)
                                        {
                                            echo "selected='selected'";
                                        }
                                    
                                    ?>
                            ><?php echo $type?></option>
                               <?php }
                                    
                                    ?>
                            
                          
                               
                            </select>
                        </span>
                    </li>
                    <li><span class="label"><?php echo _('Name'); ?><a class="help"></a></span><span class="form-element">
                      <input name="name[]" type="text" value="<?php echo $$name?>" />
                      </span></li>
                    
                    <li><span class="label"><?php echo _('Description'); ?></span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3" ><?php echo $$descriptiondis; ?></textarea>
                      </span></li>
                      <li><input type="hidden" name="field[]" value="<?php echo $field?>"/></li> 
                 
                                     
                     
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
                 <li><input name="Affiliationinformation-submit" type="submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete?></h2>
            </div>
          </div>
        </div>
    </form>