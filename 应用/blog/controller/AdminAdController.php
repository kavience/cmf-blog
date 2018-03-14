<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/30
 * Time: 13:45
 */

namespace app\blog\controller;


use app\blog\model\AdModel;
use app\blog\validate\AdValidate;
use cmf\controller\AdminBaseController;
use think\Db;
use think\Request;

class AdminAdController extends AdminBaseController
{
    /**
     * 5、广告管理
     * @adminMenu(
     *     'name'   => '广告管理',
     *     'parent' => 'blog/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> false,
     *     'order'  => 105,
     *     'icon'   => '',
     *     'remark' => '广告管理',
     *     'param'  => ''
     * )
     */
    public function adSetting()
    {
        $hasInfo = '0';
        $adModel = new AdModel();
        $ads = $adModel->getAllAd();
        if (!$ads->isEmpty())
        {
            $hasInfo = '1';
            $this->assign('ads',$ads);
        }
        $this->assign('hasInfo',$hasInfo);
        return $this->fetch('index');
    }

    /**
     * 添加广告
     *
     */
    public function add()
    {
        return $this->fetch('add');
    }

    /**
     * 执行添加广告
     *
     */
    public function addPost()
    {
        $adValidate = new AdValidate();
        $adModel = new AdModel();
        $adData = input('post.');
        if (!$adValidate->check($adData))
        {
            $this->error($adValidate->getError());
        }
        if ($adModel->addAd($adData))
        {
            $this->success('广告添加成功');
        }else{
            $this->error('广告添加失败');
        }
    }

    public function del()
    {
        empty(input('get.id'))?$id='':$id=input('get.id');
        if ($id=='')
        {
            $this->error('要删除的广告ID不能为空');
        }
        if (Db::table('cmf_blog_ad')->delete($id))
        {
            $this->success('广告删除成功');
        }else{
            $this->success('广告删除失败');
        }
    }

    /**
     *
     */
    public function edit()
    {
        $adModel = new AdModel();
        empty(input('get.id'))?$id='':$id=input('get.id');
        if ($id=='')
        {
            $this->error('要修改的广告ID不能为空');
        }
        $ad=$adModel->getAdById($id);
        if ($ad==false)
        {
            $this->error('要修改的广告不存在');
        }
        $this->assign('ad',$ad);
        return $this->fetch();
    }

    public function editPost()
    {
        $adValidate = new AdValidate();
        $adModel = new AdModel();
        $adData = input('post.');
        if (!$adValidate->check($adData))
        {
            $this->error($adValidate->getError());
        }
        if ($adModel->editAd($adData))
        {
            $this->success('广告修改成功');
        }else{
            $this->success('广告修改失败');
        }
    }
}