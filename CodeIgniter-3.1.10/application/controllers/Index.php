<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('dataIndex');
    }

    /**
     * 首页数据
     */
	public function indexPage()
	{
        $data['plane'] = $this->dataIndex->indexPage();
		$this->load->view('index');
	}
    /**
     * 数据设置(无人机设置)
     */
    public function dataSet()
    {
        if($this->input->is_ajax_request()){
            if($this->input->post('name') && $this->input->post('number')){
                $data['name'] = $this->input->post('name');
                $data['number'] = $this->input->post('number');
                if ($this->dataIndex->planeSet($data)){
                    $this->show_message('true','数据添加成功');
                }else{
                    $this->show_message('false','数据添加失败');
                }
            }else{
                $this->show_message('false','数据不能留空');
            }
        }
        $this->load->view('set');
    }

    /**
     * 数据设置(操作人员设置)
     */
    public function personSet()
    {
        if($this->input->is_ajax_request()){
            if($this->input->post('username') && $this->input->post('iphone')){
                $data['username'] = $this->input->post('username');
                $data['iphone'] = $this->input->post('iphone');
                $data['week'] = $this->input->post('week');
                $data['time'] = $this->input->post('time');
                if ($this->dataIndex->personSet($data)){
                    $this->show_message('true','数据添加成功');
                }else{
                    $this->show_message('false','数据添加失败');
                }
            }else{
                $this->show_message('false','数据不能留空');
            }
        }
        $this->load->view('set-person');
    }
    /**
     * 历史记录(无人机)
     */
    public function planeHis()
    {
        $this->load->view('history-plane');
    }
    /**
     * 历史记录(气体)
     */
    public function airHis()
    {
        $this->load->view('history-air');
    }
    /**
     * @param $status
     * @param $tips
     * @param string $data
     * @param int $ms
     * @param string $dialog
     * @param bool $returnjs
     * 公共输出模板
     */
    function show_message($status, $tips, $data = '', $ms = 2000, $dialog = '', $returnjs = false)
    {
        $data = is_array($data) ? $data : array();
        $res = array("status" => $status, "tips" => $tips, "ms" => $ms) + $data;
        $json = json_encode($res,JSON_UNESCAPED_UNICODE);
        exit($json);
    }
}
