<?php
declare(strict_types=1);

namespace App\DTO\Amqp;

/**
 * @property integer $flowId
 * @property integer $blockId
 * @property integer $messageId
 * @property string $triggeredAt
 */
class FlowBlockStatisticsMessageDto extends AbstractMessageDto
{

}
