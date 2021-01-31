<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
?>
<a class="cart-contents proradio-btn proradio-btn__cart proradio-btn__r" href="<?php echo wc_get_cart_url(); ?>"><i class='material-icons'>shopping_cart</i><?php echo WC()->cart->get_cart_total(); ?></a>