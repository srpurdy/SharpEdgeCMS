<div class="grid_16" id="content" style="width:680px">
	<form action="#">
		<p style="margin:0;padding:0;line-height:auto;">
		<span style="float:right"><span style="color:#219c14;font-size:16px">&bull;</span> Visitors and <span style="color:#0077cc;font-size:16px">&bull;</span> page views for the selected month and year.</span>
		
		<label><img src="<?php echo base_url() ?>assets/static/css/backend/assets/ajax-loader.gif" id="loader" style="display:block;float:left;margin-right:3px" /></label>
		
		<?php echo form_dropdown('dashboard_profile_id',  array('' => 'loading'), '',' id="dashboard_profile_id"'); ?>

		
		<select name="months" id="months">
      	  <?php
	        foreach(range(1, 12) as $month){
	            echo '<option ' . ($month == date('n') ? 'selected="selected" ' : '') . 'value="' . $month . '">' . date('F', mktime(0, 0, 0, $month, 1, date('Y'))) . '</option>'; 
	        }
	        ?>
	        
		</select>
		
		<select name="year" id="year">
      	  <?php
	        foreach(range(date('Y')-2, date('Y')) as $year){
	            echo '<option ' . ($year == date('Y') ? 'selected="selected" ' : '') . 'value="' . $year . '">' . $year . '</option>'; 
	        }
	        ?>
	        
		</select>
		
		(<a href="#" id="clear_cache">clear cache</a>)
		</p>
	</form>
	
	<div id="linechart" style="width:680px"></div>
	<div id="dashboard" style="width:680px"></div>
	
</div>

<script type="text/javascript">

var so = new SWFObject("<?php echo base_url()?>assets/static/swf/backend/amcharts/amline.swf", "amline", "100%", "250", "8", "#FFFFFF");
so.addVariable("data_file", encodeURIComponent("<?php echo base_url()?>assets/static/swf/backend/amcharts/amline_data.xml"));
so.addVariable("chart_id", "amline");
so.addVariable("settings_file", encodeURIComponent("<?php echo base_url()?>assets/static/swf/backend/amcharts/amline_settings.xml"));
so.addVariable("path", '<?php echo base_url()?>');
so.addParam("wmode", "transparent");
so.write("linechart");

function amChartInited(chart_id)
{
	dready();
}


function dready()
{
	window.addEvent('domready', function() {

	
		var myRequest = new Request.HTML(
		{
			url: '<?php echo site_url("dashboard/analytics_profiles")?>', 
			method: 'post',
			onRequest: function()
			{
			},
			onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript) 
			{
				$('dashboard_profile_id').innerHTML = "";
				
				//console.log(responseHTML);
				var arr = responseHTML.split("|");
				arr.each(function(el)
				{
					var row = el.split(',');
					var opt = document.createElement("option");
					$("dashboard_profile_id").options.add(opt);
					opt.text = row[1];
					opt.value = row[0];
					opt.selected = false;
				});
					
					
				$('dashboard_profile_id').disabled = false;
				$('months').disabled = false;
				$('year').disabled = false;
				//clear_cache();
				load_analytics($('months').value, $('year').value, $('dashboard_profile_id').value);
			}
		}).send();

		$('clear_cache').addEvent('click',function(e)
		{
			e.stop();
			clear_cache();
		});
	
		function clear_cache()
		{
			var myRequest = new Request.HTML(
				{
					url: '<?php echo site_url("dashboard/clear_cache")?>', 
					method: 'post',
					onRequest: function()
					{
						$('clear_cache').innerHTML = 'clearing&hellip;';
					},
					onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript) 
					{
						$('clear_cache').innerHTML = 'cleared';
						(function(){$('clear_cache').innerHTML = 'clear cache' }).delay(1000);
						load_analytics($('months').value, $('year').value, $('dashboard_profile_id').value);
					}
				}).send();
		}
	
		$('months').addEvent('change',function(e)
		{
			load_analytics($('months').value, $('year').value, $('dashboard_profile_id').value);
		})
	
		$('year').addEvent('change',function(e)
		{
			disable_months($('year').value); // need to be first
			load_analytics($('months').value, $('year').value, $('dashboard_profile_id').value);
		})
	
		$('dashboard_profile_id').addEvent('change',function(e)
		{
			load_analytics($('months').value, $('year').value, $('dashboard_profile_id').value);
		})
	
		function disable_months(year)
		{
			if(year < <?php echo date('Y')?>)
			{
				$$('#months option').each(function(el)
				{
					el.set('disabled',false);						
				});
			}
			else
			{
				$$('#months option').each(function(el)
				{
					if($('months').value >= <?php echo date('n')?>)
					{
						if(el.value == <?php echo date('n')?>)
						{
							el.set('selected', true);	
						}
					}
				
					if(el.value <= <?php echo date('n')?>)
					{
						el.set('disabled',false);	
					}
					else
					{
						el.set('disabled',true);
					}
										
				});
			}
		}
	
		disable_months(<?php echo date('Y')?>);

			function load_analytics(month, year, profile)
			{
				var myRequest = new Request.HTML(
				{
					url: '<?php echo site_url("dashboard/statistics")?>', 
					method: 'post',
					data: 'month=' + month + "&year="+year+"&profile=" + profile,
					evalScripts: false,
					onRequest: function()
					{
						$('loader').set('style','display:block;float:left;margin-right:3px');
						$('months').disabled = true;
						$('year').disabled = true;
						$('dashboard_profile_id').disabled = true;
					},
					onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript) 
					{
						$('dashboard').innerHTML = responseHTML;
						//$exec(responseJavaScript);
						$('loader').set('style','display:none');
						$('months').disabled = false;
						$('year').disabled = false;
						$('dashboard_profile_id').disabled = false;
					}
				}).send();
		
				var myRequest = new Request.HTML(
				{
					url: '<?php echo site_url("dashboard/xml_data")?>', 
					method: 'post',
					data: 'month=' + month + "&year="+year+"&profile=" + profile,
					evalScripts: false,
					onRequest: function()
					{
						$('loader').set('style','display:block;float:left;margin-right:3px');
						$('months').disabled = true;
						$('year').disabled = true;
						$('dashboard_profile_id').disabled = true;
					},
					onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript) 
					{
						if(responseHTML)
						{
							$('linechart').set('style','display:block');
							document.getElementById('amline').className = 'showswf';
							document.getElementById('amline').setData(responseHTML);
						}
						else
						{
							document.getElementById('amline').className = 'hiddenswf';
						}

						$('loader').set('style','display:none');
						$('months').disabled = false;
						$('year').disabled = false;
						$('dashboard_profile_id').disabled = false;
					}
				}).send();
			}
		
			$('dashboard_profile_id').disabled = true;
			$('months').disabled = true;
			$('year').disabled = true;
			disable_months(<?php echo date('Y')?>);
	
	
	});
}
</script>
