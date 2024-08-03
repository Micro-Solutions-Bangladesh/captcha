<?php
/**
 * Plugin Detail
 */
define("PLUGIN_SLUG_CAPTCHA", "captcha");
define("PLUGIN_SETTINGS_CAPTCHA", kahuk_create_url("admin/admin_plugin.php?plugin=" . PLUGIN_SLUG_CAPTCHA . "&page=plugin-default"));

$kahukPlugins[PLUGIN_SLUG_CAPTCHA]['title'] = "Captcha";
$kahukPlugins[PLUGIN_SLUG_CAPTCHA]['desc'] = "CAPTCHA plugin from Micro Solutions Bangladesh (MSBD) enables a Kahuk CMS powered website to avoid unwanted request using Google reCaptcha.";
$kahukPlugins[PLUGIN_SLUG_CAPTCHA]['has_settings'] = true;
$kahukPlugins[PLUGIN_SLUG_CAPTCHA]['version'] = '1.0.1';
$kahukPlugins[PLUGIN_SLUG_CAPTCHA]['homepage_url'] = '';
