<?php
/**
 * Template Name: Process Wallet Payment
 */

defined('ABSPATH') || exit;

get_header();

require_once get_template_directory() . '/cardinity-sdk-php-master/src/Client.php';
require_once get_template_directory() . '/cardinity-sdk-php-master/src/Exception/Exception.php';
// Add any other necessary files from the library here

use Cardinity\Client;

// Include the Cardinity SDK files
require_once get_template_directory() . '/cardinity-sdk-php-master/src/Client.php';


// Ensure the user is logged in
if (!is_user_logged_in()) {
    echo '<p>Please log in to proceed.</p>';
    get_footer();
    exit;
}

session_start();
$amount = $_SESSION['wallet_topup_amount'] ?? 100;

if ($amount <= 0) {
    echo '<p>Invalid payment amount.</p>';
    get_footer();
    exit;
}

// Cardinity Payment Gateway Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $card_name = sanitize_text_field($_POST['card_name']);
    $card_number = sanitize_text_field($_POST['card_number']);
    $expiry_month = intval($_POST['expiry_month']);
    $expiry_year = intval($_POST['expiry_year']);
    $cvc = intval($_POST['cvc']);

    // Cardinity Payment Processing
    require_once 'vendor/autoload.php';

    // $configuration = Cardinity\Client::configuration(
    //     'test_qxdrs18axmzydxjqbz92awnenayj1b',
    //     'rbse9awilnyltsodxvfevvjftiibqj1oawugmohh9tpklsptni'
    // );

    // Initialize the client with your credentials
    $client = Client::create([
        'consumerKey' => 'test_qxdrs18axmzydxjqbz92awnenayj1b', // Replace with your Cardinity consumer key
        'consumerSecret' => 'rbse9awilnyltsodxvfevvjftiibqj1oawugmohh9tpklsptni', // Replace with your Cardinity consumer secret
    ]);

    // $client = new Cardinity\Client($configuration);

    try {
        $payment = $client->payments()->create([
            'amount' => 100.00, // Payment amount
            'currency' => 'USD', // Payment currency
            'description' => 'Top-up wallet', // Payment description
            'card' => [
                'pan' => '4111111111111111', // Test card number
                'exp_year' => 2025, // Expiry year
                'exp_month' => 12, // Expiry month
                'cvc' => '123', // CVC code
                'holder' => 'John Doe', // Cardholder name
            ],
        ]);
    
        if ($payment->isApproved()) {
            echo '<p>Payment successful! Transaction ID: ' . $payment->getId() . '</p>';
        } else {
            echo '<p>Payment failed. Status: ' . $payment->getStatus() . '</p>';
        }
    } catch (\Cardinity\Exception\ValidationFailed $e) {
        echo '<p>Validation error: ' . $e->getMessage() . '</p>';
    } catch (\Exception $e) {
        echo '<p>Error: ' . $e->getMessage() . '</p>';
    }

    unset($_SESSION['wallet_topup_amount']);
    exit;
}
?>

<div class="wallet-payment-form">
    <h1>Secure Payment</h1>
    <p><strong>Amount:</strong> <?php echo number_format($amount, 2); ?>$</p>

    <form method="POST">
        <label for="card_name">Cardholder Name:</label>
        <input type="text" id="card_name" name="card_name" required>

        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" required>

        <label for="expiry_month">Expiry Month:</label>
        <input type="number" id="expiry_month" name="expiry_month" min="1" max="12" required>

        <label for="expiry_year">Expiry Year:</label>
        <input type="number" id="expiry_year" name="expiry_year" min="<?php echo date('Y'); ?>" required>

        <label for="cvc">CVC:</label>
        <input type="number" id="cvc" name="cvc" required>

        <button type="submit">Submit Payment</button>
    </form>
</div>

<style>
    .wallet-payment-form {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .wallet-payment-form input,
    .wallet-payment-form button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
    }
    .wallet-payment-form button {
        background-color: #0071a1;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>

<?php
get_footer();
