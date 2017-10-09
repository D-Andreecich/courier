<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Order;
use App\User;

class DenyOrder extends Notification
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
	 * @return array
	 */
	public function via()
	{
		return ['database'];
	}
	
	/**
	 * Get the array representation of the notification.
	 *
	 * @return array
	 */
	public function toArray()
	{
		$order = Order::find($this->order->id);
		
		return [
			'data' => 'Курьер отменил Ваш заказ №' . $order->id
		];
	}
}
