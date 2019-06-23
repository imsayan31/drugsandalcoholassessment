<?php
/*
 * customer Registration Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getLocation = $GeneralThemeObject->getLocation();
?>
<!-- Zipcode Verification -->

            
                <!-- <h2 class="fs-title">Location Availability</h2> -->
                <h3 class="fs-subtitle">
                	<span>Step 1: </span>Verify Our Services are Available in Your Area
                </h3>
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <div class="pop_mid_section1">
                        <div class="form-group">
                           <div class="rq-star">*</div>
                            <select class="chosen user_location" name="user_location">
                                <option value=""><?php _e('-Select Location-', THEME_TEXTDOMAIN); ?></option>
                                <?php 
                                if(is_array($getLocation) && count($getLocation) > 0){
                                    foreach ($getLocation as $eachLocation) {
                                        ?>
                                        <!-- <option value="<?php echo $eachLocation->slug; ?>" data-desc="<?php echo wpautop(wptexturize($eachLocation->description)); ?>"><?php echo $eachLocation->name; ?></option> -->
                                        <option value="<?php echo $eachLocation->slug; ?>" data-desc="<?php echo $eachLocation->slug; ?>"><?php echo $eachLocation->name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php 
                                if(is_array($getLocation) && count($getLocation) > 0){
                                    foreach ($getLocation as $eachLocation) {
                                        ?>
                                        <div class="all-state-desc state-description-<?php echo $eachLocation->slug; ?>" style="display: none;"><?php echo ($eachLocation->description) ? term_description($eachLocation->term_id, THEME_PREFIX. 'state') : 'No description available'; ?></div>

                                        <?php
                                    }
                                }
                                ?>

                            <div class="user-location-error input-error-msg"></div>
                        </div>
                </div>
                    </div>
                </div>
                <input type="button" name="next" id="firstNext" class="next action-button btn btn-primary" value="Verify Location"/>
                        

<!-- End of Zipcode Verification -->

    <?php
