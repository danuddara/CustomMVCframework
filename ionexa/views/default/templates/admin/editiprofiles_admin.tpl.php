<table style="text-align:justify;background-color: #fff; margin: 0 auto;" border="1" align="center" >
    <tr>
        <th width="100px">ID</th>
        <th width="250px">Email</th>
        <th width="150px">First name</th>
        <th width="200px">Last name </th>
        <th width="100px">Suspend</th>
        <th width="50px">Edit</th>
    </tr>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    if($people!=null)
    {
        $str = '';  
        foreach($people as $person)
            {
                $option = array('0'=>'False','1'=>'True');
                $str .= '<tr><td>'.$person[0].'</td><td>'.$person[1].'</td><td>'.$person[2].'</td><td>'.$person[3].'</td><td>
                      <select class="statuschange" style="width:80px;margin:0 auto;" id='.$person[0].'>';
                      foreach($option as $key=>$status)
                      {
                        if($person[4]==$key)
                            { 
                                $str.="<option selected='selected' value={$key}>{$status}</option>";
                                
                            }
                        else
                            {
                                $str.="<option value={$key}>{$status}</option>";
                            }
           
                      }
                        
               $str.= '</select>      
                      </td><td><a href="'.__BASE_URL.'admin/editprofile?id='.$person[0].'">edit</a></td></tr>';
               
              
            }
        echo $str;     
    }
?>
</table>