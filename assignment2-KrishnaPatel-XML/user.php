<?php
/*start the session*/
session_start();
/*fetch the same user who loged in*/
	$user_id = $_SESSION['user_id'];
	$user_tkts = [];

	/*loading tickets xml file*/
	$tkts = simplexml_load_file("xml/ticket_details.xml");
	/*tickets of the same user*/
	for($i = 0; $i<sizeof($tkts); $i++){
        if( $tkts->ticket[$i]['user_id'] == $user_id){
            array_push($user_tkts,$tkts->ticket[$i]);
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
		<div  class="container-fluid">
			<div class="logo col-md-2">
			<!--logo image-->
				<a href="#"><img src="images/logo.png" alt="Ticket managing application" /></a>
				<p>Ticket Application</p>
			</div>
		</div>

	</header>
	<main class="text-center col-md-8 align-center">
		<a href="index.php"><input type="submit" class="btn btn-secondary logout-btn" name="logout" value="Logout"/></a>
		
		<h1>List of Tickets</h1>
		<table class="table">
  			<thead class="thead-dark">
			    <tr>
			      <th scope="col">No.</th>
			      <th scope="col">Date</th>
			      <th scope="col">Complaint</th>
			      <th scope="col">Status</th>
			    </tr>
			</thead>
			<tbody>
			    <tr>
			    	
			    <?php
			    /*list of tickets of that user*/
                    for($t=0; $t<sizeof($user_tkts); $t++){
                        echo('<th class="row">
                                <td> '.($t+1).' </td>
                                <td> '.$user_tkts[$t]['dt'].' </td>
                                <td> <a href="display_tkt.php?id='.$user_tkt[$t]['id'].'">'.$user_tkts[$t]->complaint.'</a> </td>
                                <td> '.$user_tkts[$t]->ticket_status.' </td>
                            </th>');
                    }
                ?>
			    </tr>
			</tbody>
		</table>
	</main>
</body>
</html>
