<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DEMO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="triggers.php">Triggers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stored_procedures.php">Stored Procedure</a>
                </li>
            </ul>
        </div>
    </nav>

    <div style="padding:20px;background-color:#1abc9c;min-height:600px;">
        <h1>Triggers and Stored Procedures</h1>
        <h2>Demo for (MITM1 203 - Advanced Database Systems)</h2>
        <br>
        <p>Prepared By:<br>Eduard Rino Q. Carton</p>
    </div>

</body>

</html>
<!-- 
CREATE TABLE `tbl_text` (
  `text_id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`text_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_text_triggers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `old_text` varchar(255) DEFAULT '',
  `text` varchar(255) DEFAULT '',
  `triggered_by` varchar(50) DEFAULT '',
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4; -->