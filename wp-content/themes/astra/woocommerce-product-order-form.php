<?php
/**
 * Template Name: Custom WooCommerce Direct Order Form
 */

defined('ABSPATH') || exit;

// Ensure WooCommerce is active
if (!class_exists('WooCommerce')) {
    wp_die(__('WooCommerce is not active.', 'your-theme-textdomain'));
}

get_header();

// Product ID for which this form is being created
$product_id = 39;

// Get the product object
$product = wc_get_product($product_id);

// Check if product exists
if (!$product) {
    echo '<p>' . __('Product not found.', 'your-theme-textdomain') . '</p>';
    get_footer();
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_order'])) {
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $youtube_url = isset($_POST['youtube_url']) ? sanitize_text_field($_POST['youtube_url']) : '';
    $variation_id = isset($_POST['variation_id']) ? intval($_POST['variation_id']) : 0;

    // Create a new order
    $order = wc_create_order();

    // Add product to the order
    if ($variation_id) {
        $order->add_product(wc_get_product($variation_id), $quantity);
    } else {
        $order->add_product($product, $quantity);
    }

    // Add custom meta field for YouTube URL
    $order->add_order_note('YouTube URL: ' . $youtube_url);
    $order->update_meta_data('YouTube URL', $youtube_url);

    // Set order status
    $order->set_status('processing');
    $order->calculate_totals();
    $order->save();

    // Display success message
    echo '<p>' . __('Order created successfully! Your Order ID is: ', 'your-theme-textdomain') . $order->get_id() . '</p>';
    exit;
}
?>

<div class="woocommerce-custom-product-form">
    <h1><?php echo esc_html($product->get_name()); ?></h1>
    <p><?php echo wp_kses_post($product->get_description()); ?></p>
    <p><strong><?php _e('Price:', 'your-theme-textdomain'); ?></strong> <?php echo $product->get_price_html(); ?></p>

    <form method="post">
        <input type="hidden" name="create_order" value="1" />

        <!-- Select Variation -->
        <?php if ($product->is_type('variable')) : ?>
            <div class="form-group">
                <label for="service"><?php _e('Select Your Service', 'your-theme-textdomain'); ?></label>
                <select name="variation_id" id="service" required>
                    <option value=""><?php _e('Choose an option', 'your-theme-textdomain'); ?></option>
                    <?php
                    $variations = $product->get_available_variations();
                    foreach ($variations as $variation) {
                        $variation_obj = wc_get_product($variation['variation_id']);
                        echo '<option value="' . esc_attr($variation['variation_id']) . '">' . esc_html($variation_obj->get_name()) . '</option>';
                    }
                    ?>
                </select>
            </div>
        <?php endif; ?>

        <!-- Quantity -->
        <div class="form-group">
            <label for="quantity"><?php _e('Quantity (min: 100)', 'your-theme-textdomain'); ?></label>
            <input type="number" id="quantity" name="quantity" min="100" value="100" required />
        </div>

        <!-- Custom Meta Field -->
        <div class="form-group">
            <label for="youtube_url"><?php _e('Enter your YouTube URL', 'your-theme-textdomain'); ?></label>
            <input type="url" id="youtube_url" name="youtube_url" placeholder="https://www.youtube.com/watch?v=yourvideo" required />
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="button alt"><?php _e('Create Order', 'your-theme-textdomain'); ?></button>
        </div>
    </form>
</div>

<style>
    .woocommerce-custom-product-form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .woocommerce-custom-product-form .form-group {
        margin-bottom: 15px;
    }
    .woocommerce-custom-product-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .woocommerce-custom-product-form input,
    .woocommerce-custom-product-form select,
    .woocommerce-custom-product-form button {
        width: 100%;
        padding: 10px;
        margin: 0;
        font-size: 14px;
    }
    .woocommerce-custom-product-form button {
        background-color: #0071a1;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    .woocommerce-custom-product-form button:hover {
        background-color: #005b84;
    }
</style>

<?php
get_footer();
