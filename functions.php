<?php

function check_login($con){

    if(isset($_SESSION['clients_permis']))
    {

        $permis =  $_SESSION['clients_permis'];
        $query = "SELECT * FROM Clients WHERE Permis = $permis limit 1 " ;

        $result = mysqli_query($con , $query);

        if($result && mysqli_num_rows($result) > 0 ){

                $clients_data = mysqli_fetch_assoc($result);

                return $clients_data;
        }
    }
}

header("location : login.php");
die;