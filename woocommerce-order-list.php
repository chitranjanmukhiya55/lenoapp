<?php
/**
 * Template Name: WooCommerce Order List
 */

defined('ABSPATH') || exit;

// Check if WooCommerce is active
if (!class_exists('WooCommerce')) {
    wp_die(__('WooCommerce is not active', 'your-theme-textdomain'));
}

get_header(); ?>

<div class="woocommerce-order-list">
    <h1><?php _e('My Orders', 'your-theme-textdomain'); ?></h1>
    
    <?php
    // Get current user's orders
    $customer_orders = wc_get_orders(array(
        'customer_id' => get_current_user_id(),
        'status'      => array('wc-pending', 'wc-processing', 'wc-completed'),
        'orderby'     => 'date',
        'order'       => 'DESC',
        'limit'       => -1,
    ));
    ?>

    <?php if (!empty($customer_orders)) : ?>
        <table class="shop_table shop_table_responsive my_account_orders">
            <thead>
                <tr>
                    <th class="order-number"><span><?php _e('Order', 'your-theme-textdomain'); ?></span></th>
                    <th class="order-date"><span><?php _e('Date', 'your-theme-textdomain'); ?></span></th>
                    <th class="order-status"><span><?php _e('Status', 'your-theme-textdomain'); ?></span></th>
                    <th class="order-total"><span><?php _e('Total', 'your-theme-textdomain'); ?></span></th>
                    <th class="order-actions"><span><?php _e('Actions', 'your-theme-textdomain'); ?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customer_orders as $order) : ?>
                    <tr class="order">
                        <td class="order-number">
                            <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                                #<?php echo $order->get_order_number(); ?>
                            </a>
                        </td>
                        <td class="order-date">
                            <?php echo wc_format_datetime($order->get_date_created()); ?>
                        </td>
                        <td class="order-status">
                            <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
                        </td>
                        <td class="order-total">
                            <?php
                            echo wp_kses_post(sprintf(
                                __('%1$s for %2$s items', 'your-theme-textdomain'),
                                $order->get_formatted_order_total(),
                                $order->get_item_count()
                            ));
                            ?>
                        </td>
                        <td class="order-actions">
                            <?php
                            $actions = wc_get_account_orders_actions($order);

                            if (!empty($actions)) {
                                foreach ($actions as $key => $action) {
                                    echo '<a href="' . esc_url($action['url']) . '" class="button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                }
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p><?php _e('You have no orders.', 'your-theme-textdomain'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
