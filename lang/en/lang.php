<?php return [
    'plugin' => [
        'name' => 'Security Monitor',
        'description' => 'Monitor suspicious password reset attempts with IP tracking and instant email alerts for enhanced backend security.',
    ],
    'permissions' => [
        'access_settings' => 'Access Security Monitor settings',
    ],
    'mail' => [
        'reset_notification' => [
            'subject' => 'Security Alert: Password Reset Request',
        ],
    ],
];