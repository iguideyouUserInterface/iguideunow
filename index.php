<?php
session_start();
//mysql_connect ('localhost', 'blogyblogyuser', '123456') ;
//mysql_select_db ('blogyblogy');
//require_once 'writecomment.php';
require_once 'functions.func.php';
isLoggedIn();
hasLoggedOut();
 
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>iguideU.com</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="style.css" rel="stylesheet" type="text/css" />
   		<script type="text/javascript" src="jquery-1.4.2.min.js"></script>

    </head>
    
    <body>
        <div class="wrapper">
            <?
            displayTop();
            displayNav();
            ?>

            <div id="content">
                <div class='posts'>
	    		<?
	    		displayContent();
	    		//displayForm();
	    		?>
            	<div id ="footer">
					
                	<p>Copyright 2010 Susan Sarabia</p>              
            	</div>
                </div>
            </div>
        </div>
    </body>
</html>