<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/27
 * Time: 19:16
 */

namespace app\blog\model;



class ArticleModel extends BaseModel
{

    protected $autoWriteTimestamp = true;
    protected $table = 'cmf_blog_article';
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * 如果无变量 则显示所有文章
     * 否则通过变量search或者cat_id来查找文章
     * @param $search
     * @param $catId
     * @return mixed
     * @internal param Request $request
     */
    public static function getArticles($search='',$catId='')
    {
        if ($search=='' && $catId=='')
        {
            return self::order('create_time','desc')->paginate(5);
        }
        if ($search !='' && $catId=='')
        {
            return self::where('title','LIKE','%'.$search.'%')->order('create_time','desc')->paginate(5);
        }
        if ($search =='' && $catId!='')
        {
            return self::where('category_id',$catId)->order('create_time','desc')->paginate(5);
        }
        if ($search !='' && $catId !='')
        {
            return self::where('title','LIKE','%'.$search.'%')->where('category_id',$catId)->order('create_time','desc')->paginate(5);
        }

    }


    public static function getArticleById($articleId)
    {
        return self::with(['comments'])->find($articleId);
    }

    public static function getArticleByArchive($startDate,$endDate)
    {
        return self::whereTime('create_time','between',[$startDate,$endDate])->order('create_time')->paginate(5);
    }

    public static function addArticle($data)
    {
        $article = new self([
            'title' => $data['title'],
            'introduce' => $data['introduce'],
            'content' => $data['content'],
            'category_id' => $data['nav']
        ]);
        return $article->save();
    }
    public static function updateArticle($data)
    {
        return self::where('id',$data['id'])->update([
            'title' => $data['title'],
            'introduce' => $data['introduce'],
            'content' => $data['content'],
            'category_id' => $data['nav'],
        ]);
    }
    public static function delArticleById($id){

        if (self::destroy($id)){
            (new CommentModel())->where('article_id',$id)->delete();
            return true;
        }
        return false;

    }
    public function comments()
    {
        return $this->hasMany('CommentModel','article_id','id');
    }
}