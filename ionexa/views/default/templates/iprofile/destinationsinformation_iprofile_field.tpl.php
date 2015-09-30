<li>
                  <ul class="random-columns">
                    <li><span class="label"><?php echo _('Name');?><a class="help"></a></span><span class="form-element">
                      <input type="text" value="" name="name[]">
                      </span></li>
                   <?php /* <li><span class="label">Type</span>
                        <span class="form-element">
                            <select id="type" name="type[]">
                                
                                                                
                                <option>Romantic getaways</option>
                                
                                                                
                                <option>Beaches</option>
                                
                                                                
                                <option>Water Falls</option>
                                
                                                            </select>
                        </span>
                    </li>*/?>
                   
                    
                    <li><span class="label"><?php echo _('Country')?><a class="help"></a></span><span class="form-element">
                      <select id="destinationcountry" name="country[]">
                           
                                           <option value="3">AUS</option>

                                       
                                           <option value="1">SL</option>

                                       
                                           <option value="2">USA</option>

                                                        </select>
                      </span></li>
                    <li><span class="label"><?php echo _('City')?><a class="help"></a></span><span class="form-element">
                      <select id="destinationstates" name="city[]">
                          <option value="1">colombo</option>
                          <option value="2">galle</option>
                          <option value="3">Kandy</option>
                      </select>
                      </span></li>  
                    <li><span class="label"><?php _('GeoTag')?><a class="help"></a></span><span class="form-element">
                      <input type="text" value="" name="geotag[]">
                      </span></li>
                 <?php /*   <li><span class="label">Description</span><span class="form-element">
                      <textarea rows="3" cols="30" name="Description[]"></textarea>
                      </span></li> */?>
                      
                      <li><input type="hidden" value="destinationn_1" name="field[]"></li>
                                     
                     
                   </ul>
                </li>