<?php foreach($forum_profile as $fp):?>
<div id="forum_container" class="remove_underline">
	<div class="forum_topic">
		<div class="topic_post">
			<h3 class="topic_title"><?php echo $fp->first_name . ' ' . $fp->last_name;?></h3>
			<div class="forum_post">
			<div class="post_date">
			<div class="clearfix"></div>
			</div>
			
			<div class="post_body">
				<div class="post_profile">
					<div class="user_profile" style="margin-top: 20px;">
					<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $fp->avatar?>" alt="<?php echo $fp->first_name;?> <?php echo $fp->last_name?>" />
					</div>
				</div>
				
				<div class="post_text">
				Total Posts: <?php echo $fp->total_posts;?><br />
				Location: <?php echo $fp->location;?><br />
				<?php $replace_web = array('http://www.', 'http://', 'www.', '/');?>
				<?php $web_pos = strpos($fp->website, 'http://');?>
				Website: <a href="<?php if($web_pos === false):?>http://<?php echo $fp->website?><?php else:?><?php echo $fp->website;?><?php endif;?>"><?php echo str_replace($replace_web, '', $fp->website);?></a><br />
				Occupation: <?php echo $fp->occupation;?><br />
				Interests: <?php echo $fp->intrests;?><br />
				<br />
				</div>
			</div>
			</div>
		<div class="clearfix"></div>
		</div>
		<div class="topic_post">
			<h3 class="topic_title">Latest Posts By User</h3>
			<div class="forum_post" style="margin:0px">
			<div class="post_date"></div>
			
			<div class="post_body">
				<div class="post_text">
				</div>
			</div>
			</div>
		<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php endforeach;?>