<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/28
 * Time: 16:46
 */

namespace app\blog\controller;


use app\blog\model\CommentModel;
use app\blog\validate\CommentValidate;
use think\Request;

class CommentController extends BaseController
{
    public function doPostComment(Request $request)
    {
        $request->isPost()?$postData = $request->post():$this->error('访问出错');
        $commentValidate = new CommentValidate();
        if (!$commentValidate->check($postData))
        {
            $this->error($commentValidate->getError());
        }
        if (!cmf_captcha_check($postData['verify']))
        {
            $this->error('验证码输入不正确,请重新输入');
        }
        $info = CommentModel::addComment($postData);
        if ($info['valid']){
            $this->success('评论成功');
        }else{
            $this->error('评论失败');
        }
    }
}