<?php

/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/11/21
 * Time: 15:37
 */
class dataIndex extends CI_Model
{
    public $productTable = 'product';
    public $productStock = 'plane';
    public $airTable = 'air';
    public $userTable = 'user';
    public $tshTable = 'air_threshold';
    public $field = '`CO`,`SO2`,`NO2`,`O3`,`PM2.5`,`PM10`,`VOC`,`CO2`,`H2S`,`NO`,`CH2O`,`NH3`,`PH3`,`HCN`,`C2H4`,`H2O2`,`CH4`,`F2`,`HCL`,`C2H4O`,`SF6`';

    public function __construct()
    {
        $this->load->database();
    }
    /**
     * 首页数据查询
     * @return mixed
     */
    public function indexPage()
    {
        $where = date('Y-m-d');
        $data['plane'] = $this->planeOnSelect();//正在飞行中无人机信息
        $whereStockWhere = 'productId not in (SELECT productId from product)';
        $planeStock = $this->db->select('*')->from($this->productStock)->where($whereStockWhere)->get()->result_array();//无人机库存信息
        $air_query = $this->db->from($this->airTable)->join($this->productTable, $this->productTable . '.id = ' . $this->airTable . '.productId')->where('Day', $where)->order_by('serialNum', 'ASC')->get();
        $air = $air_query->result_array();//气体信息
        $airlist = $this->airList();//所有气体列表
        $user = $this->db->select('*')->from($this->userTable)->where('time', $where)->get()->result_array();//负责无人机人员列表
        $plane_new2 = $this->db->where('Day', $where)->order_by('serialNum', 'ASC')->get($this->productTable)->row_array();//无人机开始GPS数据
        $planeWhere = array(
            'Day' => $where,
            'productId' => $plane_new2['productId']
        );
        $plane_new = $this->db->where($planeWhere)->order_by('serialNum', 'DESC')->get($this->productTable)->row_array();//无人机新GPS数据
        if (!empty($plane_new)) {
            $data['End_point']['lng'] = $plane_new['lon'];
            $data['End_point']['lat'] = $plane_new['lat'];
        }
        if (!empty($plane_new2)) {
            $data['Start_point']['lng'] = $plane_new2['lon'];
            $data['Start_point']['lat'] = $plane_new2['lat'];
        }
        if (!empty($airlist)) {
            foreach ($airlist as $key => $val) {
                $airList[] = $val['field'];
                $airdataList[$val['field']] = $val['threshold'];
            }
            $data['airList'] = $airList;
            $data['airdataList'] = $airdataList;
            if (!empty($air)) {
                foreach ($air as $k => $v) {
                    $Time[] = substr($v['Time'], 0, 5);
                    $air1[] = $v;
                }
                foreach ($airdataList as $kk => $vv){
                    foreach ($air1 as $kkk => $value){
                        if(!empty($airdataList[$kk])) {
                            if ($value[$kk] > $airdataList[$kk]) {
                                $a[$kk][] = $value[$kk];
                            }else{
                                $a[$kk][] = '';
                            }
                        }
                    }
                }
                foreach ($a as $key => $item) {
                    if(in_array('',$item)){

                    }
                        $b[$k] = count($item);

                }
                $data['time'] = $Time;
                $data['air'] = $air1;
                $data['airdataList'] = $a;
            }
        }

        if (!empty($user)) {
            $data['user'] = $user;
        }
        var_dump($a);die;
        $data['planeStock'] = $planeStock;
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * 无人机数据添加
     * @param $data
     * @return bool
     */
    public function planeSet($data)
    {
        if ($this->db->insert($this->productStock, $data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 无人机数据删除
     * @param $data
     * @return bool
     */
    public function delplane($data)
    {
        if ($this->db->where('id', $data)->delete($this->productStock)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 无人机数据查询
     * @return bool
     */
    public function planeSelect()
    {
        $planeStock = $this->db->select('*')->from($this->productStock)->get()->result_array();
        if ($planeStock) {
            return $planeStock;
        } else {
            return '';
        }
    }
    /**
     * 正在飞无人机数据查询
     * @return bool
     */
    public function planeOnSelect()
    {
        $where = date('Y-m-d');
        $data = $this->db->query('select p.* from  (select * from product where `Day` = ' . '"' . $where . '"' . ' ORDER BY serialNum DESC LIMIT 999999 ) as p group by p.productId ')->result_array();//正在飞行中无人机信息
        if ($data) {
            return $data;
        } else {
            return '';
        }
    }
    /**
     * 单个无人机数据查询
     * @return bool
     */
    public function planeOneSelect($id)
    {
        $planeStock = $this->db->select('*')->from($this->productTable)->where('id',$id)->get()->row_array();
        if ($planeStock) {
            return $planeStock;
        } else {
            return '';
        }
    }
    /**
     * 无人机更新的经纬度
     * @return bool
     */
    public function planeLatLon($id)
    {
        $plane = $this->db->where('productId',$id)->order_by('serialNum', 'DESC')->get($this->productTable)->row_array();
//        var_dump($this->db->last_query());die;
        if ($plane) {
            $data['lon'] = $plane['lon'];
            $data['lat'] = $plane['lat'];
            return $data;
        } else {
            return false;
        }
    }
    /**
     * 操作人员数据添加
     * @param $data
     * @return bool
     */
    public function personSet($data)
    {
        $user = $this->db->select('*')->from($this->userTable)->where('id', $data['id'])->get()->row_array();
        if ($user) {
            $this->db->where('id', $data['id']);
            if ($this->db->update($this->userTable, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($this->db->insert($this->userTable, $data)) {
                return true;
            } else {
                return false;
            }
        }

    }
    /**
     * 气体阈值数据添加
     * @param $data
     * @return bool
     */
    public function airSet($data)
    {
        $this->db->where('id', $data['id']);
        if ($this->db->update($this->tshTable, $data)) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * 操作人员数据查询
     * @param $data
     * @return bool
     */
    public function personSelect($where)
    {
        $user = $this->db->select('*')->from($this->userTable)->where('time', $where)->get()->result_array();
        if ($user) {
            return $user;
        } else {
            return '';
        }
    }

    /**
     * 操作人员数据删除
     * @param $data
     * @return bool
     */
    public function delperson($data)
    {
        if ($this->db->where('id', $data)->delete($this->userTable)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取本周所有日期
     */
    public function get_week($time = '', $format = 'Y-m-d')
    {
        $time = $time != '' ? $time : time();
        //获取当前周几
        $week = date('w', $time);
        for ($i = 1; $i <= 7; $i++) {
            $date[$i] = date($format, strtotime('+' . $i - $week . ' days', $time));
        }
        return $date;
    }

    /**
     * 获取最近七天日期
     */
    function get_weeks($time = '', $format = 'Y-m-d')
    {
        $time = $time != '' ? $time : time();
        //组合数据
        $week = date('w', $time);
        for ($i = 1; $i <= 7; $i++) {
            $date[] = date($format, strtotime('+' . $i - 1 . ' days', $time));
        }
        foreach ($date as $k => $v) {
            $data[date('w', strtotime($v))] = $v;

        }
        return $data;
    }

    /**
     * 历史无人机数据查询
     * @param $where
     * @return string
     */
    public function hisPlane($where)
    {
        $plane = $this->db->where($where)->order_by('serialNum', 'DESC')->get($this->productTable)->result_array();
        $speed = $this->db->select_avg('speed')->where($where)->order_by('serialNum', 'DESC')->get($this->productTable)->row_array();
        $alt = $this->db->select_avg('alt')->where($where)->order_by('serialNum', 'DESC')->get($this->productTable)->row_array();
        if ($plane) {
            foreach ($plane as $k => $v) {
                $data['point'][$k]['BLng'] = $v['lon'];
                $data['point'][$k]['BLat'] = $v['lat'];
            }
            $data['speed'] = sprintf("%01.2f", $speed['speed']);
            $data['alt'] = sprintf("%01.2f", $alt['alt']);
            return $data;
        } else {
            return false;
        }

    }

    /**
     * 历史气体数据查询
     * @param $where
     * @return string
     */
    public function hisAir($where, $field)
    {
        $joinField = "`" . join("`,`", $field) . "`";
        $air = $this->db->query('select ' . $joinField . ',`Day` from ' . $this->airTable . ' join ' . $this->productTable . ' on ' . $this->productTable . '.id = ' . $this->airTable . '.productId where Day >=' . '"' . $where['startTime'] . '"' . ' and Day <= ' . '"' . $where['endTime'] . '"' . ' order by serialNum DESC')->result_array();
//        var_dump($air);die;
        if ($air) {
            foreach ($air as $k => $v) {
                $time[$k] = $v['Day'];
            }
            $time1 = array_flip($time);
            $time = array_keys($time1);
            foreach ($time as $key => $val) {
                $data[$key]['time'] = $val;
                $air1 = $this->db->query('select ' . $joinField . ',Time from ' . $this->airTable . ' join ' . $this->productTable . ' on ' . $this->productTable . '.id = ' . $this->airTable . '.productId where Day = ' . '"' . $val . '"' . ' order by serialNum ASC')->result_array();
                if (!empty($air1)) {
                    foreach ($air1 as $kk => $vv) {
                        $Time[$kk] = substr($vv['Time'], 0, 5);
                        $air2[$kk] = $vv;
                    }
                    $data[$key]['air']['Time'] = $Time;
                    $data[$key]['air']['air'] = $air2;
                }
            }
            return $data;
        } else {
            return false;
        }

    }

    public function airList()
    {
        $air_querylist = $this->db->query('select * from '.$this->tshTable);
        $airlist = $air_querylist->result_array();
        if (!empty($airlist)) {
//            foreach ($airlist as $key => $val) {
//                $airList[] = $val['field'];
//            }
            return $airlist;
        }
    }
}