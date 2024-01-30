<?php

return [
    'file_config'=>'resources/js/editorjs_config_backend.json',
    "blocks" => [
        'paragraph'=>\App\Api\Domain\EditorJS\Blocks\ParagraphBlock::class,
        'header'=> \App\Api\Domain\EditorJS\Blocks\HeaderBlock::class,
        'linkTool'=>\App\Api\Domain\EditorJS\Blocks\linkToolBlock::class,
    ],
];
