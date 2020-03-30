<?php
    session_start();
    //set logged in user in session
    $user_id = $_SESSION['user_id'];
    //load ticket_details.xml file
    $tkts = simplexml_load_file("xml/ticket_details.xml");
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
                <a href="index.php"><img src="images/logo.png" alt="Ticket managing application" /></a>
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
                  <th scope="col">User Id</th>
                  <th scope="col">Complaint</th>
                  <th scope="col">Date</th>
                  <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                
                    
                <?php
                /*list of tickets*/
                    for($t=0; $t<sizeof($tkts); $t++){
                        echo('<tr>
                                 <th class="row">
                                    <td>'.$tkts->ticket[$t]['id'].'</td>
                                    <td>'.$tkts->ticket[$t]['user_id'].'</td>
                                    <td><a href="display_ticket.php?id='.$tkts->ticket[$t]['id'].'">'.$tkts->ticket[$t]->complaint.'</a></td>
                                    <td>'.$tkts->ticket[$t]['dt'].'</td>
                                    <td>'.$tkts->ticket[$t]->status.'</td>
                                </th>
                            </tr>'
                        );
                    }
                ?>
                
            </tbody>
        </table>
    </main>
</body>
</html>

