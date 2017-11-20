[Главная](/README.MD) > [Документация](../index.md)>[Классы](./index.md)>Config

# web136\config_helper\Config

## Описание

Класс предназначен для получения массива конфигурации из нескольких файлов.

## Сводка

### Константы
- [VERSION](#VERSION)
### Методы
#### Публичные
- [__construct](#__construct)
- [addFiles](#addFiles)
- [getConfig](#getConfig)
#### Приватные
- checkFile
- includeFile
- setConfig

## Подробно
### Константы
#### VERSION
Указывает текущую версию класса
### Методы
#### __construct
``` Config __construct( array|string $files = '')```

Конструктор класса Config. 

*Параметры*:
- $files адрес (в виде строки) либо массив адресов файлов для включения
#### addFiles
``` void addFiles( array|string $files = '')```

Добавляет новых файлов конфигурации

*Параметры*:
- $files адрес (в виде строки) либо массив адресов файлов для включения
#### getConfig
```array getConfig(void)```

Возвращает результирующую конфигурацию

*Возвращаемые значения:* 

Возвращает массив, который получен из конфигурационных файлов

### Пример использования

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

Вызов:

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

```
Эквивалентен:

```php
<?php

use web136\config_helper\Config;

$config = new Config();

$config->addFiles(
	[
    		__DIR__.'/../../common/config/config.php',//общие настройки
    		__DIR__.'/../config/config.php',//настройки приложния
    		__DIR__.'/../config/config-local.php',//приватные настройки приложения
    	]
);
```
Или:

```php
<?php

use web136\config_helper\Config;

$config = new Config();

$config->addFiles(__DIR__.'/../../common/config/config.php');

$config->addFiles(__DIR__.'/../config/config.php');

$config->addFiles(__DIR__.'/../config/config-local.php');
```