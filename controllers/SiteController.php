<?php


namespace app\controllers;

use app\core\Request;
use app\core\Controller;


class SiteController extends Controller
{

  public function home()
  {
    $params = [
      'name' => 'maiobarbero'
    ];
    return $this->render('home', $params);
  }
  public function contact()
  {
    return $this->render('contact');
  }
  public function handleContact(Request $request)
  {
    $body = $request->getBody();
    var_dump($body);

    return 'handling submitted data';
  }
}