<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/28
 * Time: 9:15
 */

namespace app\blog\model;


class NavModel extends BaseModel
{
    protected $table = 'cmf_blog_category';
    protected $pk = 'id';
    /**
     *     获取所有导航
     */
    public static function getAllNav()
    {
        return self::order('list_order','desc')->select();
    }

    /** 
     * 根据ID获取导航
     * @param $id
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function getCategoryById($id)
    {
        return self::where('id',$id)->find();
    }

    public static function addNav($data)
    {
//        halt($data);
        return (new NavModel([
            'name'=>$data['name'],
            'parent_id'=>$data['parent_id'],
            'list_order'=>$data['list_order'],
        ]))->save();
    }
    public static function editNav($data)
    {
        $nav = self::get($data['id']);
        if (!empty($nav))
        {
            $nav->save([
                'name'=> $data['name'],
                'list_order'=> $data['list_order'],
            ]);
            return true;
        }else{
            return false;
        }
        $navModel = NavModel::get($data['id']);
        $navModel->name     = $data['name'];
        $navModel->list_order    = $data['list_order'];
        return $navModel->save();
    }
}