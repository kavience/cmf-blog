<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/24
 * Time: 14:34
 */
namespace app\blog\controller;
use app\blog\model\ArticleModel;
use app\blog\model\NavModel;
use think\Request;

class IndexController extends BaseController
{
    /**
     * 如果无变量 则显示所有文章
     * 否则通过变量search或者cat_id来查找文章
     * @return mixed
     */
    public function index()
    {
        $hasInfo = '0'; //0代表没有找到文章
        key_exists('search',input())?($search=input('search')):($search='');
        key_exists('cat_id',input())?($catId=input('cat_id')):($catId='');

        $articles = ArticleModel::getArticles($search,$catId);
        foreach ($articles as $article) {
            $article['category_name'] = NavModel::where('id',$article['category_id'])->value('name');
        }
        if (!$articles->isEmpty())
        {
            $hasInfo = '1';
        }
        $this->assign('hasInfo',$hasInfo);
        $this->assign('articles',$articles);
        return $this->fetch(':index');
    }

}