# Пакет config-helper
## Назначение
Пакет предназначен для облегчения процесса сбора конфигурации из файлов.
## Общий принцип
При создании экземпляра объекта, ему передаются пути до файлов, которые возвращают массив настроек. Внутри объекта массивы объединяться и в результате будет получен единый массив, который можно передавать, например, на вход объекта приложения Yii2.
## Пример использования

```php
<?php

use web136\config_helper\Config;

$config = new Config(
	[
		__DIR__.'/../../common/config/config.php',//общие настройки
		__DIR__.'/../config/config.php',//настройки приложния
		__DIR__.'/../config/config-local.php',//приватные настройки приложения
	]
);

(new \yii\web\Application($config->getConfig()))->run();

```
[Документация](docs/index.md);