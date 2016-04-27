<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace voov\QueueWorker;


use Predis\Client;
use Ramsey\Uuid\Uuid;

class QueueWorker
{

	/**
	 * QueueWorker constructor.
	 * @param $hostname
	 * @param $port
	 */
	public function __construct($hostname = 'localhost', $port=6379)
	{
		$this->redisClient = new Client([
			'scheme' => 'tcp',
			'host' => $hostname,
			'port' => $port
										]);
	}

	/**
	 * Submit a job to the QueueWorker with Redis PUBSUB
	 * @param $job array
	 * @param string $channel
	 * @return mixed|string The job ID
	 */
	public function putJob(array $job, $channel = 'queue')
	{
		if (empty($job['id'])) $job['id'] = Uuid::uuid1()->toString();
		$jobString = json_encode($job);
		$this->redisClient->publish($channel, $jobString);

		return $job['id'];
	}
}