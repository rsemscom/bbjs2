<?php
include "controller.php";
include "model.php";

use App\Controller;
use App\Hotel;
$d = new Hotel();

(new Controller())->index();