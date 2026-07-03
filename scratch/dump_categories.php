<?php
require 'config/config.php';
require 'config/database.php';
require 'app/models/ad_category.php';
$db = (new Database())->connect();
$model = new Category($db);
print_r($model->getMainParentCategories());
