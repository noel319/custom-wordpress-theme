<?php
/**
 * Loyalty Section Template Part
 */
?>

<section class="loyalty-section">
    <div class="container">
        <div class="text-center">
            <h2 class="font-display">
                <?php _e('OUR LOYALTY PROGRAM', 'espresso-joint'); ?>
            </h2>
            <p>
                <?php _e('Join our rewards program and enjoy exclusive benefits with every purchase', 'espresso-joint'); ?>
            </p>
        </div>
        
        <div class="loyalty-cards">
            <div class="loyalty-card">
                <div class="loyalty-card-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="font-display"><?php _e('Earn Points', 'espresso-joint'); ?></h3>
                <p>
                    <?php _e('1 point for every $1 spent. Points never expire and can be redeemed for free drinks and food.', 'espresso-joint'); ?>
                </p>
            </div>
            
            <div class="loyalty-card">
                <div class="loyalty-card-icon">
                    <i class="fas fa-coffee"></i>
                </div>
                <h3 class="font-display"><?php _e('Free Birthday Drink', 'espresso-joint'); ?></h3>
                <p>
                    <?php _e('Celebrate your special day with a drink on us! Plus, enjoy double points all month long.', 'espresso-joint'); ?>
                </p>
            </div>
            
            <div class="loyalty-card">
                <div class="loyalty-card-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <h3 class="font-display"><?php _e('Exclusive Rewards', 'espresso-joint'); ?></h3>
                <p>
                    <?php _e('Access to members-only events, early product releases, and special seasonal offers.', 'espresso-joint'); ?>
                </p>
            </div>
        </div>
        
        <div class="loyalty-cta">
            <button class="font-display">
                <?php _e('Join Now - It\'s Free', 'espresso-joint'); ?>
            </button>
            <p>
                <?php _e('Already a member?', 'espresso-joint'); ?> 
                <a href="#login"><?php _e('Sign in', 'espresso-joint'); ?></a>
            </p>
        </div>
    </div>
</section>