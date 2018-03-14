<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/30
 * Time: 13:43
 */

namespace app\blog\controller;


use app\blog\model\CommentModel;
use cmf\controller\AdminBaseController;

class AdminCommentController extends AdminBaseController
{

    /**
     *3、评论管理
     * @adminMenu(
     *     'name'   => '评论管理',
     *     'parent' => 'blog/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> false,
     *     'order'  => 103,
     *     'icon'   => '',
     *     'remark' => '评论管理',
     *     'param'  => ''
     * )
     */
    public function commentSetting()
    {
        $hasInfo = '0';
        $commentModel = new CommentModel();
        //如果传入变量search则通过search查找评论
        if (!empty(input('search')))
        {
            $comments = $commentModel->getCommentsBySearch(input('search'));
            if (!$comments->isEmpty())
            {
                $hasInfo = '1';
                $this->assign('comments',$comments);
            }
            $this->assign('hasInfo',$hasInfo);
            return $this->fetch(':comments');

        }else{
            $comments = $commentModel->getAllComment();
            if (!$comments->isEmpty())
            {
                $hasInfo = '1';
                $this->assign('comments',$comments);
            }
            $this->assign('hasInfo',$hasInfo);
            return $this->fetch(':comments');
        }

    }
    public function del()
    {
        empty(input('get.id'))?$id='':$id=input('get.id');
        if ($id=='')
        {
            $this->error('输入的评论ID不存在');
        }
        if (CommentModel::destroy($id)){
            $this->success('评论删除成功');
        }else {
            $this->error('评论删除失败');
        }
    }
}