<div class="import-wrapper">
    <div class="import-title">
        <h4>Import Content</h4>
    </div>
    <div class="import-content">
        <?php if ( is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ) { ?>
        <div class="alert-danger alert alert-dismissible fade in" role="alert">
            <strong>[IMPORTANT] Our Import Dummy Data will not work correctly when WordPress Importer enabled. Please disable WordPress Importer Plugin first</strong>
        </div>
        <?php } ?>
        <div class="alert-success alert alert-dismissible fade in" role="alert">
            <ul>
                <li><strong>Import Content : </strong> will import demo content to your server. This include with post, image, menu</li>
                <li><strong>Import Setting : </strong> will import dashboard setting, customizer setting, widget content, setup homepage, setup logo, and setup menu position</li>
                <li>During import process, please don't close / refresh the page Import Content Process will take sometime, you can browse to another tab. Once import finished, it will send alert to your browser</li>
                <li>if you already have content on your site, we suggest you to use <strong>Import Setting</strong> instead <strong>Import Content</strong></li>
            </ul>
        </div>
        <ul class="import-item">
            <?php for($i = 1; $i <= 6; $i++) { ?>
            <li>
                <div class="import-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . "/images/import/demo" . $i . ".jpg"); ?>">
                </div>
                <div class="import-navigation">
                    <form method="post">
                        <input type="hidden" name="action" value="import_content">
                        <input type="hidden" name="type" value="content">
                        <input type="hidden" name="number" value="<?php echo esc_attr($i) ?>">
                        <input class="import-button" type="submit" value="Import Content">
                    </form>
                    <form method="post">
                        <input type="hidden" name="action" value="import_content">
                        <input type="hidden" name="type" value="setting">
                        <input type="hidden" name="number" value="<?php echo esc_attr($i) ?>">
                        <input class="import-button" type="submit" value="Import Setting">
                    </form>
                    <div class="import-overlay"><p>Loading ...</p></div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>