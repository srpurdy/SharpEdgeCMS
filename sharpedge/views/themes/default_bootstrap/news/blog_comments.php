<script type="text/javascript">
    function insert_bbcode(bbopen, bbclose)
    {
        var input = window.document.page.message;
        input.focus();
        
        /* for Internet Explorer )*/
        if(typeof document.selection != 'undefined')
        {
            var range = document.selection.createRange();
            var insText = range.text;
            range.text = bbopen + insText + bbclose;
            range = document.selection.createRange();
            if (insText.length == 0)
            {
                range.move('character', -bbclose.length);
            }
            else
            {
                range.moveStart('character', bbopen.length + insText.length + bbclose.length);
            }
            range.select();
        }
        
        /* for newer browsers like Firefox */

        else if(typeof input.selectionStart != 'undefined')
        {
            var start = input.selectionStart;
            var end = input.selectionEnd;
            var insText = input.value.substring(start, end);
            input.value = input.value.substr(0, start) + bbopen + insText + bbclose + input.value.substr(end);
            var pos;
            if (insText.length == 0)
            {
                pos = start + bbopen.length;
            }
            else
            {
                pos = start + bbopen.length + insText.length + bbclose.length;
            }
            input.selectionStart = pos;
            input.selectionEnd = pos;
        }    

        /* for other browsers like Netscape... */
        else
        {
            var pos;
            var re = new RegExp('^[0-9]{0,3}$');
            while(!re.test(pos))
            {
                pos = prompt("insertion (0.." + input.value.length + "):", "0");
            }
            if(pos > input.value.length)
            {
                pos = input.value.length;
            }
            var insText = prompt("Please tape your text");
            input.value = input.value.substr(0, pos) + bbopen + insText + bbclose + input.value.substr(pos);
        }
    } 
</script> 
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
<h3><?php echo $this->lang->line('label_comments');?></h3>
<?php foreach($query->result() as $id):?>
<div class="container">
	<div class="span1">
	<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $id->avatar?>" alt="<?php echo $id->first_name;?> <?php echo $id->last_name?>" width="70" />
	</div>

	<div class="comment span8">
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
			
			<div class="control-group">
				<div class="controls">
				<div class="format_button">
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[b]', '[/b]')" title="Bold">B</a>
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[i]', '[/i]')" title="Italic">I</a>
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[u]', '[/u]')" title="Underline">U</a>
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[p]', '[/p]')" title="Paragraph">P</a>
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[url]', '[/url]')" title="Link URL">URL</a>
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[quote]', '[/quote]')" title="Quote">Quote</a>
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[img]', '[/img]')" title="Image">IMG</a>
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[youtube]', '[/youtube]')" title="Youtube Video">YouTube</a>
				</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<br />
			
			<?php echo form_error('message'); ?>
			<div class="control-group">
				<div class="controls">
				<textarea class="span5" name="message" rows="20" cols="50"></textarea>
				</div>
			</div>

<?php if($this->config->item('image_security') == true):?>
			<div class="control-group">
				<div class="controls">
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
			</div>
<?php endif;?>
            
			<input class="btn" type="submit" value="Post Comment" />
		
		</fieldset>
<?php echo form_close();?>
<?php else:?>
<p>You must be logged in to post a comment</p>
<?php endif;?>
<?php else:?>
<p>Comments Have been disabled</p>
<?php endif;?>
</div>