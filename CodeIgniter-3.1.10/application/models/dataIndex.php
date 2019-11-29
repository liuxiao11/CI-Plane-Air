<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/11/21
 * Time: 15:37
 */
class dataIndex extends CI_Model {
    public $productTable = 'product';
    public $productStock = 'plane';
    public $airTable = 'air';
    public $userTable = 'user';
    public function __construct()
    {

        $this->load->database();
    }
    /**
     * 首页数据查询
     * @return mixed
     */
    public function indexPage(){
        $where = date('Y-m-d');
        $plane_query = $this->db->where('Day',$where)->order_by('serialNum','DESC')->get($this->productTable);
        $whereStockWhere = 'productId not in (SELECT productId from product)';
        $planeStock = $this->db->select('*')->from($this->productStock)->where($whereStockWhere)->get()->result_array();
//        var_dump($this->db->last_query());die;
        $data['plane'] = $plane_query->result_array();
        $air_query = $this->db->from($this->airTable)->join($this->productTable,$this->productTable.'.id = '.$this->airTable.'.productId')->where('Day',$where)->order_by('serialNum','ASC')->get();
        $air_querylist = $this->db->query('select `CO`,`SO2`,`NO2`,`O3`,`PM2.5`,`PM10`,`VOC`,`CO2`,`H2S`,`NO`,`CH2O`,`NH3`,`PH3`,`HCN`,`C2H4`,`H2O2`,`CH4`,`F2`,`HCL`,`C2H4O`,`SF6` from '.$this->airTable.' join '.$this->productTable.' on '.$this->productTable.'.id = '.$this->airTable.'.productId where Day = '.'"'.$where.'"'.' order by serialNum DESC');
        $air = $air_query->result_array();
        $airlist = $air_querylist->row_array();
        if(!empty($airlist)){
            foreach ($airlist as $key => $val){
                $airList[] = $key;
                $airdataList[] = $val;
            }

            $data['airList'] = $airList;
            $data['airdataList'] = $airdataList;
        }
        if(!empty($air)){
            foreach ($air as $k =>$v){
                $Time[] = substr($v['Time'],0,5);
                $air1[] = $v;
            }
            $data['time'] = $Time;
            $data['air'] = $air1;

        }
        $data['planeStock'] = $planeStock;
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    /**
     * 无人机数据添加
     * @param $data
     * @return bool
     */
    public function planeSet($data){
        if($this->db->insert($this->productStock, $data)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 无人机数据删除
     * @param $data
     * @return bool
     */
    public function delplane($data){
        if($this->db->where('id',$data)->delete($this->productStock)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 无人机数据查询
     * @return bool
     */
    public function planeSelect(){
        $planeStock = $this->db->select('*')->from($this->productStock)->get()->result_array();
        if($planeStock){
            return $planeStock;
        }else{
            return '';
        }
    }
    /**
     * 操作人员数据添加
     * @param $data
     * @return bool
     */
    public function personSet($data){
        $user = $this->db->select('*')->from($this->userTable)->where('username',$data['username'])->get()->row_array();
        if($user){
            $this->db->where('username', $data['username']);
            if($this->db->update($this->userTable, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->db->insert($this->userTable, $data)){
                return true;
            }else{
                return false;
            }
        }

    }
    /**
     * 操作人员数据查询
     * @param $data
     * @return bool
     */
    public function personSelect($where){
        $user = $this->db->select('*')->from($this->userTable)->where('week',$where)->get()->result_array();
        if($user){
            return $user;
        }else{
            return '';
        }
    }
    /**
     * 获取本周所有日期
     */
    public function get_week($time = '', $format='Y-m-d'){
        $time = $time != '' ? $time : time();
        //获取当前周几
        $week = date('w', $time);
        $date = [];
        for ($i=1; $i<=7; $i++){
            $date[$i] = date($format ,strtotime( '+' . $i-$week .' days', $time));
        }
        return $date;
    }

    /**
     * 历史无人机数据查询
     * @param $where
     * @return string
     */
    public function hisPlane($where){
        $query = $this->db->get_where($this->productTable, $where);
//        return $this->db->last_query();
        return $query->result_array();
//        if($query){
//            return $query->result_array();
//        }else{
//            return false;
//        }

    }
    /**
     * 历史气体数据查询
     * @param $where
     * @return string
     */
    public function hisAir($where,$field){
//        $air = $this->db->select($field)->from($this->airTable)->join($this->productTable,$this->productTable.'.id = '.$this->airTable.'.productId')->where($where)->order_by('serialNum','ASC')->get()->result_array();
        $air = $this->db->query('select '.$field.',`Day` from '.$this->airTable.' join '.$this->productTable.' on '.$this->productTable.'.id = '.$this->airTable.'.productId where Day >='.'"'.$where['startTime'].'"'.' and Day <= '.'"'.$where['endTime'].'"'.' order by serialNum DESC')->result_array();
        if($air){
            foreach ($air as $k => $v){
                $time[$k] = $v['Day'];
            }
            $data['time'] = array_unique($time);
            $data['air'] = $air;
            return $data;
        }else{
            return false;
        }

    }
}