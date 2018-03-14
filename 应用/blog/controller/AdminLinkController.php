<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/30
 * Time: 13:44
 */

namespace app\blog\controller;


use app\blog\model\LinkModel;
use cmf\controller\AdminBaseController;
use think\Validate;

class AdminLinkController extends AdminBaseController
{
    /**
     * 4、友链管理
     * @adminMenu(
     *     'name'   => '友链管理',
     *     'parent' => 'blog/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> false,
     *     'order'  => 104,
     *     'icon'   => '',
     *     'remark' => '友链管理',
     *     'param'  => ''
     * )
     */
    public function friendSetting()
    {
        $hasInfo = '0';
        $linkModel = new LinkModel();
        $links = $linkModel->getAllLinks();
        if (!$links->isEmpty())
        {
            $hasInfo = '1';
            $this->assign('links',$links);
        }
        $this->assign('hasInfo',$hasInfo);
        return $this->fetch('index');
    }
    public function add()
    {
        return $this->fetch();
    }
    public function addPost()
    {
        $data = input('post.');
        $validate = new Validate([
            'name'  => 'require|max:20',
            'link'   => 'require|max:200',
            'list_order'   => 'require|number',
        ],[
            'name.require'  => '友链名称不能为空',
            'name.max'  => '友链名称不能超过20位',
            'link.require'  => '友链链接不能为空',
            'link.max'  => '友链链接不能超过200位',
            'list_order.require'  => '排序值不能为空',
            'list_order.number'  => '排序值必须是数字',
        ]);
        if (!$validate->check($data))
        {
            $this->error($validate->getError());
        }
        $linkModel = new LinkModel([
            'name'=> $data['name'],
            'link'=> $data['link'],
            'list_order'=> $data['list_order'],
        ]);
        if ($linkModel->save())
        {
            $this->success('友链添加成功');
        }else{
            $this->error('友链添加失败');
        }
    }

    public function edit()
    {
        $hasInfo = '0';
        empty(input('get.id'))?$id='':$id = input('get.id');
        if ($id=='')
        {
            $this->error('id不存在');
        }
        $link = LinkModel::get($id);
        if (!empty($link))
        {
            $hasInfo = '1';
            $this->assign('link',$link);
        }
        $this->assign('hasInfo',$hasInfo);
        return $this->fetch();
    }
    public function editPost()
    {
        $data = input('post.');
        $validate = new Validate([
            'name'  => 'require|max:20',
            'link'   => 'require|max:200',
            'list_order'   => 'require|number',
        ],[
            'name.require'  => '友链名称不能为空',
            'name.max'  => '友链名称不能超过20位',
            'link.require'  => '友链链接不能为空',
            'link.max'  => '友链链接不能超过200位',
            'list_order.require'  => '排序值不能为空',
            'list_order.number'  => '排序值必须是数字',
        ]);
        if (!$validate->check($data))
        {
            $this->error($validate->getError());
        }
        $linkModel = new LinkModel();
        $res = $linkModel->save([
            'name'=> $data['name'],
            'link'=> $data['link'],
            'list_order'=> $data['list_order'],
        ],['id'=>$data['id']]);
        if ($res==true)
        {
            $this->success('友链修改成功');
        }else{
            $this->error('友链修改失败');
        }
    }
    public function del()
    {
        empty(input('get.id'))?$id='':$id=input('get.id');
        if ($id=='')
        {
            $this->error('输入的友链ID不存在');
        }
        if (LinkModel::destroy($id)){
            $this->success('友链删除成功');
        }else {
            $this->error('友链删除失败');
        }
    }
}