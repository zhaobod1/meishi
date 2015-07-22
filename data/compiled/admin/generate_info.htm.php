<!-- $Id: goods_info.htm 17126 2010-04-23 10:30:26Z liuhui $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../data/static/js/utils.js,./js/selectzone.js,./js/colorselector.js')); ?>
<script type="text/javascript" src="../data/static/js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../data/static/js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<?php if ($this->_var['warning']): ?>
<ul style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
  <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;" ><?php echo $this->_var['warning']; ?></li>
</ul>
<?php endif; ?>

<!-- start goods form -->
<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div" style="height:40px;">
     <h3>编号-<?php echo $this->_var['good_id']; ?>产品 ( 该产品编号总数：<span style="color:red"><?php echo $this->_var['total']; ?></span>，该产品箱包数量：<span style="color:red"><?php echo $this->_var['total_case']; ?></span> )<a href="goods.php?act=no_details&good_id=<?php echo $this->_var['good_id']; ?>" target="main-frame"><input type="button" value="查看明细" /></a></h3>
     <br/>
     
    </div>
	
    <!-- tab body -->
    <div id="tabbody-div">
    
      <form enctype="multipart/form-data" action="goods.php?act=generate_confirm" method="post" name="theForm" >
      <h3 style="background:#80BDCB">批量生成编码操作</h3>
        <table width="90%" id="general-table" align="center">
          
          <tr>
            <td class="label">生成数量：</td>
            <td><input type="text" name="goods_num" value="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" style="float:left;color:<?php echo $this->_var['goods_name_color']; ?>;" size="30" /></td>
          </tr>
          
           <tr>
            <td class="label">每箱数量：</td>
            <td><input type="text" name="case_num" value="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" style="float:left;color:<?php echo $this->_var['goods_name_color']; ?>;" size="30" /></td>
          </tr>
  
        </table>

        <h3 style="background:#80BDCB">减去数量<h3>
        
        <table width="90%" id="general-table" align="center">
          
          <tr>
            <td class="label">减去数量：</td>
            <td><input type="text" name=" minus_num" value="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" style="float:left;color:<?php echo $this->_var['goods_name_color']; ?>;" size="30" /></td>
          </tr>
          
       </table>  
  

		<input type="hidden" name="good_id" value="<?php echo $this->_var['good_id']; ?>" />

        <div class="button-div">
        
       
          <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button"  />
          <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
        </div>
      </form>
    </div>
</div>
<!-- end goods form -->


<?php echo $this->fetch('pagefooter.htm'); ?>
