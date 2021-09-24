<?php

/*
 * This file is a part of the Lorhondel project.
 *
 * Copyright (c) 2021-present Valithor Obsidion <valzargaming@gmail.com>
 */

namespace Lorhondel\Parts\Battle;

use Lorhondel\Builders\MessageBuilder;
use Lorhondel\Endpoint;
use Lorhondel\Parts\Channel\Channel;
use Lorhondel\Parts\Part;
use Lorhondel\Parts\Channel\Message;
use React\Promise\ExtendedPromiseInterface;

/**
 * A battle is a general battle that is not attached to a group.
 *

 * @property int    $id            The unique identifier of the battle.
 * @property int    $party_id      Participating party id.
 * @property bool   $active        Whether the battle is active.
 * @property string $status        Placeholder.
 * @property int    $turn          Turn number.
 *
 * @property Enemy  $enemy1        The Enemy the party is fighting.
 *
 * @property        $player1act    The action that will be taken by player1 on their turn.
 * @property        $player2act    The action that will be taken by player2 on their turn.
 * @property        $player3act    The action that will be taken by player3 on their turn.
 * @property        $player4act    The action that will be taken by player4 on their turn.
 * @property        $player5act    The action that will be taken by player5 on their turn.
 *
 * @property TimerInterface $timer Controls the flow of battle. //Declared with $this->timer=addPeriodicTimer($int, function ($timer) ...) and nulled with cancelTimer($this->timer).
 */
class Battle extends Part
{

    /**
     * @inheritdoc
     */
    protected static $fillable = ['id', 'party_id', 'active', 'status', 'turn'];

	/**
     * Returns the fillable attributes.
     *
     * @return array
     */
    public static function getFillableAttributes($context = '')
	{
		$fillable = array();
		foreach (self::$fillable as $attr) {
			if (! $context || in_array($context, self::$fillable)) {
				$fillable[] = $attr;
			}
		}
		return $fillable;
	}

	/**
     * @inheritdoc
     */
    public function getCreatableAttributes(): array
    {
        return [
            'id' => $this->id,
			'party_id' => $this->party_id,
			'active' => $this->active,
			'status' => $this->status,
			'turn' => $this->turn,
        ];
    }

    /**
     * Returns a timestamp for when a battle's account was created.
     *
     * @return float
     */
    public function createdTimestamp()
    {
        return \Lorhondel\getSnowflakeTimestamp($this->id);
    }
	

    /**
     * @inheritdoc
     */
    public function getRepositoryAttributes(): array
    {
        return [
            'battle_id' => $this->id,
        ];
    }

    /**
     * Returns a formatted mention.
     *
     * @return string A formatted mention.
     */
    public function __toString()
    {
        return "<@{$this->user_id}>";
    }
}