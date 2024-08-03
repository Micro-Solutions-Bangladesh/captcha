<?php
if (!defined('KAHUKPATH')) {
	die();
}

include_once KAHUKPATH_PLUGINS . PLUGIN_SLUG_CAPTCHA . "/frontend.php";

/**
 * Hook Function
 * Plugin Settings Page
 */
function captcha_settings_page_callback() {
    $action_type = sanitize_text_field(_post("action_type", ""));

    if ($action_type == "submit-settings") {
        $captchaSiteKey = sanitize_text_field(_post("captcha_google_site_key", ""));
        $captchaSecretKey = sanitize_text_field(_post("captcha_google_secret_key", ""));

        kahuk_update_config("_captcha_google_site_key", $captchaSiteKey);
        kahuk_update_config("_captcha_google_secret_key", $captchaSecretKey);
    
        kahuk_redirect(PLUGIN_SETTINGS_CAPTCHA);
        exit;
    }

    $captchaSecretKey = kahuk_get_config("_captcha_google_secret_key");
    $captchaSiteKey = kahuk_get_config("_captcha_google_site_key");

    // Default Page for Plugin
    include __DIR__ . '/tpl/plugin-default.php';
}

$hooks->add_action("kahuk_settings_page_" . PLUGIN_SLUG_CAPTCHA, "captcha_settings_page_callback");

/**
 * Get the captcha enabled pages from settings // TODO
 * 
 * @return array
 */
function captcha_enabled_pages() {
    global $hooks;

    $output = [
        "register", 
        "submit", 
        "story",
    ];

    return $hooks->apply_filters("captcha_enabled_pages", $output);
}

/**
 * Hook Function
 * Plugin Settings Page
 */
function captcha_activate_plugin_callback() {
    $captchaSecretKey = kahuk_get_config("_captcha_google_secret_key");
    $captchaSiteKey = kahuk_get_config("_captcha_google_site_key");

    if (!$captchaSecretKey || !$captchaSiteKey) {
        kahuk_update_config("_captcha_google_site_key", '');
        kahuk_update_config("_captcha_google_secret_key", '');
    }
}

$hooks->add_action("kahuk_activate_plugin_" . PLUGIN_SLUG_CAPTCHA, "captcha_activate_plugin_callback");
