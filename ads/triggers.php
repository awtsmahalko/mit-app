<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DEMO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="triggers.php">Triggers <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stored_procedures.php">Stored Procedure</a>
                </li>
            </ul>
        </div>
    </nav>
    <div style="padding:20px;background-color:#1abc9c;min-height:600px;width:100%;">
        <h1>Triggers</h1>
        <h2>Demo for (MITM1 203 - Advanced Database Systems)</h2>

        <div class="row">
            <div class="col-md-4">
                <h3>INSERT</h3>
                <p>CREATE TRIGGER `insert` AFTER INSERT ON `tbl_text` FOR EACH ROW INSERT INTO tbl_text_triggers (text,triggered_by,datetime) VALUES (NEW.text,'INSERT',NOW())</p>
            </div>
            <div class="col-md-4">
                <h3>UPDATE</h3>
                <p>CREATE TRIGGER `update` AFTER UPDATE ON `tbl_text` FOR EACH ROW INSERT INTO tbl_text_triggers (old_text,text,triggered_by,datetime) VALUES (OLD.text,NEW.text,'UPDATE',NOW())</p>
            </div>
            <div class="col-md-4">
                <h3>DELETE</h3>
                <p>CREATE TRIGGER `delete` AFTER DELETE ON `tbl_text` FOR EACH ROW INSERT INTO tbl_text_triggers (old_text,triggered_by,datetime) VALUES (OLD.text,'DELETE',NOW())</p>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="padding:5px;">#</th>
                            <th style="padding:5px;">ID</th>
                            <th style="padding:5px;">TEXT</th>
                            <th style="padding:5px;">DATE</th>
                            <th style="padding:5px;"></th>
                        </tr>
                    </thead>
                    <tbody id="text-content">
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="padding: 5px;">#</th>
                            <th style="padding: 5px;">OLD TEXT</th>
                            <th style="padding: 5px;">NEW TEXT</th>
                            <th style="padding: 5px;">TRIGGERED BY</th>
                            <th style="padding: 5px;">DATE TIME</th>
                        </tr>
                    </thead>
                    <tbody id="text-triggers-content">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        fetchText();
        fetchTextTriggers();

        function fetchText() {
            $.post("fetch_text.php", {
                type: ''
            }, function(data, status) {
                $("#text-content").html(data);
            });
        }

        function fetchTextTriggers() {
            $.post("fetch_text_triggers.php", {}, function(data, status) {
                $("#text-triggers-content").html(data);
            });
        }

        function addText() {
            var text = $("#text-form").val();
            $.post("add_text.php", {
                text: text,
                id: 0
            }, function(data, status) {
                fetchText();
                fetchTextTriggers();
                $("#text-form").val('');
            });
        }

        function updateText(id) {
            var text = $("#text-" + id).html();
            $.post("add_text.php", {
                text: text,
                id: id,
                mode: 'update'
            }, function(data, status) {
                fetchText();
                fetchTextTriggers();
            });
        }

        function deleteText(id) {
            $.post("add_text.php", {
                text: '',
                id: id,
                mode: 'delete'
            }, function(data, status) {
                fetchText();
                fetchTextTriggers();
            });
        }
    </script>
</body>

</html>