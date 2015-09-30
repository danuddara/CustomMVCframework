<?php
$adminpanel = '';

if ($user == 'admin') {
    $PM = $permissionarray['personalinformation_iprofile'];
    $levels = array(_('PUBLIC'),_('FAMILY'),_('FRIEND'),_('OEO'));
    $options = '';
    foreach ($levels as $set) {

         if($PM==$set)
         {
             $options .= "<li name='personalinformation_iprofile'  id='{$set}'><a class='active security'>{$set}</a></li>";
         }
         else
          $options .= "<li name='personalinformation_iprofile' id='{$set}'><a class='security'>{$set}</a></li>";
}
    $adminpanel = '
                  <a href="' . __BASE_URL . 'iprofile/edit?field=personalinformation#personalinfo" class="edit">'._('Edit').'</a>
                  <div class="dropdown">
                          <a class="securityhaeding account">'._('Privacy').'</a> 
                            <div class="submenu">
                                <ul class="root">
                                    '.$options.'
                                </ul>
                            </div>
                  </div>';
    $adddelete = '<a href="#" class="delete">'._('Delete').'</a> <a href="#personalinfo" class="add">'._('Add').'</a>';
}
?>


<form id="personalinformation" action="<?php echo __BASE_URL . 'iprofile/updatePersonalInformation'; ?>" method="POST">
    <div class="info-panel editsection" id="personalinfo">
        <div class="panelcollapsed">
            <h2 class="section-title"><span class="title"><?php echo _('Edit Personal Information');?></span>
<?php echo $adminpanel; ?>

            </h2>

            <div class="panelcontent">

                <ul class="random-columns">
