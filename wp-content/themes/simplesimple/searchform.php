<?php
/****************************************

	searchform.php
	検索フォーム部分のテンプレートファイルです。

*****************************************/
?>
<!-- searchform.php -->
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
	<input type="text" class="search-field" placeholder="検索" name="s" id="s" value="" />
	<input type="submit" class="search-submit" value="" />
</form>
<!-- /searchform.php -->