    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                        $PM=$permissionarray['bookinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                              if($PM==$set)
                             {
                                 $options .= "<li name='bookinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='bookinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                         }
                         $adminpanel='
                 <a href="'.__BASE_URL.'iprofile/edit?field=bookinformation#book" class="edit">'._('Edit').'</a>
                 <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                          $adddelete ='<a href="#" class="delete">Delete</a> <a id="bookadd" href="#book" class="add">Add</a>';
                    
                     }
?>
<form action="<?php echo __BASE_URL.'iprofile/updateorinsertBookinformation'?>" method="POST">
<div class="info-panel editsection" id="book">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title">Edit Books</span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                     
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'bookinformation_iprofile_edit_'.$field;
                        
                       
                        $typedis = 'bookinformation_iprofile_type_'.$field;
                        $namedis = 'bookinformation_iprofile_author_'.$field;
                        $titledis='bookinformation_iprofile_title_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                        <li><span class="label"><?php echo _('Type');?></span>
                        <span class="form-element">
                            
                            <select name="type[]">
                                <?php $types = array(
                                                 'Academic and Professional',
                                                  'Arts, Photography and Design',
                                                  'Award Winning',
                                                  'Biographies & Autobiographies',
                                                  'Business, Investing and Management',
                                                  'Comics & Graphic Novels',
                                                  'Cooking, Food & Wine'
                                                );
                                
                                foreach($types as $bookcat){
                                ?>
                                <option <?php if($$typedis==$bookcat){echo "selected='selected'";}?>><?php echo $bookcat;?></option>
                                
                                <?php }?>
                            </select>
                            
                        </span>
                    </li>
                <li><span class="label"><?php echo _('Author') ?><a class="help"></a></span>
                        <span class="form-element">
                      <input name="author[]" type="text" value="<?php echo $$namedis;?>" />
                      </span></li>
                    
                    <li><span class="label"><?php echo _('Title')?></span><span class="form-element">
                      <input type="text" name="title[]" value="<?php echo $$titledis;?>"/>
                      </span></li>
                      
                 <li><input type="hidden" name="field[]" value="<?php echo $field?>"/></li>
                                     
                     
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
              <li><input name="Bookinformation-submit" type="submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete?></h2>
            </div>
          </div>
        </div>
    </form>