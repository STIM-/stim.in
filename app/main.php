<?php

  use Silex\Application;
  use Symfony\Component\Validator\Validation;
  use Symfony\Component\Validator\Constraints as Assert;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpKernel\HttpKernelInterface;


  /**
   *
   * Home
   *
   */
  $app->get ('/', function (Request $request) use ($app) {

    return $app->render ('index.html');

  })->bind ('index');


  /**
   *
   * Mail to
   *
   */
  $app->post ('/mailto', function (Request $request) use ($app) {

    $data = [
      'name'    => $request->request->get ('name'),
      'email'   => $request->request->get ('email'),
      'phone'   => $request->request->get ('phone'),
      'message' => $request->request->get ('message'),
    ];

    $subject = 'Hello from ' . $data['name'] . ' @ stim.in';
    //$to      = 'hello@stim.in';
    $to      = 'wake.gs@gmail.com';
    $headers = 'MIME-Version: 1.0' . "\r\n" .
               'Content-type: text/html; charset=UTF-8' . "\r\n";
    $message = 'Name: ' . $data['name'] . ' <br />' .
               'E-mail: ' . $data['email'] . ' <br />' .
               'Phone: ' . $data['phone'] . ' <br />' .
               'Message: <br />' .
               nl2br ($data['message']);

    $res = 'sent';

    if (! @mail ($to, $subject, $message, $headers))
      $res = 'failed';

    return $res;

  })->bind ('mailto');