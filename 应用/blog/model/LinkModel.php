<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/31
 * Time: 14:56
 */

namespace app\blog\model;


class LinkModel  extends BaseModel
{
    protected $table = 'cmf_blog_links';
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;
    protected $dateFormat = 'Y-m-d H:i:s';

    public function getAllLinks()
    {
        return $this->order('list_order','desc')->paginate(5);
    }

}