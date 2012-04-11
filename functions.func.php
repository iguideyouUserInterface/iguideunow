<?php

function hasLoggedOut(){
	if(isset($_POST['logout'])) {
            $_SESSION['user'] = false;
            if(isset($_SESSION['id'])) {
        	$_SESSION = array();
        	unset($_SESSION['email']);
        	unset($_SESSION['user']);
	        session_destroy();
            }
	}
}

function isLoggedIn() {
	 if (!isset($_SESSION['id'])) {
         
            require_once 'databaseconnect.php';

            if(!empty($_POST['email']) && !empty($_POST['password'])) {   // To "sanitize" our inputs
            
                $email = mysql_real_escape_string($_POST['email']);   // To protect MySQL injection
                $password = mysql_real_escape_string($_POST['password']);   // To protect MySQL injection
            
                $grabrow = mysql_query("SELECT * FROM users WHERE email = '$email'") or die
                ("MySQL Error: ".mysql_error());
                //if only one row was retrieved
                if (mysql_num_rows($grabrow) == 1) {
                     //create array from row field
                     $row = mysql_fetch_array($grabrow);

                     //store the users and email salt in a var
                     $salt = $row['usersalt'];
                     $email = $row['email'];

                     //$combine = $email . $password . $salt;
                     $combine = $password . $salt . $password;

                     //authenticate password with has function
                     $authenticatedpassword = sha1($combine);

                     // check database for username and the rehash pass
                     $checklogin = mysql_query("SELECT * FROM users WHERE email = '$email' AND password = '$authenticatedpassword'") or die
                    ("MySQL Error: ".mysql_error());

                    if(mysql_num_rows($checklogin) == 1) {

                        $id = mysql_result($checklogin, 0, 'id');
                        $_SESSION['id']= $id;
                        $_SESSION['email'] = $email;
                        $_SESSION['user'] = true;
                    } else {
                   
                        echo '<h1> Not authenticated boooo!</h1>';
                    }

                } else {
                    echo '<h1> you are not in database!</h1>';
                }
            }
	}
}

function displayTop() {
    ?>
    <div id="top">
        <h1>Welcome to iguideU.com</h1>
		<div id="links">
			<a href='index.php'>Home</a>
			<a href='registration.html'>Register</a> 
        </div>
    </div>

    <?
}


