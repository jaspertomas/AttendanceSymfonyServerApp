  
            <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_employee_name">
        <div>
      <label for=""></label>
      <div class="content">
      
      <?php echo link_to(
      "<img width=25% src=\""
      ."http://".$_SERVER['SERVER_NAME'].str_replace(array("index.php","frontend_dev.php"),"",$_SERVER['SCRIPT_NAME'])
      ."/uploads/"
      .$form->getObject()->getFilename()
      ."\">"
		,      
      "record/zoom?id=".$form->getObject()->getId()
      );?>
      
      </div>

          </div>
          </div>