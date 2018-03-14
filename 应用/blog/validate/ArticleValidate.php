<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/30
 * Time: 20:36
 */

namespace app\blog\validate;


class ArticleValidate extends BaseValidate
{
    protected $rule = [
        'title' => 'require|max:20',
        'introduce' => 'require|max:150',
        'content' => 'require'
    ];
    protected $message = [
        'title.require' => '标题不能为空',
        'title.max' => '标题不能超过20字',
        'content.require' => '内容不能为空',
        'introduce.require' => '文章简介不能为空',
        'introduce.max' => '文章简介不能超过150字',
    ];

}