<?php
namespace App\Error;

use Cake\Error\BaseErrorHandler;
use Cake\Utility\Debugger;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Error\FatalErrorException;

/**
 * Itool ErrorHandler
 *
 */
class ItoolError extends BaseErrorHandler {
	protected $_options 			= [];
	protected $coreErrorLogsTable	= [];
	protected $errorConstants 		= [
		'1' 	=> 'E_ERROR',
		'2' 	=> 'E_WARNING',
		'4' 	=> 'E_PARSE',
		'8' 	=> 'E_NOTICE',
		'16'	=> 'E_CORE_ERROR',
		'32'	=> 'E_CORE_WARNING',
		'64'	=> 'E_COMPILE_ERROR',
		'128' 	=> 'E_COMPILE_WARNING',
		'256' 	=> 'E_USER_ERROR',
		'512' 	=> 'E_USER_WARNING',
		'1024' 	=> 'E_USER_NOTICE',
		'2048' 	=> 'E_STRICT',
		'4096' 	=> 'E_RECOVERABLE_ERROR',
		'8192' 	=> 'E_DEPRECATED',
		'16384' => 'E_USER_DEPRECATED',
		'32767' => 'E_ALL',
	]; 
	
	/**
	 * Constuctor
	 * @param array $options
	 */
	public function __construct($options = []) {
		ConnectionManager::config(Configure::consume('Datasources'));
		
		$this->_options			= $options;
		$this->CoreErrorLogs 	= TableRegistry::get('CoreErrorLogs');
	}
	
	/**
	 * Display error
	 * @param $error
	 * @param $debug
	 */
	public function _displayError($error, $debug) {
		// Load core error logs table
		$this->coreErrorLogsTable = TableRegistry::get('CoreErrorLogs');
		
		// Save error into database
		$errorData = $this->setErrorData($error);
		$this->coreErrorLogsTable->createErrorLog($errorData);
		
		if (!$debug) {
			return;
		}
		Debugger::getInstance()->outputError($error);
	}
	
	/**
	 * Set error data
	 * 
	 * @param $error
	 * @return array
	 */
	private function setErrorData($error) {
		$data = [
			'CoreErrorLogs' => [
				'error_type' 		=> $error['error'],
				'error_sub_type'	=> isset($this->errorConstants[$error['code']]) ? $this->errorConstants[$error['code']] : '',
				'message'			=> $error['description'],
				'file'				=> $error['file'],
				'line'				=> $error['line']
			]
		];
		return $data;
	}
	
	/**
	 * Display exception
	 * @param $exception
	 * @throws \Exception
	 */
 	public function _displayException($exception) {
 		// Load core error logs table
 		$this->coreErrorLogsTable = TableRegistry::get('CoreErrorLogs');
 		
 		// Get additional data to error / exception
 		$additionalData = $this->getadditionalData($exception);
 		
 		// Save exception into database
 		$errorData = $this->setExceptionData($exception, $additionalData);
 		$this->coreErrorLogsTable->createErrorLog($errorData);
 		
 		// Display exception
 		$renderer = App::classname($this->_options['exceptionRenderer'], 'Error');
		try {
			if (!$renderer) {
				throw new \Exception("$renderer is an invalid class.");
			}
			$error = new $renderer($exception);
			$error->render();
		} catch (\Exception $e) {
			$this->_options['trace'] = false;
			$message = sprintf("[%s] %s\n%s",
				get_class($e),
				$e->getMessage(),
				$e->getTraceAsString()
			);
			
			trigger_error($message, E_USER_ERROR);
		}
	}
	
	/**
	 * Get exception additional data
	 * @param $exception
	 * @return array
	 */
	private function getadditionalData($exception) {
		$additionalData = [];
		if(method_exists($exception, 'getAttributes')) {
			$additionalData = $exception->getAttributes();
		}
	
		return $additionalData;
	}
	
	/**
	 * Set exception data
	 *
	 * @param $exception
	 * @param array $additionalData
	 * @return array
	 */
	private function setExceptionData($exception, $additionalData) {
		$data = [
			'CoreErrorLogs' => [
				'error_type'			=> 'Exception',
				'error_sub_type'		=> get_class($exception),
				'message'				=> $exception->getMessage(),
				'additional_error_data'	=> isset($additionalData['additional_error_data']) ? $additionalData['additional_error_data'] : '',
				'http_code'				=> $exception->getCode(),
				'additional_error_data'	=> isset($additionalData['additional_error_data']) ? implode(" | ", $additionalData['additional_error_data']) : '',
				'file'					=> $exception->getFile(),
				'line'					=> $exception->getLine(),
				'trace'					=> $exception->getTraceAsString(),
				'created'				=> date('Y-m-d H:i:s'),
				'modified'				=> date('Y-m-d H:i:s'),
			]
		];
	
		return $data;
	}
	
	/**
	 * Handle fatal error
	 * @param $code
	 * @param $description
	 * @param $file
	 * @param $line
	 */
	public function handleFatalError($code, $description, $file, $line) {
		$logData = [
			'code' 			=> $code,
			'description' 	=> $description,
			'file' 			=> $file,
			'line' 			=> $line,
			'error' 		=> 'Fatal Error',
		];
		$this->_logError(LOG_ERR, $logData);
		
		if (ob_get_level()) {
			ob_end_clean();
		}
		
		if (Configure::read('debug')) {
			$this->handleException(new \Cake\Error\FatalErrorException($description, 500, $file, $line));
		} else {
			$this->handleException(new \Cake\Error\InternalErrorException());
		}
		
		return true;
	}
}