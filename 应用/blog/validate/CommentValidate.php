<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/28
 * Time: 18:19
 */

namespace app\blog\validate;


class CommentValidate extends BaseValidate
{
    protected $rule = [
        'content' => 'require|max:500',
        'nickname' =>'require|max:10',
        'email' =>'email'
    ];
    protected $message =[
        'nickname.require'=>'昵称不能为空',
        'nickname.max'=>'昵称不能超过10位',
        'content.require'=>'内容不能为空',
        'email.email'=>'邮箱格式不正确'
    ];
}