function displayNav(){
    ?>
    <div id="nav">
        <div id="form1">
        <?
        if (!isset($_SESSION['id'])) {
        	?>
        	<form name="form1" method="post" action="?">
            	<label for='username'>Username</label>
           		<input name="email" type="text" id="email" size="30" />
            	<label for='password'>Password</label>
            	<input name="password" type="password" id="password" size="30" />
                <br />
                <input type="submit" name="login" value="Log in" /> 
            </form>        	
           <?
        } else {
        	echo "<p>You are now logged in as: <br /> " . $_SESSION['email'] . "</p>";
        	?>
        	<form name="form1" method="post" action="?">
        		<input type="submit" name="logout" value="Log out" /> 
        	</form>
        	<?
        }
        ?>
        </div>
    </div>
        
    <?
}
            
		
function displayContent() {
	
	/* This part captor the session id of the user who logs in.
	* puts the session in a local variable to be used with the query.
	* the query will then get the right documents from mySql database and display them.
	*/
	if (isset($_SESSION['id'])) {
		echo "<p>You are in this session under id:  <br /> " . $_SESSION['id'] . "</p>";
		$id = $_SESSION['id'];
		require_once 'databaseconnect.php';
		$query = "SELECT * FROM document WHERE userid = $id "or die
	    ("MySQL Error: ".mysql_error());
		$result = mysql_query($query) or print
	    ("Can't select entry from table .<br />"
	    . $query . mysql_error());
	
		while($row = mysql_fetch_array($result)) {
	        echo "<div id= 'innerblog'>" . "<p>" . $row['docid'] .
	        "<br/>". "written by:".$row['userid']."<br/>".$row['docname']. "</p>"."</div>";
	    }
	}
	//*********************************	
	/* use the below code as an example
	* be careful whe you delete code
	* comment your code at all times!!!
	*/
	
	/*
    if(isset($result)) {
        //$title = "";
        //$entry = "";
		$docid = "";
		$userid = "";
	while($row = mysql_fetch_array($result)) {
            echo "<div id= innerblog>" . "<h2>" . $row['docid'] . "</h2>" .
            "<p>" . $row['userId'] ."</p>"; // . "<i>" . $row['blogdate'] . "</i>" .
            //' <a href="?">read more</a>' . "</div>";
	}
		
    } else {

        require_once 'databaseconnect.php';
        
        	//if(isset($_POST['categorySearch']) && !($_POST['category']=='all')) {
        	//$chosenCategory = $_POST['category'];        	    	
        	$query = "SELECT * FROM document
        	WHERE userid = $_SESSION['id']";
        	//ORDER BY blogdate DESC";
    		$result = mysql_query($query) or print 
    			("Can't select entry from table blog.<br />"
    			. $query . mysql_error());
    		$title = "";
    		$entry = "";	
        } else {
        	$query = "SELECT * FROM document ";                  
        	//ORDER BY blogdate DESC";
    		$result = mysql_query($query) or print 
    		("Can't select entry from table blog.<br />"
    		. $query . mysql_error());
    		$docid = "";
    		$userid = "";
        }
        	while($row = mysql_fetch_array($result)) {
            	$var = $row['id'];
            	//$queryTwo = "SELECT COUNT(idcomment) FROM comment WHERE blogid='$var'";
            	//$resultTwo = mysql_query($queryTwo) or die('Query failed: ' . mysql_error());
            	//while($rowTwo = mysql_fetch_array($resultTwo)){
            	//$var = $rowTwo[0];
			}
        	echo "<div id= innerblog>" . "<h2>" . $row['userid'] . "</h2>" .
            "<p>" . $row['docid'] ."</p>".$row['docname']; // . "<i>" . $row['blogdate'] . 
           // " posted in category " . $row['category'] . "</i>"."</div>";

            ?>
           
            <ul class="accordion">
                <li id="acc">                    
                    <div id="comments<?= $row['postid'] ?>" ></div>
                    <h2>
                        <a href="#acc" id="commentButton<?= $row['postid'] ?>"
                         name ="showcomment" class="showcomment"  >Comments
                        </a>
                        <a href="#post<?postid?>" id="showNumComments<?= $row['postid'] ?>)">
                         <?echo $var ?></a>
                    </h2>
                </li>
                <div id="blog"></div>
            </ul>
            <ul class="comform">
                <li id="comf">
                    <a class="commentform" id="formcomment<?= $row['postid'] ?>" 
                    href="writecomment.php?postid=<?= $row['postid'] ?>">Write new comment</a>
                </li>
            </ul>
            <div class="writecomment" id="shownewcomment<?= $row['postid'] ?>">
                <?php printCommentForm($row['postid']);?>
            </div>

            <?php
                                       
            /*	if(isset($_POST['showcomment'])) {
                    include_once 'getcomment.php';
                }
                if(isset($_POST['commentform'])) {
                    include_once 'writecomment.php';
                }*7
	}
    }
*/
} //close the displayContent() function


