<?php

namespace App;

use Amp\Cancellation;
use Amp\Parallel\Worker\Task;
use Amp\Sync\Channel;

class FetchTask implements Task
{
    public function __construct(
        private readonly mixed $fp, // must be serializable, but...
    ) {
    }

    public function run(Channel $channel, Cancellation $cancellation): string
    {
        // block
        \sleep(2);
        \fseek($this->fp, 0);
        return 'future1: '.\fread($this->fp, 1024);
    }
}
