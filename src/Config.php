<?php

namespace web136\config_helper;


class Config {

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
	 * метод для добавления новых файлов конфигурации
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

		if (!empty($path) && file_exists($path) && is_readable($path) && is_file($path)) {
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
			$this->config = array_merge_recursive($this->config, $additionalConfig);
		}
	}

}