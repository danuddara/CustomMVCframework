<li>
                  <ul class="random-columns">
                  <li><span class="label"><?php echo _('Title');?><a class="help"></a></span><span class="form-element">
                      <input type="text" value="" name="name[]">
                      </span></li>
                    <li><span class="label">Category</span>
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
                                <option value="<?php echo $key?>"><?php echo $moviecats;?></option>
                                <?php }?>
                            
                           =</select>
                            
                            
                        </span>
                    </li>
                        <li><span class="label">Genre</span>
                        <span class="form-element">
                            <select name="geners[]">
                                                            <option value="1"><?php echo _('Action');?></option>
                                                            <option value="2"><?php echo _('Adventure');?></option>
                                                            <option value="3"><?php echo _('Animation');?></option>
                                                            <option value="4"><?php echo _('Biography');?></option>
                                                            <option value="5"><?php echo _('Comedy');?></option>
                                                            <option value="6"><?php echo _('Crime');?></option>
                                                            <option value="7"><?php echo _('Documentary');?></option>
                                                            <option value="8"><?php echo _('Drama');?></option>
                                                            <option value="9"><?php echo _('Family');?></option>
                                                            <option value="10"><?php echo _('Fantasy');?></option>
                                                            <option value="11"><?php echo _('Film-Noir');?></option>
                                                            <option value="12"><?php echo _('Game-Show');?></option>
                                                            <option value="13"><?php echo _('History');?></option>
                                                            <option value="14"><?php echo _('Horror');?></option>
                                                            <option value="15"><?php echo _('Music');?></option>
                                                            <option value="16"><?php echo _('Musical');?></option>
                                                            <option value="17"><?php echo _('Mystery');?></option>
                                                            <option value="18"><?php echo _('News');?></option>
                                                            <option value="19"><?php echo _('Reality-TV');?></option>
                                                            <option value="20"><?php echo _('Romance');?></option>
                                                            <option value="21"><?php echo _('Sci-Fi');?></option>
                                                            <option value="22"><?php echo _('Sport');?></option>
                                                            <option value="23"><?php echo _('Talk-Show');?></option>
                                                            <option value="24"><?php echo _('Thriller');?></option>
                                                            <option value="25"><?php echo _('War');?></option>
                                                            <option value="26"><?php echo _('Western');?></option>
                                                            </select>
                          
                        </span>
                    </li>               
                    <?php /*<li><span class="label">Description</span><span class="form-element">
                      <textarea rows="3" cols="30" name="Description[]"></textarea>
                      </span></li>*/?>
                      
                      <li><input type="hidden" value="mobiesptvv_1" name="field[]"></li>
                                     
                     
                   </ul>
                </li>