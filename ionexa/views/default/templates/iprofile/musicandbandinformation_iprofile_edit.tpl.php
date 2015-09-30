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
                          $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="Musicbandadd" href="#music" class="add">'._('Add').'</a>';
                    
                     }
?>
<form action="<?php echo __BASE_URL.'iprofile/updateorinsertMusicAndBandinformation';?>" method="POST">
<div class="info-panel  editsection" id="music">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Edit Music');?></span>
            
                <?php  echo $adminpanel; ?>
            </h2>
            <div class="panelcontent">
              <ol class="multiple-records">
                  <?php if($fields!=null){
                      
                    foreach($fields as $field=>$show)
                    {
                        
                        $tsfield= 'musicandbandinformation_iprofile_edit_'.$field;
                        
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
                            <select name="category[]" id="type">
                                
                                <?php $categorys = array(
                                                        _('Alternate'),
                                                        _('Blues'),
                                                        _('Classical'),
                                                        _('Country'),
                                                        _('Dance'),
                                                        _('Folk'),
                                                        _('Funk'),
                                                        _('Hip Hop'),
                                                        _('Jazz'),
                                                        _('Pop'),
                                                        _('R&B'),
                                                        _('Soul'),
                                                        _('Rock'),
                                                        _('Other')
                                                    );
                                foreach($categorys as $cat)
                                {
                                ?>
                                <option <?php if($$categorydis==$cat){echo "selected='selected'";}?> ><?php echo $cat;?></option>
                                <?php 
                                }?>
                                
                            </select>
                        </span>
                    </li>
                     <li><span class="label"><?php echo _('Type');?><a class="help"></a></span><span class="form-element">
                      <select name="type[]" id="type">
                          <?php $type=array('Music','Band');
                          foreach($type as $typethis)
                          {
                          ?>
                          <option <?php if($$typedis==$typethis){echo "selected='selected'";}?> ><?php echo $typethis?></option>
                          
                          <?php
                          }
                          ?>
                      </select>
                      </span></li>
                    <li><span class="label"><?php echo _('Title');?><a class="help"></a></span><span class="form-element">
                      <input name="title[]" type="text" value="<?php echo $$titledis?>" />
                      </span></li>
                    <li><span class="label"><?php echo _('Artist');?><a class="help"></a></span><span class="form-element">
                      <input name="artist[]" type="text" value="<?php echo $$artistdis?>"/>
                      </span></li>
                  <?php  /*  <li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3" ><?php echo $$descriptiondis?></textarea>
                      </span></li>*/ ?>
                      
                      <li><input type="hidden" name="field[]" value="<?php echo $field?>"/></li>
                                     
                     
                   </ul>
                </li>
                   <?php 
                        }
                    }
                }?>
              </ol>
               <li><input name="MusicandBandInformation-submit" type="submit" value="<?php echo _('Save Change');?>"/></li> <!--added by Pasindu--> 
              <h2 class="section-footer"><?php echo $adddelete?></h2>
            </div>
          </div>
        </div>
    </form>