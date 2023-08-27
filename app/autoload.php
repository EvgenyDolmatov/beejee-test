<?php
session_start();

require_once 'core/session.php';
require_once 'core/helper.php';
require_once 'core/db.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';

require_once 'models/task.php';
require_once 'models/user.php';

Route::init();