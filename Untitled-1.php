


// add_action('wp_ajax_change_product_sort', 'change_product_sort_callback');
// add_action('wp_ajax_nopriv_change_product_sort', 'change_product_sort_callback');
// function change_product_sort_callback()
// {
// 	$selected_sort_option = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'featured';
// 	$args = array(
// 		'post_type' => 'product',
// 		'posts_per_page' => -1,
// 		'orderby' => 'date',
// 		'order' => 'DESC',
// 	);
// 	if ($selected_sort_option === 'featured') {
// 		$args['meta_query'] = array(
// 			array(
// 				'key' => '_featured',
// 				'value' => 'yes',
// 			),
// 		);
// 	} elseif ($selected_sort_option === 'popular') {
// 		$args['meta_key'] = 'total_sales';
// 		$args['orderby'] = 'meta_value_num';
// 	}
// 	ob_start();
// 	foreach ($terms as $term) {
// 		if ($term->term_id === 'all') {
// 			$args = array(
// 				'post_type' => 'product',
// 				'posts_per_page' => -1,
// 				'tax_query' => array(
// 					array(
// 						'taxonomy' => 'collections',
// 					),
// 				),
// 			);
// 		} else {
// 			$args = array(
// 				'post_type' => 'product',
// 				'posts_per_page' => -1,
// 				'tax_query' => array(
// 					array(
// 						'taxonomy' => 'collections',
// 						'field' => 'term_id',
// 						'terms' => $term->term_id,
// 					),
// 				),
// 				'orderby' => 'meta_value',
// 				'meta_key' => 'total_sales',
// 				'order' => 'DESC',
// 			);
// 		}
// 		$products = get_posts($args);
// 		foreach ($products as $product) {
// 			$product_id = $product->ID;
// 			$product_cat = get_the_terms($product_id,'product_cat');
// 			$pcat_class = "";
// 			foreach ($product_cat as $pcat) {
// 				$pcat_class .= $pcat->slug.' ';
// 			}

// 			$product_name = get_the_title($product_id);
// 			$product_object = wc_get_product($product_id);
// 			$product_price = $product_object->get_price();
// 			echo '<div class="products-item ' . $pcat_class . '">';
// 			echo '<div class="products-item-inner">';
// 			echo '<div class="product-img">';
// 			echo '<a href="' . get_permalink($product_id) . '">';
// 			echo '<img src="' . esc_url(get_the_post_thumbnail_url($product_id, 'full')) . '" alt="' . esc_attr($term->slug) . '">';
// 			echo '</a>';
// 			echo '</div>';
// 			echo '<div class="product-item-text">';
// 			echo '<div class="item-name">' . esc_html($product_name) . '</div>';
// 			echo '<div class="item-price">' . esc_html('₹ ' . $product_price) . '</div>';
// 			echo '</div>';
// 			echo '</div>';
// 			echo '</div>';
// 		}
// 	}
// 	$html = ob_get_clean();
// 	echo $html;
// 	wp_die();
// }
