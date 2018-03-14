<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/30
 * Time: 13:41
 */

namespace app\blog\controller;


use app\blog\model\NavModel;
use app\blog\validate\NavValidate;
use cmf\controller\AdminBaseController;
use think\Db;

class AdminNavController extends AdminBaseController
{
    /**
     * 1、导航管理
     * @adminMenu(
     *     'name'   => '导航管理',
     *     'parent' => 'blog/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> false,
     *     'order'  => 101,
     *     'icon'   => '',
     *     'remark' => '导航管理',
     *     'param'  => ''
     * )
     */
    public function navSetting()
    {
        $hasNavs = '0'; //0代表没有导航
        $Navs = NavModel::getAllNav();
        $Navs = self::make_tree($Navs->toArray());
        if (!empty($Navs))
        {
            $hasNavs = '1';
        }
//        halt($Navs);
        $this->assign('hasNavs',$hasNavs);
        $this->assign('Navs',$Navs);
        return $this->fetch('index');
    }

    /**
     * 添加导航
     * @param string $pid 传入父ID则添加子导航
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function add($pid=0)
    {
        $navModel =new NavModel();
        if ($pid==0)
        {
            $topNavs = $navModel->where('parent_id',0)->select();
            $this->assign('topNavs',$topNavs->toArray());
        }else{
            $topNav = $navModel->find($pid);
            $this->assign('topNav',$topNav);
        }
        $this->assign('pid',$pid);
        return $this->fetch();
    }

    public function edit()
    {
        if (empty(input('get.id')))
        {
            return $this->error('id不能为空');
        }
        $id = input('get.id');
        $nav =Db::table('cmf_blog_category')->where('id',$id)->find();
        if (empty($nav)){
            return $this->error('该nav不存在');
        }
        $this->assign('nav',$nav);
        return $this->fetch();
    }

    public function del()
    {
        if (empty(input('get.id')))
        {
            $this->error('删除的导航不存在');
        }
        $id = input('get.id');
        $navModel = new NavModel();
        $navModel->where('parent_id',$id)->delete();
        NavModel::destroy(input('get.id'));
        $this->success('导航删除成功');
    }
    public function addPost()
    {
        $navValidate = new NavValidate();
        if (!$navValidate->check(input('post.')))
        {
            $this->error($navValidate->getError());
        }
        if (NavModel::addNav(input('post.')))
        {
            $this->success('导航添加成功');
        }
    }

    public function editPost()
    {
        $navValidate = new NavValidate();
        if (!$navValidate->check(input('post.')))
        {
            $this->error($navValidate->getError());
        }
        if (NavModel::editNav(input('post.')))
        {
            $this->success('导航修改成功');
        }else{
            $this->error('导航修改失败');
        }
    }

    /**
     * 数组转换成树结构
     */
    public static function make_tree($list,$pk='id',$pid='parent_id',$child='son',$root=0){
        $tree=array();
        $packData=array();
        foreach ($list as $data) {
            //转换为带有主键id的数组
            $packData[$data[$pk]] = $data;
            $packData[$data[$pk]]['hasSon'] = 'false';
            //$packData[1]=$data; $packData[2]=$data
        }
        foreach ($packData as $key =>$val){
            if($val[$pid]==$root){ //代表跟节点
                $tree[]= &$packData[$key];
            }else{
                //找到其父类
                $packData[$val[$pid]]['hasSon'] = 'true';
                $packData[$val[$pid]][$child][]= &$packData[$key];
            }
        }
        return $tree;
    }


}