<li>
                  <ul class="random-columns">
                    <li><span class="label">Categories</span>
                        <span class="form-element">
                            <select id="type" name="category[]">
                                
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
                                <option><?php echo $cat;?></option>
                                <?php 
                                }?>
                                                                
                            </select>
                        </span>
                    </li>
                     <li><span class="label"><?php echo _('Type');?><a class="help"></a></span><span class="form-element">
                      <select id="type" name="type[]">
                                                    <option><?php echo _('Music');?></option>
                          
                                                    <option><?php echo _('Band');?></option>
                          
                                                </select>
                      </span></li>
                    <li><span class="label"><?php echo _('Title')?><a class="help"></a></span><span class="form-element">
                      <input type="text" value="" name="title[]">
                      </span></li>
                    <li><span class="label"><?php echo _('Artist')?><a class="help"></a></span><span class="form-element">
                      <input type="text" value="" name="artist[]">
                      </span></li>
                  <?php  /*  <li><span class="label">Description</span><span class="form-element">
                      <textarea rows="3" cols="30" name="Description[]"></textarea>
                      </span></li>*/ ?>
                      
                      <li><input type="hidden" value="MusicandBandd_1" name="field[]"></li>
                                     
                     
                   </ul>
                </li>