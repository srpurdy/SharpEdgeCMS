<?php
###################################################################
##
##	Paypal Module
##	Version: 1.03
##
##	Last Edit:
##  Apr 24 2015
##
##	Description:
##	Paypal Gateway System
##	
##	Author:
##	By Shawn Purdy
##  @ Alex Dean Paypal Lib
##	
##	Comments:
##	
##
##################################################################
class Paypal extends MY_Controller
	{

	function Paypal()
		{
		parent::MY_Controller();
		#Libraries
		$this->load->library('cart');
		
		#Drivers
		$this->load->driver('pp');
		
		#Models
		$this->load->model('paypal_gateway_model');
		
		#Helpers
		$this->load->helper('download');
		
		#Config
		$this->load->config('paypal_ipn');
		}

	// For Paypal Payments
	function index()
		{
		echo "error occured";
		}
	
	function paypal_direct($paypal_array)
		{
		$data['heading'] = 'Re-Directing to Paypal.';
		$data['template_path'] = $this->config->item('template_page');
		$data['page'] = $data['template_path'] . '/paypal/paypal_direct';
		$data['paypal_array'] = $paypal_array;
		$data['order_items'] = $this->paypal_gateway_model->get_order_items($paypal_array['order_number']);
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
	
	function paid()
		{
		$data['heading'] = 'Thank You';
		$data['template_path'] = $this->config->item('template_page');
		$data['page'] = $data['template_path'] . '/paypal/thank_you';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
	
	function downloads()
		{
		$data['heading'] = 'Downloads';
		$data['template_path'] = $this->config->item('template_page');
		$data['page'] = $data['template_path'] . '/paypal/downloads';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
	
	function get_download()
		{
		// Extract the file information from the database, and check for valid access
		$get_download = $this->site_frontend_model->get_product_download($this->uri->segment(3), $this->uri->segment(4));
		foreach($get_download->result() as $gd)
			{
			$check_file = 'assets/downloads/files/'.$gd->userfile;
			if(file_exists($check_file))
				{
				$download_file = file_get_contents("assets/downloads/files/".$gd->userfile);
				}
			else
				{
				redirect('paypal_gateway/paid/'.$this->uri->segment(4));
				}
			$name = $gd->userfile;
			}
			
		//If a result is found force download of the file, Else redirect back to paid / thank you page.
		if($get_download->result())
			{
			force_download($name, $download_file);
			}
		else
			{
			redirect('paypal_gateway/paid/'.$this->uri->segment(4));
			}
		}
	
	function place_order()
		{
		if($this->cart->contents())
			{
			//Lets place an order in the database. The Order will consist of the entire contents of the shopping cart.
			$order_number = $this->paypal_gateway_model->place_order(str_replace('-', '.', $this->uri->segment(3)));
			
			//Lets build a paypal array based off our paypal configuration settings.
			if($this->config->item('paypal_ipn_use_live_settings') == TRUE)
				{
				$paypal_email = $this->config->item('email', 'paypal_ipn_live_settings');
				$paypal_url = $this->config->item('url', 'paypal_ipn_live_settings');
				$debug = $this->config->item('debug', 'paypal_ipn_live_settings');
				}
			else
				{
				$paypal_email = $this->config->item('email', 'paypal_ipn_sandbox_settings');
				$paypal_url = $this->config->item('url', 'paypal_ipn_sandbox_settings');
				$debug = $this->config->item('debug', 'paypal_ipn_sandbox_settings');
				}
			$total_purchase_amount = str_replace('-', '.', $this->uri->segment(3));
			$paypal_array = array(
							'paypal_email' => $paypal_email,
							'order_number' => $order_number,
							'paypal_url' => $paypal_url,
							'debug' => $debug,
							'total_purchase_amount' => $total_purchase_amount
			);
			
			//Now lets re-direct the user to paypal to process the payment.
			$this->paypal_direct($paypal_array);
			}
		else
			{
			redirect('paypal');
			}
		}

    // To handle the IPN post made by PayPal (uses the Paypal_Lib library).
    function ipn()
		{
        $this->load->library('PayPal_IPN'); // Load the library

        // Try to get the IPN data.
        if ($this->paypal_ipn->validateIPN())
        {
            // Succeeded, now let's extract the order
            $this->paypal_ipn->extractOrder();

            // And we save the order now (persist and extract are separate because you might only want to persist the order in certain circumstances).
            $this->paypal_ipn->saveOrder();

            // Now let's check what the payment status is and act accordingly
            if ($this->paypal_ipn->orderStatus == PayPal_IPN::PAID)
            {
				// Update Order Table with Paid status
				$this->paypal_gateway_model->update_order($this->uri->segment(3));
				// Configure to send HTML emails.
                $this->load->library('email');
				$this->load->config('website_config');
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['crlf'] = '\r\n';
				$config['newline'] = '\r\n';
				$config['validate'] = FALSE;
				$this->email->initialize($config);

                // Prepare the variables to populate the email template:
				$data['ppipn'] = $this->db
					->where('custom', $this->uri->segment(3))
					->select('txn_id')
					->from('ipn_orders')
					->get();
				$data['order_number'] = $this->uri->segment(3);
				$data['items'] = $this->db
					->where('orders.order_number', $data['order_number'])
					->where('orders.id = order_items.order_id')
					->select('*')
					->from('orders, order_items')
					->get();

                // Now construct the email
				$emailBody = $this->load->view('confirmation_email', $data, TRUE); 

                // Finish configuring email contents and send.
				$this->email->from($this->config->item('contact_email'));
                $this->email->to($data['payer_email'], $data['first_name'] . ' ' . $data['last_name']);
				$this->email->cc($this->config->item('contact_email'), 'Website Admin'); //For Debug
                $this->email->subject('Order confirmation');
                $this->email->message($emailBody);
                $this->email->send();
            }
        }
        else
			{
			}
		}
	}