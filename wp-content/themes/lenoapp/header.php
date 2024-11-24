<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lenoapp
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <section id="body">
        <!-- Main Wrapper -->
        <div id="dashboard-wrapper" class="flex">
            <!-- Sidebar -->
            <aside id="sidebar" class="sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-logo">
                        <span><img src="img/logo.png" alt="" style="width: 60%;"></span>
                    </div>
                    <button class="close-sidebar" id="close-sidebar-btn" onclick="toggleSidebar()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- <ul class="sidebar-menu">
                    <li onclick="navigateTo('dashboard')"><i class="fas fa-home"></i> <span>Dashboard</span></li>
                    <li onclick="navigateTo('new-order')"><i class="fas fa-plus"></i> <span>New Order</span></li>
                    <li onclick="navigateTo('order-history')"><i class="fas fa-history"></i> <span>Order History</span>
                    </li>
                    <li onclick="navigateTo('support')"><i class="fas fa-headset"></i> <span>Support</span></li>
                    <li onclick="navigateTo('payment')"><i class="fas fa-credit-card"></i> <span>Payment</span></li>
                    <li onclick="navigateTo('payment')"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></li>
                </ul> -->
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',  // Matches the location registered in functions.php
							'container'      => 'nav',    // Wraps the menu in a <nav> element
							'container_class'=> 'primary-menu-container', // Adds a class to the <nav> element
							'menu_class'     => 'sidebar-menu', // Adds a class to the <ul> element
							'fallback_cb'    => false,    // No fallback if the menu isn't assigned
						)
					);
				?>


            </aside>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Top Header -->
                <header class="top-header">
                    <div class="hamburger" id="hamburger-btn" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="header-right custom-header">
                        <div class="wallet">
                            <i class="fas fa-wallet wallet-icon"></i>
                            <span class="wallet-balance">$52.20</span>
                        </div>
                        <div class="user">
                            <span class="user-name">Hi testnew</span>
                            <div class="dropdown">
                                <button class="dropdown-button" onclick="toggleDropdown()">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Settings</a></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>