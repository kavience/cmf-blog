<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/30
 * Time: 13:41
 */

namespace app\blog\controller;


use app\blog\model\ArticleModel;
use app\blog\model\NavModel;
use app\blog\validate\ArticleValidate;
use cmf\controller\AdminBaseController;

class AdminArticleController extends AdminBaseController
{

    /**
     *2、文章管理
     * @adminMenu(
     *     'name'   => '文章管理',
     *     'parent' => 'blog/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> false,
     *     'order'  => 102,
     *     'icon'   => '',
     *     'remark' => '文章管理',
     *     'param'  => ''
     * )
     */
    public function articleSetting()
    {
        $hasInfo = '0';
        empty(input('get.search'))?$search='':$search=input('get.search');
        $articles = ArticleModel::getArticles($search);
        foreach ($articles as $article) {
            $article['category_name'] = NavModel::where('id',$article['category_id'])->value('name');
        }
        if (!$articles->isEmpty())
        {
            $hasInfo = '1';
        }

        $this->assign('hasInfo',$hasInfo);
        $this->assign('articles',$articles);
        return $this->fetch('index');
    }

    /**
     * 发布文章
     * @return mixed
     */
    public function add()
    {
        $navs = BaseController::getAllNav();
        $hasNav = '0';
       if (!empty($navs)){
           $hasNav = '1';
           $this->assign('navs',$navs);
       }
        $this->assign('hasNav',$hasNav);
        return $this->fetch();
    }

    /**
     * 发布文章数据处理
     * @return void
     */
    public function addPost()
    {
        $articleValidate = new ArticleValidate();
        $articleInfo = input('post.');
        if (!$articleValidate->check($articleInfo))
        {
            $this->error($articleValidate->getError());
        }
        if (ArticleModel::addArticle($articleInfo))
        {
            $this->success('文章发布成功');
        }else{
            $this->error('文章发布失败');
        }
    }

    /**
     * 编辑文章
     * @return mixed
     */
    public function edit()
    {
        $hasNav = '0';
        empty(input('get.id'))?$id='':$id=input('get.id');
        if ($id=='')
        {
            $this->error('文章不存在');
        }
        $article = ArticleModel::getArticleById($id);
        if (empty($article))
        {
            $this->error('文章不存在');
        }
        $navs = BaseController::getAllNav();
        if (!empty($navs)){
            $hasNav = '1';
            $this->assign('navs',$navs);
        }
        $this->assign('hasNav',$hasNav);
        $this->assign('article',$article);
        return $this->fetch();
    }

    /**
     * 编辑文章数据处理
     */
    public function editPost()
    {
        $articleValidate = new ArticleValidate();
        $articleInfo = input('post.');
        if (!$articleValidate->check($articleInfo))
        {
            $this->error($articleValidate->getError());
        }
        if (ArticleModel::updateArticle($articleInfo))
        {
            $this->success('文章修改成功');
        }else{
            $this->error('文章修改失败');
        }
    }
    /**
     * 删除文章
     * @return array
     */
    public function del()
    {
        empty(input('get.id'))?$id='':$id=input('get.id');
        if ($id==''){
            $this->error('要删除的文章不存在');
        };
        if (ArticleModel::delArticleById($id)){
            $this->success('文章和该文章评论删除成功');
        }else{
            $this->error('文章删除失败');
        }
    }
}