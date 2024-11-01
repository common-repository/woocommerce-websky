<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;


?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="shipping_calculator" action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post" style="width: 65%!important;">

	<p class="selectcitynotice" style="display:none;padding: 10px 5px; background: #F2EABB; font:12px tahoma;border-radius: 5px;">استان و شهر خود را انتخاب کنید تا روش های ارسال ، هزینه هر روش و  جمع کل سفارش شما محاسبه شود</p>

	<section class="shipping-calculator">

        <script type="text/javascript">

function submitchform(){
     jQuery('input.checkout-button').click();
    }
jQuery(document).ready(function($) {
    function select_list_sync_to_input(iid, iinput) {
        $("select#"+iid).change(function(){
            var val_now = $("select#"+iid+" option:selected").val();
            if(val_now != 0){
                $("input#"+iinput).val($("select#"+iid+" option:selected").val()+'-'+$("select#"+iid+" option:selected").text());  
            }else{
                $("input#"+iinput).val('');
            }
        
        });
    }
    
    select_list_sync_to_input('new_state', 'shipping_state');
    select_list_sync_to_input('new_city', 'shipping_city');
    
    function set_initial_val(iid, ival) {
        jQuery("select#"+iid).val(ival).trigger('onchange');
    }
    
    
    <?php 
    
    $my_state = $woocommerce->customer->get_shipping_state();
    $my_state = explode('-', $my_state);
    if(isset($my_state) && intval($my_state[0]) > 0 ){
        ?>
        set_initial_val('new_state', <?php echo $my_state[0]; ?>);
        <?php
    }
    
    $my_city = $woocommerce->customer->get_shipping_city();
    $my_city = explode('-', $my_city);
    if(isset($my_city) && intval($my_city[0]) > 0 ){
        ?>
        set_initial_val('new_city', <?php echo $my_city[0]; ?>);
        <?php
    }
    
    ?>

});
    </script>
    <style>
    select{font:12px tahoma; padding: 2px 1px;}
    </style>
    <p class="form-row form-row-last" id="billing_state_field" data-o_class="form-row form-row-last address-field"><label for="billing_state" class="">استان<abbr class="required" title="ضروری">*</abbr></label>
        <select name="new_state" id="new_state" onChange="NewCityList(this.value);">
		<option value="0">لطفا استان را انتخاب نمایید</option>
		
													<option value="1">تهران</option>
													<option value="2">گیلان</option>
													<option value="3">آذربایجان شرقی</option>
													<option value="4">خوزستان</option>
													<option value="5">فارس</option>
													<option value="6">اصفهان</option>
													<option value="7">خراسان رضوی</option>
													<option value="8">قزوین</option>
													<option value="9">سمنان</option>
													<option value="10">قم</option>
													<option value="11">مرکزی</option>
													<option value="12">زنجان</option>
													<option value="13">مازندران</option>
													<option value="14">گلستان</option>
													<option value="15">اردبیل</option>
													<option value="16">آذربایجان غربی</option>
													<option value="17">همدان</option>
													<option value="18">کردستان</option>
													<option value="19">کرمانشاه</option>
													<option value="20">لرستان</option>
													<option value="21">بوشهر</option>
													<option value="22">کرمان</option>
													<option value="23">هرمزگان</option>
													<option value="24">چهارمحال و بختیاری</option>
													<option value="25">یزد</option>
													<option value="26">سیستان و بلوچستان</option>
													<option value="27">ایلام</option>
													<option value="28">کهگلویه و بویراحمد</option>
													<option value="29">خراسان شمالی</option>
													<option value="30">خراسان جنوبی</option>
													<option value="31">البرز</option>
									
	</select>
        <input type="hidden" name="calc_shipping_state" id="shipping_state" value="" />
    </p>
    
    <p class="form-row form-row-first address-field  update_totals_on_change" id="billing_city_field" data-o_class="form-row form-row-first address-field"><label for="billing_city" class="">شهر <abbr class="required" title="ضروری">*</abbr></label>
        <select name="new_city" id="new_city">
		  <option value="0">لطفا استان را انتخاب نمایید</option>
	    </select>
        <input type="hidden" name="calc_shipping_city" id="shipping_city" value="" />
	</p>

		<p><button type="submit" name="calc_shipping" value="1" class="button" style="width: 60%;"><?php echo $have_city ? 'محاسبه مجدد جمع کل' : 'محاسبه جمع کل'; ?></button></p>

		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>