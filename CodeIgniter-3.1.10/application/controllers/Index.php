<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: * ");

class Index extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
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
        $data = $this->dataIndex->indexPage();
        if ($this->input->is_ajax_request()) {
            if ($data) {
                $this->show_message('true', '数据查询成功', $data);
            } else {
                $data = '';
                $this->show_message('false', '暂无数据', $data);
            }
        }
        $this->load->view('index', $data);
    }

    /**
     * 数据设置(无人机设置)
     */
    public function dataSet()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('productId') && $this->input->post('status') && $this->input->post('alt') && $this->input->post('speed')) {
                $data['productId'] = $this->input->post('productId');
                $data['status'] = $this->input->post('status');
                $data['alt'] = $this->input->post('alt');
                $data['speed'] = $this->input->post('speed');
                if ($this->dataIndex->planeSet($data)) {
                    $this->show_message('true', '数据添加成功');
                } else {
                    $this->show_message('false', '数据添加失败');
                }
            } else {
                $this->show_message('false', '数据不能留空');
            }
        }
        $data['plane'] = $this->dataIndex->planeSelect();
        $this->load->view('set', $data);
    }

    /**
     * 数据设置(无人机删除)
     */
    public function delPlane()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('id')) {
                $data = $this->input->post('id');
                if ($this->dataIndex->delplane($data)) {
                    $this->show_message('true', '数据删除成功');
                } else {
                    $this->show_message('false', '数据删除失败');
                }
            } else {
                $this->show_message('false', '数据异常');
            }
        }
    }

    /**
     * 数据设置(操作人员设置)
     */
    public function personSet()
    {
        if ($this->input->is_ajax_request()) {
            $where = $this->input->post('week1');
            if (!empty($where)) {
                $week = $this->dataIndex->personSelect($where);
                if ($week) {
                    $this->show_message('true', '数据查询成功', $week);
                } else {
                    $this->show_message('true', '暂无数据', '');
                }
            }
            if ($this->input->post('username') && $this->input->post('iphone') && $this->input->post('week') && $this->input->post('time')) {
                $data['username'] = $this->input->post('username');
                $data['iphone'] = $this->input->post('iphone');
                $data['charge'] = $this->input->post('charge');
                $data['week'] = $this->input->post('week');
                $data['time'] = $this->input->post('time');
                $data['id'] = $this->input->post('id');
                if ($this->dataIndex->personSet($data)) {
                    $this->show_message('true', '操作成功');
                } else {
                    $this->show_message('false', '操作失败');
                }
            } else {
                $this->show_message('false', '数据不能留空');
            }
        }
        $data['week'] = $this->dataIndex->get_weeks();
        $whereTime = date("Y-m-d");
        $data['user'] = $this->dataIndex->personSelect($whereTime);
        $this->load->view('set-person', $data);
    }

    /**
     * 数据设置(操作人员删除)
     */
    public function delPerson()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('id')) {
                $data = $this->input->post('id');
                if ($this->dataIndex->delperson($data)) {
                    $this->show_message('true', '数据删除成功');
                } else {
                    $this->show_message('false', '数据删除失败');
                }
            } else {
                $this->show_message('false', '数据异常');
            }
        }
    }

    /**
     * 数据设置(气体阈值设置)
     */
    public function airSet()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('tsh') && $this->input->post('air')) {
                $data['threshold'] = $this->input->post('tsh');
                $data['id'] = $this->input->post('air');
                $data['datetime'] = date('Y-m-d : H:i:s');
                if ($this->dataIndex->airSet($data)) {
                    $this->show_message('true', '数据更新成功');
                } else {
                    $this->show_message('false', '数据更新失败');
                }
            } else {
                $this->show_message('false', '数据不能留空');
            }
        }
        $data['airList'] = $this->dataIndex->airList();
        $this->load->view('set-air',$data);
    }

    /**
     * 历史记录(无人机)
     */
    public function planeHis()
    {
        if ($this->input->is_ajax_request()) {
            $startTime = $this->input->post('startTime');
            $endTime = $this->input->post('endTime');
            $planeId = $this->input->post('planeId');
            if ($startTime && $endTime && $planeId) {
                $where = array(
                    "Day >= " => $startTime,
                    "Day <= " => $endTime,
                    "productId = " => $planeId,
                );
                $data = $this->dataIndex->hisPlane($where);
                if ($data) {
                    $this->show_message('true', '数据查询成功', $data);
                } else {
                    $this->show_message('true', '未查到相应数据', '');
                }
            } else {
                $this->show_message('false', '搜索数据为空');
            }
        }
        $data['planeList'] = $this->dataIndex->planeSelect();
        $this->load->view('history-plane', $data);
    }

    /**
     * 历史记录(气体)
     */
    public function airHis()
    {
        if ($this->input->is_ajax_request()) {
            $startTime = $this->input->post('startTime');
            $endTime = $this->input->post('endTime');
            $field = $this->input->post('air');
            if ($startTime && $endTime && $field) {
                $where = array(
                    "startTime" => $startTime,
                    "endTime" => $endTime,
                );
                $data = $this->dataIndex->hisAir($where, $field);
                if ($data) {
                    $this->show_message('true', '数据查询成功', $data);
                } else {
                    $this->show_message('true', '未查到相应数据', '');
                }
            } else {
                $this->show_message('false', '搜索数据为空');
            }
        }
        $data['airList'] = $this->dataIndex->airList();
        $this->load->view('history-air', $data);
    }

    /*首页地图正在飞的无人机*/
    public function testMap()
    {
        $data = $this->dataIndex->planeOnSelect();
        $this->show_message('true', '数据查询成功', $data);
    }
    /*首页地图某个无人机的详细信息*/
    public function testMapId()
    {
        $id = $this->input->get('id');
        $data = $this->dataIndex->planeOneSelect($id);
        $this->show_message('true', '数据查询成功', $data);
    }
    /*首页地图正在飞的无人机经纬度*/
    public function planeLatLon()
    {
        $id = $this->input->post('productId');
        $data = $this->dataIndex->planeLatLon($id);
        $this->show_message('true', '数据查询成功', $data);
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
        $data = $data ? $data : array();
        $res = array("status" => $status, "tips" => $tips, "ms" => $ms, 'data' => $data);
        $json = json_encode($res, JSON_UNESCAPED_UNICODE);
        exit($json);
    }
}
