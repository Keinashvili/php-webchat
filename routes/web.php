<?php

use app\core\Router;

Router::get('/', function () {
    echo "<a href='/register'>Register</a>";
});
