<?php
/*
 * User Registration Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getLocations = $GeneralThemeObject->getLocation();
$getJobTypes = $GeneralThemeObject->getJobTypes();
$getJobRoles = $GeneralThemeObject->getJobRoles();
$getJobDesiredSettings = $GeneralThemeObject->getJobDesiredSettings();
$getJobExperiences = $GeneralThemeObject->getJobExperiences();
$getJobSpecialization = $GeneralThemeObject->getSpecializedAreas();
$getJobDegrees = $GeneralThemeObject->getJobCertificationDegrees();
?>

<div class="col-sm-12 sj-registration-form">
    <form name="userRegFrm" id="userRegFrm" action="javascript:void(0);" method="post">
        <input type="hidden" name="action" value="user_registration"/>

        <label><?php _e('Basic Information', THEME_TEXTDOMAIN); ?></label>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="email" name="user_email" id="user_email" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Email*', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="email" name="user_cnf_email" id="user_cnf_email" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Confirm Email*', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="password" name="user_password" id="user_password" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Password*', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="password" name="user_cnf_password" id="user_cnf_password" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Confirm Password*', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>

        <hr>

        <label><?php _e('Profile Information', THEME_TEXTDOMAIN); ?></label>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="user_fname" id="user_fname" class="form-control" value="" autocomplete="off" placeholder="<?php _e('First name*', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="user_lname" id="user_lname" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Last name*', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="user_address" id="user_address" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Street Address*', THEME_TEXTDOMAIN); ?>"/>
                    <input type="hidden" name="user_address_lat_lng" id="user_address_lat_lng" value=""/>
                    <input type="hidden" name="user_address_place_id" id="user_address_place_id" value=""/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="user_address_optional" id="" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Address Line 2', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="user_zipcode" id="user_zipcode" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Zipcode*', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="user_contact_no" id="user_contact_no" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Contact No*', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="employee_state" class="employee_state chosen">
                        <option value=""><?php _e('-Select State*-', THEME_TEXTDOMAIN); ?></option>
                        <?php
                        if (is_array($getLocations) && count($getLocations) > 0):
                            foreach ($getLocations as $eachLocation):
                                ?>
                                <option value="<?php echo $eachLocation->term_id; ?>"><?php echo $eachLocation->name; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <div class="employee-state-error input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="employee_city" class="employee_city chosen">
                        <option value=""><?php _e('-Select City*-', THEME_TEXTDOMAIN); ?></option>
                    </select>
                    <div class="employee-city-error input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="user_fax_no" id="" class="form-control" value="" autocomplete="off" placeholder="<?php _e('FAX', THEME_TEXTDOMAIN); ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="employee_hear_from" class="employee_hear_from chosen">
                        <option value=""><?php _e('-Where did you hear about us?-', THEME_TEXTDOMAIN); ?></option>
                        <option value="banner_ad"><?php _e('Banner Ad', THEME_TEXTDOMAIN); ?></option>
                        <option value="catalog"><?php _e('Catalog', THEME_TEXTDOMAIN); ?></option>
                        <option value="email"><?php _e('Email', THEME_TEXTDOMAIN); ?></option>
                        <option value="friend"><?php _e('Friend', THEME_TEXTDOMAIN); ?></option>
                        <option value="facebook"><?php _e('Facebook', THEME_TEXTDOMAIN); ?></option>
                        <option value="twitter"><?php _e('Twitter', THEME_TEXTDOMAIN); ?></option>
                        <option value="linkedin"><?php _e('LinkedIn', THEME_TEXTDOMAIN); ?></option>
                        <option value="newspaper"><?php _e('Newspaper', THEME_TEXTDOMAIN); ?></option>
                        <option value="other"><?php _e('Other', THEME_TEXTDOMAIN); ?></option>
                    </select>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="user_anonymous_profile" class="chosen user_anonymous_profile">
                        <option value=""><?php _e('-Is This Anonymous Profile?-', THEME_TEXTDOMAIN); ?></option>
                        <option value="1"><?php _e('Yes', THEME_TEXTDOMAIN); ?></option>
                        <option value="2"><?php _e('No', THEME_TEXTDOMAIN); ?></option>
                    </select>
                    <div class="anonymous-profile-error input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <select name="job_type" class="chosen job_type">
                    <option value=""><?php _e('-Select Job Type*-', THEME_TEXTDOMAIN); ?></option>
                    <?php
                    if (is_array($getJobTypes) && count($getJobTypes) > 0):
                        foreach ($getJobTypes as $eachJobType):
                            ?>
                            <option value="<?php echo $eachJobType->slug; ?>"><?php echo $eachJobType->name; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
                <div class="job-type-error input-error-msg"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="job_role" class="chosen job_role">
                        <option value=""><?php _e('-Select Job Role*-', THEME_TEXTDOMAIN); ?></option>
                        <?php
                        if (is_array($getJobRoles) && count($getJobRoles) > 0):
                            foreach ($getJobRoles as $eachJobRole):
                                ?>
                                <option value="<?php echo $eachJobRole->slug; ?>"><?php echo $eachJobRole->name; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <div class="job-role-error input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="job_desired_settings" class="chosen job_desired_settings">
                        <option value=""><?php _e('-Select Job Desired Settings*-', THEME_TEXTDOMAIN); ?></option>
                        <?php
                        if (is_array($getJobDesiredSettings) && count($getJobDesiredSettings) > 0):
                            foreach ($getJobDesiredSettings as $eachJobDesiredSettings):
                                ?>
                                <option value="<?php echo $eachJobDesiredSettings->slug; ?>"><?php echo $eachJobDesiredSettings->name; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <div class="job-desired-error input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label><?php _e('Management Experience*', THEME_TEXTDOMAIN); ?></label>
                <label class="control control--radio" for="user_management_experience1">
                    <input type="radio" name="user_management_experience" id="user_management_experience1" value="1"/><?php _e('Yes', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio" for="user_management_experience2">
                    <input type="radio" name="user_management_experience" id="user_management_experience2" value="2"/><?php _e('No', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
                <div class="user-management-experience input-error-msg"></div>

            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="form-group">
                        <select name="job_experience" class="chosen job_experience">
                            <option value=""><?php _e('-Select Career Experience*-', THEME_TEXTDOMAIN); ?></option>
                            <?php
                            if (is_array($getJobExperiences) && count($getJobExperiences) > 0):
                                foreach ($getJobExperiences as $eachJobExperince):
                                    ?>
                                    <option value="<?php echo $eachJobExperince->slug; ?>"><?php echo $eachJobExperince->name; ?></option>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                        <div class="job-experience-error input-error-msg"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="job_degree" class="chosen job_degree">
                        <option value=""><?php _e('-Select Certification & Degree*-', THEME_TEXTDOMAIN); ?></option>
                        <?php
                        if (is_array($getJobDegrees) && count($getJobDegrees) > 0):
                            foreach ($getJobDegrees as $eachJobDegrees):
                                ?>
                                <option value="<?php echo $eachJobDegrees->slug; ?>"><?php echo $eachJobDegrees->name; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <div class="job-degree-error input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?php _e('Willing to relocate?*', THEME_TEXTDOMAIN); ?></label>
                <label class="control control--radio" for="user_relocation1">
                    <input type="radio" name="user_relocation" id="user_relocation1" value="1"/><?php _e('Yes', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio" for="user_relocation2">
                    <input type="radio" name="user_relocation" id="user_relocation2" value="2"/><?php _e('No', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
                <div class="user_relocation input-error-msg"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="user_primary_state" class="user_primary_state chosen">
                        <option value=""><?php _e('-Select Primary Desired State*-', THEME_TEXTDOMAIN); ?></option>
                        <?php
                        if (is_array($getLocations) && count($getLocations) > 0):
                            foreach ($getLocations as $eachLocation):
                                ?>
                                <option value="<?php echo $eachLocation->term_id; ?>"><?php echo $eachLocation->name; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <div class="user-primary-state-error input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="user_primary_city" class="user_primary_city chosen">
                        <option value=""><?php _e('-Select Primary Desired City*-', THEME_TEXTDOMAIN); ?></option>
                    </select>
                    <div class="user-primary-city-error input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="user_secondary_state" class="user_secondary_state chosen">
                        <option value=""><?php _e('-Select Secondary Desired State-', THEME_TEXTDOMAIN); ?></option>
                        <?php
                        if (is_array($getLocations) && count($getLocations) > 0):
                            foreach ($getLocations as $eachLocation):
                                ?>
                                <option value="<?php echo $eachLocation->term_id; ?>"><?php echo $eachLocation->name; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="user_secondary_city" class="user_secondary_city chosen">
                        <option value=""><?php _e('-Select Secondary Desired City-', THEME_TEXTDOMAIN); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="job_area_specialization" class="chosen job_area_specialization">
                        <option value=""><?php _e('-Select Job Area Specialization*-', THEME_TEXTDOMAIN); ?></option>
                        <?php
                        if (is_array($getJobSpecialization) && count($getJobSpecialization) > 0):
                            foreach ($getJobSpecialization as $eachJobSpecialization):
                                ?>
                                <option value="<?php echo $eachJobSpecialization->slug; ?>"><?php echo $eachJobSpecialization->name; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <div class="job-area-specialization-error input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <select name="user_highest_degree" class="chosen user-highest-degree">
                    <option value=""><?php _e('-Select Highest Degree Earned*-', THEME_TEXTDOMAIN); ?></option>
                    <option value="AS"><?php _e('AS', THEME_TEXTDOMAIN); ?></option>
                    <option value="BS"><?php _e('BS', THEME_TEXTDOMAIN); ?></option>
                    <option value="MPT"><?php _e('MPT', THEME_TEXTDOMAIN); ?></option>
                    <option value="DPT"><?php _e('DPT', THEME_TEXTDOMAIN); ?></option>
                </select>
                <div class="user-highest-degree-error input-error-msg"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <textarea name="user_bio" rows="5" class="form-control" placeholder="<?php _e('Describe Bio Summary', THEME_TEXTDOMAIN); ?>"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label><?php _e('Licensed In*', THEME_TEXTDOMAIN); ?></label>
                    <label class="control control--radio" for="user_license1">
                        <input type="radio" name="user_license" id="user_license1" value="1"/><?php _e('US', THEME_TEXTDOMAIN); ?>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--radio" for="user_license2">
                        <input type="radio" name="user_license" id="user_license2" value="2"/><?php _e('Canada', THEME_TEXTDOMAIN); ?>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--radio" for="user_license3">
                        <input type="radio" name="user_license" id="user_license3" value="3"/><?php _e('Other', THEME_TEXTDOMAIN); ?>
                        <div class="control__indicator"></div>
                    </label>
                    <div class="user-license-error input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?php _e('Availability*', THEME_TEXTDOMAIN); ?></label>
                <label class="control control--radio" for="user_availability1">
                    <input type="radio" name="user_availability" id="user_availability1" value="1"/><?php _e('Immediately', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio" for="user_availability2">
                    <input type="radio" name="user_availability" id="user_availability2" value="2"/><?php _e('1-3 months', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio" for="user_availability3">
                    <input type="radio" name="user_availability" id="user_availability3" value="3"/><?php _e('4-6 months', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio" for="user_availability4">
                    <input type="radio" name="user_availability" id="user_availability4" value="4"/><?php _e('+6 months', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
                <div class="user-availability-error input-error-msg"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control control--checkbox" for="user_t_n_c">
                        <input type="checkbox" name="user_t_n_c" id="user_t_n_c" value="1"/><?php _e('I agree with the Terms & Conditions*', THEME_TEXTDOMAIN); ?>
                        <div class="control__indicator"></div>
                    </label>
                    <div class="user_t_n_c input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control control--checkbox" for="user_out_mailings">
                        <input type="checkbox" name="user_out_mailings" id="user_out_mailings" value="1"/><?php _e('Notify Matched Job Posting*', THEME_TEXTDOMAIN); ?>
                        <div class="control__indicator"></div>
                    </label>
                    <div class="user-out-mailings-error input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LfxtGkUAAAAAJ1_0TH1WVGnNPA9fTZ1LWMEVXsG"></div>
        </div>

        <div class="">
            <button type="submit" name="userRegSbmt" id="userRegSbmt" class="btn btn-primary ladda-button" data-size="l" data-style="zoom-in"><span class="ladda-label"><?php _e('Sign Up', THEME_TEXTDOMAIN); ?></span></button>
        </div>
    </form>
</div>

<div class="col-sm-12">
    <hr/>
    <?php _e('Already have account?', THEME_TEXTDOMAIN); ?><a href="javascript:void(0);" class="click-sign-in"><?php _e(' Sign In Here', THEME_TEXTDOMAIN); ?></a>
</div>

<script type="text/javascript">
    function setUp() {
        var user_address = document.getElementById('user_address');
        var autocomplete = new google.maps.places.Autocomplete(user_address);
        autocomplete.setComponentRestrictions({
            'country': 'US'
        });


        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            //var location = place.geometry.location;
            var lattitude = place.geometry.viewport.b.b;
            var longitude = place.geometry.viewport.f.f;
            var place_id = place.id;
            //var addressCompLength = place.address_components.length;

            jQuery('#user_address_lat_lng').val(lattitude + ', ' + longitude);
            jQuery('#user_address_place_id').val(place_id);
            for (var i = 0; i < place.address_components.length; i++) {
                for (var j = 0; j < place.address_components[i].types.length; j++) {
                    if (place.address_components[i].types[j] == "postal_code") {
                        //document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                        jQuery('#user_zipcode').val(place.address_components[i].long_name);
                    } else{
                        //jQuery('#user_zipcode').val('');
                    }
                }
            }


            /*console.log(place);
             console.log(place.address_components[6].long_name);*/
            console.log(place.address_components);


        });
    }

    jQuery(window).load(function () {
        setUp();
    });


</script>
    <?php
