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
    public $airDataPack = 'airdectectpack';

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
        $air = $this->db->from($this->airDataPack)->where('recDAY', $where)->order_by('serialNum', 'DESC')->limit(5)->get()->result_array();//首页所需包信息
        $airWarning = $this->db->from($this->airDataPack)->where('recDAY', $where)->order_by('serialNum', 'DESC')->get()->result_array();//今日所有气体信息
        $airlist = $this->airList();//所有气体列表
        $user = $this->db->select('*')->from($this->userTable)->where('time', $where)->get()->result_array();//负责无人机人员列表
        $plane_new2 = $this->db->where('recDAY', $where)->order_by('serialNum', 'DESC')->get($this->airDataPack)->row_array();//无人机开始GPS数据
        $planeWhere = array(
            'recDAY' => $where,
            'productID' => $plane_new2['productID']
        );
        $plane_new = $this->db->where($planeWhere)->order_by('serialNum', 'DESC')->get($this->airDataPack)->row_array();//无人机新GPS数据
        if (!empty($plane_new)) {
            $data['End_point']['lng'] = $plane_new['lGPS_lon'];
            $data['End_point']['lat'] = $plane_new['lGPS_lat'];
        }
        if (!empty($plane_new2)) {
            $data['Start_point']['lng'] = $plane_new2['lGPS_lon'];
            $data['Start_point']['lat'] = $plane_new2['lGPS_lat'];
        }
        if (!empty($air) && !empty($airlist)) {
            foreach ($air as $k => $v) {
                $Time[] = substr($v['recTime'], 0, 5);
                $air1[] = $v;
            }
            $data['time'] = $Time;
            $data['air'] = $air1;

            foreach ($airlist as $key => $val) {
                $airList[] = $val['field'];
                $airdataList[$val['field']] = $val['threshold'];
            }
            $data['airList'] = $airList;

            /*预警信息*/
            $airWnew = [];
            foreach ($airWarning as $wk => $wv){
                foreach ($wv as $wwk => $wwv){
                    $pos = strpos($wwk, 'u');
                    if($pos === 0){
                        $str = substr_replace($wwk,'',0,1);
                        $wwk = $str;
                        if($wwk == 'PM2_5'){
                            $wwk = 'PM2.5';
                        }
                    }else{
                        $wwk = $wwk;
                    }
                    $wvN[$wwk] = $wwv;
                }
                $airWnew[] = $wvN;

            }
//            var_dump($airWnew);
            $nAdata = array_slice($airdataList,0,6);
            foreach ($nAdata as $kk => $vv) {
                foreach ($airWnew as $kkk => $vvv) {
                    if (!empty($nAdata[$kk])) {
                        if ($vvv[$kk] >= $nAdata[$kk]) {
                            $a[$kk][] = $vvv[$kk];
                        }
                    }
                }
            }
            if(isset($a) && !empty($a)){
                foreach ($a as $ke => $val){
                    $field[] = $ke;
                }
                foreach ($airList as $key => $item) {
                    if (in_array($item, $field)) {
                        $b[$key] = count($a[$item]);
                    } else {
                        $b[$key] = 0;
                    }

                }
                foreach ($b as $key1 => $val1){
                    $total[] = $val1;
                }
            }else{
                foreach ($airList as $key => $item) {
                    $b[$key] = 0;
                }
                $total[] = 0;
            }
            $data['airdataList'] = $b;
            foreach ($b as $bk => $bv){
                $pie[$bk]['value'] = $bv;
            }
            foreach ($airList as $ak => $av){
                $pie[$ak]['name'] = $av;
            }
            $data['pie'] = array_slice($pie,0,6);
            $data['total'] = array_sum($total);
        }
        if (!empty($user)) {
            $data['user'] = $user;
        }

        $data['planeStock'] = $planeStock;
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function airWarning(){

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
        $data = $this->db->query('select p.* from  (select * from airdectectpack where `recDAY` = ' . '"' . $where . '"' . ' ORDER BY serialNum DESC LIMIT 999999 ) as p group by p.productID ')->result_array();//正在飞行中无人机信息
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
        $planeStock = $this->db->select('*')->from($this->airDataPack)->where('id',$id)->get()->row_array();
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
        $plane = $this->db->where('productID',$id)->order_by('serialNum', 'DESC')->get($this->airDataPack)->row_array();
//        var_dump($this->db->last_query());die;
        if ($plane) {
            $data['lon'] = $plane['lGPS_lon'];
            $data['lat'] = $plane['lGPS_lat'];
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
        $plane = $this->db->where($where)->order_by('serialNum', 'DESC')->get($this->airDataPack)->result_array();
        $alt = $this->db->select_avg('nGPS_alt')->where($where)->order_by('serialNum', 'DESC')->get($this->airDataPack)->row_array();
        if ($plane) {
            foreach ($plane as $k => $v) {
                $data['point'][$k]['BLng'] = $v['lGPS_lon'];
                $data['point'][$k]['BLat'] = $v['lGPS_lat'];
                $data['point'][$k]['time'] = $v['recDAY'].' '.$v['recTime'];
            }
            $data['speed'] = sprintf("%01.2f", 0);
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
        $air = $this->db->query('select ' . $joinField . ',`recDAY` from ' . $this->airDataPack . ' where recDAY >=' . '"' . $where['startTime'] . '"' . ' and recDAY <= ' . '"' . $where['endTime'] . '"' . ' order by serialNum DESC')->result_array();
//        var_dump($air);die;
        if ($air) {
            foreach ($air as $k => $v) {
                $time[$k] = $v['recDAY'];
            }
            $time1 = array_flip($time);
            $time = array_keys($time1);
            foreach ($time as $key => $val) {
                $data[$key]['time'] = $val;
                $air1 = $this->db->query('select ' . $joinField . ',recTime from ' . $this->airDataPack . '  where recDAY = ' . '"' . $val . '"' . ' order by serialNum DESC')->result_array();
                if (!empty($air1)) {
                    foreach ($air1 as $kk => $vv) {
                        $Time[$kk] = substr($vv['recTime'], 0, 5);
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
    /*所有气体名称*/
    public function airList()
    {
        $air_querylist = $this->db->query('select * from '.$this->tshTable);
        $airlist = $air_querylist->result_array();
        if (!empty($airlist)) {
            return $airlist;
        }
    }

    /*气体预警详情*/
    public function warningDis()
    {
        $where = date('Y-m-d');
        $air = $this->db->from($this->airDataPack)->where('recDAY', $where)->order_by('serialNum', 'DESC')->get()->result_array();//气体信息
        $airlist = $this->airList();//所有气体名称列表
//        var_dump($air);die;
        if (!empty($air)) {
            foreach ($airlist as $key => $val) {
                $airdataList[$val['field']] = $val['threshold'];
            }
            $i = 0;
            foreach ($airdataList as $kk => $vv) {
                foreach ($air as $kkk => $vvv) {
                    if (!empty($airdataList[$kk])) {
                        if ($vvv[$kk] >= $airdataList[$kk]) {
                            $i++;
                            $data[$i]['productId'] = $vvv['productID'];
                            $data[$i]['airName'] = $kk;
                            $data[$i]['airNum'] = $vvv[$kk];
                            $data[$i]['airTsh'] = $airdataList[$kk];
                            $data[$i]['time'] = $vvv['recTime'];
                        }
                    }
                }
            }
        }
        if(isset($data) && !empty($data)){
            return array_values($data);
        }else{
            return false;
        }
    }
    /*数据分析*/
    public function dataAnalyse($data)
    {
        $field = '`SO2`,`NO2`,`PM10`,`PM2.5`,`CO`,`O3`';
        $planeStock = $this->db->select('*')->from($this->airDataPack)->where($data)->get()->row_array();
        $air = $this->db->query('select ' . $field . ' from ' . $this->airDataPack.' where productID =' . '"' . $planeStock['id'] . '"' )->row_array();
        foreach ($air as $k => $v){
            $air1[] = $v;
            $field1[] = $k;
        }
        $info['air'] = $air1;
        $info['airlist'] = $field1;
        if(isset($info) && !empty($info)){
            return $info;
        }else{
            return false;
        }
    }

}