  <?php 
                  /* here doc */
                 $adminpanel= '';
                 $adddelete = '';
                     if($user=='admin')
                     {
                         $adminpanel='
                 <a href="'.__BASE_URL.'iprofile/edit?field=testSection" class="edit">Edit</a>
                  <a href="#" class="security">Privacy</a> ';
                         $adddelete ='';
                     }
                     
                   
?>
<!--added by the system--> 
<div class="info-panel">
          <div class="panelcollapsed">
            <h2 class="section-title"><span class="title">TEST</span>
               
                <?php  echo $adminpanel;?>
            </h2>
              <div class="panelcontent">
              <ol class="multiple-records">
                <?php if($fields!=null){
                  
                    foreach($fields as $field=>$show)
                    {
                        $tsfield= 'testSection_'.$field;
                        
                        $firstnamedis = 'testSection_firstname_'.$field;
                        $bdaydatedis = 'testSection_bdaydate_'.$field;
                       
                      if($$tsfield==true){ ?>
                  <li>
                  <ul class="random-columns">
                
                    <li>
                  
                        <span class="label">Text field Label<a class="help"></a></span><span class="form-element">
                    
                        <input name="first-name" type="text" value="<?php  echo $$firstnamedis?>"/>
                           
                     
                      </span>
                  
                    </li>
                    <li>
                     
                        <span class="label">Birthday</span><span class="form-element">
                      <select name="bday-date" id="bday-date">
                        
                          <?php
                            for($i=1;$i<32;$i++){
                        ?>
                          <option <?php if($i==$$bdaydatedis){echo "selected='selected'";} echo '>'.$i; ?></option>
                        <?php } ?>
                      </select>
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
                      </span>
                    
                    </li>
                 
                  </ul>
                </li>
                <?php 
                        }
                    }
                }?>
                
              </ol>
              <h2 class="section-footer"><?php echo $adddelete ?> </h2>
            </div>
          </div>
        </div>


