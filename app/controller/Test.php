<?php


namespace app\controller;



use app\BaseController;

class Test extends BaseController
{
    public function Index()
    {
        return 'index,方法名：'.$this->request->action().',当前实际路径：'.$this->app->getBasePath();
    }

    public function hello($value='')
    {
        return 'hello '.$value;
    }

    public function array()
    {
        $arraydata=['a'=>1,'b'=>2,'c'=>3];
        halt('中断输出');
        return json($arraydata);
    }
}