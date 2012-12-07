<?php
require 'common.inc.php';


$head_title = '404 Not Found';
@header("HTTP/1.1 404 Not Found");
include template('404', 'message');

?>