<?php
namespace App\Error;

use Cake\Core\Exception\Exception;
use Cake\ORM\TableRegistry;

/**
 * Itool custom exception
 * Usage:
 *  use \App\Error\ItoolException;
 * 	throw new ItoolException([
 *		'message' 				=> 'Itool Exception Test',
 *		'additional_error_data' =>
 *			[
 *				'Throw at: ' . $this->request->controller . '\\' . $this->request->action,
 *				'CoreProductTypeId: ' . $id
 *			]
 *  ], '404');
 */
class ItoolException extends Exception {
	protected $_messageTemplate 	= '%s';
	protected $coreErrorLogsTable	= [];

	/**
	 * Save caught exception to database
	 * @param $exception
	 * @param string $exceptionType
	 */
	public function saveException($exception, $exceptionType = null) {
		// Load Core Error Logs Model
		$this->coreErrorLogsTable = TableRegistry::get('CoreErrorLogs');

		// Get additional data to error / exception
		$additionalData = $this->getadditionalData($exception);

		// Save core error logs
		$errorData = $this->setExceptionData($exceptionType, $exception, $additionalData);
		$this->coreErrorLogsTable->createErrorLog($errorData);
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
	 * @param $exceptionType
	 * @param $exception
	 * @param array $additionalData
	 * @return array
	 */
	private function setExceptionData($exceptionType, $exception, $additionalData) {
		$data = [
			'CoreErrorLogs' => [
				'error_type'			=> isset($exceptionType) ? $exceptionType : 'Exception',
				'error_sub_type'		=> get_class($exception),
				'message'				=> $exception->getMessage(),
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
}
