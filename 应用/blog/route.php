<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 2018/1/13
 * Time: 10:50
 * blog应用独立路由，需要在 /app/route.php中与原有路由文件$runtimeRoutes合并 如：
 * $runtimeRoutes = include CMF_ROOT . "data/conf/route.php";
 * $blogRoutes = include CMF_ROOT."/app/blog/route.php";
 * $runtimeRoutes = array_merge($runtimeRoutes,$blogRoutes);
 */
return array(
    'cat_id/[:cat_id]' =>
        array(
            0 => 'blog/Index/index?cat_id=:cat_id',
            1 =>
                array(),
            2 =>
                array(
                    'condition' => '',
                ),
        ),
    'search/[:search]' =>
        array(
            0 => 'blog/Index/index?search=:search',
            1 =>
                array(),
            2 =>
                array(
                    'condition' => '',
                ),
        ),
    'detail/[:article_id]' =>
        array(
            0 => 'blog/article/detail?article_id=:article_id',
            1 =>
                array(),
            2 =>
                array(
                    'condition' => '',
                ),
        ),
    'date/[:date]' =>
        array(
            0 => 'blog/article/getarchivearticles?date=:date',
            1 =>
                array(),
            2 =>
                array(
                    'condition' => '',
                ),
        ),

);