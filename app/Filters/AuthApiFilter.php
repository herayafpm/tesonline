<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use \Firebase\JWT\JWT;
use App\Models\UsersModel;

class AuthApiFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $response = service('response');
    if (!$request->getHeader('X-Auth')) {
      $response->setStatusCode(401);
      $response->setBody(json_encode(["status" => 0, "message" => "Unauthorized", "data" => []]));
      $response->setHeader('Content-type', 'application/json');
      return $response;
    }
    try {
      $jwt = explode("Bearer ", $request->getHeader('X-Auth')->getValue())[1];
      $decoded = JWT::decode($jwt, env("appJWTKey"), array('HS256'));
      $userModel = new UsersModel();
      $user = $userModel->getUserWithRole($decoded->user_username);
      $request->user = $user;
    } catch (\Exception $th) {
      $response->setStatusCode(401);
      $response->setBody(json_encode(["status" => 0, "message" => $th->getMessage(), "data" => []]));
      $response->setHeader('Content-type', 'application/json');
      return $response;
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
