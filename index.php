<?php
require(__DIR__ . '/_protected/helpers/ServerParser.php');
$server = ServerParser::parse();

$server['host'] = gethostname();
$server['user'] = get_current_user();

switch (strtolower($server['user'])) {
     case "ubuntu": // local
         defined('YII_DEBUG') or define('YII_DEBUG', true);
         defined('YII_ENV') or define('YII_ENV', 'dev');
         break;

     case "crmqa": // qa
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        defined('YII_ENV') or define('YII_ENV', 'test');
        break;

     case "crmprod": // prod
        defined('YII_ENV') or define('YII_ENV', 'prod');
        break;
 }

$config = require(__DIR__ . '/_protected/config/'.YII_ENV.'/web.php');

require(__DIR__ . '/_protected/vendor/autoload.php');
require(__DIR__ . '/_protected/vendor/yiisoft/yii2/Yii.php');

(new yii\web\Application($config))->run();