<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_client extends CI_Controller{
	var	$url = 'http://localhost/ci-rest-server/index.php/api';
	var	$username = 'admin';
	var	$password = '1234';
	
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->library('curl');
		$this->load->library('rest');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
    {
		$data['items'] = json_decode($this->curl->simple_get($this->url.'/item'));
        $this->load->view('test_client',$data);
    }

    function create(){
        if(isset($_POST['submit'])){
            $data = array(
                'id'       =>  $this->input->post('id'),
                'title'      =>  $this->input->post('title'),
                'description'=>  $this->input->post('description'));
            $insert =  $this->curl->simple_post($this->url.'/item', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($insert)
            {
                $this->session->set_flashdata('result','Insert successfully');
            }else
            {
               $this->session->set_flashdata('result','Insert failed');
            }
            redirect('test_client');
        }else{
            $this->load->view('create');
        }
    }
    
    function edit(){
        if(isset($_POST['submit'])){
            $data = array(
                'id'          =>  $this->input->post('id'),
                'title'       =>  $this->input->post('title'),
                'description' =>  $this->input->post('description'));
            $update =  $this->curl->simple_put($this->url.'/item', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('result','Update successfully');
            }else
            {
               $this->session->set_flashdata('result','Update failed');
            }
            redirect('test_client');
        }else{
            // $params = array('id'=>  $this->uri->segment(3));
            $params = array('id' => 7 );
            $data['items'] = json_decode($this->curl->simple_get($this->url.'/item',$params));
            // $data['items'] = json_decode($this->curl->simple_get($this->url.'/item/7'));
            $this->load->view('edit',$data);
        }
    }
    
    function delete($id){
        if(empty($id)){
            redirect('test_client');
        }else{
            $delete =  $this->curl->simple_delete($this->url.'/item', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('result','Delete successfully');
            }else
            {
               $this->session->set_flashdata('result','Delete failed');
            }
            redirect('test_client');
        }
    }
}