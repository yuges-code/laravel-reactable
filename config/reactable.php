<?php

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for comments
     */
    'models' => [
        'reaction' => Yuges\Reactable\Models\Reaction::class,
        'type' => Yuges\Reactable\Models\ReactionType::class,
    ],

    'types' => [
        'allowed' => [],
    ],

    'anonymous' => false,

    'actions' => [
        'process' => 'ProcessCommentAction::class',
    ],
];
