<?php
/* 
 * This file is part of pluck, the easy content management system
 * Copyright (c) somp (www.somp.nl)
 * http://www.pluck-cms.org

 * Pluck is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 
 * See docs/COPYING for the complete license.
*/

//Make sure the file isn't accessed directly
if((!ereg("index.php", $_SERVER['SCRIPT_FILENAME'])) && (!ereg("admin.php", $_SERVER['SCRIPT_FILENAME'])) && (!ereg("install.php", $_SERVER['SCRIPT_FILENAME'])) && (!ereg("login.php", $_SERVER['SCRIPT_FILENAME']))){
    //Give out an "access denied" error
    echo "access denied";
    //Block all other code
    exit();
}

//---------------
//VARIABLES
//---------------

//GETS
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}
if (isset($_GET['editpage'])) {
	$editpage = $_GET['editpage'];
}
if (isset($_GET['deletepage'])) {
	$deletepage = $_GET['deletepage'];
}
if (isset($_GET['deleteimage'])) {
	$deleteimage = $_GET['deleteimage'];
}
if (isset($_GET['editmeta'])) {
	$editmeta = $_GET['editmeta'];
}
if (isset($_GET['pageup'])) {
	$pageup = $_GET['pageup'];
}
if (isset($_GET['pagedown'])) {
	$pagedown = $_GET['pagedown'];
}
if (isset($_GET['trash_viewitem'])) {
	$trash_viewitem = $_GET['trash_viewitem'];
}
if (isset($_GET['trash_restoreitem'])) {
	$trash_restoreitem = $_GET['trash_restoreitem'];
}
if (isset($_GET['trash_deleteitem'])) {
	$trash_deleteitem = $_GET['trash_deleteitem'];
}
if (isset($_GET['modulestart'])) {
	$modulestart = $_GET['modulestart'];
}
if (isset($_GET['module'])) {
	$module = $_GET['module'];
}
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if (isset($_GET['cat'])) {
	$cat = $_GET['cat'];
}
//Some GET-variables for general use
if (isset($_GET['var1'])) {
	$var1 = $_GET['var1'];
}
if (isset($_GET['var2'])) {
	$var1 = $_GET['var2'];
}
if (isset($_GET['var3'])) {
	$var3 = $_GET['var3'];
}
//POSTS
$kop = $_POST['kop'];
$tekst = $_POST['tekst'];
$back = $_POST['back']; 
$txt = $_POST['txt'];
$type = $_POST['type'];
$pass = $_POST['pass'];
$passoud = $_POST['passoud'];
$cont = $_POST['cont'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$chosen_lang = $_POST['chosen_lang'];
$email = $_POST['email'];
$email2 = $_POST['email2'];
$contactform = $_POST['contactform'];
$hidepage = $_POST['hidepage'];
$album_name = $_POST['album_name'];
$quality = $_POST['quality'];
$incmodule = $_POST['incmodule'];
//Some variables for general use
if (isset($_POST['cont1'])) {
	$cont1 = $_POST['cont1'];
}
if (isset($_POST['cont2'])) {
	$cont2 = $_POST['cont2'];
}
if (isset($_POST['cont3'])) {
	$cont3 = $_POST['cont3'];
}
if (isset($_POST['cont4'])) {
	$cont4 = $_POST['cont4'];
}
if (isset($_POST['cont5'])) {
	$cont5 = $_POST['cont5'];
}

//---------------
//FUNCTIONS
//---------------

//Function: define menudiv
//------------
function showmenudiv($title,$text,$image,$url,$blank,$more=NULL) {
?>
<div class="menudiv">
	<span>
		<img src="data/image/<?php echo $image; ?>" alt="" />
	</span>
	<span>
		<span><a href="<?php echo $url; ?>"
		<?php if ($blank == 'true') {
		echo ' target="_blank"'; }?>
		><?php echo $title; ?></a></span>
		<span class="more"><?php echo $more; ?></span><br />
		<?php echo $text; ?>
	</span>
</div>
<?php
}


//Function: read out the albums to show checkboxes
//------------
function read_albumsinpages($dir) {
   $path = opendir($dir);
   while (false !== ($file = readdir($path))) {
       if(($file !== ".") and ($file !== "..")) {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$file;
       }
   }
   if($dirs) {
   natcasesort($dirs);
   foreach ($dirs as $dir) {
		//Include Translation data
		include ("data/settings/langpref.php");
		include ("data/inc/lang/en.php");
		include ("data/inc/lang/$langpref");
		//Some variables
		$editpage = $_GET['editpage'];
		$action = $_GET['action'];
		//Check if we need to include the existing page
		if ($editpage) {
		include("data/settings/pages/$editpage");
		}
		
		echo "<input type=\"checkbox\" name=\"insertedalbums[]\" value=\"$dir\"";
		//Check if the checkbox should be checked...
		//...not needed when we are creating a new page...
		if ($action == "newpage") {
		echo ""; }
		//...but is needed when album has previously been included
		elseif ($incalbum[$dir] == "yes") {
		echo "checked=\"checked\""; }
		
		echo " /> $lang_albums17 $dir<br />"; }
   }
   closedir($path);
}

//Function: read out the blog categories to show checkboxes
//------------
function read_bloginpages($dir) {
	$path = opendir($dir);
	while (false !== ($file = readdir($path))) {
       if(($file !== ".") and ($file !== "..")) {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$file;           
       }
   }
   if($dirs) {
   natcasesort($dirs);
   foreach ($dirs as $dir) {
		//Include Translation data
		include ("data/settings/langpref.php");
		include ("data/inc/lang/en.php");
		include ("data/inc/lang/$langpref");
		//Some variables		
		$editpage = $_GET['editpage'];
		$action = $_GET['action'];
		//Check if we need to include the existing page
		if ($editpage) {
		include("data/settings/pages/$editpage");
		}
		
		echo "<input type=\"checkbox\" name=\"insertedblogs[]\" value=\"$dir\"";
		//Check if the checkbox should be checked...
		//...not needed when we are creating a new page...
		if ($action == "newpage") {
		echo ""; }
		//...but is needed when blog has previously been included
		elseif ($incblog[$dir] == "yes") {
		echo "checked=\"checked\""; }
		
		echo " /> $lang_blog13 $dir<br />"; }
   }
   closedir($path);
}


//Function: read out the pages
//------------
function read_pages($dir) {
   $path = opendir($dir);
   while (false !== ($file = readdir($path))) {
       if(($file !== ".") and ($file !== "..")) {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$dir."/".$file;
       }
   }
   if($dirs) {
   echo "";
   }
   if($files) {
       natcasesort($files);
       foreach ($files as $file) {
           include "data/settings/pages/$file"; 
            //Include Translation data
				include ("data/settings/langpref.php");
				include ("data/inc/lang/en.php");
				include ("data/inc/lang/$langpref");
?>
<div class="menudiv">
	<span>
		<img src="data/image/page.png" alt="" />
	</span>
	<span class="title-page"><?php echo $title; ?></span>
	<span>
	<a href="?editpage=<?php echo $file; ?>"><img src="data/image/edit.png" title="<?php echo $lang_page3; ?>" alt="<?php echo $lang_page3; ?>" /></a>		
	</span>
	<span>
	<a href="?editmeta=<?php echo $file; ?>"><img src="data/image/siteinformation.png" title="<?php echo $lang_meta1; ?>" alt="<?php echo $lang_meta1; ?>" /></a>		
	</span>
	<span>
	<a href="?pageup=<?php echo $file; ?>"><img src="data/image/up.png" title="<?php echo $lang_updown1; ?>" alt="<?php echo $lang_updown1; ?>" /></a>		
	</span>
	<span>
	<a href="?pagedown=<?php echo $file; ?>"><img src="data/image/down.png" title="<?php echo $lang_updown1; ?>" alt="<?php echo $lang_updown1; ?>" /></a>		
	</span>
	<span>
	<a href="?deletepage=<?php echo $file; ?>"><img src="data/image/delete.png" title="<?php echo $lang_trash1; ?>" alt="<?php echo $lang_trash1; ?>" /></a>		
	</span>
</div>
<?php
		}
   }
   closedir($path);
}


//Function: read out the images to let them include in pages
//------------
function read_imagesinpages($dir) {
   $path = opendir($dir);
   while (false !== ($file = readdir($path))) {
       if(($file !== ".") and ($file !== "..") and ($file !== "kop1.php")) {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$dir."/".$file;           
       }
   }
   if($files) {
       natcasesort($files);
       foreach ($files as $file) {
      //Include Translation data
		include ("data/settings/langpref.php");
		include ("data/inc/lang/en.php");
		include ("data/inc/lang/$langpref");
?>
		<div class="menudiv" style="width: 200px; margin: 2px;">
			<table>
				<tr>
					<td>
						<img src="data/image/image_small.png" alt="" />
					</td>
					<td style="font-size: 14px;">
						<span style="font-size: 16px;"><a href="images/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a></span><br>
						<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'<img src=images/<?php echo $file; ?> alt=>');return false;"><?php echo $lang_page7; ?></a>
					</td>
				</tr>
			</table>
		</div>
<?php
		}
   }
   closedir($path);
}

