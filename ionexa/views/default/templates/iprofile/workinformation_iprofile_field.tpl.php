<ul class="random-columns">
                    <li><span class="label"><?php echo _('Employer');?><a class="help"></a></span><span class="form-element">
                      <input type="text" value="" name="employer[]">
                      </span></li>
                      
                    <li><span class="label"><?php echo _('Designation');?><a class="help"></a></span><span class="form-element">
                      <input type="text" value="" name="designation[]">
                      </span></li>
                    <li><span class="label"><?php echo _('From');?></span><span class="form-element">
                    
                            <select id="bday-date" name="from-date[]">
                                 
                                      <option>1</option>
                                
                                      <option>2</option>
                                
                                      <option>3</option>
                                
                                      <option>4</option>
                                
                                      <option>5</option>
                                
                                      <option>6</option>
                                
                                      <option>7</option>
                                
                                      <option>8</option>
                                
                                      <option>9</option>
                                
                                      <option>10</option>
                                
                                      <option>11</option>
                                
                                      <option>12</option>
                                
                                      <option>13</option>
                                
                                      <option>14</option>
                                
                                      <option>15</option>
                                
                                      <option>16</option>
                                
                                      <option>17</option>
                                
                                      <option>18</option>
                                
                                      <option>19</option>
                                
                                      <option>20</option>
                                
                                      <option>21</option>
                                
                                      <option>22</option>
                                
                                      <option>23</option>
                                
                                      <option>24</option>
                                
                                      <option>25</option>
                                
                                      <option>26</option>
                                
                                      <option>27</option>
                                
                                      <option>28</option>
                                
                                      <option>29</option>
                                
                                      <option>30</option>
                                
                                      <option>31</option>
                                                            </select>
                             <select id="bday-month" name="from-month[]">
                                    <?php
                                    
                                    $months = array(_('January'),_('February'),_('March'),_('April'),_('May'),_('June'),_('July'),_('August'),_('September'),_('October'),_('November'),_('December'));
                                     foreach($months as $key=>$month)
                                             {
                                             
                                                        $key++;
                                                        echo "<option value={$key}>{$month}</option>";
                                                    
                                             }
                                    ?> 
                                <option selected="selected" value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>  

                              </select>
                              <select id="bday-year" name="from-year[]">
                                                                         <option>2013</option>
                                                                        <option>2012</option>
                                                                        <option>2011</option>
                                                                        <option>2010</option>
                                                                        <option>2009</option>
                                                                        <option>2008</option>
                                                                        <option>2007</option>
                                                                        <option>2006</option>
                                                                        <option>2005</option>
                                                                        <option>2004</option>
                                                                        <option>2003</option>
                                                                        <option>2002</option>
                                                                        <option>2001</option>
                                                                        <option>2000</option>
                                                                        <option>1999</option>
                                                                        <option>1998</option>
                                                                        <option>1997</option>
                                                                        <option>1996</option>
                                                                        <option>1995</option>
                                                                        <option>1994</option>
                                                                        <option>1993</option>
                                                                        <option>1992</option>
                                                                        <option>1991</option>
                                                                        <option>1990</option>
                                                                        <option>1989</option>
                                                                        <option>1988</option>
                                                                        <option>1987</option>
                                                                        <option>1986</option>
                                                                        <option>1985</option>
                                                                        <option>1984</option>
                                                                        <option>1983</option>
                                                                        <option>1982</option>
                                                                        <option>1981</option>
                                                                        <option>1980</option>
                                                                        <option>1979</option>
                                                                        <option>1978</option>
                                                                        <option>1977</option>
                                                                        <option>1976</option>
                                                                        <option>1975</option>
                                                                        <option>1974</option>
                                                                        <option>1973</option>
                                                                        <option>1972</option>
                                                                        <option>1971</option>
                                                                        <option>1970</option>
                                                                        <option>1969</option>
                                                                        <option>1968</option>
                                                                        <option>1967</option>
                                                                        <option>1966</option>
                                                                        <option>1965</option>
                                                                        <option>1964</option>
                                                                        <option>1963</option>
                                                                        <option>1962</option>
                                                                        <option>1961</option>
                                                                        <option>1960</option>
                                                                        <option>1959</option>
                                                                        <option>1958</option>
                                                                        <option>1957</option>
                                                                        <option>1956</option>
                                                                        <option>1955</option>
                                                                        <option>1954</option>
                                                                        <option>1953</option>
                                                                        <option>1952</option>
                                                                        <option>1951</option>
                                                                        <option>1950</option>
                                                                        <option>1949</option>
                                                                        <option>1948</option>
                                                                        <option>1947</option>
                                                                        <option>1946</option>
                                                                        <option>1945</option>
                                                                        <option>1944</option>
                                                                        <option>1943</option>
                                                                        <option>1942</option>
                                                                        <option>1941</option>
                                                                        <option>1940</option>
                                                                        <option>1939</option>
                                                                        <option>1938</option>
                                                                        <option>1937</option>
                                                                        <option>1936</option>
                                                                        <option>1935</option>
                                                                        <option>1934</option>
                                                                        <option>1933</option>
                                                                        <option>1932</option>
                                                                        <option>1931</option>
                                                                        <option>1930</option>
                                                                        <option>1929</option>
                                                                        <option>1928</option>
                                                                        <option>1927</option>
                                                                        <option>1926</option>
                                                                        <option>1925</option>
                                                                        <option>1924</option>
                                                                  </select>
                      </span></li>
                      
                       <li><span class="label"><?php echo _('To');?></span><span class="form-element">
                     
                             <select id="bday-date" name="to-date[]">
                                 
                                      <option>1</option>
                                
                                      <option>2</option>
                                
                                      <option>3</option>
                                
                                      <option>4</option>
                                
                                      <option>5</option>
                                
                                      <option>6</option>
                                
                                      <option>7</option>
                                
                                      <option>8</option>
                                
                                      <option>9</option>
                                
                                      <option>10</option>
                                
                                      <option>11</option>
                                
                                      <option>12</option>
                                
                                      <option>13</option>
                                
                                      <option>14</option>
                                
                                      <option>15</option>
                                
                                      <option>16</option>
                                
                                      <option>17</option>
                                
                                      <option>18</option>
                                
                                      <option>19</option>
                                
                                      <option>20</option>
                                
                                      <option>21</option>
                                
                                      <option>22</option>
                                
                                      <option>23</option>
                                
                                      <option>24</option>
                                
                                      <option>25</option>
                                
                                      <option>26</option>
                                
                                      <option>27</option>
                                
                                      <option>28</option>
                                
                                      <option>29</option>
                                
                                      <option>30</option>
                                
                                      <option>31</option>
                                                            </select>
                             <select id="bday-month" name="to-month[]">

                               <?php
                                    
                                    $months = array(_('January'),_('February'),_('March'),_('April'),_('May'),_('June'),_('July'),_('August'),_('September'),_('October'),_('November'),_('December'));
                                     foreach($months as $key=>$month)
                                             {
                                             
                                                        $key++;
                                                        echo "<option value={$key}>{$month}</option>";
                                                    
                                             }
                                    ?> 
                              </select>
                              <select id="bday-year" name="to-year[]">
                                                                         <option>2013</option>
                                                                        <option>2012</option>
                                                                        <option>2011</option>
                                                                        <option>2010</option>
                                                                        <option>2009</option>
                                                                        <option>2008</option>
                                                                        <option>2007</option>
                                                                        <option>2006</option>
                                                                        <option>2005</option>
                                                                        <option>2004</option>
                                                                        <option>2003</option>
                                                                        <option>2002</option>
                                                                        <option>2001</option>
                                                                        <option>2000</option>
                                                                        <option>1999</option>
                                                                        <option>1998</option>
                                                                        <option>1997</option>
                                                                        <option>1996</option>
                                                                        <option>1995</option>
                                                                        <option>1994</option>
                                                                        <option>1993</option>
                                                                        <option>1992</option>
                                                                        <option>1991</option>
                                                                        <option>1990</option>
                                                                        <option>1989</option>
                                                                        <option>1988</option>
                                                                        <option>1987</option>
                                                                        <option>1986</option>
                                                                        <option>1985</option>
                                                                        <option>1984</option>
                                                                        <option>1983</option>
                                                                        <option>1982</option>
                                                                        <option>1981</option>
                                                                        <option>1980</option>
                                                                        <option>1979</option>
                                                                        <option>1978</option>
                                                                        <option>1977</option>
                                                                        <option>1976</option>
                                                                        <option>1975</option>
                                                                        <option>1974</option>
                                                                        <option>1973</option>
                                                                        <option>1972</option>
                                                                        <option>1971</option>
                                                                        <option>1970</option>
                                                                        <option>1969</option>
                                                                        <option>1968</option>
                                                                        <option>1967</option>
                                                                        <option>1966</option>
                                                                        <option>1965</option>
                                                                        <option>1964</option>
                                                                        <option>1963</option>
                                                                        <option>1962</option>
                                                                        <option>1961</option>
                                                                        <option>1960</option>
                                                                        <option>1959</option>
                                                                        <option>1958</option>
                                                                        <option>1957</option>
                                                                        <option>1956</option>
                                                                        <option>1955</option>
                                                                        <option>1954</option>
                                                                        <option>1953</option>
                                                                        <option>1952</option>
                                                                        <option>1951</option>
                                                                        <option>1950</option>
                                                                        <option>1949</option>
                                                                        <option>1948</option>
                                                                        <option>1947</option>
                                                                        <option>1946</option>
                                                                        <option>1945</option>
                                                                        <option>1944</option>
                                                                        <option>1943</option>
                                                                        <option>1942</option>
                                                                        <option>1941</option>
                                                                        <option>1940</option>
                                                                        <option>1939</option>
                                                                        <option>1938</option>
                                                                        <option>1937</option>
                                                                        <option>1936</option>
                                                                        <option>1935</option>
                                                                        <option>1934</option>
                                                                        <option>1933</option>
                                                                        <option>1932</option>
                                                                        <option>1931</option>
                                                                        <option>1930</option>
                                                                        <option>1929</option>
                                                                        <option>1928</option>
                                                                        <option>1927</option>
                                                                        <option>1926</option>
                                                                        <option>1925</option>
                                                                        <option>1924</option>
                                                                  </select>     
                               
                               
                      </span></li>
                       
                      <li><span class="label"><?php echo _('Country');?></span><span class="form-element">
                         
                          
                          <select name="countrySelect[]" id="countrySelect">
                
                                      
                                           <option value="3">AUS</option>

                                       
                                           <option value="1">SL</option>

                                       
                                           <option value="2">USA</option>

                                                              </select>
                         </span></li>
                         
                         
                      <?php /*   <li><span class="label">Description</span><span class="form-element">
                      <textarea rows="3" cols="30" name="Description[]"></textarea>
                      </span></li>*/ ?>
                      <li><input type="hidden" value="workk_1" name="field[]"></li>
                  </ul>