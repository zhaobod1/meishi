/**
 * 烽火微信分销代理系统 版本号v H1.0
 *火一五信息科技有限公司
 *主营业务：网站建设、手机app开发、应用软件开发、SEO网络优化、竞价排名已经计算机电路、软件设计
 *网址：www.huo15.com
 *联系方式：15288986891 18765270751
 *QQ : 3186355915
 */
 
 $(document).ready(function(e) {
	//alert($('.list-div').size());
	//隐藏积分选项
	$('.form-div').css('display', 'none');
	$('.list-div').each(function(index, element) {
        var tr_last = $(element).find('tr').last();
		
		//affiliate.php?act=add&caption='+obj.caption+'&id='+(parseInt(obj.id)+1)+')
		//最后一行构造
		var tr = '<tr  align="center">' +
		'<td></td>' +
		'<td><input type="text" id="name'+index+'" /></td>' +
		
		'<td><a href="javascript:void(0);" class="add_a" target="main-frame" ><img style="border:0px;" src="images/icon_add.gif" /></a></td>' + 
		'</tr>';
		//插入最后一行
		$(tr).insertAfter(tr_last);
		var sdiscount = '#discount'+index;
		var sagent_num = '#agent_num' + index;
		var agent_name = '#name' + index;
		var number = '#number' + index;
		
		
		var str = tr_last.find('a').attr('href');
		
		if (typeof str == 'undefined') {
			
			str = 'act=del&caption=' + $(element).find('h3').html() + '&id=0';
			
		}
			str = str.substring(str.indexOf('act=del'), str.length-2);
		
		var arr = str.split('&');
		var obj = {};//请求参数
		for(i=0;i<arr.length;i++) {
			var temp = arr[i].split('=');
			obj[temp[0]] = temp[1];
		}
			
			//最后一行add的链接a
		 var tr_last = $(element).find('tr').last();
		tr_last.find('a').attr('href', 'javascript:void(0)');
		
		tr_last.find('a').click(function () {
			var addData = {
				discount : $('#discount'+index).val(),
				agent_num : $('#agent_num' + index).val(),
				number : $('#number' + index).val(),
				name : $('#name' + index).val(),
				caption : obj.caption,
				id : parseInt(obj.id) + 1
			};
			$(this).attr('disabled','disaled');
			window.location = 'affiliate.php?act=add&caption='+obj.caption+'&id='+(parseInt(obj.id)+1)+'&discount='+addData.discount+'&agent_num='+addData.agent_num + '&number=' + addData.number + '&name=' + addData.name;
			
			
		});
		
		
		
    });
});

