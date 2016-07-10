<?php

return [

    'connections' => [

        /*
         * The environment name.
         */
        'production' => [

            /*
             * The hostname to send the env file to
             */
            'host'  => '52.22.30.227',

            /*
             * The username to be used when connecting to the server where the logs are located
             */
            'user' => 'forge',

            /*
             * The full path to the directory where the .env is located MUST end in /
             */
            'rootEnvDirectory' => '/home/forge/universalcomicshub.io/',

            'port' => 22
        ],
    ],
];
