<?php foreach($blog_post->result() as $blog):?>
<?php $datestring = "%Y-%m-%d";?>
<?php $unix = mysql_to_unix($blog->date);?>
<?php $human = unix_to_human($unix);?>
<?php $date = explode(" ",$unix);?>
<article class="news">
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
</article>
<?php if($blog->gallery_display == 'Y'):?>
<script type="text/javascript">
// Our simplified "load" function accepts a URL and CALLBACK parameter.
load('/news/ajax_gallery/'+ <?php echo $blog->gallery_id;?>, function(xhr) {
    document.getElementById('post_gallery').innerHTML = xhr.responseText;
});
 
function load(url, callback) {
        var xhr;
         
        if(typeof XMLHttpRequest !== 'undefined') xhr = new XMLHttpRequest();
        else {
            var versions = ["MSXML2.XmlHttp.5.0", 
                            "MSXML2.XmlHttp.4.0",
                            "MSXML2.XmlHttp.3.0", 
                            "MSXML2.XmlHttp.2.0",
                            "Microsoft.XmlHttp"]
 
             for(var i = 0, len = versions.length; i < len; i++) {
                try {
                    xhr = new ActiveXObject(versions[i]);
                    break;
                }
                catch(e){}
             } // end for
        }
         
        xhr.onreadystatechange = ensureReadiness;
         
        function ensureReadiness() {
            if(xhr.readyState < 4) {
                return;
            }
             
            if(xhr.status !== 200) {
                return;
            }
 
            // all is well  
            if(xhr.readyState === 4) {
                callback(xhr);
            }           
        }
         
        xhr.open('GET', url, true);
        xhr.send('');
    }
</script>
<?php endif;?>
<?php endforeach;?>
<div class="clearfix"></div>
<div class="hidden-print">
<?php widget::run('related_articles');?>
<h3><?php echo $this->lang->line('label_comments');?></h3>
<?php if($this->config->item('disqus_comments') == 1):?>
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: THIS CODE IS ONLY AN EXAMPLE * * */
    var disqus_shortname = '<?php echo $this->config->item('disqus_shortname');?>'; // Required - Replace example with your forum shortname
	var disqus_identifier = '<?php echo $blog->blog_id;?>';
    var disqus_title = '<?php echo $blog->url_name;?>';
    var disqus_url = '<?php echo site_url();?>/news/comments/<?php echo $blog->url_name;?>';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<?php else:?>
<?php $sub_parent = '';?>
<?php foreach($query->result() as $id):?>
<?php if($id->parent_id == '0'):?>
	<div class="col-md-12 remove_padding">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $id->first_name;?> <?php echo $id->last_name?> <?php echo $this->lang->line('label_blog_on');?> <?php echo $id->datetime?></div>
			<div class="panel-body">
			<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $id->avatar?>" alt="<?php echo $id->first_name;?> <?php echo $id->last_name?>" width="70" align="left" />
			<?php $str = htmlentities($id->message,ENT_QUOTES,"UTF-8")?>
			<?php $str = nl2br($str);?>
			<?php $str = parse_smileys($str, base_url()."assets/images/system_images/smileys/");?>
			<?php $str = parse_bbcode($str);?>
			<p><?php echo $str;?></p>
			<div class="pull-right reply_block">
			<a class="btn btn-warning btn-sm reply_comment" id="reply" data-parent="<?php echo $id->comment_id;?>" href="javascript:void(0)">Reply</a>
			</div>
			</div>
		</div>
	</div>
	<?php foreach($query->result() as $id2):?>
	<?php if($id2->parent_id == $id->comment_id):?>
	<?php $sub_parent = $id2->comment_id;?>
	<div class="col-md-12 remove_padding padding_left">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $id2->first_name;?> <?php echo $id2->last_name?> <?php echo $this->lang->line('label_blog_on');?> <?php echo $id2->datetime?></div>
			<div class="panel-body">
			<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $id2->avatar?>" alt="<?php echo $id2->first_name;?> <?php echo $id2->last_name?>" width="70" align="left" />
			<?php $str = htmlentities($id2->message,ENT_QUOTES,"UTF-8")?>
			<?php $str = nl2br($str);?>
			<?php $str = parse_smileys($str, base_url()."assets/images/system_images/smileys/");?>
			<?php $str = parse_bbcode($str);?>
			<p><?php echo $str;?></p>
			<div class="pull-right reply_block">
			<a class="btn btn-warning btn-sm reply_comment" id="reply" data-parent="<?php echo $id2->comment_id;?>" href="javascript:void(0)">Reply</a>
			</div>
			</div>
		</div>
	</div>
	<?php foreach($query->result() as $id3):?>
	<?php if($id3->parent_id == $sub_parent):?>
	<div class="col-md-12 remove_padding padding_left_2">
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
<div class="col-md-12 remove_padding">
<div id="reply_comment"></div>
<?php if($this->config->item('allow_comments') == true):?>
<?php $attributes = array('name' => 'page');?>
<?php if($user_logged_in == true):?>
<?php echo form_open('news/comments/'.$this->uri->segment(3), $attributes);?>
		<input type="hidden" name="blog_id" value="<?php echo $blog->blog_id?>">
		<input type="hidden" name="datetime" value="<?php echo $date?>">
		<input type="hidden" value="<?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?>" name="postedby"/>
		<input type="hidden" name="active" value="Y">
		<div id="parent" class="hide">
		<input type="hidden" id="parent_id" name="parent_id" value="" />
		</div>
			
			<?php echo form_error('message'); ?>
			<div class="input-group col-md-12 remove_padding">
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
			<div class="col-md-12 remove_padding bottom_padding">
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
<?php endif;?>
</div>