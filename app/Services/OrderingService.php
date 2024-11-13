<?php

namespace App\Services;

class OrderingService
{

    /** @var string The class name of the model being ordered. */
    private string $class;

    /** @var string The name of the order column in the model's table. */
    private string $order_column;

    /** @var string The name of the parent column in the model's table. */
    private string $parent_column;

    /**
     * Constructor for OrderingService.
     *
     * @param string $class The class name of the model being ordered.
     * @param string $order_column The name of the order column in the model's table.
     * @param string $parent_column The name of the parent column in the model's table.
     */
    public function __construct(string $class, string $order_column, string $parent_column)
    {
        $this->class = $class;
        $this->order_column = $order_column;
        $this->parent_column = $parent_column;
    }

    /**
     * Get a new order value for a child item.
     *
     * @param int $parent_id The ID of the parent item.
     * @param bool $withTrashed Whether to include trashed items.
     * @return int The new order value.
     */
    public function newOrder(int $parent_id, bool $withTrashed = false): int
    {
        $order = $this->class::orderBy($this->order_column, 'desc')->limit(1);
        if ($withTrashed) $order->withTrashed();
        $order = $order->first();
        return $order ? ++$order->{$this->order_column} : 1;
    }

    /**
     * Move an item up in the order.
     *
     * @param int $current_id The ID of the item to move up.
     * @return bool True if the item was moved successfully, false otherwise.
     */
    public function moveUp(int $current_id): bool
    {
        return $this->move($current_id);
    }

    /**
     * Move an item down in the order.
     *
     * @param int $current_id The ID of the item to move down.
     * @return bool True if the item was moved successfully, false otherwise.
     */
    public function moveDown(int $current_id): bool
    {
        return $this->move($current_id, 'down');
    }

    /**
     * Move an item up or down in the order.
     *
     * @param int $current_id The ID of the item to move.
     * @param string $dir The direction to move the item ('up' or 'down').
     * @return bool True if the item was moved successfully, false otherwise.
     */
    private function move(int $current_id, string $dir = "up"): bool
    {
        if ($dir == "down") {
            $operator = '>';
            $ordering = 'asc';
        } else {
            $operator = '<';
            $ordering = 'desc';
        }
        $find = $this->class::findOrFail($current_id);
        $last = $this->class::where($this->order_column, $operator, $find->{$this->order_column})
            ->orderBy($this->order_column, $ordering)->limit(1)->first();
        if (!$last || !$last->{$this->order_column}) return false;
        $currentOrder = $find->{$this->order_column};
        $find->{$this->order_column} = $last->{$this->order_column};
        $last->{$this->order_column} = $currentOrder;
        return $find->save() && $last->save();
    }
}
