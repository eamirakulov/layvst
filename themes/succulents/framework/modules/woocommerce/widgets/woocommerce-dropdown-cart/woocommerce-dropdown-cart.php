<?php

class SucculentsQodefWoocommerceDropdownCart extends SucculentsQodefWidget
{
    public function __construct() {
        parent::__construct(
            'qodef_woocommerce_dropdown_cart',
            esc_html__('Qode Woocommerce Dropdown Cart', 'succulents'),
            array('description' => esc_html__('Display a shop cart icon with a dropdown that shows products that are in the cart', 'succulents'),)
        );

        $this->setParams();
    }

    protected function setParams() {

        $this->params = array(
            array(
                'type'        => 'textfield',
                'name'        => 'woocommerce_dropdown_cart_margin',
                'title'       => esc_html__('Icon Margin', 'succulents'),
                'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'succulents')
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        global $woocommerce;

        $icon_styles = array();

        if ($instance['woocommerce_dropdown_cart_margin'] !== '') {
            $icon_styles[] = 'padding: ' . $instance['woocommerce_dropdown_cart_margin'];
        }

        $cart_is_empty = sizeof($woocommerce->cart->get_cart()) <= 0;
        ?>
        <div class="qodef-shopping-cart-holder" <?php succulents_qodef_inline_style($icon_styles) ?>>
            <div class="qodef-shopping-cart-inner">
                <a itemprop="url" class="qodef-header-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
                    <span class="qodef-cart-icon icon_bag_alt"></span>
                </a>
                <div class="qodef-shopping-cart-dropdown">
                    <ul>
                        <?php if (!$cart_is_empty) : ?>
                            <?php foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :
                                $_product = $cart_item['data'];
                                // Only display if allowed
                                if (!$_product->exists() || $cart_item['quantity'] == 0) {
                                    continue;
                                }
                                // Get price
                                $product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? wc_get_price_excluding_tax($_product) : wc_get_price_including_tax($_product);
                                ?>
                                <li>
                                    <div class="qodef-item-image-holder">
                                        <a itemprop="url" href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>">
                                            <?php echo wp_kses($_product->get_image(), array(
                                                'img' => array(
                                                    'src'    => true,
                                                    'width'  => true,
                                                    'height' => true,
                                                    'class'  => true,
                                                    'alt'    => true,
                                                    'title'  => true,
                                                    'id'     => true
                                                )
                                            )); ?>
                                        </a>
                                    </div>
                                    <div class="qodef-item-info-holder">
                                        <h5 itemprop="name" class="qodef-product-title">
	                                        <a itemprop="url" href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>"><?php echo apply_filters('succulents_qodef_woo_widget_cart_product_title', $_product->get_name(), $_product); ?></a>
                                        </h5>
                                        <?php if(apply_filters('succulents_qodef_woo_cart_enable_quantity', true)) { ?>
                                            <span class="qodef-quantity"><?php esc_html_e('Quantity: ', 'succulents'); echo esc_html($cart_item['quantity']); ?></span>
                                        <?php } ?>
                                        <?php echo apply_filters('succulents_qodef_woo_cart_item_price_html', wc_price($product_price), $cart_item, $cart_item_key); ?>
                                        <?php echo apply_filters('succulents_qodef_woo_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'succulents')), $cart_item_key); ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                            <li class="qodef-cart-bottom">
                                <div class="qodef-subtotal-holder clearfix">
                                    <span class="qodef-total"><?php esc_html_e('Order Total:', 'succulents'); ?></span>
                                    <span class="qodef-total-amount">
										<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
                                            'span' => array(
                                                'class' => true,
                                                'id'    => true
                                            )
                                        )); ?>
									</span>
                                </div>
                                <div class="qodef-btn-holder clearfix">
                                    <a itemprop="url" href="<?php echo esc_url(wc_get_cart_url()); ?>" class="qodef-view-cart"><?php esc_html_e('VIEW BAG & CHECKOUT', 'succulents'); ?></a>
                                </div>
                            </li>
                        <?php else : ?>
                            <li class="qodef-empty-cart"><?php esc_html_e('No products in the cart.', 'succulents'); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }
}

add_action('widgets_init', function () {
    register_widget( "SucculentsQodefWoocommerceDropdownCart" );
});


add_filter('woocommerce_add_to_cart_fragments', 'succulents_qodef_woocommerce_header_add_to_cart_fragment');

function succulents_qodef_woocommerce_header_add_to_cart_fragment($fragments) {
    global $woocommerce;

    ob_start();

    $cart_is_empty = sizeof($woocommerce->cart->get_cart()) <= 0;
    ?>
    <div class="qodef-shopping-cart-inner">
        <a itemprop="url" class="qodef-header-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
            <span class="qodef-cart-icon icon_bag_alt"></span>
        </a>
        <div class="qodef-shopping-cart-dropdown">
            <ul>
                <?php if (!$cart_is_empty) : ?>
                    <?php foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :
                        $_product = $cart_item['data'];
                        // Only display if allowed
                        if (!$_product->exists() || $cart_item['quantity'] == 0) {
                            continue;
                        }
                        // Get price
                        $product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? wc_get_price_excluding_tax($_product) : wc_get_price_including_tax($_product);
                        ?>
                        <li>
                            <div class="qodef-item-image-holder">
                                <a itemprop="url" href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>">
                                    <?php echo wp_kses($_product->get_image(), array(
                                        'img' => array(
                                            'src'    => true,
                                            'width'  => true,
                                            'height' => true,
                                            'class'  => true,
                                            'alt'    => true,
                                            'title'  => true,
                                            'id'     => true
                                        )
                                    )); ?>
                                </a>
                            </div>
                            <div class="qodef-item-info-holder">
                                <h5 itemprop="name" class="qodef-product-title">
	                                <a itemprop="url" href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>"><?php echo apply_filters('succulents_qodef_woo_widget_cart_product_title', $_product->get_name(), $_product); ?></a>
                                </h5>
		                        <?php if(apply_filters('succulents_qodef_woo_cart_enable_quantity', true)) { ?>
                                    <span class="qodef-quantity"><?php esc_html_e('Quantity: ', 'succulents'); echo esc_html($cart_item['quantity']); ?></span>
                                <?php } ?>
                                <?php echo apply_filters('succulents_qodef_woo_cart_item_price_html', wc_price($product_price), $cart_item, $cart_item_key); ?>
                                <?php echo apply_filters('succulents_qodef_woo_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'succulents')), $cart_item_key); ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    <li class="qodef-cart-bottom">
                        <div class="qodef-subtotal-holder clearfix">
                            <span class="qodef-total"><?php esc_html_e('Order Total:', 'succulents'); ?></span>
                            <span class="qodef-total-amount">
								<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
                                    'span' => array(
                                        'class' => true,
                                        'id'    => true
                                    )
                                )); ?>
							</span>
                        </div>
                        <div class="qodef-btn-holder clearfix">
                            <a itemprop="url" href="<?php echo esc_url(wc_get_cart_url()); ?>" class="qodef-view-cart"><?php esc_html_e('VIEW BAG & CHECKOUT', 'succulents'); ?></a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="qodef-empty-cart"><?php esc_html_e('No products in the cart.', 'succulents'); ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <?php
    $fragments['div.qodef-shopping-cart-inner'] = ob_get_clean();

    return $fragments;
}

?>