<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\TakenOrder;
use App\Order;
use App\UserOrder;
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
	 * @param
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
		$orderId = Order::find($this->order->id)->id;
		$courier = UserOrder::all()->where('order_id', $orderId)->where('role', 'courier');
		
		foreach ($courier as $ceil) {
			$courierId = $ceil->user_id;
		}
		
		$courier = User::find($courierId);
		
		return [
			'data' => $courier->name . ' отменил Ваш заказ #' . $orderId
		];
	}
}
