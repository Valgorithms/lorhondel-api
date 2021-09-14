<?php

/*
 * This file is a part of the LorhondelPHP project.
 *
 * Copyright (c) 2015-present David Cole <david.cole1340@gmail.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE.md file.
 */

namespace Lorhondel\WebSockets\Events;

use Lorhondel\Parts\Channel\Channel;
use Lorhondel\WebSockets\Event;
use Lorhondel\Helpers\Deferred;

class ChannelCreate extends Event
{
    /**
     * @inheritdoc
     */
    public function handle(Deferred &$deferred, $data): void
    {
        /** @var Channel */
        $channel = $this->factory->create(Channel::class, $data, true);

        if ($channel->is_private) {
            $this->lorhondel->private_channels->push($channel);
        } else {
            if ($guild = $this->lorhondel->guilds->get('id', $channel->guild_id)) {
                $guild->channels->push($channel);
                $this->lorhondel->guilds->push($guild);
            }
        }

        $deferred->resolve($channel);
    }
}
