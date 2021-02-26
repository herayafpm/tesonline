<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $response = service('response');
    $cekAuth = $request->user->role_id == 2;
    if (!$cekAuth) {
      return $response->setStatusCode(401)->setBody(json_encode(["status" => 0, "message" => "Unauthorized", "data" => []]))->setHeader('Content-type', 'application/json');
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
