<?php

// Return category list
function adv_category_list($custom = null) 
{
    $dir = "cache/widget";
    $filename = "cache/widget/category.list.cache";
    $tmp = array();
    $cat = array();
    $list = array();
    $cList = '';

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    if (file_exists($filename)) {
        $cat = unserialize(file_get_contents($filename));
    } else {
        $arr = get_category_info(null);
        foreach ($arr as $i => $a) {
            $cat[] = array($a->slug, $a->title, $a->count, $a->description);
        }

        $tmp = serialize($cat);
        file_put_contents($filename, print_r($tmp, true), LOCK_EX);
    }

    if(!empty($custom)) {
        return $cat;
    }

    $cList .= '
<ul class="submenu">';

    foreach ($cat as $k => $v) {
        if ($v['2'] !== 0) {
            $cList .= '
	<li class="nav-item">
		<a href="' . site_url() . 'category/' . $v['0'] . '">' . $v['1'] . '</a> <span>('. $v['2'] .')</span>
	</li>';
        }
    }

    $cList .= '
</ul>
';
    return $cList;

}


// Return tag cloud.
function adv_tag_cloud($custom = null)
{
    $dir = "cache/widget";
    $filename = "cache/widget/tags.cache";
    $tg = array();

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    $posts = get_blog_posts();
    $tags = array();
    
    $tagcloud_count = config('tagcloud.count');
    if(empty($tagcloud_count)) {
        $tagcloud_count = 40;
    }

    if (!empty($posts)) {

        if (!file_exists($filename)) {
            foreach ($posts as $index => $v) {
                $arr = explode('_', $v['filename']);
                $data = rtrim($arr[1], ',');
                $mtag = explode(',', $data);
                foreach ($mtag as $etag) {
                    $tags[] = strtolower($etag);
                }
            }
            $tag_collection = array_count_values($tags);
            ksort($tag_collection);
            $tg = serialize($tag_collection);
            file_put_contents($filename, print_r($tg, true), LOCK_EX);
        } else {
            $tag_collection = unserialize(file_get_contents($filename));
        }

        if(empty($custom)) {
            $wrapper = '';
            $cache_t = "cache/widget/tags.default.cache";
            if (file_exists($cache_t)) {
                $wrapper = unserialize(file_get_contents($cache_t));
                return $wrapper;
            } else {
                // Font sizes
                $max_size = 22; // max font size in %
                $min_size = 8; // min font size in %

                // Get the largest and smallest array values
                $max_qty = max(array_values($tag_collection));
                $min_qty = min(array_values($tag_collection));

                // Find the range of values
                $spread = $max_qty - $min_qty;
                if (0 == $spread) { // we don't want to divide by zero
                    $spread = 1;
                }

                // Font-size increment
                // this is the increase per tag quantity (times used)
                $step = ($max_size - $min_size)/($spread);

                arsort($tag_collection);
                $sliced_tags = array_slice($tag_collection, 0, $tagcloud_count, true);
                ksort($sliced_tags);
				$i = 0;
				$i_max = count($sliced_tags);
				$comma = ', ';
                foreach ($sliced_tags as $tag => $count) {
					$i++;
					if ($i == $i_max) { $comma = ''; }

                    $size = $min_size + (($count - $min_qty) * $step);
                    $wrapper .= ' <a class="tag-cloud-link" href="'. site_url(). 'tag/'. $tag .'">'.tag_i18n($tag).'</a>' .$comma;
                }
                $ar = serialize($wrapper);
                file_put_contents($cache_t, $ar, LOCK_EX);                    
                return $wrapper;
            }

        } else {
            return $tag_collection;
        }
    } else {
        if(empty($custom)) return;
        return $tags;
    }
}

?>