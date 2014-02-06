<?php foreach($blog_post->result() as $id2):?>
<?php $datestring = "%Y-%m-%d";?>
<?php $unix = mysql_to_unix($id2->date);?>
<?php $human = unix_to_human($unix);?>
<?php $date = explode(" ",$unix);?>
<div class="news">
<h3><?php echo $id2->name?></h3><br />
<div class="news_bottom" style="clear:both; font-size: 16px;"><?php echo $id2->postedby?> <?php echo $this->lang->line('label_blog_on');?> <?php echo date("F j, Y", $date[0]);?>
<div style="float: right;">
<?php echo widget::run('addthis_widget');?>
</div>
</div>
<div class="news_content">
<?php $blog_str = parse_smileys($id2->text, "/assets/images/system_images/smileys/");?>
<?php $blog_str = parse_bbcode($blog_str);?>
<?php $blog_str = $this->shortcodes->parse($blog_str);?>
<p><?php echo $blog_str;?></p>
<div id="post_gallery"></div>
</div>
</div>
<?php if($id2->gallery_display == 'Y'):?>
<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_protection" />
<script type="text/javascript">
$(document).ready( function () {
   	var site_data = {
		csrf_sharpedgeV320: $("#csrf_protection").val()
	};
	$.ajax(
	{
		url: "/news/ajax_gallery/"+<?=$id2->gallery_id;?>,
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
<br /><br />
<div class="clearfix"></div>
<hr />
<br />
<?php endforeach;?>
<?php widget::run('related_articles');?>
<h3><?php echo $this->lang->line('label_comments');?></h3>
<?php foreach($query->result() as $id):?>
<div class="container">
	<div class="col-md-1">
	<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $id->avatar?>" alt="<?php echo $id->first_name;?> <?php echo $id->last_name?>" width="70" />
	</div>

	<div class="comment col-md-8">
	<small><?php echo $id->first_name;?> <?php echo $id->last_name?> <?php echo $this->lang->line('label_blog_on');?> <?php echo $id->datetime?></small>
	<?php $str = htmlentities($id->message,ENT_QUOTES,"UTF-8")?>
	<?php $str = nl2br($str);?>
	<?php $str = parse_smileys($str, base_url()."assets/images/system_images/smileys/");?>
	<?php $str = parse_bbcode($str);?>
	<p><?php echo $str;?></p>
	</div>
</div>
<div class="clearfix"></div>
<br />
<?php endforeach; ?>
<?php
$datestring = "Y-m-d H:i:s";
$time = time();
$date = gmdate($datestring, $time);
?>
<?php if($this->config->item('allow_comments') == true):?>
<?php $attributes = array('name' => 'page');?>
<?php if($user_logged_in == true):?>
<?php echo form_open('news/comments/'.$this->uri->segment(3), $attributes);?>
		<input type="hidden" id="id" name="blog_id" value="<?=$id2->blog_id?>">
		<input type="hidden" id="id" name="datetime" value="<?echo $date?>">
		<input type="hidden" value="<?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?>" name="postedby"/>
		<input type="hidden" id="id" name="active" value="Y">
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_comment');?></legend>
			
			<?php echo form_error('message'); ?>
			<div class="input-group">
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
			<input class="btn btn-default" type="submit" value="Post Comment" />
		
		</fieldset>
<?php echo form_close();?>
<?php else:?>
<p>You must be logged in to post a comment</p>
<?php endif;?>
<?php else:?>
<p>Comments Have been disabled</p>
<?php endif;?>