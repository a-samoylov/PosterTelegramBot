<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

$settings = [
    'commands' => [
        [
            'name'   => '/start',
            'action' => [
                'command' => 'open_layout',
                'params'  => [
                    'layout_id' => 2
                ]
            ]
        ]
    ],

    'relationship' => [
        [
            'layout_id'         => 1,
            'button_id'         => 1,
            'action'            => [
                [
                    'command' => 'open_layout',
                    'params' => [
                        'layout_id' => 2
                    ]
                ]
            ]
        ]
    ],
    'layouts' => [
        [
            'id' => 1,
            'name' => 'Screen #1',
            'text' => 'Screen #1',
            'reply_markup' => [
                'type' => 'inline_keyboard_markup',
                'buttons' => [
                    [
                        ['id' => 1, 'text' => 'Screen #2']
                    ],
                ]
            ]
        ],
        [
            'id' => 2,
            'name' => 'Screen #2',
            'text' => 'Screen #2'
        ]
    ]
];

$b = json_encode($settings);

$c = 2;
