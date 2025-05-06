<?php
declare(strict_types=1);
if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
  $db = mysqli_connect('localhost', 'root', "", 'skiarealor');
} else {
  $db = mysqli_connect('uvds141.active24.cz', 'skiarealor', "6pCgK3n5", 'skiarealor');
}
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}