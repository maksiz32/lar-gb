<?php

namespace App\Jobs;

use App\Models\Resource;
use App\Services\YandexParser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $resource;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(YandexParser $parser)
    {
        $parser->parseYandexNews($this->resource);
    }
}
