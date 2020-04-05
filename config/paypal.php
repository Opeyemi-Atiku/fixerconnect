<?php

return array(

    /**
     * Set our Sandbox and Live credentials
     */
    'client_id' => 'AX89Ga0XhxZR04vHqQXspCG9zUug-IFTpPrXFQo6Bgx7vFenX1RHHEaxb-xEc-S4dBhS65KYMdNwIfap',
    'secret' => 'EPDffgYjQQIVXOyEhZuqOAY6hQc7V0z49dro3Mqfd-9VDEIq4bcfn6SfjkfeDoEnjvThV-lPoF2XDODk',

    /**
     * SDK configuration settings
     */
    'settings' => array(

        /**
         * Payment Mode 
         *
         * Available options are 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        // Specify the max connection attempt (3000 = 3 seconds)
        'http.ConnectionTimeOut' => 10000,

        // Specify whether or not we want to store logs
        'log.LogEnabled' => true,

        // Specigy the location for our paypal logs
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Log Level
         *
         * Available options: 'DEBUG', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the DEBUG level and decreases
         * as you proceed towards ERROR. WARN or ERROR would be a
         * recommended option for live environments.
         *
         */
        'log.LogLevel' => 'DEBUG'
    ),
);
