<?php


namespace app\controller;


use app\model\User;
use think\db\Where;
use think\facade\Db;
use function Symfony\Component\VarDumper\Dumper\esc;

class DataTest
{
    public function index()
    {
//        $user=Db::table('test_user')->select();
//        dump($user);
        //单条数据查询
        //$user=Db::table('test_user')->where('id',1)->find();        查询一条数据如果没有返回null
        //return Db::getlastSql();      获取最近的一条sql执行语句
        //$user=Db::table('test_user')->where('id',100)->findOrFail();        查询一条数据如果没有返回一个异常
        //$user=Db::table('test_user')->where('id',100)->findOrEmpty();        //查询一条数据如果没有就返回一个空数组

        // 数据集查询
       // $user=Db::table('test_user')->where('id',100)->selectOrFail();      //查询数据集为空返回异常
        //$user=Db::table('test_user')->select()->toArray();          //数据集查询返回二维数组
        //$user=Db::name('user')->select();           //配置了表头可以把table改为name，就可以去掉表头
         //return Db::name('user')->where('id',2)->value('name');         //指定显示某个字段
        //$user=Db::name('user')->column('name','id');         //指定显示某个字段
        //return json($user);


        //分批查询
            //可指定数量查询
//        Db::name('user')->chunk(100,function($users){
//
//            foreach($users as $user){
//                dump($user);
//            }
//            echo 100;
//        });
        //单条查询
//        $cursor=Db::name('user')->cursor();
//        foreach($cursor as $user){
//            dump($user);
//        }

        //链式查询
        //$user=Db::name('user')->where('id',1)->order('id','desc')->find();
        //$user=Db::name('user')->where('id',1)->order('id','desc')->select();

        $userQuery=Db::name('user');
        $user=$userQuery->where('id',3)->find();
        $data=$userQuery->removeOption('order')->select();      //如果把结果集存储在一个变量里，进行多次查询去获取最近的sql语句会不准确，需要使用removeOption清除
        echo Db::getlastSql();
//        dump($user);
    }
    public function bbs()
    {
        $bbsuser=Db::connect('bbs')->table('bbs_father_modeule')->select();
        return json($bbsuser);
    }
    public function getUser()
    {
        return User::select();

    }

    //单条新增的使用
    public function insert()
    {
        $data=[
            'name'=>'邱淑贞',
            'sex'=>'女',
            'age'=>'54',
            'address'=>'中国香港',
        ];
        //return Db::name('user')->insert($data);         //新增语句
        //return Db::name('user')->strict(false)->insert($data);      //强行新增，有多余字段可行，错误名称不可行
        //Db::name('user')->replace()->insert($data);         //使用replace进行新增如果出现主键重复会进行覆盖
        // return Db::name('user')->insertGetId($data);        //新增成功后返回新增的ID
        return Db::name('user')->save($data);       //save新增or修改都可用，判断是否存在主键如果存在为修改否则为新增
    }

    //多条新增
    public function insertAll()
    {
        $dataAll=[
            [
                'name'=>'关之琳',
                'sex'=>'女',
                'age'=>'56',
                'address'=>'中国香港',
            ],
            [
                'name'=>'赵敏',
                'sex'=>'女',
                'age'=>'56',
                'address'=>'中国香港',
            ]
        ];
        return Db::name('user')->insertAll($dataAll);       //使用一个二维数组
    }

    //修改
    public function update()
    {
        echo 'hello world!'.'<br>';
        //普通的根据条件修改
//        $data=[
//
//            'name'=>'克拉拉'
//        ];
//
//        return Db::name('user')->where('id',2)->update($data);


//         $data=[
//             'id'=>2,
//            'name'=>'李敏成'
//        ];
//
//        return Db::name('user')->update($data);

        //全部字母为大写
//        return Db::name('user')->where('id',2)->exp('name','UPPER(name)')->update();

        //save方法修改
        $data=[
             'id'=>2,
            'name'=>'李成敏'
        ];
        return Db::name('user')->save($data);
    }

    public function delete()
    {
        //单条删除
        //return Db::name('user')->delete(24);

        //多条删除
        //return Db::name('user')->delete([16,17]);

        //根据条件删除
        return Db::name('user')->where('id',14)->delete();

        //删除所有
        //return Db::name('user')->delete(true);
    }

}