<?php

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for comments
     */
    'models' => [
        'reaction' => [
            'default' => Yuges\Reactable\Models\Reaction::class,
            'type' => Yuges\Reactable\Models\ReactionType::class,
        ],
        'reactor' => [
            'default' => \App\Models\User::class,
            'allowed' => [
                \App\Models\User::class,
            ],
        ],
    ],

    'types' => [
        'allowed' => [],
    ],

    'anonymous' => false,

    'actions' => [
        'create' => Yuges\Reactable\Actions\CreateReactionAction::class,
        'process' => Yuges\Reactable\Actions\ProcessReactionAction::class,
    ],
];
