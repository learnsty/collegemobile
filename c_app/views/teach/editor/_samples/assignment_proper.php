<?php
include('../../../iwire/iplugi.php');
if(!isset($_SESSION['avwerosuoghene_ode'])){
die(header('location:../index.php'));	
}
else{
if(isset($_GET['4444'])){
$gather=reg($_GET['4444']);
$assignment2=assignment2($_GET['4444'],$_GET['5555']);
echo $_GET['5555'];
}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Faculty News</title>
	<script type="text/javascript" src="../ckeditor.js"></script>
	<script src="sample.js" type="text/javascript"></script>
	<link href="sample.css" rel="stylesheet" type="text/css" />
<script>
$('.prof tr:odd').css({'background-color':'#F4F4F4'});
$('.prof tr').css({'height':'30px','font-size':'11px'});
$('.news_right').load('avwerosuoghene/f_news_display.php');
</script>

<style>
.prof tr:hover{color:#930}

</style>
</head>

<body>
	<h1 class="samples">
		CKEditor Sample &mdash; Using AutoGrow Plugin
	</h1>
	<div class="description">
	<p>
		This sample shows how to configure CKEditor instances to use the
		<strong>AutoGrow</strong> (<code>autogrow</code>) plugin that lets the editor window expand
		and shrink depending on the amount and size of content entered in the editing area.
	</p>
	<p>
		In its default implementation the <strong>AutoGrow feature</strong> can expand the
		CKEditor window infinitely in order to avoid introducing scrollbars to the editing area.
	</p>
	<p>
		It is also possible to set a maximum height for the editor window. Once CKEditor
		editing area reaches the value in pixels specified in the <code>
		<a href="http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html#.autoGrow_maxHeight">autoGrow_maxHeight</a>
		</code> configuration setting, scrollbars will be added and the editor window will no longer expand.
	</p>
	<p>
		To add a CKEditor instance using the <code>autogrow</code> plugin and its
		<code>autoGrow_maxHeight</code> attribute, insert the following JavaScript call to your code:
	</p>
	<pre class="samples">CKEDITOR.replace( '<em>textarea_id</em>',
	{
		<strong>extraPlugins : 'autogrow',</strong>
		autoGrow_maxHeight : 800,
		// Remove the Resize plugin as it does not make sense to use it in conjunction with the AutoGrow plugin.
		removePlugins : 'resize'
	});</pre>
	<p>
		Note that <code><em>textarea_id</em></code> in the code above is the <code>id</code> attribute of
		the <code>&lt;textarea&gt;</code> element to be replaced with CKEditor. The maximum height should
		be given in pixels.
	</p>
	</div>
	<!-- This <div> holds alert messages to be display in the sample page. -->
	<div id="alerts">
		<noscript>
			<p>
				<strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript
				support, like yours, you should still see the contents (HTML data) and you should
				be able to edit it normally, without a rich editor interface.
			</p>
		</noscript>
	</div>
	<form action="sample_posteddata.php" method="post">
		<p>
			<label for="editor1">
				CKEditor using the <code>autogrow</code> plugin with its default configuration:</label>
			<textarea cols="80" id="editor1" name="editor1" rows="10">&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;</textarea>
			<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'editor1', {
					extraPlugins : 'autogrow',
					removePlugins : 'resize'
				});

			//]]>
			</script>
		</p>
		<p>
			<label for="editor2">
				CKEditor using the <code>autogrow</code> plugin with maximum height set to 400 pixels:</label>
			<textarea cols="80" id="editor2" name="editor2" rows="10">&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;</textarea>
			<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'editor2', {
					extraPlugins : 'autogrow',
					autoGrow_maxHeight : 400,
					removePlugins : 'resize'
				});

			//]]>
			</script>
		</p>
		<p>
			<input type="submit" value="Submit" />
		</p>
	</form>
	<div id="footer">
		<hr />
		<p>
			CKEditor - The text editor for the Internet - <a class="samples" href="http://ckeditor.com/">http://ckeditor.com</a>
		</p>
		<p id="copy">
			Copyright &copy; 2003-2011, <a class="samples" href="http://cksource.com/">CKSource</a> - Frederico
			Knabben. All rights reserved.
		</p>
	</div>
</body>
</html>