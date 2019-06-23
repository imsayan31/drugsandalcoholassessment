<?php
$GeneralThemeObject = new GeneralTheme();
$userDetails = $GeneralThemeObject->user_details();
?>
<div class="sj-sidebar">
    <h2><?php _e('Hello '. $userDetails->data['fname'], THEME_TEXTDOMAIN); ?></h2>
    <a href="<?php echo wp_logout_url(BASE_URL); ?>"><?php _e('Not '. $userDetails->data['fname'].'? Log Out', THEME_TEXTDOMAIN); ?></a>
    <?php
    if ($userDetails->data['role'] == 'customer'):
            ?>
            
            <?php
        elseif ($userDetails->data['role'] == 'counselor'):
            ?>
            
            <?php
        endif;
        ?>
        
    
</div>
<?php
