<?php
declare(strict_types=1);

namespace App\DTO\Amqp;

/**
 * @property integer $flowId
 * @property integer $telegramUserId
 * @property integer $sent
 * @property integer $received
 * @property integer $spaceUsed
 * @property string $subscribedAt
 */
class FlowTelegramUsersStatisticsMessageDto extends AbstractMessageDto
{

}
