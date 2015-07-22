<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="utf-8" />
<title><?php echo $this->_var['page_title']; ?> 触屏版</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/touch-icon.png" rel="apple-touch-icon-precomposed" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/ectouch.css?id=1212" rel="stylesheet" type="text/css" />




<?php if ($this->_var['action'] == 'update_agent'): ?>
<script src="<?php echo $this->_var['ectouch_themes']; ?>/js/huo15jq.js"></script>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/huo15-ui.js"></script>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/datepicker-zh-CN.js"></script>
<link href="<?php echo $this->_var['ectouch_themes']; ?>/css/huo15-ui.css" rel="stylesheet" type="text/css" />
<?php else: ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,common.js,user.js')); ?>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/jquery-1.4.4.min.js"></script>
<?php endif; ?>
<style>
.is_ok {
	height:30px;
	margin-bottom:2px;
	font-family:"黑体";
}
#is_ok_btn {
	float:right;
	margin-right:30px;
}
.label {
	height:3em;
}
</style>



</head>
<body>
 
<?php if ($this->_var['action'] == 'default'): ?>
<header id="header">
  <div class="header_l header_return"> <a class="ico_10" href="user.php"> 返回 </a> </div>
  <h1> 代理中心 </h1>
</header>
<dl class="user_top">
  <dt> <?php if ($this->_var['imgUrl']): ?><img src="<?php echo $this->_var['imgUrl']; ?>"><?php else: ?><img src="<?php echo $this->_var['ectouch_themes']; ?>/images/get_avatar.png"><?php endif; ?> </dt>
  <dd>
    <p><?php echo $this->_var['info']['username']; ?></p>
    <p><span><?php echo $this->_var['tianxin']; ?></span></p>
  </dd>
  <div class="user_distri_list">
    <ul>
      <li> 累计销售：<span style="color:red">￥<?php echo $this->_var['agent_money_sum']; ?></span></li>
    </ul>
  </div>
  <div class="quan1"></div>
  <div class="quan2"></div>
  <div class="quan3"></div>
