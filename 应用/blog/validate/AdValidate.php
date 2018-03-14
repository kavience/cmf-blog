<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2018/1/5
 * Time: 16:43
 */

namespace app\blog\validate;


class AdValidate extends BaseValidate
{
    protected $rule = [
        'name' => 'require|max:10',
        'link' => 'require|max:200',
        'list_order' => 'require|number|max:5',
        'img_link' => 'require',
    ];
    protected $message = [
        'name.require' => '广告名称不能为空',
        'name.max' => '广告名称不能大于10位',
        'link.require' => '广告链接不能为空',
        'list_order.require' => '广告排序值不能为空',
        'list_order.number' => '广告排序值必须是数字',
        'img_link.require' => '广告缩略图不能为空',
    ];

}