<?php
// 根据路由判断是否激活
function navViewActive($anchor)
{
    return Route::currentRouteName() == $anchor ? 'active' : '';
}

/**
 * 得到七牛cdn上100x100头像
 * @param $avatar 头像路径
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function avatar_min($avatar)
{
    $avatar = $avatar ? $avatar : 'avatar/default.jpeg';
    return url(env('QINIU_WEB') . $avatar . '?imageView2/1/w/100/h/100/interlace/0/q/100');
}

/**
 * 从七牛云获得原图
 * @param $img_url
 * @return string
 */
function img($img_url)
{
    return url(env('QINIU_WEB')) . $img_url;
}

function thumb($img_url)
{
    return url(env('QINIU_WEB') . $img_url . '?imageView2/2/w/200');
}

/**
 * 后台查看详细信息链接生成
 * @param $resource
 * @param $key
 * @return string
 */
function viewRow($resource, $key)
{
    return "<a href='/$resource/$key'><i class='fa fa-eye'></i></a>";
}

function getCategory()
{
    $all = \App\Models\Category::all()->toArray();
    $categories = [];
    // 循环组装
    foreach ($all as $category) {
        $categories[$category['id']] = $category['title'];
    }
    return $categories;
}

/**
 * 获取社区分类
 * @return array
 */
function getComCategory()
{
    $all = \App\Models\CategoryCommunity::all()->toArray();
    $categories = [];
    // 循环组装
    foreach ($all as $category) {
        $categories[$category['id']] = $category['title'];
    }
    return $categories;
}

function getTree($data, $parent_id = 0, $count = 1)
{
    // 定义静态变量，使用递归实现取出树结构
    static $treeList = [0 => '顶级分类'];
    // 添加顶级分类
    foreach ($data as $key => $value) {
        if ($value['parent_id'] == $parent_id) {
            $treeList[$value['id']] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $count) . $value['name'];
            unset($data[$key]);
            getTree($data, $value['id'], $count+1);
        }
    }
    return $treeList;
}

function sendActivateMail(\App\Models\User $user) {
    // 生成token，并且将verify设置成false
    \Jrean\UserVerification\Facades\UserVerification::generate($user);
    // 发送邮件
    \Jrean\UserVerification\Facades\UserVerification::send($user, '请验证您的邮箱');
}