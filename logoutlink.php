 <?php
 include('config.php');

session_start(); 

            $user = $_SESSION['UserName'];
            $sessName = "p2_" . $user . "_session";
            $fileName = $sessName . ".txt";
            $last_login = $_SESSION["Timestamp"];
            $hand = fopen($fileName,"w");
            fwrite($hand, $last_login);
            fclose($hand);
            session_unset();
            session_destroy();
            header("Location: ./login.php");
            ?>
