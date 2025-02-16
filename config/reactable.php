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

    'types' => Yuges\Reactable\Enums\ReactionType::class,
    'icons' => Yuges\Reactable\Enums\ReactionIcon::class,
    'weights' => Yuges\Reactable\Enums\ReactionWeight::class,

    'permissions' => [
        'anonymous' => false,
        'duplicate' => false,
    ],

    'actions' => [
        'create' => Yuges\Reactable\Actions\CreateReactionAction::class,
        'toggle' => Yuges\Reactable\Actions\ToggleReactionAction::class,
    ],
];
