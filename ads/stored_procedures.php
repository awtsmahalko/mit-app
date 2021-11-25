<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Stored Procedures</title>
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="triggers.php">Triggers</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="stored_procedures.php">Stored Procedure <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div style="padding:20px;background-color:#1abc9c;min-height:600px;width:100%;">
        <h1>Stored Procedures</h1>
        <h2>Demo for (MITM1 203 - Advanced Database Systems)</h2>
        <br>
        <div class="row">
            <div class="col-md-4">
                <h3>INSERT</h3>
                <p>CREATE PROCEDURE `insert_text`(IN `text_data` VARCHAR(255)) NOT DETERMINISTIC MODIFIES SQL DATA SQL SECURITY DEFINER BEGIN INSERT INTO tbl_text (text,datetime) VALUES(text_data,NOW()); END</p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Text Data" aria-label="Text Data" aria-describedby="basic-addon2" id="use-insert">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="useInsert()">Use</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h3>UPDATE</h3>
                <p>CREATE PROCEDURE `update_text`(IN `text_data` VARCHAR(255), IN `text_data_id` INT(11)) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER BEGIN UPDATE tbl_text SET text = text_data,datetime = NOW() WHERE text_id = text_data_id; END</p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Text Data" aria-label="Text Data" aria-describedby="basic-addon2" id="use-update">
                    <input type="number" class="form-control" placeholder="ID" aria-label="ID" aria-describedby="basic-addon2" id="use-update-id">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" onclick="useUpdate()">Use</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h3>DELETE</h3>
                <p>CREATE PROCEDURE `delete_text`(IN `text_data_id` INT(11)) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER BEGIN DELETE FROM tbl_text WHERE text_id = text_data_id; END</p>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="ID" aria-label="ID" aria-describedby="basic-addon2" id="use-delete-id">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" onclick="useDelete()">Use</button>
                    </div>
                </div>
            </div>


            <div class="col-md-3 text-center">
                <h3>COMMAND</h3>
                <textarea class="form-control" name="as" id="command" rows="5"></textarea>
            </div>
            <div class="col-md-3 text-center">
                <h3>RESPONSE</h3>
                <textarea class="form-control" name="as" id="response" rows="5"></textarea>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="padding:5px;">#</th>
                            <th style="padding:5px;">ID</th>
                            <th style="padding:5px;">TEXT</th>
                            <th style="padding:5px;">DATE</th>
                        </tr>
                    </thead>
                    <tbody id="text-content">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        fetchText();

        function fetchText() {
            $.post("fetch_text.php", {
                type: 'no-add'
            }, function(data, status) {
                $("#text-content").html(data);
            });
        }

        function execute() {
            var command = $("#command").val();
            $.post("execute_command.php", {
                command: command
            }, function(data, status) {
                $("#command").html(data);
                fetchText();
            });
        }

        function useInsert() {
            var use_insert = $("#use-insert").val();
            if (use_insert != '') {
                $.post("execute_command.php", {
                    command: 'insert',
                    text: use_insert
                }, function(data, status) {
                    var res = JSON.parse(data);
                    $("#command").html(res.command);
                    $("#response").html(res.response);
                    fetchText();
                });
                // $.post("clean.php", {
                //     text: use_insert
                // }, function(data, status) {
                //     var command = "SET @p0='" + data + "'; CALL insert_text(@p0);";
                //     $("#command").val(command);
                // });
            } else {
                $("#command").val("");
                alert("Please input text");
            }
        }

        function useUpdate() {
            var use_update = $("#use-update").val();
            var use_id = $("#use-update-id").val() * 1;
            if (use_update != '' && use_id > 0) {
                $.post("execute_command.php", {
                    command: 'update',
                    text: use_update,
                    id: use_id
                }, function(data, status) {
                    var res = JSON.parse(data);
                    $("#command").html(res.command);
                    $("#response").html(res.response);
                    fetchText();
                });
            } else {
                $("#command").val("");
                alert("Please input text");
            }
        }

        function useDelete() {
            var use_id = $("#use-delete-id").val() * 1;
            if (use_id > 0) {
                $.post("execute_command.php", {
                    command: 'delete',
                    id: use_id
                }, function(data, status) {
                    var res = JSON.parse(data);
                    $("#command").html(res.command);
                    $("#response").html(res.response);
                    fetchText();
                });
            } else {
                $("#command").val("");
                alert("Please input text");
            }
        }
    </script>
</body>

</html>