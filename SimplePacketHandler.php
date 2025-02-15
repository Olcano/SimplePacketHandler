<?php

declare(strict_types=1);

namespace SimplePacketHandler;

use InvalidArgumentException;
use pocketmine\event\EventPriority;
use pocketmine\plugin\Plugin;
use SimplePacketHandler\interceptor\IPacketInterceptor;
use SimplePacketHandler\interceptor\PacketInterceptor;
use SimplePacketHandler\monitor\IPacketMonitor;
use SimplePacketHandler\monitor\PacketMonitor;

final class SimplePacketHandler
{

    public static function createInterceptor(Plugin $registerer, int $priority = EventPriority::NORMAL, bool $handle_cancelled = false): IPacketInterceptor
    {
        if ($priority === EventPriority::MONITOR) {
            throw new InvalidArgumentException("Cannot intercept packets at MONITOR priority");
        }
        return new PacketInterceptor($registerer, $priority, $handle_cancelled);
    }

    public static function createMonitor(Plugin $registerer, bool $handle_cancelled = false): IPacketMonitor
    {
        return new PacketMonitor($registerer, $handle_cancelled);
    }
}