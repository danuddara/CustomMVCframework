

        <div class="form-panel">
            <h6>Create New Event</h6>
            <form id="create_event" action="<?php print __BASE_URL ?>events/createevent" method="post">
                <dl class="two-columns">
                <dt>Event Type</dt>
                <dd><select name="event_type">
                        <option value="1">Gathering</option>
                        <option value="2">Baby/Bridal Shower</option>
                        <option value="3">Disaster Relief/Donation</option>
                        <option value="4">Event Proposal</option>
                        
                    </select></dd>
                <dt>Event Name</dt>
                <dd><input type="textbox" name="event_basic_name" id="event_basic_name"/></dd>
                <dt>Date</dt>
                <dd><input class="datepicker" type="textbox" name="event_start_Date" id="event_startdate"/></dd>
                <dt>End Date</dt>
                <dd><input class="datepicker" type="textbox" name="event_end_Date" id="event_endate"/></dd>
                <dt>Starting Time</dt>
                <dd><select name="starting_time_hours">
                        <?php 
                            for($i=0;$i<24;$i++)
                            {
                                ?>
                        
                         <option value="<?php if($i<10){print '0';}print $i;?>"><?php if($i<10){print '0';}print $i;?></option>
                        <?php         
                            }
                        ?>
                    
                    </select>
                    <select name="starting_time_mins">
                         <?php 
                            for($i=0;$i<60;$i++)
                            {
                                ?>
                        
                         <option value="<?php if($i<10){print '0';} print $i;?>"><?php if($i<10){print '0';} print $i;?></option>
                        <?php         
                            }
                        ?>
                        
                        
                    </select>
                   
                
                
                <dt>Ending Time</dt>
                <dd><select name="ending_time_hours">
                        <?php 
                            for($i=0;$i<24;$i++)
                            {
                                ?>
                        
                         <option value="<?php if($i<10){print '0';} print $i;?>"><?php if($i<10){print '0';} print $i;?></option>
                        <?php         
                            }
                        ?>
                    
                    </select>
                    <select name="ending_time_mins">
                         <?php 
                            for($i=0;$i<60;$i++)
                            {
                                ?>
                        
                         <option value="<?php if($i<10){print '0';} print $i;?>"><?php if($i<10){print '0';} print $i;?></option>
                        <?php         
                            }
                        ?>
                        
                        
                    </select>
                   </dd>
                 <dt>Special Notes</dt>
                <dd><span class="form-element"><textarea rows="3" cols="30" name="event_description"></textarea></span></dd>
                
                <dt>Address</dt>
                <dd><span class="form-element"><textarea rows="3" cols="30" name="address"></textarea></span></dd>
              
                <dt>Contact Person(s)</dt>
                <br/>
                <dd><span class="form-element"><label>Name:</label><input name="contact_p_name[]" type="textbox"/></span><span class="form-element"><label>Contact No:</label><input name="contact_p_number[]" type="textbox"/></span></dd>
                <dt></dt>
                <dd><span class="form-element"><label>Name:</label><input name="contact_p_name[]" type="textbox"/></span><span class="form-element"><label>Contact No:</label><input name="contact_p_number[]" type="textbox"/></span></dd>
                
                 <dt>Invite friends</dt>
                 <div class="invite-friends">
                    <?php print $invitees; ?>
                    
                </div>
               <dt>Confirm Attendance By</dt>
                <dd><input class="datepicker" type="textbox" name="event_confirm_attendance" id="event_name"/></dd>
                <dt>Dress Code</dt>
                <dd><select name="event_dress_code">
                        <option value="1">Black Tie</option>
                        <option value="2">Tuxedo</option>
                        <option value="3">Formal</option>
                        <option value="4">Casual</option>
                        <option value="4">Costume</option>
                        <option value="4">Other</option>
                        
                    </select></dd>
                 
                <dt>Event For</dt>
                <dd>
                    <select name="event_for">
                        <option value="1">All</option>
                        <option value="2">Adults only</option>
                        <option value="3">Children Only</option>
                   </select>
                </dd>
                   
                <dt>Parking Instructions</dt>
                <dd><span class="form-element"><textarea rows="3" cols="30" name="event_parking_info"></textarea></span></dd>
                
                <dt><b>Need Detail Planning?</b></dt>
                <dd><span class="form-element"><input type="checkbox" name="event_need_detail_plan" value="1"/></span></dd>
                
                <dt>Add Dietary restrictions ?</dt>
                <dd><span class="form-element"><input type="checkbox" name="event_add_dietary_restrictions" value="1"/></span></dd>
                
                <dt>Add Allergies ?</dt>
                <dd><span class="form-element"><input type="checkbox" name="event_add_allergies" value="1"/></span></dd>
                
                <dt>Add Spirits ?</dt>
                <dd><span class="form-element"><input type="checkbox" name="event_add_spirits" value="1"/></span></dd>
                
                
                  <dl>
                    <input type="submit" value="Create New Event" name="createEvent-submit"/>
                    </dl>
                   </form>
                <div id="detailed-plan">
                </div>  
                <div id="Continue-plan">
                    <div class="food">
                       <form id="addfood" action="<?php print __BASE_URL ?>events/addFood" method="POST"> 
                        
                        
                        
                       
                        
                           <div class="info-panel">
                              <div class="panelcollapsed">
                                <h2 class="section-title"><span class="title">Food</span></h2>
                                <div class="panelcontent">
                                            <div>
                                                <table class="event-calendar">
                                                    <h1>Food Items</h1>
                                                    <thead>
                                                        <tr>
                                                            <th colspan="4">Breakfast</th>
                                                        </tr>
                                                    </thead>
                                                        
                                                      
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td>Meal Type</td>
                                                            <td>Category</td>
                                                            <td>Qty needed</td>
                                                            <td>Request Contributors?</td>
                                                            <td>edit</td>
                                                         </tr>   
                                                        
                                                        <tr>
                                                            <td>Meat</td>
                                                            <td>chicken</td>
                                                            <td>10</td>
                                                            <td>yes</td>
                                                            <td><a href="#">edit</a></td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td>Meat</td>
                                                            <td>chicken</td>
                                                            <td>10</td>
                                                            <td>yes</td>
                                                            <td><a href="#">edit</a></td>
                                                            
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th colspan="3">Lunch</th>
                                                        </tr>
                                                         <tr>
                                                            <td>Meal Type</td>
                                                            <td>Category</td>
                                                            <td>Qty needed</td>
                                                            <td>Request Contributors?</td>
                                                            <td>edit</td>
                                                         </tr> 
                                                        <tr>
                                                            <td>Meat</td>
                                                            <td>chicken</td>
                                                            <td>10</td>
                                                            <td>yes</td>
                                                            <td><a href="#">edit</a></td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td>Meat</td>
                                                            <td>chicken</td>
                                                            <td>10</td>
                                                            <td>yes</td>
                                                            <td><a href="#">edit</a></td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>

                                            </div>    
                                    
                                    
                                    
                                    
                                            <dt>Meal Type</dt>
                                            <dd>
                                                <select name="food_mealtype">
                                                    <option value="1">Break Fast</option>
                                                    <option value="2">Snack/Refreshment/Tea Party</option>
                                                    <option value="3">Brunch</option>
                                                    <option value="4">Lunch</option>
                                                    <option value="4">Dinner</option>
                                               </select>
                                            </dd>
                                            <dt >Category</dt>
                                            <dd>
                                                <select name="food_category">
                                                    <?php print $food_categories;?>

                                               </select>
                                            </dd>
                                            <dt>List Items for category</dt>
                                            <dd>
                                                <select name="food_item">
                                                   <?php print $food_list_items;?>


                                               </select>
                                            </dd>
                                             <dt>Menu Name</dt>
                                            <dd><input type="textbox" name="food_menu_name" id="event_name"/></dd>
                                            <dt>Quantity</dt>
                                            <dd><input type="textbox" name="food_item_qty" id="event_name"/></dd>

                                             <dt>Request Contributors?</dt>
                                             <dd><span class="form-element"><input type="checkbox" name="food_request_contributors"/></span></dd>

                                               <dl>
                                            <input type="submit" value="Add-Food" name="Food-submit"/>
                                            </dl>
                                </div>
                              </div>
                            </div>
                        
                       </form>
                         
                    </div>
                    <div class="entertaiment">
                        <form id="addEntertainment" action="<?php print __BASE_URL ?>events/addEntertainment" method="POST"> 
                            
                           <div class="info-panel">
                              <div class="panelcollapsed">
                                <h2 class="section-title"><span class="title">Entertainment</span></h2>
                                <div class="panelcontent">
                                           
                                         <div>
                                                <table class="event-calendar">
                                                    <h3>Entertainment Items</h3>
                                                    <thead>
                                                        <tr>
                                                            <th colspan="6">Music</th>
                                                        </tr>
                                                    </thead>
                                                        
                                                      
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td>Category</td>
                                                            <td>List Item</td>
                                                            <td>Name</td>
                                                            <td>Quantity</td>
                                                            <td>Request Contributors?</td>
                                                            <td>edit</td>
                                                         </tr>   
                                                        
                                                        <tr>
                                                            <td>Live Band</td>
                                                            <td>classical</td>
                                                            <td>Sa</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td>Live Band</td>
                                                            <td>Rock</td>
                                                            <td>SaRock</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                            
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th colspan="6">Dance</th>
                                                        </tr>
                                                         <tr>
                                                            <td>Category</td>
                                                            <td>List Item</td>
                                                            <td>Name</td>
                                                            <td>Quantity</td>
                                                            <td>Request Contributors?</td>
                                                            <td>edit</td>
                                                         </tr> 
                                                         <tr>
                                                            <td>Live Band</td>
                                                            <td>classical</td>
                                                            <td>Sa</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td>Live Band</td>
                                                            <td>Rock</td>
                                                            <td>SaRock</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>

                                            </div> 
                                    
                                    
                                            <dt>Entertainment Type</dt>
                                            <dd>
                                                <select name="entertainment_cats">
                                                   <?php print $entertainment_categories;?>
                                               </select>
                                            </dd>
                                            <dt>Entertainment Items for category</dt>
                                            <dd>
                                                <select name="entertainment_items">
                                                    <?php print $entertainment_list_items;?>


                                               </select>
                                            </dd>
                                            
                                             <dt>Name</dt>
                                            <dd><input type="textbox" name="event_entertainment_name" id="event_name"/></dd>
                                            <dt>Quantity</dt>
                                            <dd><input type="textbox" name="event_entertainment_qty" id="event_name"/></dd>

                                             <dt>Request Contributors?</dt>
                                             <dd><span class="form-element"><input name="entertainment_request_contributors" type="checkbox"/></span></dd>

                                             <dl>
                                            <input type="submit" value="Add-Entertainment" name="Entertainment-submit"/>
                                            </dl>
                                </div>
                              </div>
                          </div>
                        
                        </form>
                         
                    </div>
                    <div class="volunteer">
                         <form id="addvolunteer" action="<?php print __BASE_URL ?>events/addVolunteer" method="POST">
                           <div class="info-panel">
                              <div class="panelcollapsed">
                                <h2 class="section-title"><span class="title">Volunteers</span></h2>
                                <div class="panelcontent">
                                    
                                            <div>
                                                <table class="event-calendar">
                                                    <h3>Work List</h3>
                                                    <thead>
                                                        <tr>
                                                            <th colspan="5">Cleaning</th>
                                                        </tr>
                                                    </thead>
                                                        
                                                      
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td>Description</td>
                                                            <td>Tools needed</td>
                                                            <td>Quantity</td>
                                                            <td>Request Contributors?</td>
                                                            <td>edit</td>
                                                         </tr>   
                                                        
                                                        <tr>
                                                            <td>Hellow eorwa asd asdsa the asworkd</td>
                                                            <td>wheels</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td>Hellow eorwa asd asdsa the asworkd</td>
                                                            <td>wheels</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                            
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th colspan="5">cooking</th>
                                                        </tr>
                                                          <tr>
                                                            <td>Description</td>
                                                            <td>Tools needed</td>
                                                            <td>Quantity</td>
                                                            <td>Request Contributors?</td>
                                                            <td>edit</td>
                                                         </tr>   
                                                        
                                                        <tr>
                                                            <td>Hellow eorwa asd asdsa the asworkd</td>
                                                            <td>wheels</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td>Hellow eorwa asd asdsa the asworkd</td>
                                                            <td>wheels</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>

                                            </div> 
                                    
                                            <dt>Work Type</dt>
                                            <dd>
                                                <select name="volunteer_cats">
                                                   <?php print $volunteer_categories; ?>
                                               </select>
                                            </dd>
                                            <dt>Description</dt>
                                            <dd>
                                                <span class="form-element"><textarea rows="3" cols="30" name="volunteer_Description"></textarea></span>
                                            </dd>
                                            <dt>Tools Needed</dt>
                                            <dd>
                                                <span class="form-element"><textarea rows="3" cols="30" name="volunteer_tools_needed"></textarea></span>
                                            </dd>


                                            <dt>Quantity</dt>
                                            <dd><input type="textbox" name="volunteer_qty" id="event_name"/></dd>

                                             <dt>Request Contributors?</dt>
                                             <dd><span class="form-element"><input name="volunteer_request_contributors" type="checkbox"/></span></dd>

                                             <dl>
                                            <input type="submit" value="Add-Work" name="volunteer-submit"/>
                                            </dl>
                                </div>
                              </div>
                            </div>
                        
                         </form>
                         
                    </div>
                    
                     <div class="Equipment">
                         <form id="addEquipment" action="<?php print __BASE_URL ?>events/addEquipment" method="POST">
                            <div class="info-panel">
                              <div class="panelcollapsed">
                                <h2 class="section-title"><span class="title">Equipment</span></h2>
                                <div class="panelcontent">
                                        
                                    
                                        <div>
                                                <table class="event-calendar">
                                                    <h3>Equipment List</h3>
                                                    <thead>
                                                        <tr>
                                                            <th colspan="4">Music accessories</th>
                                                        </tr>
                                                    </thead>
                                                        
                                                      
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td>Description</td>
                                                            <td>Quantity</td>
                                                            <td>Request Contributors?</td>
                                                            <td>edit</td>
                                                         </tr>   
                                                        
                                                        <tr>
                                                            <td>Hellow eorwa asd asdsa the asworkd</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td>Hellow eorwa asd asdsa the asworkd</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                            
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th colspan="5">Video games</th>
                                                        </tr>
                                                         <tr>
                                                            <td>Description</td>
                                                            <td>Quantity</td>
                                                            <td>Request Contributors?</td>
                                                            <td>edit</td>
                                                         </tr>   
                                                        
                                                        <tr>
                                                            <td>Hellow eorwa asd asdsa the asworkd</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td>Hellow eorwa asd asdsa the asworkd</td>
                                                            <td>1</td>
                                                            <td>Yes</td>
                                                            <td><a href="#">edit</a></td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div> 
                                    
                                        <dt>Equipment Type</dt>
                                        <dd>
                                            <select name="equipment_id">
                                                <?php print $equipment_categories;?>

                                           </select>
                                        </dd>
                                        <dt>Description</dt>
                                        <dd>
                                            <span class="form-element"><textarea rows="3" cols="30" name="equipment_description"></textarea></span>
                                        </dd>


                                        <dt>Quantity</dt>
                                        <dd><input type="textbox" name="equipment_qty" id="event_name"/></dd>

                                         <dt>Request Contributors?</dt>
                                         <dd><span class="form-element"><input name="equipment_request_contributors" type="checkbox"/></span></dd>

                                         <dl>
                                        <input type="submit" value="Add-Equipment" name="Equipment-submit"/>
                                        </dl>
                                </div>
                              </div>
                            </div>
                         
                         </form>
                         
                    </div>
                   
                    
                </div> 
                
                
                
           
                
                </dl>
               
         
            
                               
                 
            
            
        </div>
    
   

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
