<?php
   /*
   Plugin Name: Shortcode for WP Product Review
   Plugin URI: https://odd-one-out.serek.eu/wp-product-review-custom-shortcode/
   Description: Shortcode for WP Product Review. Read more here https://odd-one-out.serek.eu/wp-product-review-custom-shortcode/
   Version: 1.0
   Author: Poul Serek
   Author URI: https://odd-one-out.serek.eu
   License: GPL2
   */

function product_review_shortcode( $atts ) {
        extract( shortcode_atts(
                array(
                        'post_id' => get_the_ID(),
                        'aff_link_content1' => '',
                        'aff_link_content2' => '',
                ), $atts )
        );

        $content = '';

        if (is_numeric($post_id)) {
                $content = cwppos_show_review($post_id);
        } else {
                return "Post_id is not a number: ".$post_id;
        }

        $aff_link_content1 = str_replace('{', '[', $aff_link_content1);
        $aff_link_content1 = str_replace('}', ']', $aff_link_content1);
        $aff_link_content2 = str_replace('{', '[', $aff_link_content2);
        $aff_link_content2 = str_replace('}', ']', $aff_link_content2);
        $cssClass = "affiliate-button";

        if($aff_link_content1 && $aff_link_content2){
                $cssClass .= "2 affiliate-button";
        }

        $content .= "<div style='width: 100%; overflow: hidden;'>";
        if($aff_link_content1){
                $content .= "<div class='".$cssClass."'>".$aff_link_content1."</div>";
        }
        if($aff_link_content2){
                $content .= "<div class='".$cssClass."'>".$aff_link_content2."</div>";
        }

        $content .= "</div>";

        return do_shortcode($content);
}
add_shortcode( 'product_review', 'product_review_shortcode' );

?>
