<?php

namespace emteknetnz\ApiDataFetcher\Jobs;

use Exception;
use emteknetnz\ApiDataFetcher\Misc\Logger;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\FieldType\DBDatetime;
use Symbiote\QueuedJobs\DataObjects\QueuedJobDescriptor;
use Symbiote\QueuedJobs\Services\AbstractQueuedJob;
use Symbiote\QueuedJobs\Services\QueuedJob;
use Symbiote\QueuedJobs\Services\QueuedJobService;

abstract class AbstractLoggableJob extends AbstractQueuedJob
{
    use Injectable;

    public function process()
    {
        $this->queueNextJob();
        $isComplete = true;
        try {
            $this->processWithLogging();
        } catch (Exception $e) {
            Logger::singleton()->log(get_class($e));
            Logger::singleton()->log($e->getMessage());
            Logger::singleton()->log($e->getTraceAsString());
            $isComplete = false;
        }
        foreach (Logger::singleton()->getLogs() as $log) {
            $this->addMessage($log);
        }
        $this->isComplete = $isComplete;
    }

    public function requireDefaultJob()
    {
        $filter = [
            'Implementation' => get_class($this),
            'JobStatus' => [
                QueuedJob::STATUS_NEW,
                QueuedJob::STATUS_INIT,
                QueuedJob::STATUS_RUN
            ]
        ];
        if (QueuedJobDescriptor::get()->filter($filter)->count() > 0) {
            return;
        }
        $this->queueNextJob();
    }

    abstract protected function processWithLogging(): void;

    abstract protected function getSecondsBetweenJobs(): int;

    private function queueNextJob(): void
    {
        $timestamp = time() + $this->getSecondsBetweenJobs();
        QueuedJobService::singleton()->queueJob(
            Injector::inst()->create(static::class),
            DBDatetime::create()->setValue($timestamp)->Rfc2822()
        );
    }
}
