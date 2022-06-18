# crash-data-app
## About
This is an all in one web based application for working with [South Australia road crash data](https://data.sa.gov.au/data/dataset/road-crash-data). The app includes a form page for inserting new data and a dashboard page for basic statistical analysis.

The project was inteded as a skills development task for year 12 digital technologies. It uses a combination of PHP and JavaScript.
## Dependencies
### External
* A valid php installation or server
* A valid SQL database - either MariaDB or MySQL must include correct tables (have fun reverse engineering that)
* A file named connect.php in the root of the public folder (format detailed later)
* Ajax jquery - uses google CDN
* Chart js - uses jsdelivr
* Leaflet js - uses unpkg
* Leaflet js CSS file - uses unpkg
* Node SASS
### Bundled dependencies:
* Action.fw - My custom CSS framework (WIP)
* Heatmap js
* Leaflet-heatmap js - Pretty sure this is bundled with base library but included just in case
* Proj4 - Used for coordinate translation (include minified version and src)
### Connect.php
For this application to work a connection to a valid database is required. The below code is an example of a valid database connection script. The values need to be substituted, and the file should be saved in the `public/` directory.
```
<?php
$servername = "SERVERNAME";
$username = "USERNAME";
$password = "PASSWORD";
$db = "DATABASE";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully"; // this is only for testing purposes and can be removed
?> 
```

## Installation
This project can be cloned using:  
```
git clone https://github.com/ERieger/crash-data-app.git
```
Once cloned the public folder can be deployed to a server or pointed to as the root of the project in a program such as uWamp.

You will also require SASS installed to compile any custom CSS changes.
```
npm i
```

## Features
* Data entry form
* Bulk output table
* CSV upload of new data
* Heatmap showing distribution of crashes
* Custom server side data retrieval API
* Dynamic graphs with selectable contact
* Quick printout statistics
