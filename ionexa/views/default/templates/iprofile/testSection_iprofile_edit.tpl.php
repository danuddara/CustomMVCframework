   <?php 
                  /* here doc */
                 $adminpanel= '';
                 
                     if($user=='admin')
                     {
                          $adminpanel='
                  <a href="'.__BASE_URL.'iprofile/edit?field=testSection" class="edit">Edit</a>
                  <a href="#" class="security">Privacy</a> ';
                          $adddelete ='<a href="#" class="delete">'._('Delete').'</a> <a id="workplaceadd" href="#work" class="add">'._('Add').'</a>';
                   
                     }
?>
<!--added by the system--> 
<form name="testsectionform" action="" method="post">
<div class="info-panel">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title">Edit Test</span>
             
                
                <?php echo $adminpanel; ?>
            </h2>
              <div class="panelcontent">
              <ol class="multiple-records">
                   <?php if($fields!=null){
               
                    foreach($fields as $field=>$show)
                    {
                        $tsfield= 'testSection_iprofile_edit_'.$field;
                        
                        $firstnamedis = 'testSection_firstname_'.$field;
                        $bdaydatedis = 'testSection_bdaydate_'.$field;
                       
                      if($$tsfield==true){ ?>
                <li>
                  <ul class="random-columns">
                    <li><span class="label">Text field Label<a class="help"></a></span><span class="form-element">
                      <input name="first-name" type="text" value="<?php  echo $$firstnamedis?>"/>
                      </span></li>
                    <li><span class="label">Birthday</span><span class="form-element">
                      <select name="bday-date" id="bday-date">
                        <?php
                            for($i=1;$i<32;$i++){
                        ?>
                          <option <?php if($i==$$bdaydatedis){echo "selected='selected'";} echo '>'.$i; ?></option>
                        <?php } ?>
                      </select>
                      <select name="bday-month" id="bday-month">
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                      </select>
                      <select name="bday-year" id="bday-year">
                        <option>1970</option>
                        <option>1971</option>
                        <option>1972</option>
                        <option>1973</option>
                        <option>1974</option>
                        <option>1975</option>
                        <option>1976</option>
                        <option>1977</option>
                        <option>1978</option>
                        <option>1979</option>
                        <option>1980</option>
                        <option>1981</option>
                        <option>1982</option>
                        <option>1983</option>
                        <option>1984</option>
                        <option>1985</option>
                        <option>1986</option>
                        <option>1987</option>
                        <option>1988</option>
                        <option>1989</option>
                        <option>1990</option>
                      </select>
                      </span></li>
                    <li><span class="label">Check Box</span><span class="form-element">
                      <input name="check-box" type="checkbox" value="Like" class="styled" />
                      Select or Not </span></li>
                    <li><span class="label">Radio Button</span><span class="form-element">
                      <input name="radio" type="radio" value="" />
                      Yes </span></li>
                    <li><span class="label">Text Area</span><span class="form-element">
                      <textarea name="textarea" cols="30" rows="3" ></textarea>
                      </span></li>
                  </ul>
                </li>
                
                      
                  </ul>
                </li>
                <?php 
                        }
                    }
                }?>
               
              </ol>
                  <li><input type="submit" value="<?php echo_('Save Change');?>"/></li> <!--added by Pasindu-->
              <h2 class="section-footer"><?php echo $adddelete ?></h2>
            </div>
          </div>
        </div>
</form>

