<?php
/**
 * Refund email
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// allowed tags for escaping
$allowed_tags = array(
	'span' => array(),
	'div'  => array(),
	'p'    => array(),
);
?>

<p><?php printf( __( 'Hi %s,', 'woocommerce-advanced-notifications' ), esc_html( $recipient_name ) ); ?></p>

<p><?php printf( __( 'Order #%s has been refunded.', 'woocommerce-advanced-notifications' ), esc_html( $order->get_order_number() ) ); ?></p>

<h2><a class="link" href="<?php echo admin_url( 'post.php?post=' . $order->id . '&action=edit' ); ?>"><?php printf( __( 'Order #%s', 'woocommerce-advanced-notifications' ), esc_html( $order->get_order_number() ) ); ?></a> (<?php printf( '<time datetime="%s">%s</time>', esc_attr( date_i18n( 'c', strtotime( $order->order_date ) ) ), esc_html( date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ) ); ?>)</h2>


<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, false, $email ); ?>

<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
	<thead>
		<tr>
			<th class="td" scope="col" style="text-align:left;"><?php esc_html_e( 'Product', 'woocommerce-advanced-notifications' ); ?></th>
			<th class="td" scope="col" style="text-align:left;" <?php if ( ! $show_prices ) : ?>colspan="2"<?php endif; ?>><?php esc_html_e( 'Quantity', 'woocommerce-advanced-notifications' ); ?></th>
			<?php if ( $show_prices ) : ?>
				<th class="td" scope="col" style="text-align:left;"><?php _e( 'Price', 'woocommerce-advanced-notifications' ); ?></th>
			<?php endif; ?>
		</tr>
	</thead>

	<tbody>
		<?php
		$displayed_total = 0;

		foreach ( $order->get_items() as $item_id => $item ) :

			$_product = $order->get_product_from_item( $item );

			$display = false;

			if ( $triggers['all'] || in_array( $_product->id, $triggers['product_ids'] ) || in_array( $_product->get_shipping_class_id(), $triggers['shipping_classes'] ) ) {
				$display = true;
			}

			if ( ! $display ) {

				$cats = wp_get_post_terms( $_product->id, 'product_cat', array( "fields" => "ids" ) );

				if ( sizeof( array_intersect( $cats, $triggers['product_cats'] ) ) > 0 )
					$display = true;

			}

			if ( ! $display )
				continue;

			$displayed_total += $order->get_line_total( $item, true );

			if ( version_compare( WC_VERSION, '2.4.0', '<' ) ) {
				$item_meta = new WC_Order_Item_Meta( $item['item_meta'] );
			} else {
				$item_meta = new WC_Order_Item_Meta( $item );
			}
			?>
			<tr>
				<td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;"><?php

					// Product name
					echo apply_filters( 'woocommerce_order_product_title', $item['name'], $_product );

					// SKU
					echo $_product->get_sku() ? ' (#' . $_product->get_sku() . ')' : '';

					// allow other plugins to add additional product information here
					do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text );

					// Variation
					echo $item_meta->meta ? '<br/><small>' . nl2br( $item_meta->display( true, true ) ) . '</small>' : '';

					// File URLs
					if ( $show_download_links ) {
						$order->display_item_downloads( $item );
					}

					// allow other plugins to add additional product information here
					do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text );
				?></td>
				<td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" <?php if ( ! $show_prices ) : ?>colspan="2"<?php endif; ?>><?php echo esc_html( $item['qty'] ) ;?></td>

				<?php if ( $show_prices ) : ?>
					<td style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"><?php echo wp_kses( $order->get_formatted_line_subtotal( $item ), $allowed_tags ); ?></td>
				<?php endif; ?>
			</tr>

		<?php endforeach; ?>
	</tbody>

	<?php if ( $show_totals ) : ?>
	<tfoot>
		<?php
			if ( $triggers['all'] && ( $totals = $order->get_order_item_totals() ) ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th class="td" scope="col" colspan="2" style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; text-align:left;"><?php echo esc_html( $total['label'] ); ?></th>
						<td style="text-align:left;border: 1px solid #eee;"><?php echo wp_kses( $total['value'], $allowed_tags ); ?></td>
					</tr><?php
				}
			} else {
				// Only show the total for displayed items
				?>
				<tr>
					<th class="td" scope="col" colspan="2" style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; text-align:left;"><?php _e( 'Total', 'woocommerce-advanced-notifications' ); ?></th>
					<td style="text-align:left;border: 1px solid #eee;"><?php echo wp_kses( wc_price( $displayed_total ), $allowed_tags ); ?></td>
				</tr>
				<?php
			}
		?>
	</tfoot>
	<?php endif; ?>
</table>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php
 /**
  * @hooked WC_Emails::customer_details() Shows customer details
  * @hooked WC_Emails::email_address() Shows email address
  */
 do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
?>