//Function: read out the pages to let them be included in pages as link
//------------
function read_pagesinpages($dir) {
   $path = opendir($dir);
   while (false !== ($file = readdir($path))) {
       if(($file !== ".") and ($file !== "..")) {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$dir."/".$file;    
       }
   }
   if($dirs) {
   echo "";
   }
   if($files) {
       natcasesort($files);
       foreach ($files as $file) {
           include "data/settings/pages/$file"; 
            //Include Translation data
				include ("data/settings/langpref.php");
				include ("data/inc/lang/en.php");
				include ("data/inc/lang/$langpref");
				echo "<div class=\"menudiv\" style=\"width: 200px; margin: 2px;\">
							<table>
								<tr>
									<td>
										<img src=\"data/image/page_small.png\" border=\"0\" alt=\"\">
									</td>
									<td style=\"font-size: 14px;\">
										<span style=\"font-size: 16px; color: gray\">$title</span><br>
										<a href=\"#\" onclick=\"tinyMCE.execCommand('mceInsertContent',false,'<a href=index.php?file=$file title=$title>$title</a>');return false;\">$lang_page9</a>
									</td>
								</tr>
							</table>
						</div>";  }
   }
   closedir($path);
}


//Function: readout the images
//------------
function read_images($dir) {
   $path = opendir($dir);
   while (false !== ($file = readdir($path))) {
       if(($file !== ".") and ($file !== "..")) {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$dir."/".$file;
       }
   }
   if (!$files) {
	//Include Translation data
	include ("data/settings/langpref.php");
	include ("data/inc/lang/en.php");
	include ("data/inc/lang/$langpref");
	echo "<span class=\"kop4\">$lang_albums14</span>"; }
	
   if($files) {
       natcasesort($files);
       foreach ($files as $file) {
       //Include Translation data
		include ("data/settings/langpref.php");
		include ("data/inc/lang/en.php");
		include ("data/inc/lang/$langpref");
				echo "<div class=\"menudiv\" style=\"margin: 15px;\">
							<table>
								<tr>
									<td>
										<img src=\"data/image/image.png\" alt=\"\">
									</td>
									<td style=\"width: 350px\">
										<span style=\"font-size: 17pt;\">$file</span>
									</td>
									<td>
										<a href=\"images/$file\" target=\"_blank\"\"><img src=\"data/image/view.png\" alt=\"\"></a>									
									</td>
									<td>
										<a href=\"?deleteimage=$file\"><img src=\"data/image/delete.png\" title=\"$lang_trash1\" alt=\"$lang_trash1\"></a>		
									</td>
								</tr>
							</table>
						</div>"; }
   }
   closedir($path);
}

//Function: read out the pages in the trashcan
//------------
function read_pages_trashcan($dir) {
   $path = opendir($dir);
   while (false !== ($file = readdir($path))) {
       if(($file !== ".") and ($file !== "..")) {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$dir."/".$file;    
       }
   }
   if (!$files) {
	//Include Translation data
	include ("data/settings/langpref.php");
	include ("data/inc/lang/en.php");
	include ("data/inc/lang/$langpref");
	echo "<span class=\"kop4\">$lang_albums14</span>"; }
   if($files) {
       natcasesort($files);
       foreach ($files as $file) {
           include "data/trash/pages/$file"; 
            //Include Translation data
				include ("data/settings/langpref.php");
				include ("data/inc/lang/en.php");
				include ("data/inc/lang/$langpref");
echo "<div class=\"menudiv\" style=\"margin: 20px;\">
<table>
	<tr>
		<td>
			<img src=\"data/image/page.png\" alt=\"\">
		</td>
		<td style=\"width: 350px;\">
			<span style=\"font-size: 17pt;\">$title</span>
		</td>
		<td>
		<a href=\"?trash_viewitem=$file&cat=page\"><img src=\"data/image/view.png\" alt=\"$lang_trash7\" title=\"$lang_trash7\"></a>		
		</td>
		<td>
		<a href=\"?trash_restoreitem=$file&cat=page\"><img src=\"data/image/restore.png\" title=\"$lang_trash10\" alt=\"$lang_trash10\"></a>		
		</td>
		<td>
		<a href=\"?trash_deleteitem=$file&cat=page\"><img src=\"data/image/delete_from_trash.png\" title=\"$lang_trash8\" alt=\"$lang_trash8\"></a>		
		</td>
	</tr>
</table>
</div>"; }
   }
   closedir($path);
}

//Function: read out the images in the trashcan
//------------
function read_images_trashcan($dir) {
   $path = opendir($dir);
   while (false !== ($file = readdir($path))) {
       if(($file !== ".") and ($file !== "..")) {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$dir."/".$file;    
       }
   }
   if (!$files) {
	//Include Translation data
	include ("data/settings/langpref.php");
	include ("data/inc/lang/en.php");
	include ("data/inc/lang/$langpref");
	echo "<span class=\"kop4\">$lang_albums14</span>"; }
   if($files) {
       natcasesort($files);
       foreach ($files as $file) {
            //Include Translation data
				include ("data/settings/langpref.php");
				include ("data/inc/lang/en.php");
				include ("data/inc/lang/$langpref");
echo "<div class=\"menudiv\" style=\"margin: 20px;\">
<table>
	<tr>
		<td>
			<img src=\"data/image/image.png\" alt=\"\">
		</td>
		<td style=\"width: 350px;\">
			<span style=\"font-size: 17pt;\">$file</span>
		</td>
		<td>
		<a href=\"data/trash/images/$file\" target=\"_blank\"><img src=\"data/image/view.png\" alt=\"$lang_trash7\" title=\"$lang_trash7\"></a>		
		</td>
		<td>
		<a href=\"?trash_restoreitem=$file&cat=image\"><img src=\"data/image/restore.png\" title=\"$lang_trash10\" alt=\"$lang_trash10\"></a>		
		</td>
		<td>
		<a href=\"?trash_deleteitem=$file&cat=image\"><img src=\"data/image/delete_from_trash.png\" title=\"$lang_trash8\" alt=\"$lang_trash8\"></a>		
		</td>
	</tr>
</table>
</div>"; }
   }
   closedir($path);
}
?>