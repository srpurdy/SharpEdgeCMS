<?php foreach($blog_post->result() as $blog):?>
<?php $datestring = "%Y-%m-%d";?>
<?php $unix = mysql_to_unix($blog->date);?>
<?php $human = unix_to_human($unix);?>
<?php $date = explode(" ",$unix);?>
<div class="news">
<h1><?php echo $blog->name?></h1><br />
<div class="news_bottom"><?php echo $blog->postedby?> <?php echo $this->lang->line('label_blog_on');?> <?php echo date("F j, Y", $date[0]);?>
<div class="pull-right">
<?php echo widget::run('addthis_widget');?>
</div>
</div>
<div class="news_content">
<?php $blog_str = parse_smileys($blog->text, "/assets/images/system_images/smileys/");?>
<?php $blog_str = parse_bbcode($blog_str);?>
<?php $blog_str = $this->shortcodes->parse($blog_str);?>
<p><?php echo $blog_str;?></p>
<div id="post_gallery"></div>
</div>
</div>
<?php if($blog->gallery_display == 'Y'):?>
<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_protection" />
<script type="text/javascript">
$(document).ready( function () {
   	var site_data = {
		csrf_sharpedgeV320: $("#csrf_protection").val()
	};
	$.ajax(
	{
		url: "/news/ajax_gallery/"+<?=$blog->gallery_id;?>,
		type: "POST",
		data: site_data,
		success: function(msg)
		{
			//alert(msg);
			$('#post_gallery').html(msg);
		}
	})
});
</script>
<?php endif;?>
<?php endforeach;?>
<div class="clearfix"></div>
<div class="hidden-print">
<?php widget::run('related_articles');?>
<h3><?php echo $this->lang->line('label_comments');?></h3>
<?php $sub_parent = '';?>
<?php foreach($query->result() as $id):?>
<?php if($id->parent_id == '0'):?>
	<div class="col-md-12" style="padding:0px;">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $id->first_name;?> <?php echo $id->last_name?> <?php echo $this->lang->line('label_blog_on');?> <?php echo $id->datetime?></div>
			<div class="panel-body">
			<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $id->avatar?>" alt="<?php echo $id->first_name;?> <?php echo $id->last_name?>" width="70" align="left" />
			<?php $str = htmlentities($id->message,ENT_QUOTES,"UTF-8")?>
			<?php $str = nl2br($str);?>
			<?php $str = parse_smileys($str, base_url()."assets/images/system_images/smileys/");?>
			<?php $str = parse_bbcode($str);?>
			<p><?php echo $str;?></p>
			<div class="pull-right">
			<a class="btn btn-warning btn-sm" id="reply-<?php echo $id->comment_id;?>" data-parent="<?php echo $id->comment_id;?>" href="#reply_comment">Reply</a>
			<script type="text/javascript">
			$(document).on('click', '#reply-<?php echo $id->comment_id;?>', function()
				{
				var parent_id = $('#reply-<?php echo $id->comment_id;?>').data("parent");
				$('#parent').show();
				$('#parent_id').val(parent_id);
				//$(document.body).animate({'scrollTop':   $('#reply_comment').offset().top}, 2000);
				//return false;
				});
			</script>
			</div>
			</div>
		</div>
	</div>
	<?php foreach($query->result() as $id2):?>
	<?php if($id2->parent_id == $id->comment_id):?>
	<?php $sub_parent = $id2->comment_id;?>
	<div class="col-md-12" style="padding:0px;padding-left:50px;">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $id2->first_name;?> <?php echo $id2->last_name?> <?php echo $this->lang->line('label_blog_on');?> <?php echo $id2->datetime?></div>
			<div class="panel-body">
			<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $id2->avatar?>" alt="<?php echo $id2->first_name;?> <?php echo $id2->last_name?>" width="70" align="left" />
			<?php $str = htmlentities($id2->message,ENT_QUOTES,"UTF-8")?>
			<?php $str = nl2br($str);?>
			<?php $str = parse_smileys($str, base_url()."assets/images/system_images/smileys/");?>
			<?php $str = parse_bbcode($str);?>
			<p><?php echo $str;?></p>
			<div class="pull-right">
			<a class="btn btn-warning btn-sm" id="reply-<?php echo $id2->comment_id;?>" data-parent="<?php echo $id2->comment_id;?>" href="#reply_comment">Reply</a>
			<script type="text/javascript">
			$(document).on('click', '#reply-<?php echo $id2->comment_id;?>', function()
				{
				var parent_id = $('#reply-<?php echo $id2->comment_id;?>').data("parent");
				$('#parent').show();
				$('#parent_id').val(parent_id);
				//$(document.body).animate({'scrollTop':   $('#reply_comment').offset().top}, 2000);
				//return false;
				});
			</script>
			</div>
			</div>
		</div>
	</div>
	<?php foreach($query->result() as $id3):?>
	<?php if($id3->parent_id == $sub_parent):?>
	<div class="col-md-12" style="padding:0px;padding-left:100px;">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $id3->first_name;?> <?php echo $id3->last_name?> <?php echo $this->lang->line('label_blog_on');?> <?php echo $id3->datetime?></div>
			<div class="panel-body">
			<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $id3->avatar?>" alt="<?php echo $id3->first_name;?> <?php echo $id3->last_name?>" width="70" align="left" />
			<?php $str = htmlentities($id3->message,ENT_QUOTES,"UTF-8")?>
			<?php $str = nl2br($str);?>
			<?php $str = parse_smileys($str, base_url()."assets/images/system_images/smileys/");?>
			<?php $str = parse_bbcode($str);?>
			<p><?php echo $str;?></p>
			</div>
		</div>
	</div>
	<?php endif;?>
	<?php endforeach;?>
	<?php endif;?>
	<?php endforeach;?>
