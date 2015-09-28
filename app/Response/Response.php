<?php
namespace App\Response;

interface Response
{
    public function badRequest();
    public function forBidden();
}