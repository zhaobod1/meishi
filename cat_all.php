<?php

/**
 * 烽火微信分销代理系统 版本号v H1.0
 *火一五信息科技有限公司
 *主营业务：网站建设、手机app开发、应用软件开发、SEO网络优化、竞价排名已经计算机电路、软件设计
 *网址：www.huo15.com
 *联系方式：15288986891 18765270751
 *QQ : 3186355915
 */
define('IN_ECTOUCH', true);

require(dirname(__FILE__) . '/include/init.php');
$pcat_array = get_categories_tree();


foreach ($pcat_array as $key => $pcat_data) {
    $pcat_array[$key]['name'] = $pcat_data['name'];
    if ($pcat_data['cat_id']) {
        foreach ($pcat_data['cat_id'] as $k => $v) {
            $pcat_array[$key]['cat_id'][$k]['name'] = $v['name'];
        }
    }
}

$smarty->assign('pcat_array', $pcat_array);

$smarty->display("category_all.dwt");
?>