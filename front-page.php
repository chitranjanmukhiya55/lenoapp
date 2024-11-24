<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lenoapp
 */

get_header();
?>
<!-- Main Section -->
<div class="main-content" id="main-content">

    <div id="dashboard" class="page active dashboard-section">
        <h1>Dashboard</h1>
        <div class="cards">
            <!-- Orders Card -->
            <div class="card orders">
                <div class="card-header">
                    <span>Orders</span>
                    <div class="progress-circle">
                        <div class="circle">
                            <span>6</span>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <i class="fas fa-shopping-bag"></i>
                    <h4 class="number">6</h4>
                    <p>Total Orders</p>
                </div>
            </div>
            <!-- Pending Card -->
            <div class="card pending">
                <div class="card-header">
                    <span>Pending</span>
                    <div class="progress-circle">
                        <div class="circle">
                            <span>1</span>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <i class="fas fa-clock"></i>
                    <h4 class="number">6</h4>
                    <p>Total Pending</p>
                </div>
            </div>
            <!-- Completed Card -->
            <div class="card completed">
                <div class="card-header">
                    <span>Completed</span>
                    <div class="progress-circle">
                        <div class="circle">
                            <span>3</span>
                        </div>
                    </div>
                </div>
                <div class="card-content">

                    <i class="fas fa-check-circle"></i>
                    <h4 class="number">6</h4>
                    <p>Total Completed</p>
                </div>
            </div>
        </div>
        <div class="center-button">
            <button class="create-order" onclick="navigateTo('new-order')">Create Order</button>
        </div>
    </div>

    <div id="new-order" class="page hidden new-order">
        <h1>New Order</h1>
        <p>Place a new order here.</p>

        <div class="form-container">
            <h2 class="form-title">Add New Campaign</h2>
            <form class="campaign-form">
                <!-- Select Service -->
                <div class="form-group">
                    <label for="service-select">Select Your Service</label>
                    <select id="service-select" name="service">
                        <option value="" disabled selected>Select a service</option>
                        <option value="service1">Service 1</option>
                        <option value="service2">Service 2</option>
                        <option value="service3">Service 3</option>
                    </select>
                </div>

                <!-- Quantity -->
                <div class="form-group">
                    <label for="quantity">Quantity <span class="min-quantity">(min: 100)</span></label>
                    <input type="number" id="quantity" name="quantity" placeholder="Enter quantity"
                        min="100" required />
                </div>

                <!-- YouTube URL -->
                <div class="form-group">
                    <label for="youtube-url">Enter your YouTube URL</label>
                    <input type="url" id="youtube-url" name="youtube-url"
                        placeholder="https://www.youtube.com/watch?v=..." required />
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div id="order-history" class="page order-history-section hidden">
        <h1>Order History</h1>
        <div class="search-container">
            <label for="search-orders">Search:</label>
            <input type="text" id="search-orders" placeholder="Orders...">
        </div>
        <table class="order-history-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Start Count</th>
                    <th>Remaining</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Link</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example rows -->
                <tr>
                    <td>3396337</td>
                    <td>721</td>
                    <td>0</td>
                    <td>YouTube Views - Less drop & Lifetime - (Real users)</td>
                    <td><span class="status completed">COMPLETED</span></td>
                    <td><a href="https://www.youtube.com/watch?v=jt8pJI20m88" target="_blank">View</a></td>
                    <td>2024-02-08</td>
                </tr>
                <tr>
                    <td>3396311</td>
                    <td>527</td>
                    <td>0</td>
                    <td>YouTube Views - Less drop & Lifetime - (Real users)</td>
                    <td><span class="status completed">COMPLETED</span></td>
                    <td><a href="https://www.youtube.com/watch?v=jt8pJI20m88" target="_blank">View</a></td>
                    <td>2024-02-08</td>
                </tr>
                <tr>
                    <td>3326507</td>
                    <td>109</td>
                    <td>0</td>
                    <td>YouTube Views (test)</td>
                    <td><span class="status pending">PENDING</span></td>
                    <td><a href="https://www.youtube.com/watch?v=VdocEDizbA0" target="_blank">View</a></td>
                    <td>2024-01-21</td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            <span>Page 1 of 1</span>
            <button>&laquo;</button>
            <button>&lsaquo;</button>
            <button>&rsaquo;</button>
            <button>&raquo;</button>
        </div>
    </div>
    

    <div id="support" class="page support-section hidden">
        <div class="support-container">
            <h1>Support - We're here to Help</h1>
            <form class="support-form">
                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="janedoe@email.com" required>
                </div>
    
                <!-- Subject -->
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject" required>
                </div>
    
                <!-- Order ID -->
                <div class="form-group">
                    <label for="order-id">Order Id</label>
                    <input type="text" id="order-id" name="order-id" placeholder="Order Id" required>
                </div>
    
                <!-- Message -->
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Write Message..." rows="5" required></textarea>
                </div>
    
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    

    <div id="payment" class="page payment-section hidden">
        <div class="balance-container">
            <h2 class="balance-amount">52.20$</h2>
            <p class="balance-label">Current Balance</p>
        </div>
        <div class="top-up-container">
            <h2 class="top-up-title">Top up your wallet <i class="fas fa-wallet"></i></h2>
            <form class="top-up-form">
                <div class="form-group">
                    <input type="number" id="top-up-amount" placeholder="Enter amount" required />
                </div>
                <button type="submit" class="proceed-button">Proceed</button>
            </form>
            <p class="secure-message">
                Choose the amount you want to add to your wallet and proceed securely. <i class="fas fa-lock"></i>
            </p>
        </div>
    </div>
    
</div>
 
<?php get_footer(); ?>
