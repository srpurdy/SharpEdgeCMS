 // CREATE THE EMPTY OBJECT
 var ADMIN = {}; 
 
 // DOCUMENT READY?...GO!!! ALL YOUR METHODS AND PROPERTIES ARE GLOBAL
 $(function(){ 	
 	jQuery.ADMIN.hijackLink('.adminEditList'); 
 	jQuery.ADMIN.hijackLink('#setupCatItems'); 
	jQuery.ADMIN.deleteAlert();
	jQuery.ADMIN.showadminNav();
	jQuery.ADMIN.editCategories();
 });
 
 // Attach the Object to the jQuery NAMESPACE
 jQuery.ADMIN = { 
 
 	// CREATE A NEW METHOD AND PROPERTIES
 	hijackLink : function( trigger ) 
	{
		// START AT THE TRIGGER <div> GET ALL THE CHILD <a> TAGS AND BUILD AN ARRAY TO HIGHJACK 
		$(trigger).find('a')
		
		// BY PASS ALL .delete BUTTONS TO PREVENT HIJACKLINK
		.not('.delete').not('.logout').not('.noHiJack')
		
		// PREPARE FOR THE ONCLICK EVENT
		.click(function() {  
						
			// HIDE ANY OBJECTS OR IFRAMES SO THAT Z-INDEX WORKS IN ALL BROWSERS - IE6 
			$('body').find('object').css({display: 'none'});
			$('body').find('iframe').css({display: 'none'});
		
			// INJECT THE MODAL INTO THE BODY TAG
			$('body').append('<div id="modal"></div>'); 
			
			// BUILD WIDTH AND HEIGHT FOR MODAL
			var W = $(window).width();
			var WH = $(window).height();
			var H = $('html').height();
			
			/* HELPER FOR MODAL TO WORK ON SHORT PAGES
			** IF THE <body> HEIGHT IS LESS THAN THE WINDOW HEIGHT, USE WINDOW HEIGHT TO BUILD THE MODAL  
			** IF NOT, USE THE <body> HEIGHT TO COVER THE SCROLL AREA
			*/
			if(H < WH){ 
				var H = WH;
			}

			// STYLE THE MODAL 
			$('#modal').css({display: 'block', width: W, height: H, opacity: 0.5});		 

			// CREATE THE AHAH WINDOW TO EDIT THE RESULTS IN
			$('body').append('<div id="adminNewEditBox"></div>'); 
			
			// GET THE LINK TO HIJACK AS A STRING // THIS IS THE VALUE OF THE <a> TAG WE CLICKED TO START THIS
			var urlJack = $(this).attr('href'); 
			
			// STYLE THE AHAH WINDOW AND TRIGGER THE CANEL HIJACK
			var L = ($(window).width() - 1000 ) / 2; // CENTER THE MODAL WINDOW IN THE VIEWPORT
			$('#adminNewEditBox').css({left: L}).load(urlJack, function(){ 
				$('#adminNewEditBox').append('<span class="cancelHiJack">Cancel</span>');
				jQuery.ADMIN.cancelHiJack();
			});
			
			// RESET THE SCROLL VIEW TO THE TOP TO ENSURE IT'S IN THE USERS VIEWABLE WINDOW
			$('html, body').animate({scrollTop:0}, 'slow'); 

		// DISABLE THE <a> TAG CUZ WE'RE HIJACKIN' IT
		return false; 
		
		});
		
	},
	
 	// DEPENDENT WITH HIJACKLINK
	cancelHiJack : function()
	{
		$('.cancelHiJack').click(function(){
			$('#adminNewEditBox').remove();	
			$('#modal').css({display: 'none'});
			$('body').find('object').css({display: 'block'});
			$('body').find('iframe').css({display: 'block'});
		});
	},


 	// HOVER NOTICE TO EDIT AREA
/*	updateTemplate : function()
	{
		// THE DIV NEEDS TO BE THE FIRST CHILD TO GET PARENT DIV
		$('.updateTemplateWrap').parent('div')
			.hover(
				function(){ 
					$(this).addClass('hoverTemplate').css({opacity: '0.8'});
					$(this).find('.updateTemplateWrap').css({display: 'block'});
				}, 
				function() {
					$(this).removeClass('hoverTemplate').css({opacity: 1});;
					$(this).find('.updateTemplateWrap').css({display: 'none'});
				}
			);
	},*/
	

 	// ADD .delete CLASS AND GET A JS POPUP
	deleteAlert : function()
	{
		$('.delete').click(function(){
			return confirm('Are you sure you want to delete this?');  // OLD SCHOOL :)
		});
	},
	
	showadminNav : function()
	{
		$('#adminNav').find('h3').click(function(){
			$(this).next('ul').slideToggle('fast');											  							
		});
		
		$('#adminNav>ul>li').click(function(){
			$(this).addClass('on');
			$(this).siblings('li').removeClass('on').find('ul:visible').css('display', 'none');
			$(this).find('ul').css({display: 'block'});
		});
		
		$('#adminNav').find('a').click(function(){
			$('#adminNav').find('h3:first').click();
			//alert($(this).parent('li').parent('ul').parent('li').parent('ul').parent('div').find('h3:first').html());
		});
	},
	
	editCategories : function()
	{
		$('.catListWrap').find('a').click(function(){
			var url = $(this).attr('href'); 
			$(this).parent().parent('div.catListWrap').load(url);
			return false;
		});
	}
	
 };
