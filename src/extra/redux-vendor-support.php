<?php

    if ( ! defined( 'ABSPATH' ) ) {
        die;
    }

    if ( ! class_exists( 'ReduxFramework_extension_vendor_support' ) ) {
        if ( file_exists( dirname( __FILE__ ) . '/vendor_support/extension_vendor_support.php' ) ) {
            require dirname( __FILE__ ) . '/vendor_support/extension_vendor_support.php';
            new ReduxFramework_extension_vendor_support();
        }
    }