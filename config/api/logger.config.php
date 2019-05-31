<?php
return [
    'log_manager' => [
        'log_enabled' => true,
    ],
    'logs' => [
        'api' => [
            'type' => 'file',
            'options' => [
                'logs_dir'   => '%LOGS_DIR%/%DATE_Y4%/%DATE_M%/%DATE_D%',
                'file_name'  => '%DATE_Y4%-%DATE_M%-%DATE_D%_%DATE_H24%-%DATE_I%-%DATE_S%_%DATE_U%_api.log',
                'log_levels' => ['ALL'],
            ],
        ],
    ],
];