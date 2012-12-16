var CFYO = {};

$(function(){
	jQuery.CFYO.mainNav();
	jQuery.CFYO.TurnItOn("#navigation");
	jQuery.CFYO.GrowPageLine();
	jQuery.CFYO.searchBox();
});
	
	jQuery.CFYO = {
	
		Compactor : function(list,trigger,target,topOffset){
			$(list).find(trigger).addClass(" link").hover(function(){
				$(this).addClass(" linkOver");
			},function(){
				$(this).removeClass("linkOver");
			}).click(function(){
				$(list).find(target+":visible").not(this).slideUp("def");
				$(list).find(trigger).not(this).removeClass("linkOn");
				$(this).addClass(" linkOn").next(target+":hidden").slideDown("def");
			});
		},
		
		mainNav : function(){
			$('.level_1').find('li').hover(function(){
				$(this).children('ul.level_2').animate({'height': 'toggle', 'opacity': 'toggle'}, 500);
			},function(){
				$(this).children('ul.level_2').fadeOut(250);
			});
			$('.level_2').find('li').hover(function(){
				$(this).children('ul.level_3').css({display:'block'});
			},function(){
				$(this).children('ul.level_3').css({display:'none'});
			});
			$('.level_1').find('a').each(function(){
				if($(this).attr('href').split('/')[3]=='#'){
					$(this).css('cursor','CFYO').click(function(){
						return false;
					});
				}
			});
		},
			
		TurnItOn : function(nav){
			$(nav).find("a").each(function(){
				if(location.href.indexOf(this.href)!=-1){
					$(this).addClass(" on").parent().parent("ul").parent("li").find("a:first").addClass(" on");
				}});
		},
		
		GrowPageLine : function()
		{
		var PLH = $('#primaryContent').height();
		$('.page_line').height(PLH+'px');
		},
		
		searchBox : function()
		{
			$('#searchbox').find('form').submit(function()
			{
			var searchField = $('.searchbox').find('.field').val();
			if(searchField.length <= 3)
				{
				$('.searchbox').append('<div class="min_char">You must enter a string longer than 3 characters!</div>');
				$('.min_char').delay('5000').fadeOut('slow');
				return false;
				}
			})
		}
	}