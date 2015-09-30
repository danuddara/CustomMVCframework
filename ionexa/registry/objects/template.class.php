<?php

/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "04/06/2013";
 * @class = "Template Class";
 * 
 * Template class for loading relavant views 
 * 
 * 1. should load AJAX contents- Bits of site contents/modules
 * 2. should display a full page
 *
 */

    class Template
    {
      
        private $vars = array(); // auto set variables
        private $baseurl; 
        
         /* 
          * will be useful for privacy settings
          * this have to be set on the controller level
          *  
          *condition is on loadtemplatebit();
          */
         
         private $authenticateSections = array();
         
          /*
             * authenticationFields = array(

                        'sectionofthepage'= > array(

                                                'field_1'=>true,
                                                'field_2'=>false,


                                                ),
                        'sectionofthepage'= > array(
                                                'family-name'=>true,
                                                'nick-name'=>false,


			)

             */
         private $authenticationFields = array();
        
        public function __construct() {
            
            $this->authenticateSections['index']  = true;
          /*  $alerts = $this->registry->getObject('messageAlert');
            $this->vars['messages'] = $alerts;*/
            
        }
        /*
         * 
         * set the authentication levels to the template
         *  use isAuthenticated to control the privacy
         * 
         */
        public function isAuthenticated($action='index',$auth=true,$fields=array())
        {
           
            $this->authenticateSections[$action] = $auth;
            
            /*
             * set field authentications 
             * set the relatvant fields if not set and if is set;
             */
            if($fields!=null)
            {  
                
                 if( array_key_exists($action,  $this->authenticationFields)==true)
                 {
                     $tempfield=$this->authenticationFields[$action];
                    foreach($fields as $field =>$value)
                    {
                       $tempfield[$field]=$value;
      
                    }
                    $this->authenticationFields[$action]=$tempfield;
                   
                 }
                 else
                 {
                     $this->authenticationFields[$action]=$fields;
                    
                 }
            }
          
        }


        /**
         *
         * @set undefined vars
         *
         * @param string $index
         *
         * @param mixed $value
         *
         * @return void
         * is used to set the template variables automatically, at the controller level.$template->variable
         */
         public function __set($index, $value)
         {
                $this->vars[$index] = $value;
         }
        /*
         * pass the view  to templatebit
         * @param = paths, you can pass many as you want
         * 
         * Will be useful for AJAX calls, the tempaltes need to be stored separately.
         */
        public function loadtemplatebit()
        {
           /* if (!function_exists("gettext"))
            {
                echo "gettext is not installed\n";
            }
            else
            {
                echo "gettext is supported\n";
            }*/
            ob_start();
           // $this->seti18n(); // won't work in local machine.
            
            

         
           if($this->authenticateSections['index']==true)
           {
                $arg = func_get_args(); // get args automatically
                $this->setAuthenticationKeys($arg) ; //set keys for non intialized authentication sections
                
                $pageFolder = $this->getControllerPage();
                
                $content = "";
                foreach( $arg as $bit )
                {
		    $key = preg_replace('/.tpl.php/','',$bit);
                    /***set the page for the default controller***/
                    
                    if($key=='error404'|| $key=='messageAlert'|| $pageFolder=='' )
                        {
                            $pagepath = "";
                            if($pageFolder=='')
                            {
                                $pagepath="templates/index/";
                            }
                          
                        }
                   
                   else { 
                       
                            $pagepath = 'templates/'.$pageFolder.'/';
                       }
                    
                    
                   
		    if( strpos( $bit, 'views/' ) === false && $this->authenticateSections[$key] == true )
		    {
                     
			    $bit = 'views/' .Registry::getSetting('skin') .'/'.$pagepath. $bit;
                            /*
                             * Load field authentications over here
                             */
                           
                          
		    }
                 
		    if( file_exists( $bit ) == true )
		    {
                         /*set the template base url path*/
                        $this->baseurl = __BASE_URL.'/views/' .Registry::getSetting('skin') . '/';
                        
                        $baseurl = $this->baseurl;
                       
                        
                         
                         if(array_key_exists($key,  $this->authenticationFields))
                         {
                        foreach($this->authenticationFields[$key] as $field=>$show)
                        {
                            //echo 'keys:'. $key.'<br/>';
                                    $fields = $this->authenticationFields[$key];
                           
                                     $fieldname= $key.'_'.$field; // section.fieldname;
                                     $$fieldname = $show; // initiatefiled name if its true;$section_fieldname;
                                
                                 //echo $fieldname.'<br/>';
                          
                        }
                        
                         }
                         
                           foreach ($this->vars as $key => $value) // load template variables
                            {
                                    $$key = $value;
                                    
                                    
                            }
                    
                            include_once ($bit); // include the template file after loading the variables
                     //  $content .= file_get_contents( $bit );// the file_get_contents will only get the contents it can't be used in that
                            
		    }
                
                    
                }   
           }
           
           ob_end_flush(); // i18n translation
           
        }
        
         /*
         * pass the views or the view to the build template function
          * it will construct the whole page by adding the header and the footer with the 
          * template views passed in.
         * @param = views, you can pass many as you want
          * ex: buildtemplate('index.tpl.php','error404.tpl.php');
          * 
          * An apply function
         */
        private function list_system_locales(){
                ob_start();
                system('locale -a');
                $str = ob_get_contents();
                ob_end_clean();
               // return $str;
                $matchesarray = null;
                $language = $this-> readUserHeader();
                
                /*Linux Requires the country code to be capital and matched to the folder*/
                if(strpos($language,'-'))
                {
                    $exlanuage = explode('-', $language);
                     $exlanuage[1]=strtoupper( $exlanuage[1]);
                    $language = implode('_',$exlanuage);
                   
                }
                
                $locale = array_unique(preg_split("/\n/", trim($str)));
               // var_dump($locale);
                
                if(!in_array($language, $locale))
                       {
                            
                            preg_match_all("/".$language."_(\w+)/", $str, $matchesarray);
                            
                            if($matchesarray!=null)
                            {
                                if(!in_array($language, $matchesarray))
                                   {
                                    $filter = array_unique($matchesarray[0]);
                                    $language=$filter[0];//set the default as the first setup
                                   }

                            }
                       }
                
                
                return $language;
               //return  array_unique(preg_split("/\n/", trim($str)));
            }
            
        private function seti18n()
        {
            ob_start();
            
            
            $language = $this->list_system_locales();
            //$language = $this-> readUserHeader();
            
            putenv("LANG=$language"); 
            setlocale(LC_ALL, $language.'.UTF-8');
            header("content-type: text/html;charset=UTF-8 \r\n");
            mb_internal_encoding('UTF-8');
            mb_language('uni');
            
            $domain = 'lang_main';
            bindtextdomain($domain, './views/'.Registry::getSetting('skin').'locale/nocache'); 
			
            bindtextdomain($domain, './views/'.Registry::getSetting('skin') .'/locale'); 
            textdomain($domain);
            
            ob_end_flush();
        }
            
            
        public function  buildtemplate()
        {
            ob_start();
            
            
            //$this->seti18n(); // comment on local because it won't work in local machine
           
             
             
            
             
            /*$language = $this-> readUserHeader();
           
            if($language==false){ $language='en_US';}
           
           /* echo 'env'.  putenv("LANG=$language").'env<br/>'; 
            echo 'locale'.setlocale(LC_ALL, $language).'locale<br/>';
            header("content-type: text/html;charset=UTF-8 \r\n");
            mb_internal_encoding('UTF-8');
            mb_language('uni');
            
            $domain = 'lang_main';
            bindtextdomain($domain, './views/'.Registry::getSetting('skin').'locale/nocache');
            bindtextdomain($domain, './views/'.Registry::getSetting('skin').'/locale'); 
			bind_textdomain_codeset($domain, 'UTF-8');
			textdomain($domain);*/
			//echo $out .' :'.$out2.'<br/>';
			//echo 'views/'.Registry::getSetting('skin') .'/locale/';die;
          
           
           
           
                $template = 'views/' .Registry::getSetting('skin') . '/';
                $header = $template.'includes/header.php' ; // header of the template.these are fixed files in the template;
                $menu = $template.'includes/menu.php' ;
                $defaultcss = $template.'includes/index.css.php' ;
                $defaultjs = $template.'includes/index.js.php' ;
                $footer = $template.'includes/footer.php' ; // footer of the templaete.these are fixed files in the template;

                /*set the template base url path*/
                $this->baseurl = __BASE_URL.'/views/' .Registry::getSetting('skin') . '/';

                $baseurl = $this->baseurl;
                $args = func_get_args(); // get args automatically;
                //set keys for authentication sections
                $this->setAuthenticationKeys($args) ;
                $pageName = $this->getControllerPage();
                $pagefolder= "";
                foreach( $args as $bit )
                {
		    $key = preg_replace('/.tpl.php/','',$bit);
                    /***set the page for the default controller***/
                    
                    if($key=='error404' || $pageName=='')
                        {
                            /*
                             * load index css and js files
                             */
                            $pageName = 'index';
                            $pagefolder = 'includes/';
                           
                        
                        } 
                    else
                        {
                        
                            /*
                             * load relavant page css and js files !important to have those two files in the page folder
                             */
                            $pagefolder = 'templates/'.$pageName.'/includes/';
                        
                        
                        }
                }
                
      
                include_once  $header; /***header tag****/
                
                /*
                 * css  and js files relavant to the page store in the relavant folder/includes in the default templates
                 */
                $cssfilepath = $template.$pagefolder.$pageName.'.css.php';
                $jsfilepath = $template.$pagefolder.$pageName.'.js.php';
                
               if(file_exists( $cssfilepath ) == true)
                   include_once  $cssfilepath;
               else 
                   include_once  $defaultcss;
               
               if(file_exists( $jsfilepath ) == true)
                   include_once  $jsfilepath;
                else 
                   include_once  $defaultjs;
       
                include_once  $menu;
                call_user_func_array(array($this, "loadtemplatebit"),$args );
                include_once $footer;
                
                    ob_end_flush(); // i18n translation
            
        }
        
        private function setAuthenticationKeys($args)
        {
                 foreach( $args as $bit )
                 {
                      $key = preg_replace('/.tpl.php/','',$bit);
                     if( array_key_exists($key,  $this->authenticateSections)==false)
                     {
                         $this->authenticateSections[$key]=true; // by default all keys are true
                         
                     }
                 }  
            
        }
        
        private function getControllerPage()
        {
            $pageFolder = "";
             /*** get the route from the url Controller/Action ***/
            $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
            
                    if (empty($route))
                    {
                            $pageFolder = 'index'; /* the controller classes will have to overide this abstract method*/
                          
                    }
                    else 
                    {

                        /*** get the parts of the route separated by a ('/')
                         * !Note:don't use any ('/') when passsing arguments 
                         *  ***/

                            $parts = explode('/', $route);
                            $pageFolder = $parts[0]; /*controller is the first part,set controller*/
                           
                    }
                   
                  
                    return $pageFolder;
                
                    
                    
        }
        
        
        
        private function readUserHeader() {
                $locale = false;
		$client_header = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
              //  var_dump($client_header);die;
                
                if (count($client_header) < 1) {
			return (boolean) FALSE;
		} // end if
                
               
                $locale=trim($client_header[0]);
                /*foreach ($client_header as $raw_entry) {
			$temp = explode(';', $raw_entry);
			$locale = trim($temp[0]);
			
		} // end foreach*/
                
                return $locale;
        }
       
    } 
?>
