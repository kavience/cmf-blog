<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/27
 * Time: 20:33
 */

namespace app\blog\controller;


use app\blog\model\ArticleModel;
use app\blog\model\NavModel;
use think\Db;
use think\paginator\driver\Bootstrap;
use think\Request;

class ArticleController extends BaseController
{


    /**
     * 通过传入article_id，获取文章详细信息以及所有评论
     *
     */
    public function detail()
    {
        $hasInfo = '0';//0代表没有找到文章
        $hasComments ='0';//0代表该文章没有评论
        empty(input('article_id'))?($articleId=''):($articleId=input('article_id'));
        if ($articleId == '')
        {
            $this->error('文章不存在！');
        }
        $articleInfo = (new ArticleModel())->getArticleById($articleId);
        Db::table('cmf_blog_article')->where('id',$articleId)->setInc('read_times');
        if (!empty($articleInfo))
        {
            $hasInfo = '1';
            $articleInfo = $articleInfo->toArray();
            if (!empty($articleInfo['comments']))
            {
                $hasComments = '1';
                $comments = $this->paginateArray($articleInfo['comments'],'');
                $this->assign('comments',$comments);
            }
            $this->assign('articleInfo',$articleInfo);
        }
        $this->assign('hasInfo',$hasInfo);
        $this->assign('hasComments',$hasComments);
        return $this->fetch(':article-detail');
    }

    /**
     * 获取文章归档内容
     * @return mixed
     */
    public function getArchiveArticles()
    {
        $hasInfo = '0';
        if (!empty(input('date'))){
            $startDate = input('date').'-1';
            $endDate = input('date').'-31';
            $archiveArticles = ArticleModel::getArticleByArchive($startDate,$endDate);
        }else{
            $archiveArticles = ArticleModel::getArticles();
        }


        foreach ($archiveArticles as $article) {
            $article['category_name'] = NavModel::where('id',$article['category_id'])->value('name');
        }
        if (!$archiveArticles->isEmpty()){
            $hasInfo = '1';
        }
        $this->assign('hasInfo',$hasInfo);
        $this->assign('articles',$archiveArticles);
        return $this->fetch(':index');
    }


    /**
     * 对数组进行分页处理
     * @param        $data  要分页的数组
     * @param string $url   分页地址，默认为空
     * @param int    $listRow 每页的数量
     * @return \think\Paginator
     */
    public function paginateArray($data,$url='',$listRow = 5){

        $curpage = input('page') ? input('page') : 1;//当前第x页，有效值为：1,2,3,4,5...
        $countPage = (int)(count($data)/$listRow)+1;
        $showdata = array_chunk($data,$listRow,true);

        if ($curpage<$countPage){
            $p = Bootstrap::make($showdata[$curpage-1], $listRow, $curpage, count($data), false, [
                'var_page' => 'page',
                'path'=>$url,
                'query'    => [],
                'fragment' => '',
            ]);
        }else{
            $p = Bootstrap::make($showdata[$countPage-1], $listRow, $curpage, count($data), false, [
                'var_page' => 'page',
                'path'=>$url,
                'query'    => [],
                'fragment' => '',
            ]);
        }
        $p->appends($_GET);
        return $p;
    }
}