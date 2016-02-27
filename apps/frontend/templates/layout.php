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
  <body bgcolor="#EEEEEE">
              <?php if($sf_user->getGuardUser()){ ?>
            		<div style="float:right;">
            		<?php 
            		  echo "Welcome ".$sf_user->getGuardUser()->getUsername();
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
    <p>
    <b>Purchase Report</b> |
    <?php echo link_to("Home",'home/index'); ?> | 
    <?php echo link_to("New Account",'account/new'); ?> | 
    <?php echo link_to("New Account Entry",'account_entry/new'); ?> | 
    <?php echo link_to("Accounts",'account/index'); ?> | 
    <?php echo link_to("Account Entries",'account_entry/index'); ?> | 
    <?php echo link_to("Journals",'account_entry/index'); ?> | 
    <?php echo link_to("Ledgers",'account_entry/index'); ?> | 
    <?php echo link_to("Reports",'account_entry/index'); ?> | 
    
    
		<table>
		<tr>

			<td>
					<input id="purchasesearchinput" name="purchasesearchinput">
					<!--
					<input value="Search PO / Cash Voucher" type="submit">
					-->
					Search PO / Cash Voucher
			</td>
			<td>
				<input id=vendorsearchinput autocomplete="off"> Search Supplier |
			</td>
			<td>
				<input type=button value="Clear" id=clearsearch>
			</td>
		</tr>
		</table>
		<div id="searchresult"></div>
  <hr>
    
    
    <?php echo $sf_content ?>
  </body>
</html>

<script>
$("#vendorsearchinput").keyup(function(event){
	//if 3 or more letters in search box
    //if($("#vendorsearchinput").val().length>=3){
    
    //if enter key is pressed
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
	    $.ajax({url: "<?php echo "http://".$_SERVER['SERVER_NAME'].str_replace("index.php","",$_SERVER['SCRIPT_NAME'])?>/vendor/search?searchstring="+$("#vendorsearchinput").val(), success: function(result){
	 		  $("#searchresult").html(result);
	    }});
    }
    //else clear
    else
 		  $("#searchresult").html("");
});
$("#purchasesearchinput").keyup(function(event){
	//if 3 or more letters in search box

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
	    $.ajax({url: "<?php echo "http://".$_SERVER['SERVER_NAME'].str_replace("index.php","",$_SERVER['SCRIPT_NAME'])?>/purchase/search?searchstring="+$("#purchasesearchinput").val(), success: function(result){
	 		  $("#searchresult").html(result);
	    }});
    }
    //else clear
    else
 		  $("#searchresult").html("");
});
$("#clearsearch").click(function(){
 		  $("#searchresult").html("");
	    //hide all password entry boxes
	    $(".password_tr").attr('hidden',true);
});

</script>
