<?php
###################################################################
##
##	Paypal Database Model
##	Version: 1.00
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Paypal Gateway Database System
##	
##	Author:
##	By Shawn Purdy
##  @ Alex Dean Paypal Lib
##	
##	Comments:
##	
##
##################################################################
class Paypal_gateway_model extends CI_Model 
	{
	
    function Paypal_gateway_model()
		{     
		parent::__construct();
		}
	
	function update_order($order_number)
		{
		$order = array(
				'order_number' => $order_number,
				'paid' => 'Y'
		);
		$this->db->set($order);
		$this->db->where('order_number', $order_number);
		$this->db->update('orders');
		}
		
	function place_order($total)
		{
		#Create Crazy Unique Random Number
		$datestring = "Y-m-d H:i:s";
		$time = time();
		$date = date($datestring, $time);
		$year = substr($date, 0, 4);
		$month = substr($date, 5, 2);
		$day = substr($date, 8, 2);
		$hours = substr($date, 11, 2);
		$minutes = substr($date, 14, 2);
		$seconds = substr($date, 17, 2);
		$order_year = $year * 65536;
		$order_day = $day * 256;
		$order_month = $month * 256;
		$order_hours = $hours * 65536;
		$order_minutes = $minutes * 256;
		$order_seconds = $seconds * 256;
		$order_number_group2 = $order_year + $order_minutes + $order_day;
		$order_number_group1 = $order_month + $order_seconds + $order_hours;
		$order_num = $order_number_group1 . $order_number_group2;
		
		#Check if this number exists in the database, and create a new number if it does.
		$this->db->where('order_number', $order_num);
		$check_num = $this->db->get('orders');
		if(!$check_num->result())
			{
			}
		else
			{
			#Re-Run the place order function if the order number exists, and keeping do so until a unique number is found.
			//$order_num = '123456789'; //for debugging
			$this->place_order();
			}
		
		#Total Order Purchase
		$total_purchase = $this->cart->total();
		
		#Create an Order
		$new_order = array(
					'order_number' => $order_num,
					'total_amount' => $total_purchase
		);
		$this->db->set($new_order);
		$this->db->insert('orders');
		$order_id = $this->db->insert_id();
		
		#Loop through contents of the cart.
		foreach($this->cart->contents() as $items)
			{
			$cart_items = array(
					'order_id' => $order_id,
					'product_id' => $items['id'],
					'name' => $items['name'],
					'qty' => $items['qty'],
					'price' => $items['price'],
					'subtotal' => $items['subtotal']
			);
			$this->db->set($cart_items);
			$this->db->insert('order_items');
			}
		return $order_num;
		}
		
	function get_order_items($order_num)
		{
		$items = $this->db
			->where('orders.order_number', $order_num)
			->where('orders.id = order_items.order_id')
			->select('*')
			->from('orders,order_items')
			->get();
		return $items;
		}
	}
?>