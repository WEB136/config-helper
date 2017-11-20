<?php

namespace web136\config_helper;

/**
 * Class Config
 * Класс предназначен для получения массива конфигурации из нескольких файлов.
 *
 * @package web136\config_helper
 * @version 1.01
 */
class Config {

	const VERSION = '1.01';

	/**@property array $checkedFiles нужно для того, чтобы включать каждый файл не более одного раза */
	protected $checkedFiles = [];

	/**@property array $config Результирующая конфигурация */
	protected $config = [];


	/**
	 * Config constructor.
	 * @param array|string $files //адрес либо массив адресов файлов для включения
	 */
	public function __construct($files = '') {
		$this->addFiles($files);
	}

	/**
	 * Добавляет новых файлов конфигурации
	 * @param array|string $files адрес либо массив адресов файлов для включения
	 */
	public function addFiles($files = '') {

		if (!empty($files)) {

			if (is_array($files)) {
				foreach ($files as $file) {
					$this->setConfig($this->includeFile($file));
				}
			}
			else {
				$this->setConfig($this->includeFile(strval($files)));
			}

		}

	}

	/**
	 * Возвращает результирующую конфигурацию
	 * @return array
	 */
	public function getConfig() {
		return $this->config;
	}

	/**
	 * @param string $path
	 * @return bool;
	 */
	protected function checkFile($path = '') {

		$path = realpath($path);

		if (!empty($path) && !in_array($path, $this->checkedFiles) && file_exists($path) && is_readable($path) && is_file($path)) {
			$this->checkedFiles[] = $path;
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * возвращает массив (пустой в случае проблем, наполненный если ОК)
	 * @param string $path
	 * @return array
	 */
	protected function includeFile($path = '') {

		if ($this->checkFile($path)) {
			$result = include $path;
			if (is_array($result)) {
				return $result;
			}
			else {
				return [];
			}
		}
		else {
			return [];
		}

	}

	/**
	 * объединяет рекурсивно $this->config и $additionalConfig
	 * @param array $additionalConfig
	 * @return void;
	 */
	protected function setConfig( $additionalConfig = [] ) {
		if(is_array($additionalConfig) && !empty($additionalConfig)){
			$this->config = array_replace_recursive($this->config, $additionalConfig);
		}
	}

}