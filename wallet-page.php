<?php
/**
 * Template Name: Wallet Page
 */

defined('ABSPATH') || exit;

get_header();

// Ensure the user is logged in
if (!is_user_logged_in()) {
    echo '<p>Please log in to access your wallet.</p>';
    get_footer();
    exit;
}

$current_user_id = get_current_user_id();
$wallet_balance = get_user_wallet_balance($current_user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wallet_amount'])) {
    $amount = floatval($_POST['wallet_amount']);

    // Proceed to the payment process
    if ($amount > 0) {
        $_SESSION['wallet_topup_amount'] = $amount;
        wp_redirect(site_url('/process-wallet-payment/'));
        exit;
    } else {
        echo '<p>Invalid amount entered. Please try again.</p>';
    }
}
?>

<div class="wallet-dashboard">
    <h1>Your Wallet</h1>
    <p><strong>Current Balance:</strong> <?php echo number_format($wallet_balance, 2); ?>$</p>

    <form method="POST">
        <label for="wallet_amount">Top-up Amount ($):</label>
        <input type="number" id="wallet_amount" name="wallet_amount" min="1" required>
        <button type="submit">Top-up Wallet</button>
    </form>
</div>

<style>
    .wallet-dashboard {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .wallet-dashboard form {
        margin-top: 20px;
    }
    .wallet-dashboard input {
        padding: 10px;
        margin-right: 10px;
    }
    .wallet-dashboard button {
        padding: 10px 20px;
        background-color: #0071a1;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>
