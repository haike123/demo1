<?php
namespace web\controller;
use core\View;
use Gregwar\Captcha\CaptchaBuilder;
class Index{
    protected $view;
    public function __construct ()
    {
        $this->view = new View();
    }
    public function show()
    {
        $a = $this->view->make('index')->with('version','版本：1.0 copyright:王海博');
        return $a;
    }
    public function login()
    {
        dd($_SESSION);
        dd($_COOKIE);
    }
    public function code()
    {
        $builder = new CaptchaBuilder;
        $builder->build(200,30);
//        $builder->save('out.jpg');
        $_SESSION['phrase'] = $builder->getPhrase();
        $_COOKIE['code'] = $builder->getPhrase();
        setcookie('code',$builder->getPhrase());
//        var_dump($builder->getPhrase());
        header('Content-type: image/jpeg');
        $builder->output();
    }
}
?>