</dl>
<div class="blank3"></div>
<?php if ($this->_var['is_ok']): ?>
<section class="wrap">
  <div class="list_box padd1 radius10" style="padding-top:0;padding-bottom:0;"> 
    <ul>
	 <li><span class="uninclude">&nbsp; &nbsp; </span><span>代理中心</span>
        <div class="son_list">
          <ul>
            <li onclick="location.href='distribute.php?act=generate&u=<?php echo $this->_var['user_id']; ?>'"><span class="icon">&nbsp; &nbsp; </span><span>我的邀请链接</span> <i></i></li>
            <!--<li onclick="location.href='user.php?act=dianpu'"><span class="icon">&nbsp; &nbsp; </span><span>修改店铺名</span> <i></i></li>-->
			 <li onclick="location.href='user.php'"><span class="icon">&nbsp; &nbsp; </span><span>个人中心</span> <i></i></li>
             <li onclick="location.href='user.php?act=trace'"><span class="icon">&nbsp; &nbsp; </span><span>产品追溯</span> <i></i></li>
          </ul>
        </div>
      </li>
	
      <li><span class="uninclude">&nbsp; &nbsp; </span><span>我的代理商</span> <span class="person"><?php echo $this->_var['total_agent']; ?>人</span>
      
      
      
     <div style="background:#eee; margin:1em 1em;">概览</div>
      
     <?php $_from = $this->_var['agents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('brand_key', 'v');if (count($_from)):
    foreach ($_from AS $this->_var['brand_key'] => $this->_var['v']):
?> 
    
     
      <div class="son_list">
      <?php if ($this->_var['v']['sum']): ?>
          <ul>
		   
		   
		    <li onclick="location.href='distribute.php?act=vertifing&brand=<?php echo $this->_var['brand_key']; ?>'"><span class="icon">&nbsp; &nbsp; </span><span><?php echo $this->_var['brand_key']; ?></span> <i></i><span class="sp"><?php echo $this->_var['v']['sum']; ?>人</span></li>
		
          </ul>
          <?php endif; ?>
        </div>
      
      
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
         
      
      <div style="background:#eee; margin:1em 1em;">注意</div> 
      <div class="son_list">
          <ul>
		   
		   
		    <li onclick="location.href='distribute.php?act=vertifing'"><span class="icon">&nbsp; &nbsp; </span><span>未审核人数</span> <i></i><span class="sp"><?php if ($this->_var['total_vertifing'] != ''): ?><?php echo $this->_var['total_vertifing']; ?><?php else: ?>0<?php endif; ?>人</span></li>
		
          </ul>
        </div> 
      
    
      
      
      
      
      
      
      
      
      
        
      </li>
	  
	  <!--
      <li><span class="uninclude">&nbsp; &nbsp; </span><span>我的推广</span></li>
        <div class="son_list">
          <ul>
            <li><span class="icon1">&nbsp; &nbsp; </span><span>点击量</span> <span class="sp">2人</span></li>
            <li><span class="icon1">&nbsp; &nbsp; </span><span>关注量</span> <span class="sp">1人</span></li>
            <li><span class="icon1">&nbsp; &nbsp; </span><span>成为分销会员</span> <span class="sp">1人</span></li>
          </ul>
        </div>
        -->
      <li id="self_list"><span class="uninclude">&nbsp; &nbsp; </span><span>垂直</span>业务 <span class="person"><?php echo $this->_var['user_order_num']; ?></span></li>
      	<div class="son_list">
          <ul>
              <li id="self_add_order"><span class="icon2" >&nbsp; &nbsp; </span><span>添加订单</span> <span class="sp">》</span></li>
              <li id="self_scan_order"><span class="icon2" >&nbsp; &nbsp; </span><span>扫码未完结订单</span> <span class="sp"><?php echo $this->_var['user_order_scan_num']; ?></span></li>
               <li id="self_end_order"><span class="icon2" >&nbsp; &nbsp; </span><span>已发货订单</span> <span class="sp"><?php echo $this->_var['user_order_end_num']; ?></span></li>
                 
          </ul>
        </div>
      <li id="agent_money_sum"><span class="uninclude">&nbsp; &nbsp; </span><span>代理商</span>业务 <span class="person">￥<?php echo $this->_var['agent_money_sum']; ?></span></li>
        <div class="son_list">
          <ul>
          <li id="agent_add_order"><span class="icon2" >&nbsp; &nbsp; </span><span>添加订单</span> <span class="sp">》</span></li>
			
          <li id="agent_scan_list"><span class="icon2">&nbsp; &nbsp; </span><span>扫码未完结订单</span> <span class="sp">￥<?php echo $this->_var['agent_scan_sum']; ?></span></li>
            <li id="agent_unpay_list"><span class="icon2">&nbsp; &nbsp; </span><span>未付款订单</span> <span class="sp">￥<?php echo $this->_var['agent_unpay_sum']; ?></span></li>
            <li id="agent_pay_list"><span class="icon2">&nbsp; &nbsp; </span><span>已付款订单</span> <span class="sp">￥<?php echo $this->_var['agent_pay_sum']; ?></span></li>
            <li id="agent_done_list"><span class="icon2" >&nbsp; &nbsp; </span><span>已发货订单</span> <span class="sp">￥<?php echo $this->_var['agent_done_sum']; ?></span></li>
			
			<!--
            <li><span class="icon2">&nbsp; &nbsp; </span><span>已审核订单佣金</span> <span class="sp">￥177.6</span></li>-->
          </ul>
        </div>
      <!--<li onclick="location.href='distribute.php?act=account_raply';"><span class="uninclude">&nbsp; &nbsp; </span><span>申请提现</span></li>-->
    </ul>
  </div>
  
  
  <?php endif; ?>
  <div class="blank3"></div>
  <div class="blank3"></div>
  <div class="list_box padd1 radius10" style="padding-top:0;padding-bottom:0;"> 
    <!-- <a href="user.php?act=track_packages" class="clearfix">
				<span></span><i></i>
			</a>  --> 
 </div>
</section>

<?php endif; ?> 
 
 
 







 
<?php if ($this->_var['action'] == 'vertifing'): ?> 
<header id="header">
  <div class="header_l header_return"> <a class="ico_10" href="distribute.php"> 返回 </a> </div>
  <h1><?php if ($this->_var['huo15_vertifing_agent']): ?>未审核通过的代理商<?php else: ?>我的下级代理商申请人<?php endif; ?></h1>
</header>

<section class="class="wrap"">
<div class="content">

  <img src="<?php echo $this->_var['user']['head_url']; ?>"  border="0">
 
  <?php $_from = $this->_var['arr_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['user']):
?>
   <a href="distribute.php?act=update_agent&user_id=<?php echo $this->_var['user']['user_id']; ?>">
   
       	<dl>
            	<dt><?php if ($this->_var['user']['head_url'] != ''): ?><?php else: ?><img src="<?php echo $this->_var['ectouch_themes']; ?>/images/get_avatar.png"  border="0"><?php endif; ?></dt>
                <dd style="float:right"><h3> <?php if ($this->_var['user']['is_ok']): ?><span style="color:red">已经审核</span><?php else: ?>审核未通过 <?php endif; ?></h3></dd>
               
                <div class="fl">
                  <h3>&nbsp;会&nbsp;员&nbsp;名：<?php if ($this->_var['user']['nickname']): ?><?php echo $this->_var['user']['nickname']; ?><?php else: ?><?php echo $this->_var['user']['user_name']; ?><?php endif; ?></h3>
                  <h3>代理品牌：<?php echo $this->_var['user']['agent_brand']; ?></h3>
                 
                  <h3>订单数量：<?php echo $this->_var['user']['order_num']; ?></h3>
                  
                  
                <p>
    </p></div>
    
            </dl>
        </a>
      <!--  <?php if ($this->_var['user']['is_ok'] == '1'): ?>
        <a href="distribute.php?act=myorder&user_id=<?php echo $this->_var['user']['user_id']; ?>&level=<?php echo $this->_var['user']['agent_level']; ?>">订单详情</a>
        <?php endif; ?>-->
       
	<?php endforeach; else: ?>
  <div class="no-records" colspan="10" align="center"><?php echo $this->_var['lang']['no_records']; ?></div>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
</section>
<?php endif; ?> 
 

 
<?php if ($this->_var['action'] == 'fenxiao2'): ?> 
<header id="header">
  <div class="header_l header_return"> <a class="ico_10" href="distribute.php"> 返回 </a> </div>
  <h1> 我的分销二级会员<?php echo $this->_var['count']; ?>人</h1>
</header>

<section class="class="wrap"">
<div class="content">
  <?php $_from = $this->_var['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['user']):
?>
   
    	<a href="distribute.php?act=myorder&user_id=<?php echo $this->_var['user']['user_id']; ?>&level=<?php echo $this->_var['user']['level']; ?>">
        	<dl>
            	<dt><?php if ($this->_var['user']['head_url'] != ''): ?><img src="<?php echo $this->_var['user']['head_url']; ?>"  border="0"><?php else: ?><img src="<?php echo $this->_var['ectouch_themes']; ?>/images/get_avatar.png"  border="0"><?php endif; ?></dt>
                <div>
                  <h3>&nbsp;会&nbsp;员&nbsp;名：<?php if ($this->_var['user']['nickname']): ?><?php echo $this->_var['user']['nickname']; ?><?php else: ?><?php echo $this->_var['user']['user_name']; ?><?php endif; ?></h3>
                  <h3>订单数量：<?php echo $this->_var['user']['order_num']; ?></h3>
                  <h3>提成金额：<?php echo $this->_var['user']['setmoney']; ?></h3>
                <p>
    </p></div>
            </dl>
        </a>
	<?php endforeach; else: ?>
  <div class="no-records" colspan="10" align="center"><?php echo $this->_var['lang']['no_records']; ?></div>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
</section>
<?php endif; ?> 
 

 
<?php if ($this->_var['action'] == 'fenxiao3'): ?> 
<header id="header">
  <div class="header_l header_return"> <a class="ico_10" href="distribute.php"> 返回 </a> </div>
  <h1> 我的分销三级会员<?php echo $this->_var['count']; ?>人</h1>
</header>

<section class="class="wrap"">
<div class="content">
  <?php $_from = $this->_var['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['user']):
?>
   
    	<a href="distribute.php?act=myorder&user_id=<?php echo $this->_var['user']['user_id']; ?>&level=<?php echo $this->_var['user']['level']; ?>">
        	<dl>
            	<dt><?php if ($this->_var['user']['head_url'] != ''): ?><img src="<?php echo $this->_var['user']['head_url']; ?>"  border="0"><?php else: ?><img src="<?php echo $this->_var['ectouch_themes']; ?>/images/get_avatar.png"  border="0"><?php endif; ?></dt>
                <div>
                  <h3>&nbsp;会&nbsp;员&nbsp;名：<?php if ($this->_var['user']['nickname']): ?><?php echo $this->_var['user']['nickname']; ?><?php else: ?><?php echo $this->_var['user']['user_name']; ?><?php endif; ?></h3>
                  <h3>订单数量：<?php echo $this->_var['user']['order_num']; ?></h3>
                  <h3>提成金额：<?php echo $this->_var['user']['setmoney']; ?></h3>
                <p>
    </p></div>
            </dl>
        </a>
	<?php endforeach; else: ?>
  <div class="no-records" colspan="10" align="center"><?php echo $this->_var['lang']['no_records']; ?></div>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
</section>
<?php endif; ?> 

 
<?php if ($this->_var['action'] == 'fenxiao4'): ?> 
<header id="header">
  <div class="header_l header_return"> <a class="ico_10" href="distribute.php"> 返回 </a> </div>
  <h1> 我的分销四级会员<?php echo $this->_var['count']; ?>人</h1>
</header>

<section class="class="wrap"">
<div class="content">
  <?php $_from = $this->_var['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['user']):
?>
   
    	<a href="distribute.php?act=myorder&user_id=<?php echo $this->_var['user']['user_id']; ?>&level=<?php echo $this->_var['user']['level']; ?>">
        	<dl>
            	<dt><?php if ($this->_var['user']['head_url'] != ''): ?><img src="<?php echo $this->_var['user']['head_url']; ?>"  border="0"><?php else: ?><img src="<?php echo $this->_var['ectouch_themes']; ?>/images/get_avatar.png"  border="0"><?php endif; ?></dt>
                <div>
                  <h3>&nbsp;会&nbsp;员&nbsp;名：<?php if ($this->_var['user']['nickname']): ?><?php echo $this->_var['user']['nickname']; ?><?php else: ?><?php echo $this->_var['user']['user_name']; ?><?php endif; ?></h3>
                  <h3>订单数量：<?php echo $this->_var['user']['order_num']; ?></h3>
                  <h3>提成金额：<?php echo $this->_var['user']['setmoney']; ?></h3>
                <p>
    </p></div>
            </dl>
        </a>
	<?php endforeach; else: ?>
  <div class="no-records" colspan="10" align="center"><?php echo $this->_var['lang']['no_records']; ?></div>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
</section>
<?php endif; ?> 

 











<?php if ($this->_var['action'] == 'update_user'): ?>
<form method="post" action="user.php" name="theForm" onsubmit="return validate()" enctype="multipart/form-data">
<table width="100%" >
  <tr>
    <td class="label"><?php echo $this->_var['lang']['username']; ?>:</td>
    <td><?php if ($this->_var['form_action'] == "update"): ?><?php echo $this->_var['user']['user_name']; ?><input type="hidden" name="username" value="<?php echo $this->_var['user']['user_name']; ?>" /><?php else: ?><input type="text" name="username" maxlength="60" value="<?php echo $this->_var['user']['user_name']; ?>" /><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?></td>
  </tr>
    <tr style="display:none">
    <td class="label">会员号:</td>
    <td><?php echo $this->_var['user']['user_num']; ?></td>
  </tr>
  
  <script>
   <?php $_from = $this->_var['arrBAndL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'BAndL');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['BAndL']):
?>
   	var agent_level_option_s<?php echo $this->_var['key']; ?> = <?php echo $this->_var['BAndL']['start_num']; ?>;
    var agent_level_option_d<?php echo $this->_var['key']; ?> = <?php echo $this->_var['BAndL']['end_num']; ?>;
   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   
   </script>
   
   
  
  
   <script>
    	var brand_name_option = '';
    </script>
  <?php $_from = $this->_var['arrBAndL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'BAndL');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['BAndL']):
?>
  
   
 
  
  
  
  
 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
 <script>
 $(function () {
 <?php $_from = $this->_var['user']['brand_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['user']):
?>
 	var agent_brand<?php echo $this->_var['k']; ?> = '<?php echo $this->_var['user']['agent_brand']; ?>';
    var agent_level<?php echo $this->_var['k']; ?> = <?php echo $this->_var['user']['agent_level']; ?>;
	var agent_is_ok<?php echo $this->_var['k']; ?> = <?php echo $this->_var['user']['is_ok']; ?>;
	
	 //更改选择项目
	 $('[name="agent_brand<?php echo $this->_var['k']; ?>"]').find('option[value="<?php echo $this->_var['user']['agent_brand']; ?>"]').attr('selected', 'selected');
	 $('[name="agent_level<?php echo $this->_var['k']; ?>"]').find('option[value="<?php echo $this->_var['user']['agent_level']; ?>"]').attr('selected', 'selected');
	
	  $('[name="is_ok<?php echo $this->_var['k']; ?>"]').each(function(index, element) {
		 
        if ($(element).val() == <?php echo $this->_var['user']['is_ok']; ?>) {
			
			$(element).attr('checked', true);
		}
    });

 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
 });
 </script>

   
 
  
  
  
  
  
  
  
  
  <?php if ($this->_var['form_action'] == "update"): ?>
  <tr style="display:none">
    <td class="label"><?php echo $this->_var['lang']['user_money']; ?>:</td>
    <td><?php echo $this->_var['user']['formated_user_money']; ?> <a href="account_log.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>&account_type=user_money">[ <?php echo $this->_var['lang']['view_detail_account']; ?> ]</a> </td>
  </tr>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['frozen_money']; ?>:</td>
    <td><?php echo $this->_var['user']['formated_frozen_money']; ?> <a href="account_log.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>&account_type=frozen_money">[ <?php echo $this->_var['lang']['view_detail_account']; ?> ]</a> </td>
  </tr>
  <tr style="display:none">
    <td class="label" ><a href="javascript:showNotice('noticeRankPoints');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="themes/miqinew/images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a> <?php echo $this->_var['lang']['rank_points']; ?>:</td>
    <td><?php echo $this->_var['user']['rank_points']; ?> <a href="account_log.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>&account_type=rank_points">[ <?php echo $this->_var['lang']['view_detail_account']; ?> ]</a> <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeRankPoints"><?php echo $this->_var['lang']['notice_rank_points']; ?></span></td>
  </tr>
  <tr style="display:none">
    <td class="label" ><a href="javascript:showNotice('noticePayPoints');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="themes/miqinew/images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>" /></a> <?php echo $this->_var['lang']['pay_points']; ?>:</td>
    <td><?php echo $this->_var['user']['pay_points']; ?> <a href="account_log.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>&account_type=pay_points">[ <?php echo $this->_var['lang']['view_detail_account']; ?> ]</a> <br />
        <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticePayPoints"><?php echo $this->_var['lang']['notice_pay_points']; ?></span></td>
  </tr>
  <?php endif; ?>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['email']; ?>:</td>
    <td><input type="text" name="email" maxlength="60" size="40" value="<?php echo $this->_var['user']['email']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <?php if ($this->_var['form_action'] == "insert"): ?>
  <tr>
    <td class="label">密码：</td>
    <td><input class="inputBg" type="password" name="password" maxlength="20" size="20" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label">确认密码:</td>
    <td><input  class="inputBg" type="password" name="confirm_password" maxlength="20" size="20" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <?php elseif ($this->_var['form_action'] == "update"): ?>
  <tr>
    <td class="label">密码:</td>
    <td><input  class="inputBg" type="password" name="password" maxlength="20" size="20" /></td>
  </tr>
  <tr>
    <td class="label">确认密码:</td>
    <td><input  class="inputBg" type="password" name="confirm_password" maxlength="20" size="20" /></td>
  </tr>
  <?php endif; ?>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['user_rank']; ?>:</td>
    <td><select name="user_rank">
      <option value="0"><?php echo $this->_var['lang']['not_special_rank']; ?></option>
      <?php echo $this->html_options(array('options'=>$this->_var['special_ranks'],'selected'=>$this->_var['user']['user_rank'])); ?>
    </select></td>
  </tr>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['gender']; ?>:</td>
    <td><?php echo $this->html_radios(array('name'=>'sex','options'=>$this->_var['lang']['sex'],'checked'=>$this->_var['user']['sex'])); ?></td>
  </tr>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['birthday']; ?>:</td>
    <td><?php echo $this->html_select_date(array('field_order'=>'YMD','prefix'=>'birthday','time'=>$this->_var['user']['birthday'],'start_year'=>'-60','end_year'=>'+1','display_days'=>'true','month_format'=>'%m')); ?></td>
  </tr>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['credit_line']; ?>:</td>
    <td><input name="credit_line" type="text" id="credit_line" value="<?php echo $this->_var['user']['credit_line']; ?>" size="10" /></td>
  </tr>
  
  <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
  <tr>
    <td class="label"><?php echo $this->_var['field']['reg_field_name']; ?>:</td>
    <td>
    <?php if ($this->_var['field']['reg_field_name'] == '性别'): ?>
    
    男<input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="radio" size=""  value="0" <?php if ($this->_var['field']['content']): ?><?php else: ?>checked="checked"<?php endif; ?> />
     女<input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="radio" size=""  value="1" <?php if ($this->_var['field']['content']): ?> checked="checked"<?php else: ?><?php endif; ?>/>
     <?php elseif ($this->_var['field']['field_type'] == 4): ?>
     	<?php if ($this->_var['field']['content']): ?><?php else: ?><input type="file" name="extend_field<?php echo $this->_var['field']['id']; ?>" /><br/><?php endif; ?>
     
         <img src="WEB_PATH<?php echo $this->_var['field']['content']; ?>" alt="头像图片" style="max-height:300px;" />
     <?php else: ?>
    <input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="text" size="40" class="inputBg" value="<?php echo $this->_var['field']['content']; ?>"/>
    <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <?php if ($this->_var['user']['parent_id']): ?>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['parent_user']; ?>:</td>
    <td><a href="users.php?act=edit&id=<?php echo $this->_var['user']['parent_id']; ?>"><?php echo $this->_var['user']['parent_username']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="users.php?act=remove_parent&id=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['parent_remove']; ?></a></td>
  </tr>
  <?php endif; ?>
  <?php if ($this->_var['affiliate']['on'] == 1 && $this->_var['affdb']): ?>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['affiliate_user']; ?>:</td>
    <td>[<a href="users.php?act=aff_list&auid=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['show_affiliate_users']; ?></a>][<a href="affiliate_ck.php?act=list&auid=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['show_affiliate_orders']; ?></a>]</td>
  </tr>
  <tr>
    <td></td>
    <td>   
    <table border="0" cellspacing="1" style="background: #dddddd; width:30%;">
    <tr>
    <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_lever']; ?></td>
    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('level', 'val0');if (count($_from)):
    foreach ($_from AS $this->_var['level'] => $this->_var['val0']):
?>
    <td bgcolor="#ffffff"><?php echo $this->_var['level']; ?></td>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </tr>
    <tr>
    <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_num']; ?></td>
    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
    <td bgcolor="#ffffff"><?php echo $this->_var['val']['num']; ?></td>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </tr>
    </table>
    </td>
  </tr>
  <?php endif; ?>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" value="提交" class="button" />
      <input type="hidden" name="act" value="update_agent_do" />
      <input type="hidden" name="id" value="<?php echo $this->_var['user_id']; ?>" />    </td>
  </tr>
</table>

</form>
<?php endif; ?>

















<?php if ($this->_var['action'] == 'certification'): ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.1, maximum-scale=2.0, user-scalable=yes" /> 
 <style>
 	.agent_bg {
		position:relative;
	}
		
 	p {
		position:absolute;
		color:#fff;
		font-size:1.8em;
		font-family:"微软雅黑";
	}
	p.black {
		color:#000;
	}
	p.line1 {
		left:250px;
		top:285px;
	}
	p.line1 span.wx {
		margin-left:150px;
	}
	p.line1 span.phone {
		margin-left:100px;
	}
	p.line2 {
		left:240px;
		top:325px;
	}
	p.line3 {
		font-size:1.5em;
		left:170px;
		top:420px;
	}
	p.line4 {
		font-size:1.5em;
		left:270px;
		top:465px;
	}
	p.line5 {
		font-size:3em;
		left:350px;
		top:380px;
		font-weight:bold;
	}
 	.agent_bg {
		width:900px;
		height:650px;
		margin:1em auto;
	}
 </style>
    <?php $_from = $this->_var['agent_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'v');if (count($_from)):
    foreach ($_from AS $this->_var['v']):
?>
         <?php if ($this->_var['v']['is_ok']): ?>
         
         <div class="agent_bg" style="background:url(/mobile/images/<?php if ($this->_var['v']['agent_brand'] == 'AL'): ?>al.jpg<?php else: ?>msg.jpg<?php endif; ?>)">
         	
         	
            <p class="line1 <?php if ($this->_var['v']['agent_brand'] == 'AL'): ?>black<?php endif; ?>"><span class="name"><?php echo $this->_var['v']['name']; ?></span><span class="wx"><?php echo $this->_var['v']['wx']; ?></span><span class="phone"><?php echo $this->_var['v']['phone']; ?></span></p>
           <?php if ($this->_var['v']['agent_brand'] == 'AL'): ?>
            <p class="line2 <?php if ($this->_var['v']['agent_brand'] == 'AL'): ?>black<?php endif; ?>"><span><?php echo $this->_var['v']['agent_brand']; ?></span></p>
           <?php endif; ?>
           <?php if ($this->_var['v']['start_date']): ?>
            <p class="line3 <?php if ($this->_var['v']['agent_brand'] == 'AL'): ?>black<?php endif; ?>"><span>授权日期：</span><span><?php echo $this->_var['v']['start_date']; ?></span> <span>&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;</span> <span><?php echo $this->_var['v']['end_date']; ?></span></p>
            <?php endif; ?>
            <p class="line4 <?php if ($this->_var['v']['agent_brand'] == 'AL'): ?>black<?php endif; ?>"><span><?php echo $this->_var['v']['no']; ?></span></p>
            <p class="line5 <?php if ($this->_var['v']['agent_brand'] == 'AL'): ?>black<?php endif; ?>"><span><?php echo $this->_var['v']['agent_name']; ?></span></p>
              
            
         </div>
		 <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

<?php endif; ?>























<?php if ($this->_var['action'] == 'update_agent'): ?>
<form method="post" action="distribute.php" name="theForm" onsubmit="return validate()" enctype="multipart/form-data">
<table width="95%" style="margin:0 auto;" >
  <tr>
    <td class="label"><?php echo $this->_var['lang']['username']; ?>:</td>
    <td><?php if ($this->_var['form_action'] == "update"): ?><?php echo $this->_var['user']['user_name']; ?><input type="hidden" name="username" value="<?php echo $this->_var['user']['user_name']; ?>" /><?php else: ?><input type="text" name="username" maxlength="60" value="<?php echo $this->_var['user']['user_name']; ?>" /><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?></td>
  </tr>
    <tr style="display:none">
    <td class="label">会员号:</td>
    <td><?php echo $this->_var['user']['user_num']; ?></td>
  </tr>
  
  <script>
  var brand_name_option = '<option value="not">请选择</option>';
  var obj_check = {};
   <?php $_from = $this->_var['arrBAndL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'BAndL');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['BAndL']):
?>
   	var agent_level_option_s<?php echo $this->_var['key']; ?> = <?php echo $this->_var['BAndL']['start_num']; ?>;
    var agent_level_option_d<?php echo $this->_var['key']; ?> = <?php echo $this->_var['BAndL']['end_num']; ?>;
	 brand_name_option = brand_name_option + '<option value="<?php echo $this->_var['BAndL']['agent_brand']; ?>"><?php echo $this->_var['BAndL']['agent_brand']; ?></option>';
	 obj_check.c<?php echo $this->_var['key']; ?> = {};
	 obj_check.c<?php echo $this->_var['key']; ?>.brand = '<?php echo $this->_var['BAndL']['agent_brand']; ?>';
	 obj_check.c<?php echo $this->_var['key']; ?>.start_num = <?php echo $this->_var['BAndL']['start_num']; ?>;
	 obj_check.c<?php echo $this->_var['key']; ?>.end_num = <?php echo $this->_var['BAndL']['end_num']; ?>;
   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
 
	  
	
   
   </script>
   
 
  <?php $_from = $this->_var['user']['brand_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'BAndL');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['BAndL']):
?>
  
   <tr>
    <td class="label">代理品牌:</td>
    
    <td><select class="brand_name_option" name="agent_brand<?php echo $this->_var['key']; ?>" > 
   	
    </select>
    代理等级：<select name="agent_level<?php echo $this->_var['key']; ?>" >
    	<?php echo $this->_var['BAndL']['option']; ?>
    </select>
    </td>
  </tr>
 <tr >
   <td class="label">授权日期:</td>
    <td><input name="start_date<?php echo $this->_var['key']; ?>" type="text" class="datepicker"  <?php if ($this->_var['BAndL']['start_date']): ?>value="<?php echo $this->_var['BAndL']['start_date']; ?>"<?php else: ?><?php endif; ?>  />&nbsp;&nbsp;至&nbsp;&nbsp;<input class="datepicker" name="end_date<?php echo $this->_var['key']; ?>" type="text"  <?php if ($this->_var['BAndL']['end_date']): ?>value="<?php echo $this->_var['BAndL']['end_date']; ?>"<?php else: ?><?php endif; ?>  /></td>
  </tr>
  <tr >
   <td class="label">审核状态:</td>
    <td>通过<input name="is_ok<?php echo $this->_var['key']; ?>" type="radio"  <?php if ($this->_var['user']['is_ok'] == '1'): ?>checked="checked"<?php else: ?><?php endif; ?>  value="1" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;未审核<input name="is_ok<?php echo $this->_var['key']; ?>" type="radio"  <?php if ($this->_var['user']['is_ok'] == '1'): ?><?php else: ?>checked="checked"<?php endif; ?> value="0" /></td>
  </tr>
  <br/>
  <tr>
  	<td style="height:0.3em;background:#333;"></td><td style="height:0.3em;background:#333;"></td>
  </tr>
  
  
 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
 <script>
  //更改选择项目
	 $('.brand_name_option').each(function(index, element) {
        $(element).html(brand_name_option);
    });
 $(function () {
 <?php $_from = $this->_var['user']['brand_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['user']):
?>
 	var agent_brand<?php echo $this->_var['k']; ?> = '<?php echo $this->_var['user']['agent_brand']; ?>';
    var agent_level<?php echo $this->_var['k']; ?> = <?php echo $this->_var['user']['agent_level']; ?>;
	var agent_is_ok<?php echo $this->_var['k']; ?> = <?php echo $this->_var['user']['is_ok']; ?>;
	
	 
	 //$('[name="agent_brand<?php echo $this->_var['k']; ?>"]').find('option[value="<?php echo $this->_var['user']['agent_brand']; ?>"]').attr('selected', 'selected');
	 $('[name="agent_brand<?php echo $this->_var['k']; ?>"]').find('option[value="<?php echo $this->_var['user']['agent_brand']; ?>"]').prop('selected', 'selected');
	
	// $('[name="agent_level<?php echo $this->_var['k']; ?>"]').find('option[value="<?php echo $this->_var['user']['agent_level']; ?>"]').attr('selected', 'selected');
	 $('[name="agent_level<?php echo $this->_var['k']; ?>"]').find('option[value="<?php echo $this->_var['user']['agent_level']; ?>"]').prop('selected', 'selected');
	 
	  $('[name="is_ok<?php echo $this->_var['k']; ?>"]').each(function(index, element) {
		 
        if ($(element).val() == <?php echo $this->_var['user']['is_ok']; ?>) {
			
			$(element).attr('checked', true);
			$(element).prop('checked', true);
		}
    });

 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
 
 	//点击下拉菜单更改下拉状态
	
	 $('.brand_name_option').each(function(index, element) {
    	
		
			
				
				$(element).change(function () {
					//alert($('[name="agent_level'+ index +'"]').attr('name'));
					<?php $_from = $this->_var['arrBAndL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'BAndL');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['BAndL']):
?>
					if ($(element).find('option:selected').val() == '<?php echo $this->_var['BAndL']['agent_brand']; ?>')
					$('[name="agent_level'+ index +'"]').html('<?php echo $this->_var['BAndL']['option']; ?>');
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				});
			
		
	});
	
	
	//日期选择
	$('.datepicker').each(function(index, element) {
        $(element).datepicker();
    });
	
	
 });
 </script>

   
 
  
  
  
  
  
  
  
  
  <?php if ($this->_var['form_action'] == "update"): ?>
  <tr style="display:none">
    <td class="label"><?php echo $this->_var['lang']['user_money']; ?>:</td>
    <td><?php echo $this->_var['user']['formated_user_money']; ?> <a href="account_log.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>&account_type=user_money">[ <?php echo $this->_var['lang']['view_detail_account']; ?> ]</a> </td>
  </tr>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['frozen_money']; ?>:</td>
    <td><?php echo $this->_var['user']['formated_frozen_money']; ?> <a href="account_log.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>&account_type=frozen_money">[ <?php echo $this->_var['lang']['view_detail_account']; ?> ]</a> </td>
  </tr>
  <tr style="display:none">
    <td class="label" ><a href="javascript:showNotice('noticeRankPoints');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="themes/miqinew/images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a> <?php echo $this->_var['lang']['rank_points']; ?>:</td>
    <td><?php echo $this->_var['user']['rank_points']; ?> <a href="account_log.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>&account_type=rank_points">[ <?php echo $this->_var['lang']['view_detail_account']; ?> ]</a> <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeRankPoints"><?php echo $this->_var['lang']['notice_rank_points']; ?></span></td>
  </tr>
  <tr style="display:none">
    <td class="label" ><a href="javascript:showNotice('noticePayPoints');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="themes/miqinew/images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>" /></a> <?php echo $this->_var['lang']['pay_points']; ?>:</td>
    <td><?php echo $this->_var['user']['pay_points']; ?> <a href="account_log.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>&account_type=pay_points">[ <?php echo $this->_var['lang']['view_detail_account']; ?> ]</a> <br />
        <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticePayPoints"><?php echo $this->_var['lang']['notice_pay_points']; ?></span></td>
  </tr>
  <?php endif; ?>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['email']; ?>:</td>
    <td><input type="text" name="email" maxlength="60" size="40" value="<?php echo $this->_var['user']['email']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <?php if ($this->_var['form_action'] == "insert"): ?>
  <tr>
    <td class="label">密码：</td>
    <td><input class="inputBg" type="password" name="password" maxlength="20" size="20" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label">确认密码:</td>
    <td><input  class="inputBg" type="password" name="confirm_password" maxlength="20" size="20" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <?php elseif ($this->_var['form_action'] == "update"): ?>
  <tr>
    <td class="label">密码:</td>
    <td><input  class="inputBg" type="password" name="password" maxlength="20" size="20" /></td>
  </tr>
  <tr>
    <td class="label">确认密码:</td>
    <td><input  class="inputBg" type="password" name="confirm_password" maxlength="20" size="20" /></td>
  </tr>
  <?php endif; ?>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['user_rank']; ?>:</td>
    <td><select name="user_rank">
      <option value="0"><?php echo $this->_var['lang']['not_special_rank']; ?></option>
      <?php echo $this->html_options(array('options'=>$this->_var['special_ranks'],'selected'=>$this->_var['user']['user_rank'])); ?>
    </select></td>
  </tr>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['gender']; ?>:</td>
    <td><?php echo $this->html_radios(array('name'=>'sex','options'=>$this->_var['lang']['sex'],'checked'=>$this->_var['user']['sex'])); ?></td>
  </tr>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['birthday']; ?>:</td>
    <td><?php echo $this->html_select_date(array('field_order'=>'YMD','prefix'=>'birthday','time'=>$this->_var['user']['birthday'],'start_year'=>'-60','end_year'=>'+1','display_days'=>'true','month_format'=>'%m')); ?></td>
  </tr>
  <tr  style="display:none">
    <td class="label"><?php echo $this->_var['lang']['credit_line']; ?>:</td>
    <td><input name="credit_line" type="text" id="credit_line" value="<?php echo $this->_var['user']['credit_line']; ?>" size="10" /></td>
  </tr>
  
  <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
  <tr>
    <td class="label"><?php echo $this->_var['field']['reg_field_name']; ?>:</td>
    <td>
    <?php if ($this->_var['field']['reg_field_name'] == '性别'): ?>
    
    男<input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="radio" size=""  value="0" <?php if ($this->_var['field']['content']): ?><?php else: ?>checked="checked"<?php endif; ?> />
     女<input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="radio" size=""  value="1" <?php if ($this->_var['field']['content']): ?> checked="checked"<?php else: ?><?php endif; ?>/>
     <?php elseif ($this->_var['field']['field_type'] == 4): ?>
     	<?php if ($this->_var['field']['content']): ?><?php else: ?><input type="file" name="extend_field<?php echo $this->_var['field']['id']; ?>" /><br/><?php endif; ?>
     
         <img src="WEB_PATH<?php echo $this->_var['field']['content']; ?>" alt="头像图片" style="max-height:300px;" />
     <?php else: ?>
    <input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="text" size="40" class="inputBg" value="<?php echo $this->_var['field']['content']; ?>"/>
    <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <?php if ($this->_var['user']['parent_id']): ?>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['parent_user']; ?>:</td>
    <td><a href="users.php?act=edit&id=<?php echo $this->_var['user']['parent_id']; ?>"><?php echo $this->_var['user']['parent_username']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="users.php?act=remove_parent&id=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['parent_remove']; ?></a></td>
  </tr>
  <?php endif; ?>
  <?php if ($this->_var['affiliate']['on'] == 1 && $this->_var['affdb']): ?>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['affiliate_user']; ?>:</td>
    <td>[<a href="users.php?act=aff_list&auid=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['show_affiliate_users']; ?></a>][<a href="affiliate_ck.php?act=list&auid=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['show_affiliate_orders']; ?></a>]</td>
  </tr>
  <tr>
    <td></td>
    <td>   
    <table border="0" cellspacing="1" style="background: #dddddd; width:30%;">
    <tr>
    <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_lever']; ?></td>
    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('level', 'val0');if (count($_from)):
    foreach ($_from AS $this->_var['level'] => $this->_var['val0']):
?>
    <td bgcolor="#ffffff"><?php echo $this->_var['level']; ?></td>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </tr>
    <tr>
    <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_num']; ?></td>
    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
    <td bgcolor="#ffffff"><?php echo $this->_var['val']['num']; ?></td>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </tr>
    </table>
    </td>
  </tr>
  <?php endif; ?>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" value="提交" class="button" />
      <input type="hidden" name="act" value="update_agent_do" />
      <input type="hidden" name="id" value="<?php echo $this->_var['user_id']; ?>" />    </td>
  </tr>
</table>

</form>
<?php endif; ?>






<?php if ($this->_var['action'] == 'generate'): ?> 

<header id="header">
  <div class="header_l header_return"> <a class="ico_10" href="distribute.php"> 返回 </a> </div>
  <h1>生成邀请链接</h1>
</header>

<section class="class="wrap"">
<div class="content">
  
   
    
        	<dl>
        	  <div>
              
                <div id="link_div">
                               <!-- <input type="text" id="mylink" size="100"   />--><input type="button" id="mybtn" value="点击生成链接" />    <br/><br/><br/> <img src="" id="myimg" alt="请点击生成邀请链接，在这里生成图片" /></div>
                        </div>
            </dl>
       
	

  
  </div>
</section>
<?php endif; ?> 


<?php echo $this->fetch('library/page_footer.lbi'); ?>
<div style="width:1px; height:1px; overflow:hidden"><?php $_from = $this->_var['lang']['p_y']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pv');if (count($_from)):
    foreach ($_from AS $this->_var['pv']):
?><?php echo $this->_var['pv']; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></div>
</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

$(function () {
	
	
	var linkTxt = encodeURI("http://" + window.location.host + "/mobile/user.php?act=register&u=<?php echo $this->_var['u']; ?>");
	var linkTxt = encodeURIComponent("http://" + window.location.host + "/mobile/user.php?act=register&u=<?php echo $this->_var['u']; ?>");
	$('#mybtn').click(function(){
		//alert(linkTxt);
		alert('邀请二维码生成成功！请等待加载。长按二维码即可打开邀请页！');
	
	
	
	
	$('#mylink').val(linkTxt);
$('#myimg').removeAttr('src');
	
	$('#mylink').val(linkTxt);
$('#myimg').attr('src', 
		"http://qr.liantu.com/api.php?w=200&text=" + linkTxt
	);
	
	

	
	
	
	
	
	});
	
	

function removeYq() {
	$('#link_div').empty();
	
	$('#link_div').append('<input type="text" id="mylink" size="100"   /><br/><br/><br/> <img src="" id="myimg" alt="请重新生成链接"/>');
}
});




//huo15  代理业务点击事件
//代理商业务订单全部列表

$('#agent_money_sum').click(function () {
	window.location = "user.php?act=agent_order_list";
});
//未发货完结订单
$('#agent_scan_list').click(function () {
	window.location = "user.php?act=agent_scan_list";
});
//未付款列表
$('#agent_unpay_list').click(function () {
	window.location = "user.php?act=agent_unpay_list";
});

//已经付款列表
$('#agent_pay_list').click(function () {
	window.location = "user.php?act=agent_pay_list";
});

//已经发货列表
$('#agent_done_list').click(function () {
	window.location = "user.php?act=agent_done_list";
});

//手动添加订单，代理系统
$('#agent_add_order').click(function () {
	window.location = "user.php?act=agent_add_order";
});


//手动添加订单，垂直业务
$('#self_add_order').click(function () {
	window.location = "user.php?act=user_add_order";
});

//全部订单订单，垂直业务
$('#self_list').click(function () {
	window.location = "huo15user.php?act=user_order_list";
});

//扫码订单，垂直业务
$('#self_scan_order').click(function () {
	window.location = "huo15user.php?act=user_scan_list";
});

//已发货订单，垂直业务
$('#self_end_order').click(function () {
	window.location = "huo15user.php?act=user_end_list";
});
function copyToClipboard(maintext){
  if (window.clipboardData){
    window.clipboardData.setData("Text", maintext);
    }else if (window.netscape){
      try{
        netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
    }catch(e){
        alert("该浏览器不支持一键复制！n请手工复制文本框链接地址～");
    }

    var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
    if (!clip) return;
    var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
    if (!trans) return;
    trans.addDataFlavor('text/unicode');
    var str = new Object();
    var len = new Object();
    var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
    var copytext=maintext;
    str.data=copytext;
    trans.setTransferData("text/unicode",str,copytext.length*2);
    var clipid=Components.interfaces.nsIClipboard;
    if (!clip) return false;
    clip.setData(trans,null,clipid.kGlobalClipboard);
  }
  alert("以下内容已经复制到剪贴板nn" + maintext);
}
</script>
</html>
