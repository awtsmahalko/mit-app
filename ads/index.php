<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #04AA6D;
        }
    </style>
</head>

<body>

    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="triggers.php">Triggers</a></li>
        <li><a href="#contact">Stored Procedures</a></li>
    </ul>

    <div style="padding:20px;margin-top:30px;background-color:#1abc9c;min-height:600px;">
        <h1>Triggers and Stored Procedures</h1>
        <h2>Demo for (MITM1 203 - Advanced Database Systems)</h2>
        <br>
        <p>Prepared By:<br>Eduard Rino Q. Carton</p>
    </div>

</body>

</html>