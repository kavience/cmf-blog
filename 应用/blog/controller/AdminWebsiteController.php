<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/30
 * Time: 13:45
 */

namespace app\blog\controller;


use cmf\controller\AdminBaseController;
use think\Db;
use think\Validate;

class AdminWebsiteController extends AdminBaseController
{
    /**
     * 6、站点管理
     * @adminMenu(
     *     'name'   => '站点管理',
     *     'parent' => 'blog/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> false,
     *     'order'  => 106,
     *     'icon'   => '',
     *     'remark' => '站点管理',
     *     'param'  => ''
     * )
     */
    public function websiteSetting()
    {
        $websiteData = Db::table('cmf_blog_info')->find(1);
        $this->assign('websiteData',$websiteData);
        return $this->fetch('index');
    }
    public function editPost()
    {
        $websiteValidate = new Validate(
            [
                'name' => 'require|max:20',
                'subtitle' => 'require|max:35',
                'copyright' => 'require|max:35',
            ],
            [
                'name.require' => '站点名称不能为空',
                'name.max' => '站点名称不能大于20为',
                'subtitle.require' => '副标题不能为空',
                'copyright.require' => '备案号不能为空',
            ]
        );
        $websiteData = input('post.');
        if (!$websiteValidate->check($websiteData))
        {
            $this->error($websiteValidate->getError());
        }
        DB::table('cmf_blog_info')->where('id',$websiteData['id'])->update([
            'blog_name' => $websiteData['name'],
            'blog_subtitle' => $websiteData['subtitle'],
            'copyright' => $websiteData['copyright'],
        ]);
        $this->success('站点更新成功');
    }
}