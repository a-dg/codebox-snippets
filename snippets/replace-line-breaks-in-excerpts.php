define('LINE_BREAKS', serialize(array("</p>\n<p>", "\r\n", "\n", "\r", '<br>', '<br />')));

echo str_replace(unserialize(LINE_BREAKS), ' ', $post_item->getTheExcerpt());