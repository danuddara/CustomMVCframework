    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                          $PM=$permissionarray['musicandbandinformation_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                           
                           if($PM==$set)
                             {
                                 $options .= "<li name='musicandbandinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='musicandbandinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                        }
                         $adminpanel='
                 <a href="'.__BASE_URL.'iprofile/edit?field=musicandbandinformation#music" class="edit">'._('Edit').'</a>
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
<div class="info-panel" id="music">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Music');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'musicandbandinformation_iprofile_'.$field;
                        
                        
                        
                        $categorydis = 'musicandbandinformation_iprofile_category_'.$field;
                        $typedis = 'musicandbandinformation_iprofile_type_'.$field;
                        $titledis = 'musicandbandinformation_iprofile_title_'.$field;
                        $artistdis = 'musicandbandinformation_iprofile_artist_'.$field;
                        $descriptiondis = 'musicandbandinformation_iprofile_Description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Categories');?></span>
                        <span class="form-element">
                             
                            <input type="text" name="category" value="<?php echo $$categorydis?>"/>
                            
                           
                        </span>
                    </li>
                     <li><span class="label"><?php echo _('Type');?><a class="help"></a></span><span class="form-element">
                             <input type="text" name="type" value="<?php echo $$typedis?>"/>
                      
                      </span></li>
                    <li><span class="label"><?php echo _('Title');?><a class="help"></a></span><span class="form-element">
                      <input name="title" type="text" value="<?php echo $$titledis?>" />
                      </span></li>
                    <li><span class="label"><?php echo _('Artist');?><a class="help"></a></span><span class="form-element">
                      <input name="artist" type="text" value="<?php echo $$artistdis?>" />
                      </span></li>
                   <?php  /* <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description" cols="30" rows="3" ><?php echo $$descriptiondis?></textarea>
                      </span></li>*/ ?>
                      
                 
                                     
                     
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
              <h2 class="section-footer"><?php echo $adddelete?></h2>
            </div>
          </div>
        </div>