<?php if ($fields != null) { ?>    

    <?php if ($personalinformation_iprofile_edit_secondaryemail_1 == true) { ?>    
                         <?php /*    <li><span class="label">Secondary e-mail</span><span class="form-element">
                                    <input name="secondary-email" type="text" value="<?php echo $personalinformation_iprofile_secondarayemail; ?>" />
                                </span></li>*/?>
                        <?php
                        }
                        if ($personalinformation_iprofile_edit_address_1 == true) {
                            ?>
                           <?php /* <li><span class="label">Address</span><span class="form-element">
                                    <input name="address" type="text" value="<?php echo $personalinformation_iprofile_address; ?>"/>
                                </span></li> */?>
                        <?php
                        }
                        if ($personalinformation_iprofile_edit_city_1 == true) {
                            ?>   

                <?php /*               <li><span class="label">City</span><span class="form-element">


                                    <select id="cities" name="city">
                                        
     
        if ($cities != null) {

            foreach ($cities as $city) {
                $citytemp = $city;
                ?>     
                                                <option <?php if ($personalinformation_iprofile_city === $citytemp[0]) {
                                    echo "selected='selected'";
                                } ?> value="<?php echo $citytemp[0]; ?>"><?php echo $citytemp[1]; ?></option>

                                            <?php
                                            }
                                        }
                                      
                                    </select>
                                </span></li> */ ?>

                        <?php
                        }
                        if ($personalinformation_iprofile_edit_state_1 == true) {
                            ?> 
                            <li><span class="label"><?php echo _('State/City');?></span><span class="form-element">

                                    <select id="StateSelect"  name="state">

                                        <?php
                                        if ($states != null) {

                                            foreach ($states as $state) {
                                                $statetemp = $state;
                                                ?>     
                                                <option <?php if ($personalinformation_iprofile_state == $statetemp[0]) {
                                    echo "selected='selected'";
                                } ?> value="<?php echo $statetemp[0]; ?>"><?php echo $statetemp[1]; ?></option>

                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>      

                                </span></li>

                        <?php
                        }
                        if ($personalinformation_iprofile_edit_zipcode_1 == true) {
                            ?> 
                            <?php /*<li><span class="label">Zip Code</span><span class="form-element">
                                    <input name="zip-code" type="text" value="<?php echo $personalinformation_iprofile_zipcode; ?>"/>
                                </span></li>*/?>
    <?php
    }
    if ($personalinformation_iprofile_edit_homecountry_1 == true) {
        ?>     

                            <li><span class="label"><?php echo _('Home Country');?></span><span class="form-element">

                                    <select id="countrySelect"  name="countrySelect">

                                        <?php
                                        if ($countries != null) {
                                            // print_r($countries);
                                            foreach ($countries as $country) {
                                                $countrytemp = $country;
                                                ?>     
                                                <option <?php if ($personalinformation_iprofile_homecountry == $countrytemp[0]) {
                                    echo "selected='selected'";
                                } ?> value="<?php echo $countrytemp[0]; ?>"><?php echo $countrytemp[1]; ?></option>

                                <?php
                                }
                            }
                            ?>
                                    </select>     
                                </span></li>
                                    <?php
                                    }
                                    if ($personalinformation_iprofile_edit_bday_1 == true) {
                                        ?>
                            <li><span class="label"><?php echo _('Birthday');?></span><span class="form-element">
                                    <select name="bday-date" id="bday-date">
        <?php
        $bday = explode('-', $personalinformation_iprofile_bday);

        for ($i = 1; $i < 32; $i++) {
            ?>

                                            <option <?php if ($i == $bday[2]) {
                                    echo "selected='selected'";
                                } echo '>' . $i; ?></option>
                                        <?php } ?>
                                    </select>
                                    <select name="bday-month" id="bday-month">

                                        <?php
                                        $bmonth = $bday[1];

                                        $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                                        foreach ($months as $key => $month) {
                                            if (($bmonth - 1) == $key) {
                                                $key++;
                                                echo "<option value={$key} selected='selected'>{$month}</option>";
                                            } else {
                                                $key++;
                                                echo "<option value={$key}>{$month}</option>";
                                            }
                                        }
                                        ?>  

                                    </select>
                                    <select name="bday-year" id="bday-year">
                                        <?php
                                        $year = new DateTime("now");
                                        $y = $year->format('Y') - 13;
                                        $old = $y - 90; // generate years for 90 years

                                        for ($y; $y > $old; $y--) {
                                            ?>
                                            <option <?php if ($y == $bday[0]) {
                        echo "selected='selected'";
                    } ?>><?php echo $y ?></option>
        <?php } ?>
                                    </select>
                                </span></li>

                                    <?php
                                    }
                                    if ($personalinformation_iprofile_edit_relationshipstatus_1 == true) {
                                        ?>   
                            <li>
                                <span class="label"><?php echo _('Relationship Status');?></span>
                                <span class="form-element">
                                    <select name="relationshipstatus" id="relationshipstatus">
                                        <?php
                                        $select = $personalinformation_iprofile_relationshipstatus;

                                        $relationships = array('Single', 'Married', 'Engaged', 'Widowed', 'Divorced', 'Separated', 'In-a-Relationship');
                                        foreach ($relationships as $key => $name) {

                                            if (($key) == ($select)) /* == will be case sensetive */ {
                                                echo "<option value={$key} selected='selected'>{$name}</option>";
                                            }
                                            else
                                                echo "<option value={$key} >{$name}</option>";
                                        }
                                        ?>      
                                    </select>
                                </span>
                            </li>
    <?php
    }
    if ($personalinformation_iprofile_edit_height_1 == true) {
        ?> 
                            <li><span class="label"><?php echo _('Height');?></span><span class="form-element">
                                    <input name="height" type="text" value="<?php echo $personalinformation_iprofile_height; ?>"/>
                                </span></li>
                        <?php
                        }
                        if ($personalinformation_iprofile_edit_weight_1 == true) {
                            ?> 
                            <li><span class="label"><?php echo _('Weight');?></span><span class="form-element">
                                    <input name="weight" type="text" value="<?php echo $personalinformation_iprofile_weight; ?>" />
                                </span></li>
                            <?php
                        }
                    }
                    ?> 

<?php /* <li><span class="label">Check Box</span><span class="form-element">
  <input name="check-box" type="checkbox" value="Like" class="styled" />
  Select or Not </span></li>
  <li><span class="label">Radio Button</span><span class="form-element">
  <input name="radio" type="radio" value="" />
  Yes </span></li>
  <li><span class="label">Text Area</span><span class="form-element">
  <textarea name="textarea" cols="30" rows="3" ></textarea>
  </span></li> */ ?>
                </ul>
                <dl><input name="Personalinformation-submit" type="submit" value="<?php echo _('Save Change');?>"/></dl> <!--added by Pasindu-->
            </div>
        </div>
    </div>
</form>