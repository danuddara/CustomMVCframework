    <?php 
                  
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                         $PM=$permissionarray['moviessptv_iprofile'];
                         $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
                         $options = '';
                         foreach($levels as $set)
                         {
                             
                             
                           if($PM==$set)
                             {
                                 $options .= "<li name='moviessptv_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
                             }
                             else
                              $options .= "<li name='moviessptv_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
                        }
                         $adminpanel='
                 <a href="'.__BASE_URL.'iprofile/edit?field=moviessptv#entertainment" class="edit">'._('Edit').'</a>
                  <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
                          $adddelete ='<a href="#" class="delete">'._('Delete').'/a> <a id="movieadd" href="#entertainment" class="add">'._('Add').'</a>';
                    
                     }
?>
<form action="<?php echo __BASE_URL.'iprofile/updateorinsertEntertainmentinformation'?>" method="POST" >
<div class="info-panel editsection" id="entertainment">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Edit Entertainment');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'moviessptv_iprofile_edit_'.$field;
                        
                        $typedis = 'moviessptv_iprofile_category_'.$field;
                        $generedis = 'moviessptv_iprofile_genere_'.$field;
                        $namedis = 'moviessptv_iprofile_name_'.$field;
                        $descriptiondis = 'moviessptv_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                  <li><span class="label"><?php echo _('Title');?><a class="help"></a></span><span class="form-element">
                      <input name="name[]" type="text" value="<?php echo $$namedis?>"/>
                      </span></li>
                    <li><span class="label"><?php echo _('Category')?></span>
                        <span class="form-element">
                            <?php $categories = array(
                                                        _('Feature Film'),
                                                        _('TV Movie'),
                                                        _('TV Series'),
                                                        _('TV Episode'),
                                                        _('TV Special'),
                                                        _('Mini-Series'),
                                                        _('Documentary'),
                                                        _('Video Game'),
                                                        _('Short Film'),
                                                        _('Video'),
                                                        _('Stage Plays')
                                
                                                      ); ?>
                            
                            <select name="type[]">
                                <?php foreach($categories as $key=>$moviecats) {?>
                                <option <?php if($$typedis==$key)echo "selected='selected'"?> value="<?php echo $key?>"><?php echo $moviecats;?></option>
                                <?php }?>
                            </select>
                            
                            
                        </span>
                    </li>
                        <li><span class="label"><?php echo _('Genre');?></span>
                        <span class="form-element">
                            <select name="geners[]">
                            <?php if($geners!=null)
                            {
                                foreach($geners as $key=>$gener)
                                {?>
                            <option <?php if($gener[0]==$$generedis){echo "selected='selected'";}?> value="<?php echo $gener[0]?>"><?php echo $gener[1]?></option>
                                <?php    
                                }
                            }
                                ?>
                            </select>
                          
                        </span>
                    </li>               
                   <?php /* <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3" ><?php echo $$descriptiondis?></textarea>
                      </span></li>*/?>
                      
                      <li><input name="field[]" type="hidden" value="<?php echo $field?>"/></li>
                                     
                     
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
              <li><input name="Entertainmentinformation-submit" type="submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete?></h2>
            </div>
          </div>
        </div>
    </form>