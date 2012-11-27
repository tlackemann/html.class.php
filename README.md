#html.class.php

A pretty HTML class to use with any PHP project

To use, include the file and instantiate

		<?php
    	require_once('html.class.php');
    	$html = new HTML();
    ?>

###Basic Document Construction

Input

    <?php
			$html = new HTML();
			$html->begin_document('My cool webpage',array('application'),array('jquery','application'));

			$elements = array(
			  'Name: ' => $html->text_tag('name'),
			  'Gender: ' => $html->select_tag('gender', array(''=>'--Select--', 'm'=>'Male','f'=>'Female')),
			  $html->submit_tag('submit', 'Submit Form')
			);
			echo $html->make_form('user', $elements, $options = array('action'=>'signup.php', 'method'=>'post'));

			$html->end_document();
		?>

Output

		<!DOCTYPE html>
		<html>
		<head>
		  <title>My cool webpage</title>
		  <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/application.css" />
		  <script src="javascripts/jquery.js"></script>
		  <script src="javascripts/application.js"></script>
		  <!--[if lt IE 9]>
			  <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
		</head>
		<body>
		<form name="user" action="signup.php" method="post">
		  <div>
		    <label>Name: </label>
		    <input type="text" name="name" value="">
		  </div>
		  <div>
		    <label>Gender: </label>
		    <select name="gender">
		      <option value="" selected="selected">--Select--</option>
		      <option value="m">Male</option>
		      <option value="f">Female</option>
		    </select>
		  </div>
		  <div>
		    <input type="submit" name="submit" value="Submit Form">
		  </div>
		</form>
		</body>
		</html>

See source code for more documentation

http://www.whoistom.me