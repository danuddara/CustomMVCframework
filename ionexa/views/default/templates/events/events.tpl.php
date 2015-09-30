<div class="section-panel">
        <div class="bread-crumb">
          <ul>
            <li><a href="<?php print __BASE_URL?>"><?php echo _('Home')?></a></li>
            <li><?php echo _('iProfile')?></li>
          </ul>
        </div>
        <div class="iprofile-tabs">
            <ul style="float:right">
                <li>
                    <a href="<?php print __BASE_URL.'events'?>">Events</a>
                </li>
                <li><a href="#">BP</a></li>
                <li><a href="#">MP</a></li>
            </ul>
        </div>
         <div class="page-title">
            <h1>
            <?php if(isset ($title) )echo $title;
            ?>
            </h1>
          <span class="special-note"><?php echo sprintf(_('Please read the %s Privacy Settings %s  instructions before filling out information'),'<a href="#">','</a>');?></span>
         </div>
    
     
