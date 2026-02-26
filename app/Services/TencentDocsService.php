<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Arr;

class TencentDocsService
{
    public function __construct(
        protected HttpFactory $http,
    ) {
    }

    /**
     * 复制腾讯文档模板，返回新文档ID和访问链接。
     */
    public function copyTemplate(string $templateId, string $projectName): array
    {
        $response = $this->http
            ->withToken((string) config('services.tencent_docs.token'))
            ->post(
                rtrim((string) config('services.tencent_docs.base_url'), '/') . '/openapi/drive/v2/files/copy',
                [
                    'file_id' => $templateId,
                    'new_title' => sprintf('%s-测试模板', $projectName),
                    'target_folder_id' => config('services.tencent_docs.target_folder_id'),
                ],
            )
            ->throw()
            ->json();

        return [
            'doc_id' => (string) Arr::get($response, 'data.file_id'),
            'doc_url' => (string) Arr::get($response, 'data.url'),
        ];
    }

    /**
     * 更新已复制测试文档内容。
     */
    public function updateCopiedTestDoc(string $docId, string $content): void
    {
        $this->http
            ->withToken((string) config('services.tencent_docs.token'))
            ->put(
                rtrim((string) config('services.tencent_docs.base_url'), '/') . sprintf('/openapi/drive/v2/files/%s/content', $docId),
                [
                    'content' => $content,
                ],
            )
            ->throw();
    }
}
