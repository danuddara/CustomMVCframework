<li>
<ul class="random-columns">
                    <li><span class="label">Type</span>
                        <span class="form-element">
                            <select name="type[]" id="type">
                               <option><?php echo _('Religious');?></option>
                                <option><?php echo _('Political');?></option>
                                <option><?php echo _('Clubs');?></option>
                                <option><?php echo _('Societies');?></option>
                                <option><?php echo _('Organizations');?></option>
                            </select>
                        </span>
                    </li>
                    <li><span class="label"><?php echo _('Name'); ?><a class="help"></a></span><span class="form-element">
                      <input name="name[]" type="text" value="">
                      </span></li>
                    
                    <li><span class="label"><?php echo _('Description'); ?></span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3"></textarea>
                      </span></li>
                      <li><input type="hidden" name="field[]" value="affiliationn_1"></li> 
                 
                                     
                     
                   </ul>
</li>