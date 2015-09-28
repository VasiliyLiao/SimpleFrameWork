<?php
namespace App\Kernel;

abstract class Controller
{
	public $middleResponse = null;
	protected $request = null;
	protected $response = null;
}