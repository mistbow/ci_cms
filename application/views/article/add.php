<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="keywords" content="math,science" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/demo_style.css" />
		<script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/plugins/ckeditor_wiris/core/display.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>
		<title>CKEditor WIRIS integration on PHP | Educational mathematics</title>

		<script type="text/javascript">
			function loadPage(list) {
				location.href='?language=' + list.options[list.selectedIndex].value;
			}
		</script>		
		
		<style>
			#iconsDiv {display:inline-block;}
			#langFormDiv { display:inline-block; margin-left:640px;}
		</style>
		<!--[if IE]><style>#langFormDiv { margin-left:640px; }</style><![endif]-->
		<!--[if lt IE 9]><style>#langFormDiv { margin-left:645px; }</style><![endif]-->
		<!--[if lt IE 8]><style>#iconsDiv {display:inline;zoom:1; margin-bottom:-20px;} #langFormDiv { display:inline; zoom:1; margin-bottom:-20px;}</style><![endif]-->		
		
		<?php 
			//Init languages
			$langs = array('ar', 'eu', 'pt-br', 'ca', 'zh-tw', 'hr', 'cs', 'da', 'nl', 'en', 'et', 'fi', 'fr', 'gl', 'de', 'he', 'hu', 'it', 'ja', 'ko', 'no', 'pl', 'pt', 'ru', 'es', 'sv', 'tr'); 
			$languages = array('Arabic', 'Basque', 'Brazilian', 'Catalan', 'Chinese', 'Croatian', 'Czech', 'Danish', 'Dutch', 'English', 'Estonian', 'Finnish', 'French', 'Galician', 'German', 'Hebrew', 'Hungarian', 'Italian', 'Japanese', 'Korean', 'Norwegian', 'Polish', 'Portuguese', 'Russian', 'Spanish', 'Swedish', 'Turkish');			
		
			if (isset($_GET['language']) && in_array($_GET['language'], $langs)){
				$language = $_GET['language'];	
			}else{
				$language = 'en';	
			}
		?>		
	</head>
	<body>
		<h1>CKEditor WIRIS integration on PHP</h1>
		
		<div id="languages">Try it with different technologies:</div><br/>
		
		<ul id="buttons">
			<li><a class="button" href="http://www.wiris.com/plugins/editors/download?filter=ckeditor">Download plugin</a></li>
			<li><a class="button" href="http://www.wiris.com/plugins/docs/demo-download?filter=ckeditor">Download this demo</a></li>
			<li><a class="button" href="http://www.wiris.com/plugins/docs/ckeditor">Documentation</a></li>
			<li><a href="http://www.wiris.com/plugins/demo/ckeditor/php"><img class="tech" src="http://www.wiris.com/themes/wiris_com/plugins/php_45.png" title="PHP Demo" /></a></li>
            <li><a href="http://www.wiris.com/plugins/demo/ckeditor/aspx"><img class="tech" src="http://www.wiris.com/themes/wiris_com/plugins/aspnet_45.png" title="ASPX Demo" /></a></li>
           	<li><a href="http://www.wiris.com/plugins/demo/ckeditor/java"><img class="tech" src="http://www.wiris.com/themes/wiris_com/plugins/java_45.png" title="Java Demo" /></a></li>
		</ul>
		
		<h2>New icons in the editor</h2>

		<div id="iconsDiv">		
		<ul id="icons">
			<li><img src="<?php echo base_url(); ?>/ckeditor/plugins/ckeditor_wiris/core/icons/formula.gif" /> WIRIS editor</li>
			<li><img src="<?php echo base_url(); ?>/ckeditor/plugins/ckeditor_wiris/core/icons/cas.gif" /> WIRIS cas</li>
		</ul>
		</div>

		<div id="langFormDiv">
			<form name="langForm" method="GET">
				<select name="language" onchange="loadPage(this.form.elements[0])">
					<?php 
						foreach ($langs as $key => $value){
							if ($value == $language){
								echo '<option value="' . $value . '" selected="true">' . $languages[$key] . '</option>';
							}else{
								echo '<option value="' . $value . '">' . $languages[$key] . '</option>';
							}
						}
					?>
				</select>
			</form>
		</div>
		
		<form name="exampleForm" method="POST">
			<textarea id="example" name="content"><?php
				if (isset($_POST['content'])) {
					echo htmlentities($_POST['content'], ENT_QUOTES, 'UTF-8');
				}
			?></textarea>
			
			<script type="text/javascript">
				CKEDITOR.config.toolbar_Full =
				[
					{ name: 'document', items : [ 'Source'] },
					{ name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
					{ name: 'editing', items : [ 'Find'] },
					{ name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
					{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] },
					{ name: 'styles', items : [ 'Font','FontSize' ] },
					{ name: 'colors', items : [ 'TextColor','BGColor' ] }
				];
			
				CKEDITOR.replace('example', {
					//skin: 'kama',
					language: '<?php echo $language ?>',
					width: '850px',
					toolbar:'Full'
					//wirisimagecolor:'#000000',
					//wirisbackgroundcolor:'#ffffff',
					//wirisimagefontsize:'16px'					
				});
			</script>
			
			<input id="previewButton" type="submit" value="Preview"/>
		</form>
		
		<h2>Preview</h2>
		
		<div id="previewBox">
			<?php
			if (isset($_POST['content'])) {
				echo $_POST['content'];
			}
			else {
				echo '<span id="previewMessage">Press the "Preview" button.</span>';
			}
			?>
		</div>
		
		<div id="logo">
			<a href="http://www.wiris.com"><img src="http://www.wiris.com/en/system/files/attachments/889/wiris_50.png" title="WIRIS" /></a>
		</div>
		<?php
		if (isset($_POST['content'])){ 
		?>		
		<script type="text/javascript">
			var lang = '<?php echo $language ?>';
			if (lang == 'ar' || lang == 'he'){
				var prevBox = document.getElementById('previewBox');
				prevBox.setAttribute('dir', 'rtl');
			}			
		</script>
		<?php	
		}
		?>		
		<script src="<?php echo base_url(); ?>/js/google_analytics.js"></script>
	</body>
</html>