function displayForm() {
   if(isset($_SESSION['username'])) {
        $title = "";
        $entry = "";
         ?>
        <form action='?' method='post'>
            <label for='title'>Title</label>
            <input  type='text' name='title' id='title' value='<?=$title;?>' /><br />
            <label for='entry'>New Post</label>
            <input type='text' name='entry' id='entry' value='<?=$entry;?>' /><br />
            <label for='category'>Category</label>
            <select name='category'>
            	<option value='chicken'>Chicken</option>
            	<option value='lion'>Lion</option>
            	<option value='snake'>Snake</option>
            	<option value='dog'>Dog</option>
            	<option value='cat'>Cat</option>
            </select><br />
            <input type='hidden' name='postid' value='<?=$postid?>' />
            <input type='submit' name='new_entry' value='New Post!' />
        </form>

        <?php
        if(isset($_POST['new_entry'])) {
            $title = stripslashes($_POST['title']);
            $entry = stripslashes($_POST['entry']);
            $username = $_SESSION['username'];
            $postid = $_POST['postid'];
            $userid = $_SESSION['id'];
            $category = $_POST['category'];
         
            $query = "INSERT INTO blog
                   (title,entry,blogdate,userid,category)
                VALUES ('$title','$entry',NOW(), '$userid', '$category')";
            if(mysql_query($query)) {
                echo "Your post has been saved into the database!";
            } else {
                echo "Something is wrong!";
                }

	}
    }
}//close the displayForm() function



function statistics($currentUserId){
	
	require_once 'databaseconnect.php';

	$numberOfPosts=0;
	$numberOfComments=0;
	
	$query = "SELECT postid FROM blog WHERE userid = '$currentUserId'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	
 	while($row = mysql_fetch_array($result)){
		$postid = $row[0];
		$numberOfPosts++;

					
		$queryTwo = "SELECT idcomment FROM comment WHERE blogid = '$postid'";
		$resultTwo = mysql_query($queryTwo) or die('Query failed: ' . mysql_error());
			
		while($rowTwo = mysql_fetch_array($resultTwo)){
			$commentid = $rowTwo[0];
			$numberOfComments++;
		}
	}	
	$avarage = ((1*($numberOfComments))/(1*($numberOfPosts)));
	
	echo "you have a total of " . $numberOfPosts . " number of posts, a total of " . 
	$numberOfComments . " number of comments with an avarage of " . 
	$avarage . "comments for each post.<br />";

        function numberOfComments($numberOfComments) {
            echo  $numberOfComments;
        }
	function getEntries($currentUserId) {

            $query = "SELECT * FROM blog
                  WHERE userid = '$currentUserId'";

            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            while($row = mysql_fetch_array($result)) {
                
                $rows[] = $row;
                $user_menu = "
                <a href='?delete={$row['postid']}'>Ta bort</a>
                <a href='?edit={$row['postid']}'>Redigera</a>
                ";
            
                echo "
                <p>postid:{$row['postid']}</p>
                <p>posttitle:{$row['title']}</p>
                <p>entry:{$row['entry']}</p>
                <p>{$row['blogdate']}</p>
                <p>userid:{$row['userid']}</p>
                $user_menu
                <hr />
                ";
            }
            $user_menu = "";
	}
        function deleteEntry($delete_id){
            $query = "DELETE FROM blog WHERE postid = $delete_id";
            $result = mysql_query($query);
            return $result;
        }
        function printEntryForm($title="",$entry="",$postid=""){
    	?>
    	<form action='?' method='post'>
            <label for='title'>Title</label>
            <input type='text' name='title' id='title' value='<?=$title;?>' /><br />
            <label for='entry'>Entry</label>
            <textarea name='entry' id='entry' value='<?=$entry;?>'></textarea>
            <input type='hidden' name='postid' value='<?=$postid?>' />
            <input type='submit' name='edit_entry' value='Send Post!' />
        </form>
        <hr />
        <?php
        }
    
        function getEntry($edit_id){
            $query = "SELECT * FROM blog WHERE postid=$edit_id LIMIT 1";
            $result = mysql_query($query) or die(mysql_error());
            return mysql_fetch_assoc($result);
        }
    
        function addEntry($title,$entry,$postid){
            if($postid) {
                $query = "UPDATE blog
                SET title = '$title',
                entry = '$entry'
                WHERE postid = $postid
                ";
            } else {
                $query = "INSERT INTO blog
                (title,entry,postid,date)
                VALUES ('$title','$entry','$postid',NOW())
          	";
            }

            if(mysql_query($query)){
                echo "Your post has been saved!";
            } else {
                echo "Something went wrong booooo!";
            }
        }
}//close the statistics() function
?>