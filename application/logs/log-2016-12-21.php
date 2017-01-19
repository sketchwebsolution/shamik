<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-12-21 11:09:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT  u.* FROM `h_users` u where time_to_sec(TIMEDIFF(NOW(),u.created_date))/3600 <=24 and id=
ERROR - 2016-12-21 12:04:10 --> Severity: Notice --> Undefined variable: arr D:\xampp\htdocs\Hiberce\application\controllers\Front.php 147
ERROR - 2016-12-21 12:04:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL' at line 3 - Invalid query: SELECT *
FROM `h_users`
WHERE  IS NULL
ERROR - 2016-12-21 12:15:19 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\Hiberce\application\helpers\urlapp_helper.php 156
ERROR - 2016-12-21 15:03:03 --> Severity: Notice --> Undefined index: email D:\xampp\htdocs\Hiberce\application\models\front\Registration.php 115
ERROR - 2016-12-21 15:03:50 --> Severity: Notice --> Undefined variable: uid D:\xampp\htdocs\Hiberce\application\models\front\Registration.php 262
ERROR - 2016-12-21 15:03:50 --> Query error: Column 'user_id' cannot be null - Invalid query: INSERT INTO `h_login_log` (`user_id`, `login_ip`, `login_device`, `login_agent`, `created_date`, `modified_date`, `last_login`, `last_login_ip`) VALUES (NULL, '::1', 'browser', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '2016-12-21 15:03:50', '2016-12-21 15:03:50', '', '')
ERROR - 2016-12-21 15:07:00 --> Severity: Notice --> Undefined index: email D:\xampp\htdocs\Hiberce\application\models\front\Registration.php 115
ERROR - 2016-12-21 15:20:16 --> Severity: Notice --> Undefined index: password D:\xampp\htdocs\Hiberce\application\models\front\Registration.php 110
