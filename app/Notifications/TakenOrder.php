<?php

namespace App\Notifications;

use App\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TakenOrder extends Notification
{
	use Queueable;
	
	protected $order;
	
	/**
	 * Create a new notification instance.
	 *
	 * @param Order $order
	 */
	public function __construct(Order $order)
	{
		$this->order = $order;
	}
	
	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed
	 *
	 * @return array
	 */
	public function via()
	{
		return ['database'];
	}
	
	/**
	 * Get the array representation of the notification.
	 *
	 * @param
	 *
	 * @return array
	 */
	public function toArray()
	{
		$order = Order::find($this->order->id);
		$courier = User::find($order->courier_id);
		
		return [
			'data' => 'Курьер ' . $courier->name .' забрал Ваш заказ #' . $order->id
		];
	}
}
