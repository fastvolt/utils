<?php

declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use FastVolt\Utils\Input;

if (Input::has('name')) {
    $req = Input::get('name');
    echo $req;
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>

    <form method="POST">
        <input type="text" placeholder="Enter Name" name="name" />
    </form>

</body>

</html>