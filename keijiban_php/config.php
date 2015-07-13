<?php

/*

alter table toiawase add status enum('active', 'deleted') default 'active' after naiyo;

*/

define('DSN', 'mysql:host=localhost;dbname=toiawase_php');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', 'tm521923');

define('COMMENTS_PER_PAGE', 10);


define('SITE_URL', 'http://localhost/toiawase_php/');
define('ADMIN_URL', SITE_URL);

error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/toiawase_php/');