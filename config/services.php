<?php

return [
    'tencent_docs' => [
        'base_url' => env('TENCENT_DOCS_BASE_URL', 'https://docs.qq.com'),
        'token' => env('TENCENT_DOCS_TOKEN'),
        'target_folder_id' => env('TENCENT_DOCS_TARGET_FOLDER_ID'),
    ],
];
