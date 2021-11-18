<?php

/** Core Path **/
define("view", "pages/");
define("base_url", "http://192.168.64.2/PIMS");

/** Database connection **/

/*

define("host","localhost");
define("username","u981310152_root");
define("password","?Hy0nOb3");
define("database","u981310152_pims_db");

*/

define("host", "localhost");
define("username", "root");
define("password", "");
define("database", "pims_db");
/** Auth **/

define("email", "pims.mit2021@gmail.com");
define("email_pass", "pimsmit@2021!");
define("email_no", "09274018956");

define("sms_api_code", "TR-PROCU018956_BPK9X");
define("sms_api_pass", "kdrcb3(!y}");

define("is_dev", "Y");

define("head_procure_entity", "MARLON L. SOLVIO, PhD");

define("school_name", "HIMOGA-AN BAYBAY INTEGRATED SCHOOL");
define("school_head", "MARLON L. SOLVIO, PhD");
define("school_treasurer", "MARY ANN ESTELLOSO");

define("table", "tbl_users");
define("user_session_id", "user_id");
define("passwordHashing", true);
define("error_message", "Your Credentials did not matched");

/** Function / Classes **/

//inside dir
define("VALUE", serialize(array("auth.php", "my_functions.php")));
