<?php

return [
    'driver' => env('IMAGE_DRIVER', 'gd'), // gd or imagick
    
    'options' => [
        'gd' => [
            // GD specific options
        ],
        'imagick' => [
            'binpath' => env('IMAGICK_BIN_PATH', ''),
        ]
    ]
];