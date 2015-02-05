<?php //Make sure the file isn't accessed directly.
defined('IN_PLUCK') or exit('Access denied!');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo LANG; ?>">
<head>
<?php theme_meta(true); ?>
<link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>
</head>
<body>

<div id="templatemo_wrapper_01">
<div id="templatemo_wrapper_02">

    <div id="templatemo_header">
    	<div id="site_title">
         <h1> <?php theme_sitetitle(); ?></h1>
        </div>
        
        <div id="header_right">
        	
        
           
        
            <div id="templatemo_menu">
              	
            </div> <!-- end of templatemo_menu -->        
        </div>
    </div> <!-- end of templatemo_header -->
    
    
    <div id="templatemo_main">
    	
        <div id="templatemo_content_wrapper">
        <div id="templatemo_content_top"></div>
        <div id="templatemo_content">
        	
            <div class="content_box">
            	<h2 title="<?php theme_pagetitle(); ?>"><?php theme_pagetitle(); ?></h2>
		<?php theme_content(); ?>
		<?php theme_area('main'); ?>
		  </div>
            
			
            
            
			        

        </div> <!-- end of content -->
        <div id="templatemo_content_bottom"></div>
        </div> <!-- end of content wrapper -->
        
        <div id="templatemo_sidebar">
        
        	<div class="sidebar_box_wrapper">

                <div class="sidebar_box">
                    <div class="sb_title"></div>
                    <div class="sb_content">
						 <ul class="tmo_list">
                          <?php theme_menu('ul', 'li', 'active', 1); ?>	
                          </ul>	
                    </div>
                </div>
                
                
			</div>
			
			<div class="templatemo_cleaner"></div>            

            <div class="templatemo_sidebar_bottom"></div>
			
			<div class="templatemo_cleaner"></div>
            
			

		  	<div class="templatemo_cleaner"></div>
			
  			
           
        </div> <!-- end of sidebar -->
    
    	<div class="clear"></div>
    </div> <!-- end of main -->
    
    <div id="templatemo_footer">
    	<?php theme_area('footer'); ?>
		<a href="<?php echo SITE_URL; ?>/login.php">admin</a> | powered by <a href="http://www.pluck-cms.org">pluck</a>
    </div> 
<div style="text-align: center; font-size: 0.75em;">Provided by <a href="http://www.template4all.com/css/">free css templates</a></div>
 <!-- end of footer -->   
</div> <!-- end of wrapper 02 -->
</div> <!-- end of wrapper 01 -->

</body>
</html>
