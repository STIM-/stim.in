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
  $app->get ('/mailto', function (Request $request) use ($app) {

    $data = [
      'name' => $request->request->get ('name'),
    ];

    $subject = 'E-mail from <yourdomain.com>'; // Subject of your email
    $to      = 'hello@stim.in'; //Your e-mail address
    $headers = 'MIME-Version: 1.0' . "\r\n" .
               'Content-type: text/html; charset=UTF-8' . "\r\n";
    $message = 'Name: ' . $_REQUEST['name'] . ' <br/>' .
               'E-mail: ' . $_REQUEST['email'] . ' <br/>' .
               'Phone: ' . $_REQUEST['phone'] . ' <br/>' .
               'Message: ' .$_REQUEST['message'];

    if (@mail($to, $subject, $message, $headers))
    {
     echo 'sent';
    }
    else
    {
     echo 'failed';
    }
    return $app->render ('index.html');

  })->bind ('mailto');


