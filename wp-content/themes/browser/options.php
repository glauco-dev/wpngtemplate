<?php

if (!defined("ABSPATH")) {
	exit;
} // Exit if accessed directly

add_action("admin_menu", "register_theme_menu");

function register_theme_menu() {
    add_menu_page(
        __("Integra Chagas Glaucodev Theme - Options", "textdomain"),   // Page title
        "Integra Chagas Glaucodev Theme",                               // Menu Title
        "manage_options",                               // Capability
        "integra-chagas-glaucodev-theme-options",                  // Menu Slug
        "integra_chagas_glaucodev_theme_options",             // Function
        "",                                             // Icon
        3                                               // Position
    );
}

function integra_chagas_glaucodev_theme_options() {
?>
    <div class="wrap">
        <div class="ngwp-settings-container">
            <div class="ngwp-settings-section">
    <div class="title">Main Config</div>

    <div class="setting">
    <div class="name">Title</div>
    <div class="value">
        <input id="field_title" type="text" value="<?php echo get_theme_mod("title", ""); ?>" />
    </div>
</div>
<div class="setting">
    <div class="name">Author</div>
    <div class="value">
        <input id="field_author" type="text" value="<?php echo get_theme_mod("author", ""); ?>" />
    </div>
</div>
</div>

            <div class="ngwp-settings-footer">
                <button class="button button-primary" onclick="save()">Save</button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const siteUrl = getSiteUrl();
        const settingsAtLoad = readSettingsFromForm();

        function save() {
            const settings = readSettingsFromForm();
            const patchObject = {};

            const keys = Object.keys(settings);
            for (let i = 0; i < keys.length; i++) {
                const key = keys[i];

                if (settingsAtLoad[key] !== settings[key]) {
                    patchObject[key] = settings[key];
                }
            }

            if (Object.keys(patchObject).length > 0) {
                updateSettings(patchObject);
            }
        }

        function readSettingsFromForm() {
            const settings = {};
            
            const titleValue = document.getElementById('field_title')?.value;

if (titleValue) {
    settings['title'] = titleValue;
}

const authorValue = document.getElementById('field_author')?.value;

if (authorValue) {
    settings['author'] = authorValue;
}

const logoValue = document.getElementById('field_logo')?.value;

if (logoValue) {
    settings['logo'] = logoValue;
}


            return settings;
        }

        function updateSettings(settings) {
            const url = `${siteUrl}/wp-json/ngwp/theme-setting`;
            post(url, settings, function(response) { });
        }

        function post(url, data, callback) {
            const nonce = '<?php echo wp_create_nonce("wp_rest"); ?>';

            const xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-WP-Nonce', nonce);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const json = xhr.responseText.replace(/[^a-zA-Z0-9_":,\{\}\[\]]+/gi, '');
                    callback(JSON.parse(json));
                }
            };
            
            const payload = JSON.stringify(data);
            xhr.send(payload);
        }

        function getSiteUrl() {
            let siteUrl = '<?php echo esc_url(site_url()); ?>';
            return siteUrl[siteUrl.length - 1] === '/' ? siteUrl.substring(0, siteUrl.length - 1) : siteUrl;
        }
    </script>

    <style type="text/css">
        .button.button-primary {
            font-size: 16px;
            padding: 2px 20px;
            border-radius: 30px;
        }

        .ngwp-settings-container {
            background: #fff;
            padding: 20px 40px 40px 40px;
            border: 1px solid #cbcbcb;
            border-radius: 6px;
            box-sizing: border-box;
            max-width: 600px;
            margin: 50px auto 0 auto;
        }

        .ngwp-settings-container * {
            box-sizing: border-box;
        }

        .ngwp-settings-section {
            margin-bottom: 60px;
        }

        .ngwp-settings-section > .title {
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 40px 0;
            border-left: 6px solid #2271b1;
            padding: 6px 8px 8px 8px;
        }

        .ngwp-settings-section > .setting {
            margin: 15px 0;
        }

        .ngwp-settings-section > .setting > .name {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .ngwp-settings-section > .setting > .value > input {
            width: 100%;
            font-size: 16px;
            padding: 2px 10px;
            margin: 5px 0;
        }

        .ngwp-settings-footer {
            margin-top: 50px;
        }
    </style>
<?php
}