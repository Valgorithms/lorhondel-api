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

use Lorhondel\Parts\Guild\Invite;
use Lorhondel\WebSockets\Event;
use Lorhondel\Helpers\Deferred;

class InviteCreate extends Event
{
    /**
     * @inheritdoc
     */
    public function handle(Deferred &$deferred, $data): void
    {
        $invite = $this->factory->create(Invite::class, $data, true);

        $deferred->resolve($invite);
    }
}
