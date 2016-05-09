
8<?php


        $serverlocation = ""; // Network Location of the MySQL installation.
        $username = ""; // Username used for logging into the MySQL server.
        $password = ""; // Password used for logging into the MySQL server.
        $databasename = ""; // Name of the database that the email table is stored in.


        $conn = new mysqli($serverlocation, $username, $password, $databasename); // Sets the variable $conn as the credentials needed to login to the database.


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error); // Shows an error message if the connection to the database fails.
        } 


        $sql = "SELECT ID, address FROM addresses"; // Attempts to select the columns ID and address from the Table addresses in the database.
        $result = $conn->query($sql); // Sets the variable $result as a query to the database.


        if ($result->num_rows > 0) { // If Rows exist within the database


            while($row = $result->fetch_assoc()) { // Fetches Rows from Database


                mkdir('/folders/that/sort/images/by/id' . $row["ID"] . '/' , 0777, true); // Creates the necessary directories for the images to be saved in. 

                $rawurl40 = 'http://www.gravatar.com/avatar/' .md5( $row["address"] ). '?s=40&d=404/'; // Builds the raw URL of the Gravatars that will be used to save the images from (40px).
                $rawurl80 = 'http://www.gravatar.com/avatar/' .md5( $row["address"] ). '?s=80&d=404/'; // Builds the raw URL of the Gravatars that will be used to save the images from (80px).
                $rawurl190 = 'http://www.gravatar.com/avatar/' .md5( $row["address"] ). '?s=190&d=404/'; // Builds the raw URL of the Gravatars that will be used to save the images from (190px).
                $rawurl200 = 'http://www.gravatar.com/avatar/' .md5( $row["address"] ). '?s=200&d=404/'; // Builds the raw URL of the Gravatars that will be used to save the images from (200px).

                $htmlimglink = '<img src="http://www.gravatar.com/avatar/' .md5( $row["address"] ). '" width="200px" height="200px">'; // Builds the HTML URL of the Gravatars for the images to be displayed from once they are saved.


                echo "ID: " . $row["ID"]. " - Email Hash: " . md5( $row["address"] ). " " . "<br>"; // Displays the ID and Hash of each individual record once the images have been saved.
                echo "ID: " . $row["ID"]. " - Email: " . $row["address"]. " " . "<br><br>"; // Displays the actual Email address of each indiviidual record once the images have been saved.
                echo $htmlimglink; // Displays the Gravatars to the page from the HTML URL built on line 25.
                echo "<br><br>"; // General Styling
                echo "<hr />"; // General Styling


                $directory = '/root/directory/where/id/folders/are/stored' . '/' . $row["ID"] . '/'; // Sets the directories for the images to be saved in to the directories created earlier.

                $content40 = file_get_contents($rawurl40); // Fetches each Gravatar
                file_put_contents($directory . $row["address"] . '-40.jpg', $content40); // Saves each Gravatar under the relevant file name and directory. (40px)

                $content80 = file_get_contents($rawurl80); // Fetches each Gravatar
                file_put_contents($directory . $row["address"] . '-80.jpg', $content80); // Saves each Gravatar under the relevant file name and directory. (80px)

                $content190 = file_get_contents($rawurl190); // Fetches each Gravatar
                file_put_contents($directory . $row["address"] . '-190.jpg', $content190); // Saves each Gravatar under the relevant file name and directory. (190px)

                $content200 = file_get_contents($rawurl200); // Fetches each Gravatar
                file_put_contents($directory . $row["address"] . '-200.jpg', $content200); // Saves each Gravatar under the relevant file name and directory. (200px)


            }


        } 

        else {
            echo "There are no records in the database for the script to read. It's empty."; // Displays if there are no records in the database.
        }


        $conn->close(); // Closes connection to the database once the script has completed.
        

?>