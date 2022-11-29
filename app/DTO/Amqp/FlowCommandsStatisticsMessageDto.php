<?php
declare(strict_types=1);

namespace App\DTO\Amqp;

/**
 * @property integer $flowId
 * @property integer $commandId
 * @property integer $botChatTelegramUserId
 * @property string $triggeredAt
 */
class FlowCommandsStatisticsMessageDto extends AbstractMessageDto
{

}
