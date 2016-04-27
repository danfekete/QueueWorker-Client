<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace test;
use voov\QueueWorker\QueueWorker;

require '../vendor/autoload.php';

$qw = new QueueWorker();

for ($i=0;$i<100;$i++) {
	$qw->putJob(['name' => 'Dani', 'jobNo' => $i]);
}
