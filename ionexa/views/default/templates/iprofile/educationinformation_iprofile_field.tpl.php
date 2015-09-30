<li>
                  <ul class="random-columns">
                   <li><span class="label"><?php echo _('Type');?></span>
                        <span class="form-element">
                            <select name="type[]" id="type">
                                <option><?php echo _('High School');?></option>
                                <option><?php echo _('University');?></option>
                                <option><?php echo _('College');?></option>
                                <option><?php echo _('Other');?></option>
                            </select>
                        </span>
                    </li>
                    <li><span class="label"><?php echo _('Name');?><a class="help"></a></span><span class="form-element">
                      <input name="name[]" type="text" value="">
                      </span></li>
                    <li><span class="label"><?php echo _('Graduated On');?></span><span class="form-element">
                      
                   <select name="graduation-date[]" id="bday-date">
                                             
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
                  <select name="graduation-month[]" id="bday-month">
                      
                    <?php 
                        $months = array(_('January'),_('February'),_('March'),_('April'),_('May'),_('June'),_('July'),_('August'),_('September'),_('October'),_('November'),_('December'));
                     foreach($months as $key=>$month)
                             {
                               
                                        $key++;
                                        echo "<option value={$key}>{$month}</option>";
                                    
                             }
                    ?> 
                  </select>
                  <select name="graduation-year[]" id="bday-year">
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
                                        <option>1923</option>
                                        <option>1922</option>
                                        <option>1921</option>
                                        <option>1920</option>
                                        <option>1919</option>
                                        <option>1918</option>
                                        <option>1917</option>
                                        <option>1916</option>
                                        <option>1915</option>
                                        <option>1914</option>
                                        <option>1913</option>
                                        <option>1912</option>
                                        <option>1911</option>
                                      </select>
                      
                      </span></li>
                    
                    <?php /*<li><span class="label">Description</span><span class="form-element">
                      <textarea name="Description[]" cols="30" rows="3"></textarea>
                      </span></li>*/?>
                      
                       <li><span class="label">Country</span><span class="form-element">
                     
                      
                          <select id="countrySelect" name="countrySelect[]">
                
                      
                           <option value="3">AUS</option>
                
                       
                           <option value="1">SL</option>
                
                       
                           <option value="2">USA</option>
                
                                  </select>
                     </span></li>
                       <li><input type="hidden" name="field[]" value="educationn_1"></li>
                                          
                      
                      
                  </ul>
                </li>