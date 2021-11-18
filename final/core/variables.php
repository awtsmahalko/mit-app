<?php

/** Core Path **/
define("view", "pages/");
define("base_url", "http://eduardcarton.ml/final");

/** Database connection **/



define("host", "localhost");
define("username", "edua_user");
define("password", "edua_pass");
define("database", "edua_db");

/*
define("host", "localhost");
define("username", "root");
define("password", "");
define("database", "mit_db");
*/

/** Auth **/

define("email", "pims.mit2021@gmail.com");
define("email_pass", "pimsmit@2021!");
define("email_no", "");

define("sms_api_code", "");
define("sms_api_pass", "");

define("is_dev", "Y");

define("school_name", "NAME OF SCHOOL");
define("school_head", "JUAN A DELA CRUZ, PhD");
define("school_treasurer", "NAME OF SECRETARY");

define("bac_1", "BAC Member 1");
define("bac_2", "BAC Member 2");
define("bac_3", "BAC Member 3");
define("bac_4", "BAC Member 4");
define("bac_chair", "BAC Chair");
define("bac_vice_chair", "BAC Vice Chair");

define("table", "tbl_users");
define("user_session_id", "user_id");
define("passwordHashing", true);
define("error_message", "Your Credentials did not matched");

/** Function / Classes **/

//inside dir
define("VALUE", serialize(array("auth.php", "my_functions.php")));
