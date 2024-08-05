<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class SaveImage implements ShouldQueue
{
    use Queueable;

    protected string $photoLink;
    protected string $localPath;

    /**
     * Create a new job instance.
     */
    public function __construct($photoLink, $localPath)
    {
        $this->photoLink = $photoLink;
        $this->localPath = $localPath;
    }

    /**
     * Execute the job.
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client();
        $response = $client->request('GET', $this->photoLink);

        if ($response->getStatusCode() == 200) {
            Storage::disk('public')->put($this->localPath, $response->getBody()->getContents());
        }
    }
}
