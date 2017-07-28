<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset='UTF-8'>

	<title>Dynamic Dropdown</title>

	<link rel='stylesheet' href='css/style.css'>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

	
</head>

<body>

    <div id="demo-top-bar">

  <div id="demo-bar-inside">

    <h2 id="demo-bar-badge">
      <a href="/">CSS-Tricks Example</a>
    </h2>

    <div id="demo-bar-buttons">
          </div>

  </div>

</div>
	<div id="page-wrap">
		<h1>Pulls from MySQL Database</h1>

		<select id="db-one" onChange="update_options(this)">
			<option selected value="base">Please Select</option>
			<option value="beverages">Beverages</option>
			<option value="snacks">Snacks</option>
		</select>

		<br />

		<select id="db-two" class="update_source_db-one">
			<option>Please choose from above</option>
		</select>

	</div>
    
    <div id="page-wrap">
		<h1>Pulls from MySQL Database</h1>

		<select id="db-one1">
			<option selected value="base">Please Select</option>
			<option value="beverages">Beverages</option>
			<option value="snacks">Snacks</option>
		</select>

		<br />

		<select id="db-two1">
			<option>Please choose from above</option>
		</select>

	</div>
    
    <div id="page-wrap">
		<h1>Pulls from MySQL Database</h1>

		<select id="db-one2">
			<option selected value="base">Please Select</option>
			<option value="beverages">Beverages</option>
			<option value="snacks">Snacks</option>
		</select>

		<br />

		<select id="db-two2">
			<option>Please choose from above</option>
		</select>

	</div>

	 <style type="text/css" style="display: none !important;">
	* {
		margin: 0;
		padding: 0;
	}
	body {
		overflow-x: hidden;
	}
	#demo-top-bar {
		text-align: left;
		background: #222;
		position: relative;
		zoom: 1;
		width: 100% !important;
		z-index: 6000;
		padding: 20px 0 20px;
	}
	#demo-bar-inside {
		width: 960px;
		margin: 0 auto;
		position: relative;
		overflow: hidden;
	}
	#demo-bar-buttons {
		padding-top: 10px;
		float: right;
	}
	#demo-bar-buttons a {
		font-size: 12px;
		margin-left: 20px;
		color: white;
		margin: 2px 0;
		text-decoration: none;
		font: 14px "Lucida Grande", Sans-Serif !important;
	}
	#demo-bar-buttons a:hover,
	#demo-bar-buttons a:focus {
		text-decoration: underline;
	}
	#demo-bar-badge {
		display: inline-block;
		width: 302px;
		padding: 0 !important;
		margin: 0 !important;
		background-color: transparent !important;
	}
	#demo-bar-badge a {
		display: block;
		width: 100%;
		height: 38px;
		border-radius: 0;
		bottom: auto;
		margin: 0;
		background: url(/images/examples-logo.png) no-repeat;
		background-size: 100%;
		overflow: hidden;
		text-indent: -9999px;
	}
	#demo-bar-badge:before, #demo-bar-badge:after {
		display: none !important;
	}
</style>

<script>	
		function update_options(val)
		{
			$update_select_id = $(val).attr('id');
			
			alert($update_select_id);
			//var i=row.parentNode.parentNode.rowIndex;
			//document.getElementById('tbl_sub_visit').deleteRow(i);
			
			$(".update_source_" + $update_select_id).load("http://ehs.uky.edu/apps/inspection_dev/inspection_saa_corrections_list.php?choice=" + $(val).val());
		}
		
		$(function() {
			$(".source_update").change(function() {
				//$("#db-one").load("http://ehs.uky.edu/apps/inspection_dev/inspection_saa_corrections_list.php?choice=" + $("#db-one").val());
			});

		});
		
		
		
	</script>

</body>

</html>