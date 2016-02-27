<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
  	<?php use_javascript('jquery-1.10.2.js') ?>
    <?php include_javascripts() ?>
  </head>
  <body>
              <?php if($sf_user->getGuardUser()){ ?>
            		<div style="float:right;">
            		<?php 
            		  echo "Welcome ".$sf_user->getGuardUser()->getUsername();
            		  if($sf_user->getGuardUser()->getIsSuperAdmin())
            		  {
                    echo 
                      " | ".
                      link_to("Frontend","/../index.php");
            		  }
                  echo " | ".
                    link_to("Logout","@sf_guard_signout");
                    //" | ".
                    //link_to("Edit Profile",url_for("@user_edit?id=".$sf_user->getGuardUser()->getUser()->getId())); ?>
                </div>

              <?php }else{ ?>
            		<div style="float:right;">
              		<?php echo link_to("Please login","@sf_guard_signin"); ?>
                </div>
                <br>
          		<?php } ?>
    <?php echo $sf_content ?>
  </body>
</html>
