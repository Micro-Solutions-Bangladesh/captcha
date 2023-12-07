<?php

/**
 * Verify the captcha token
 * 
 * @return array
 */
function captcha_submit_verify_callback($dataArray) {
    if (isset($dataArray['success']) && ($dataArray['success'] == false)) {
        // Already false verification found by other hook
        // We return the previous data without further verification
        return $dataArray;
    }

    $upname = kahuk_build_unique_page();
    $captcha_enabled_pages = captcha_enabled_pages();
    $captchaSecretKey = kahuk_get_config("_captcha_google_secret_key");

    if (in_array($upname, $captcha_enabled_pages)) {
        $dataArray['success'] = false;
        $dataArray['message'] = "Invalid captcha found!";

        if (!empty($captchaSecretKey) && isset($_POST["g-token"])) {
            $url  = "https://www.google.com/recaptcha/api/siteverify";
            $url .= "?secret={$captchaSecretKey}";
            $url .= "&response=" . sanitize_text_field($_POST["g-token"]);
            $url .= "&remoteip=" . check_ip_behind_proxy();
    
            $request  = file_get_contents($url);
            $response = json_decode($request);
    
            if ($response->success) {
                $dataArray['success'] = true;
                $dataArray['message'] = "Captcha verification successful!";
            }
        }
    }    

    return $dataArray;
}

$hooks->add_filter("submit_verify", "captcha_submit_verify_callback");


/**
 * 
 */
function captcha_tpl_kahuk_before_head_end_callback($location) {
    global $user_authenticated;

    $upname = kahuk_build_unique_page();
    $captcha_enabled_pages = captcha_enabled_pages();
    $captchaSiteKey = kahuk_get_config("_captcha_google_site_key");

    if (in_array($upname, $captcha_enabled_pages)) {
        if ($upname == "story" && !$user_authenticated) {
            return;
        }

        if ($location == "tpl_kahuk_before_head_end") {
            ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= $captchaSiteKey ?>"></script>
            <?php
        } else if ($location == "tpl_kahuk_before_body_end") {
            ?>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('<?= $captchaSiteKey ?>', {action: 'submit'}).then(function(token) {
        document.getElementById("g-token").value = token;
    });
});
</script>
            <?php
        }
    }
}

$hooks->add_action("snippet_action_tpl", "captcha_tpl_kahuk_before_head_end_callback", 99);


/**
 * 
 */
function captcha_kahuk_form_start_callback() {
    $upname = kahuk_build_unique_page();
    $captcha_enabled_pages = captcha_enabled_pages();

    if (in_array($upname, $captcha_enabled_pages)) {
        echo '<input type="hidden" id="g-token" name="g-token" />';
    }
}

$hooks->add_action("kahuk_form_start", "captcha_kahuk_form_start_callback");

