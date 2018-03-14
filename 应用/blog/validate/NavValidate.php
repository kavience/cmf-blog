<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/30
 * Time: 15:42
 */

namespace app\blog\validate;


class NavValidate extends BaseValidate
{
    protected $rule = [
      'name'=>'require|max:10',
      'list_order'=>'require|number|max:5'
    ];
    protected $message = [
        'name.require' => '导航名称不能为空',
        'name.max' =>'导航名称不能超过10位',
        'list_order.require' => '排序值不能为空',
        'list_order.number' =>'排序值必须是数字',
        'list_order.max' =>'排序值不能超过5位',
    ];
}