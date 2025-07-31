<?php 

require_once 'config/database.php';
require_once 'routes/batch.php';
require_once 'routes/students.php';
require_once 'routes/schools.php';

$port = 3000;
$host = 'localhost';
$command = "php -S $host:$port -t public";
echo "Server running at http://$host:$port\n";
exec($command);

?>