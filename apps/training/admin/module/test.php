<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script src="../../../../libraries/javascript/jquery_ui_timepicker_addon.js"></script>
<script src="../../../../libraries/javascript/options_update.js"></script> 
</head>

<span class="inputname">
    Project Images:
    <a href="#" class="cmd_add_answer">
        Add
    </a>
</span>

<div class="project_images">
    <div>
    	<input name="upload_project_images[]" type="file" />
        <a href="#" class="cmd_remove_answer" border="2">Remove</a>
    </div>
</div>

<script>
$(document).ready(function(e) {
    <?php
		for($i=0; $i<5; $i++)
		{
	?>
			$(".project_images").append(
        '<div>'
      + '<input name="upload_project_images[]" type="file" class="new_project_image" /> '
      + '<a href="#" class="cmd_remove_answer" border="2">Remove <?php echo $i ?></a>'
      + '</div>');
		
	<?php
		}
	?>
});

// Add new input with associated 'remove' link when 'add' button is clicked.
$('.cmd_add_answer').click(function(e) {
    e.preventDefault();

    $(".project_images").append(
        '<div>'
      + '<input name="upload_project_images[]" type="file" class="new_project_image" /> '
      + '<a href="#" class="cmd_remove_answer" border="2">Remove</a>'
      + '</div>');
});

// Remove parent of 'remove' link when link is clicked.
$('.project_images').on('click', '.cmd_remove_answer', function(e) {
    e.preventDefault();

    $(this).parent().remove();
});
</script>

<body>
</body>
</html>

