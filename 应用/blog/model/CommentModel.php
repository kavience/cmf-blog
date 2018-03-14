<?php
/**
 * Created by kavience.
 * web: www.kavience.com
 * Date: 2017/12/27
 * Time: 21:04
 */

namespace app\blog\model;


use think\Db;

class CommentModel extends BaseModel
{
    protected $autoWriteTimestamp = true;
    protected $table = 'cmf_blog_comment';
    protected $pk = 'id';
    protected $updateTime = false;
    protected $dateFormat = 'Y-m-d H:i:s';

    public function getAllComment()
    {
        return $this->with('article')->paginate(5);
    }
    public function getCommentsBySearch($search)
    {
        return $this->where('content','LIKE','%'.$search.'%')->with('article')->paginate(10);
    }
    public function article()
    {
        return $this->belongsTo('ArticleModel','article_id','id')->field(['title','id']);
    }
    public static function addComment($commentData)
    {
        $comment = new CommentModel([
            'nickname' =>$commentData['nickname'],
            'content' =>$commentData['content'],
            'email' =>$commentData['email'],
            'article_id' =>$commentData['articleId'],
        ]);
        if ($comment->save()){
            Db::table('cmf_blog_article')->where('id',$commentData['articleId'])->setInc('comment_nums');
            return ['valid'=>1,'msg'=>'评论成功'];
        }else{
            return ['valid'=>0,'msg'=>'评论失败'];
        }
    }
}