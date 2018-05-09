<?php


$serverlocation = ""; // Network Location of the MySQL installation.
$username = ""; // Username used for logging into the MySQL server.
$password = ""; // Password used for logging into the MySQL server.
$databasename = ""; // Name of the database that the email table is stored in.
$tableName = ""; // mySQL Table where the emails are stored
$emailColumn = ""; // mySQL Column Name the Email addresses are stored in
$idColumn = ""; // mySQL Column Name the ID's of the Email addresses are stored in
$rootSaveLocation = ""; // Save location for images, please add a trailing slash

$connector = new mysqli( $serverlocation, $username, $password, $databasename ); // Sets the variable $connector as the credentials needed to login to the database.


if ( $connector->connect_error ) {
    die( "Connection failed: " . $connector->connect_error ); // Shows an error message if the connection to the database fails.
}


$sql = "SELECT " . $idColumn . " , " . $emailColumn . " FROM " . $tableName; // Attempts to select the columns ID and address from the Table addresses in the database.
$result = $connector->query( $sql ); // Sets the variable $result as a query to the database.


if ( $result->num_rows > 0 ) { // Checks if Rows exist within the table


    while ( $row = $result->fetch_assoc() ) { // Fetches Rows from table

        mkdir($rootSaveLocation, 777, true); // Creates the root directory for the image directories to be stored in
        mkdir( $rootSaveLocation . $row[$emailColumn] . '/' , 777, true ); // Creates the necessary directories for the images to be saved in.
        $imagesizes = array( '40', '80', '200' ); // Array defining the image sizes to be saved in px (e.g 190 in the array represents an 190px * 190px image)
        $htmlimglink = '<img src="http://secure.gravatar.com/avatar/' .md5( $row[$emailColumn] ). '&d=404/">'; // Builds the HTML URL of the Gravatars for the images to be displayed on the final page from once they are saved (Standard 80px).
        $directory = $rootSaveLocation . '/' . $row[$emailColumn] . '/'; // Sets the directories for the images to be saved in to the directories created earlier.


        foreach ( $imagesizes as $urlsizes ) { // Begins cycling the array of image sizes
            $genericurl = 'http://secure.gravatar.com/avatar/' .md5( $row[$emailColumn] ). '?s=' . $urlsizes . '&d=404/'; // Builds the URL to get the image for each address from and returns a 404 error if no Gravatar is found.
            $content = file_get_contents( $genericurl ); // Actually fetches the images from the url built previously
            file_put_contents( $directory . 'profile_photo-' . $urlsizes . '.jpg', $content ); // Saves the images in their respective directories.
            shell_exec('find ' . $rootSaveLocation . ' -empty -type f -delete'); // Finds Empty Files in the root image directory and subdirectories and Removes them (If the email doesn't have a Gravatar set)
            shell_exec('find ' . $rootSaveLocation . ' -empty -type d -delete'); // Finds Empty Directories in the root image directory and Removes them (For directories that contain(ed) empty files when emails don't have a Gravatar set)
        }

        shell_exec('chmod -R 0755 ' . $rootSaveLocation); // Sets the permissions of the root folder and all of its subdirectories to 755 for added security (Useful for Web Servers for example)


        echo "ID: " . $row[$idColumn]. " - Email Hash: " . md5( $row[$emailColumn] ). " " . "<br>"; // Displays the ID and Hash of each individual record once the images have been saved.
        echo "Email: " . $row[$emailColumn]. " " . "<br><br>"; // Displays the actual Email address of each indiviidual record once the images have been saved.
        echo $htmlimglink; // Displays the Gravatars to the page from the HTML URL built in the variable $htmlimglink.
        echo "<br /><br />"; // General Styling
        echo "<hr />"; // General Styling

        $connector->close(); // Closes connection to the database once the script has completed.


    }


}

else {
    echo "There are no records in the database for the script to read. It's either empty or the database is not being read correctly."; // Displays if there are no records in the database or they are not being read properly.
}


$connector->close(); // Closes connection to the database once the script has completed.


?>
