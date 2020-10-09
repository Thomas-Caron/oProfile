<?php

require get_theme_file_path( 'inc/customizer/panel/class-main.php' );

require get_theme_file_path( 'inc/customizer/section/class-front-page.php' );

require get_theme_file_path( 'inc/customizer/setting/class-front-page-post-count.php' );

require get_theme_file_path( 'inc/customizer/section/class-front-page-banner.php' );

require get_theme_file_path( 'inc/customizer/setting/class-banner-title.php' );
require get_theme_file_path( 'inc/customizer/setting/class-banner-description.php' );
require get_theme_file_path( 'inc/customizer/setting/class-banner-image.php' );

require get_theme_file_path( 'inc/customizer/section/class-footer.php' );

require get_theme_file_path( 'inc/customizer/setting/class-email.php' );
require get_theme_file_path( 'inc/customizer/setting/class-phone.php' );
require get_theme_file_path( 'inc/customizer/setting/class-address.php' );

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Panel\Main',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Section\Front_Page',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Setting\Front_Page_Post_Count',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Section\Front_Page_Banner',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Setting\Banner_Title',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Setting\Banner_Description',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Setting\Banner_Image',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Section\Footer',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Setting\Email',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Setting\Phone',
        'add'
    ]
);

add_action(
    'customize_register',
    [
        'oProfile\Theme\Customizer\Setting\Address',
        'add'
    ]
);
