<?php
declare(strict_types=1);

namespace App\DTO\Amqp;

/**
 * @property string $botToken
 * @property integer $sent
 * @property integer $received
 * @property integer $triggered
 * @property integer $subscribed
 * @property integer $unsubscribed
 * @property string $dateHour
 */
class BotStatisticsMessageDto extends AbstractMessageDto
{

}
