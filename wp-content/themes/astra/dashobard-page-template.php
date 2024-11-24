<?php
/**
 * Template Name: Dashboard Page
 */

defined('ABSPATH') || exit;

// Ensure WooCommerce is active
if (!class_exists('WooCommerce')) {
    wp_die(__('WooCommerce is not active.', 'your-theme-textdomain'));
}

get_header();
?>

<div class="dashboard-page">
    <h1><?php _e('Dashboard', 'your-theme-textdomain'); ?></h1>

    <!-- Order History Section -->
    <section class="order-history">
        <h2><?php _e('Your Orders', 'your-theme-textdomain'); ?></h2>

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
                                <a href="<?php echo esc_url($order->get_view_order_url()); ?>" class="button"><?php _e('View', 'your-theme-textdomain'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p><?php _e('You have no orders.', 'your-theme-textdomain'); ?></p>
        <?php endif; ?>
    </section>

    <!-- Add New Campaign Button -->
    <section class="add-new-campaign">
        <h2><?php _e('Add New Campaign', 'your-theme-textdomain'); ?></h2>
        <p><?php _e('Create a new campaign by clicking the button below.', 'your-theme-textdomain'); ?></p>
        <a href="http://localhost:8080/project/add-new-campaign-2/" class="button add-campaign-button">
            <?php _e('Add New Campaign', 'your-theme-textdomain'); ?>
        </a>
    </section>
</div>

<style>
    .dashboard-page {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .order-history {
        margin-bottom: 40px;
    }
    .shop_table {
        width: 100%;
        border-collapse: collapse;
    }
    .shop_table th, .shop_table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    .shop_table th {
        background-color: #f9f9f9;
    }
    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #0071a1;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .button:hover {
        background-color: #005b84;
    }
    .add-campaign-button {
        margin-top: 20px;
    }
</style>

<?php
get_footer();
