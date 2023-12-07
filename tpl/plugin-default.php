<h3>Google Captcha Settings</h3>
<p>
    This plugin require google reCaptcha <strong>Site Key</strong> and <strong>Secret Key</strong>.
</p>
<p>Please visit <a href="https://www.google.com/recaptcha/admin/" target="_blank">Google Re-captcha</a> to create and collect the configuration settings.</p>

<form name="captcha" method="post">
<div class="data-list">
    <div class="data-item gap-8 p-4 font-bold">
        <div class="col-span-3">
            <label for="captcha_google_site_key">Site Key</label>
        </div>
        <div class="col-span-9">
            <input type="text" name="captcha_google_site_key" 
                id="captcha_google_site_key"  value="<?= $captchaSiteKey ?>"
                class="form-control" />
        </div>
    </div>

    <div class="data-item gap-8 p-4 font-bold">
        <div class="col-span-3">
            <label for="captcha_google_secret_key">Secret Key</label>
        </div>
        <div class="col-span-9">
            <input type="text" name="captcha_google_secret_key" 
                id="captcha_google_secret_key"  value="<?= $captchaSecretKey ?>"
                class="form-control" />
        </div>
    </div>

    <div class="flex gap-4">
        <input type="hidden" name="action_type" value="submit-settings" />
        <input type="submit" name="submit" value="Update" class="btn btn-primary" />
    </div>
</form>
