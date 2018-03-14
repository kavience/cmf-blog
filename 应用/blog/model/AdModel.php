<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2018/1/5
 * Time: 14:33 
 */

namespace app\blog\model;


class AdModel extends BaseModel
{
    protected $table = 'cmf_blog_ad';
    protected $pk = 'id';

    /**
     * 获取所有广告
     * @return \think\Paginator
     */
    public function getAllAd()
    {
        return $this->order('list_order','desc')->paginate(3);
    }

    public function getAdById($id)
    {
        return self::find($id);
    }

        /**
     * 添加广告
     * @param $adData
     * @return int|string
     */
    public function addAd($adData)
    {
        return self::insert([
            'name' => $adData['name'],
            'link' => $adData['link'],
            'img_link' => $adData['img_link'],
            'list_order' => $adData['list_order'],
        ]);
    }

    public function editAd($adData)
    {
        $ad = self::get($adData['id']);
        if (!empty($ad))
        {
            $ad->save([
                'name'=> $adData['name'],
                'link'=> $adData['link'],
                'img_link'=> $adData['img_link'],
                'list_order'=> $adData['list_order'],
            ]);
            return true;
        }else{
            return false;
        }
    }
}