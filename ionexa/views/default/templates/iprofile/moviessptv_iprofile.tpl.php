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
                          $adddelete ='';
                    
                     }
?>
<div class="info-panel" id="entertainment">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Entertainment');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'moviessptv_iprofile_'.$field;
                        
                        $typedis = 'moviessptv_iprofile_category_'.$field;
                        $generedis = 'moviessptv_iprofile_genere_'.$field;
                        $namedis = 'moviessptv_iprofile_name_'.$field;
                        $descriptiondis = 'moviessptv_iprofile_description_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                  <li><span class="label"><?php echo _('Title');?><a class="help"></a></span><span class="form-element">
                      <input name="name" type="text" value="<?php echo $$namedis?>"  />
                      </span></li>
                    <li><span class="label"><?php echo _('Category');?></span>
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
                            <input name="type" type="text" value="<?php
                                     foreach($categories as $key=>$moviecats) 
                                        {
                                            if($$typedis==$key)echo trim($moviecats);
                                        }?>"
                                   
                                   />
                        </span>
                    </li>
                        <li><span class="label"><?php echo _('Genre');?></span>
                        <span class="form-element">
                            <input name="genre" type="text" value="<?php                         
                                if($geners!=null)
                            {
                                foreach($geners as $key=>$gener)
                                {
                                     if($gener[0]==$$generedis){echo trim($gener[1]);}
                                }
                            }?>"
                            
                             />
                        </span>
                    </li>               
                    <?php /*<li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description" cols="30" rows="3" ><?php echo $$descriptiondis?></textarea>
                      </span></li>*/?>
                      
                 
                                     
                     
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