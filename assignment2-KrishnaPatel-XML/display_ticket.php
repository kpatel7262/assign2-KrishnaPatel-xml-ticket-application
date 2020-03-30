<?php
	session_start();
    
    $user_id = $_SESSION['user_id'];
    //load ticket_details.xml file
    $tkts = simplexml_load_file('xml/ticket_details.xml');
   
    //load user_details.xml file
    $users = simplexml_load_file('xml/user_details.xml');
    $tkt_id = $_GET['id'];
    $user_tkts = [];
    
    
    for($t = 0; $t<sizeof($tkts); $t++){
        if($tkts->ticket[$t]['id'] == $tkt_id){
           $tkt_userid = $tkts->ticket[$t]['user_id'];
           $tkt_complaint = $tkts->ticket[$t]->complaint; 
           $tkt_status = $tkts->ticket[$t]->ticket_status;
           $tkt_msgs = $tkts->ticket[$t]->reply;
        }
    }

    //message sending feature
    if(isset($_POST['send_msg'])){
        if($_POST['msg_detail'] != "" || $_POST['msg_detail'] != null){
            $msg_detail = $_POST['msg_detail'];
            $reply = $tkts->ticket[$tkt_id-1]->addChild('reply', $msg_detail);
            $reply->addAttribute('sender', $user_id);
            $tkts->saveXML('xml/ticket_details.xml');
        }
    }
?>
<html>
<head>
	<title>Ticket Application</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="styles/stylesheet.css" />
</head>
<body>
	<!--header starts here -->
	<header>
		<div class="container-fluid">
			<div class="logo col-md-2">
			<!--logo image-->
				<a href="index.php"><img src="images/logo.png" alt="Ticket managing application" /></a>
				<p>Ticket Application</p>
			</div>
		</div>
	</header>
	<main class="text-center col-md-8 align-center">
		<a href="index.php"><input type="submit" class="btn btn-secondary logout-btn" name="logout" value="Logout"/></a>


		<h3>Ticket Details</h3>
		<form class="form-group" name="login_form" method="post">
				<div class="chatbox col-md-12">
					<div>
	                    <?php
	                        foreach($tkt_msgs as $tkt_msg){
	                            
	                                echo('
	                                <div class="tags-left"> Message : '.$tkt_msg.'</div>
	                                <br/>
	                            	');
	                            	
	                            
	                        }
	                    ?>
	                </div>

					<input type="text" name="msg_detail" placeholder="Enter your complaint">
		            <input type="submit" name="send_msg" class="submit-button" value="Send">
					
				</div>
				<div class="tags-left">User Id:<?= $tkt_userid?></div>
			        <div class="tags-right">Status:<?= $tkt_status?></div>		           

		</form>
	</main>
</body>
</html>