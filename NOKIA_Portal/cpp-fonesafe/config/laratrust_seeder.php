<?php

return [
    'role_structure' => [
        'supadmin' => [
            'users' => 'c,r,u,d',
            'profile' => 'c,r,u,d',
            'report' => 'c,r,u,d',
            'store' => 'c,r,u,d',
            'file' => 'c,r,u,d',
            'sales' => 'c,r,u,d'
        ],
        'admin' => [
            'report' => 'r'
        ],
        'salescenter' => [
            'sales' => 'c,r,u,d'
        ],
        'servicepoint' => [
            'service' => 'r,u'
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
