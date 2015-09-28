<?php
namespace App\Response;

class JsonResponse extends HttpHeader implements Response
{
	protected $response = [];

	public function __construct()
	{
		if (!headers_sent()) {
			header('Content-Type: application/json; charset=utf-8');
		}
	}

	public function forBidden()
	{
		$this->response['header_status'] = 403;
		$this->response['header_message'] = 'forbidden';
		return $this->getResponse(403);
	}

	public function badRequest()
	{
		$this->response['header_status'] = 400;
		$this->response['header_message'] = 'bad request';
		return $this->getResponse(400);
	}

	public function ok($data = [])
	{
		$this->response['header_status'] = 200;
		$this->response['header_message'] = 'ok';
		$this->response = array_merge($this->response,$data);
		return $this->getResponse(200);
	}

	protected function getResponse($errorCode)
	{
		$this->httpStatus($errorCode);
		return json_encode($this->response);
	}


}

?>