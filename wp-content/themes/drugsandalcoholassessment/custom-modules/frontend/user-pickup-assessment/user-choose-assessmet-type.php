<?php
/*
 * Customer Assessment Type Choosing Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getProducts = $GeneralThemeObject->getProducts();
?>

<!-- Choose Assesment Type -->

    <h3 class="fs-subtitle"><span><?php _e('Choose the type you need',THEME_TEXTDOMAIN); ?></span></h3>
    
    <div class="custom-accordion" style="max-height: 250px;overflow-y: scroll;">
            <ul>
            <?php
            if(is_array($getProducts) && count($getProducts) > 0){
                $liCount = 1;
                foreach ($getProducts as $eachProduct) {
                    $getProductDetails = $GeneralThemeObject->product_details($eachProduct->ID);
                    if($liCount%2 == 0){
                        $liClass = 'col-new-light';
                    } else{
                        $liClass = 'col-dark';
                    }
                    ?>
                    <li class="<?php echo $liClass; ?>">
                        <label class="control control--radio" for="<?php echo base64_encode($eachProduct->ID); ?>">
                            <input type="radio" name="product_id" class="product_selection" id="<?php echo base64_encode($eachProduct->ID); ?>" value="<?php echo base64_encode($eachProduct->ID); ?>"/>
                            <div class="choose_left"><h3 style="color: #3e5861 !important;"><?php echo $eachProduct->post_title; ?></h3></div>
                            <div class="choose_right"><span><?php echo '$'. $getProductDetails->data['product_price']; ?></span></div>
                            <div style="clear:both;"></div>
                            <p style="display: none;"><?php echo $getProductDetails->data['content']; ?></p>
                            <div class="control__indicator"></div>
                        </label>
                        
                    </li>
                    <?php
                    $liCount++;
                }
            }
            ?>    
            </ul>
            <div class="product-choosing-error input-error-msg"></div>
        </div>
    <!-- <div> -->
    <input type="button" name="next" id="firstAssessmentNext" class="assmnt_next action-button" value="Next"/>
    <!-- </div> -->
    


<!-- End of Choose Assesment Type -->

    <?php