<div class="clearfix"></div>
<br />
<?php endif;?>
<?php endforeach; ?>
<?php
$datestring = "Y-m-d H:i:s";
$time = time();
$date = gmdate($datestring, $time);
?>
<div class="col-md-12" style="padding:0px;">
<a name="reply_comment"></a>
<?php if($this->config->item('allow_comments') == true):?>
<?php $attributes = array('name' => 'page');?>
<?php if($user_logged_in == true):?>
<?php echo form_open('news/comments/'.$this->uri->segment(3), $attributes);?>
		<input type="hidden" name="blog_id" value="<?php echo $blog->blog_id?>">
		<input type="hidden" name="datetime" value="<?php echo $date?>">
		<input type="hidden" value="<?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?>" name="postedby"/>
		<input type="hidden" name="active" value="Y">
		<div id="parent" style="display:none;">
		<input type="hidden" id="parent_id" name="parent_id" value="" />
		</div>
			
			<?php echo form_error('message'); ?>
			<div class="input-group col-md-12" style="padding:0px;">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: '';
				echo form_ckbbcode('message', $textareaContent, 'post_text');?>
			</div>

<?php if($this->config->item('image_security') == true):?>
			<div class="input-group">
				<script type="text/javascript">
				  var RecaptchaOptions = { 
					theme: "<?php echo $this->config->item('re_theme', 'recaptcha');?>",
					lang: "en"
				  };
				</script>
				<script type="text/javascript" src="<?php echo $server?>/challenge?k=<?php echo $key.$errorpart?>"></script>
				<noscript>
				<iframe src="<?php echo $server?>/noscript?lang=<?php echo $lang?>&k=<?php echo $key.$errorpart?>" height="300" width="500" frameborder="0"></iframe><br/>
				<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
				<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
				</noscript>
			</div>
<?php endif;?>
            <br />
			<div class="col-md-12" style="padding:0px;padding-bottom:10px;">
			<input class="btn btn-primary" type="submit" value="Post Comment" />
			</div>
<?php echo form_close();?>
<?php else:?>
<p>You must be logged in to post a comment</p>
<?php endif;?>
<?php else:?>
<p>Comments Have been disabled</p>
<?php endif;?>
</div>
</div>