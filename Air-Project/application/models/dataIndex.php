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
    public $field = '`CO`,`SO2`,`NO2`,`O3`,`PM2.5`,`PM10`';
    public $airDataPack = 'airdectectpack';

    public function __construct()
    {
        $this->load->database();
    }
    public function planeOneAir($productID)
    {

        $where = date('Y-m-d');
        $airWhere = array(
            'recDAY' => $where,
            'uPM2_5 < ' => 500,
            'uPM10 < ' => 500,
            'uSO2 < ' => 500,
            'uCO < ' => 500,
            'uO3 < ' => 500,
            'uNO2 < ' => 500,
            'productID' => $productID
        );
        $airwWhere = array(
            'recDAY' => $where,
            'uPM2_5 < ' => 500,
            'uPM10 < ' => 500,
            'uSO2 < ' => 500,
            'uCO < ' => 500,
            'uO3 < ' => 500,
            'uNO2 < ' => 500,
        );
        $air = $this->db->from($this->airDataPack)->where($airWhere)->order_by('recTime', 'DESC')->limit(5)->get()->result_array();//首页所需气体包信息
        $airWarning = $this->db->from($this->airDataPack)->where($airwWhere)->order_by('recTime', 'DESC')->get()->result_array();//今日所有气体预警信息
        $airlist = $this->airList();//所有气体列表
        $last_names = array_column($air,'recTime');
        array_multisort($last_names,SORT_ASC,$air);
        if (!empty($air) && !empty($airlist)) {
            foreach ($air as $k => $v) {
                $Time[] = $v['recTime'];
                $air1[] = $v;
                $SO2[] = $v['uSO2'];
                $NO2[] = $v['uNO2'];
                $CO[] = $v['uCO'];
                $O3[] = $v['uO3'];
                $PM10[] = $v['uPM10'];
                $PM2_5[] = $v['uPM2_5'];
            }
            $SO2i = array_sum($SO2)/count($SO2);
            $NO2i = array_sum($NO2)/count($NO2);
            $COi = array_sum($CO)/count($CO);
            $O3i = array_sum($O3)/count($O3);
            $PM10i = array_sum($PM10)/count($PM10);
            $PM2_5i = array_sum($PM2_5)/count($PM2_5);
            $SO2aqi = $this->SO2aqi($SO2i);
            $NO2aqi = $this->NO2aqi($NO2i);
            $COaqi = $this->COaqi($COi);
            $O3aqi = $this->O3aqi($O3i);
            $PM10aqi = $this->PM10aqi($PM10i);
            $PM2_5aqi = $this->PM2_5aqi($PM2_5i);
            $aqi = [$SO2aqi,$NO2aqi,$COaqi,$PM2_5aqi,$PM10aqi,$O3aqi];
            $aqix = ['SO2','NO2','CO','PM2.5','PM10','O3'];
            $data['aqi'] = $aqi;
            $data['aqix'] = $aqix;
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
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    /**
     * 首页数据查询
     * @return mixed
     */
    public function indexPage()
    {
        $where = date('Y-m-d');
        $data['plane'] = $this->planeOnSelect();//正在飞行中无人机信息
        if($data['plane']){
        	$airWhere = array(
	            'recDAY' => $where,
	            'uPM2_5 < ' => 500,
	            'uPM10 < ' => 500,
	            'uSO2 < ' => 500,
	            'uCO < ' => 500,
	            'uO3 < ' => 500,
	            'uNO2 < ' => 500,
	            'productID' => $data['plane'][0]['productID']
        	);
        }else{
        	$airWhere = array(
	            'recDAY' => $where,
	            'uPM2_5 < ' => 500,
	            'uPM10 < ' => 500,
	            'uSO2 < ' => 500,
	            'uCO < ' => 500,
	            'uO3 < ' => 500,
	            'uNO2 < ' => 500,
	           
	        );
        }

        $airwWhere = array(
            'recDAY' => $where,
            'uPM2_5 < ' => 500,
            'uPM10 < ' => 500,
            'uSO2 < ' => 500,
            'uCO < ' => 500,
            'uO3 < ' => 500,
            'uNO2 < ' => 500,
        );
        $air = $this->db->from($this->airDataPack)->where($airWhere)->order_by('recTime', 'DESC')->limit(5)->get()->result_array();//首页所需气体包信息
        $airWarning = $this->db->from($this->airDataPack)->where($airwWhere)->order_by('recTime', 'DESC')->get()->result_array();//今日所有气体预警信息
        $airlist = $this->airList();//所有气体列表
        $plane_new2 = $this->db->where('recDAY', $where)->order_by('recTime', 'DESC')->get($this->airDataPack)->row_array();//无人机开始GPS数据
        $planeWhere = array(
            'recDAY' => $where,
            'productID' => $plane_new2['productID']
        );
        $plane_new = $this->db->where($planeWhere)->order_by('recTime', 'DESC')->get($this->airDataPack)->row_array();//无人机新GPS数据
        if (!empty($plane_new)) {
            $data['End_point']['lng'] = $plane_new['lGPS_lon'];
            $data['End_point']['lat'] = $plane_new['lGPS_lat'];
        }
        if (!empty($plane_new2)) {
            $data['Start_point']['lng'] = $plane_new2['lGPS_lon'];
            $data['Start_point']['lat'] = $plane_new2['lGPS_lat'];
        }
        $last_names = array_column($air,'recTime');
        array_multisort($last_names,SORT_ASC,$air);
        if (!empty($air) && !empty($airlist)) {
            foreach ($air as $k => $v) {
                $Time[] = $v['recTime'];
                $air1[] = $v;
                $SO2[] = intval($v['uSO2']);
                $NO2[] = intval($v['uNO2']);
                $CO[] = intval($v['uCO']);
                $O3[] = intval($v['uO3']);
                $PM10[] = intval($v['uPM10']);
                $PM2_5[] = intval($v['uPM2_5']);
            }

            $SO2i = array_sum($SO2)/count($SO2);
            $NO2i = array_sum($NO2)/count($NO2);
            $COi = array_sum($CO)/count($CO);
            $O3i = array_sum($O3)/count($O3);
            $PM10i = array_sum($PM10)/count($PM10);
            $PM2_5i = array_sum($PM2_5)/count($PM2_5);
            $SO2aqi = $this->SO2aqi($SO2i);
            $NO2aqi = $this->NO2aqi($NO2i);
            $COaqi = $this->COaqi($COi);
            $O3aqi = $this->O3aqi($O3i);
            $PM10aqi = $this->PM10aqi($PM10i);
            $PM2_5aqi = $this->PM2_5aqi($PM2_5i);
            $aqi = [$SO2aqi,$NO2aqi,$COaqi,$PM2_5aqi,$PM10aqi,$O3aqi];
            $aqix = ['SO2','NO2','CO','PM2.5','PM10','O3'];
            $data['aqi'] = $aqi;
            $data['aqix'] = $aqix;
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
        $video_url= $this ->video_url();
        $vul = array_slice($video_url,0,1);
        $vid = [];
        foreach ($vul as $vk => $vv){
            $vid = $vv['video'];
        }
        $data['video_url'] = $vid;
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function SO2aqi($SO2i){
        if($SO2i >= 0 && $SO2i < 50){
            $Cl = 0 ;$Ch = 50; $Il = 0; $Ih=50;
        }elseif($SO2i >= 50 && $SO2i < 150){
            $Cl = 50 ;$Ch = 150; $Il = 50; $Ih=100;
        }elseif($SO2i >= 150 && $SO2i < 475){
            $Cl = 150 ;$Ch = 475; $Il = 100; $Ih=150;
        }elseif($SO2i >= 475 && $SO2i < 800){
            $Cl = 475 ;$Ch = 800; $Il = 150; $Ih=200;
        }elseif($SO2i >= 800 && $SO2i < 1600){
            $Cl = 800 ;$Ch = 1600; $Il = 200; $Ih=300;
        }elseif($SO2i >= 1600 && $SO2i < 2100){
            $Cl = 1600 ;$Ch = 2100; $Il = 300; $Ih=400;
        }else{
            $Cl = 2100 ;$Ch = 2620; $Il = 400; $Ih=500;
        }
        $SO2aqi = round((($Ih-$Il)/($Ch-$Cl)*($SO2i-$Cl))+$Il);
        return $SO2aqi;
    }
    public function NO2aqi($NO2i){
        if($NO2i >= 0 && $NO2i < 40){
            $Cl = 0 ;$Ch = 40; $Il = 0; $Ih=50;
        }elseif($NO2i >= 40 && $NO2i < 80){
            $Cl = 40 ;$Ch = 80; $Il = 50; $Ih=100;
        }elseif($NO2i >= 80 && $NO2i < 180){
            $Cl = 80 ;$Ch = 180; $Il = 100; $Ih=150;
        }elseif($NO2i >= 180 && $NO2i < 280){
            $Cl = 180 ;$Ch = 280; $Il = 150; $Ih=200;
        }elseif($NO2i >= 280 && $NO2i < 565){
            $Cl = 280 ;$Ch = 565; $Il = 200; $Ih=300;
        }elseif($NO2i >= 565 && $NO2i < 750){
            $Cl = 565 ;$Ch = 750; $Il = 300; $Ih=400;
        }else{
            $Cl = 750 ;$Ch = 940; $Il = 400; $Ih=500;
        }
        $NO2aqi = round((($Ih-$Il)/($Ch-$Cl)*($NO2i-$Cl))+$Il);
        return $NO2aqi;
    }
    public function COaqi($COi){
        if($COi >= 0 && $COi < 2){
            $Cl = 0 ;$Ch = 2; $Il = 0; $Ih=50;
        }elseif($COi >= 2 && $COi < 4){
            $Cl = 2 ;$Ch = 4; $Il = 50; $Ih=100;
        }elseif($COi >= 4 && $COi < 14){
            $Cl = 4 ;$Ch = 14; $Il = 100; $Ih=150;
        }elseif($COi >= 14 && $COi < 24){
            $Cl = 14 ;$Ch = 24; $Il = 150; $Ih=200;
        }elseif($COi >= 24 && $COi < 36){
            $Cl = 24 ;$Ch = 36; $Il = 200; $Ih=300;
        }elseif($COi >= 36 && $COi < 48){
            $Cl = 36 ;$Ch = 48; $Il = 300; $Ih=400;
        }else{
            $Cl = 48 ;$Ch = 60; $Il = 400; $Ih=500;
        }
        $COaqi = round((($Ih-$Il)/($Ch-$Cl)*($COi-$Cl))+$Il);
        return $COaqi;
    }
    public function O3aqi($O3i){
        if($O3i >= 0 && $O3i < 100){
            $Cl = 0 ;$Ch = 100; $Il = 0; $Ih=50;
        }elseif($O3i >= 100 && $O3i < 160){
            $Cl = 100 ;$Ch = 160; $Il = 50; $Ih=100;
        }elseif($O3i >= 160 && $O3i < 215){
            $Cl = 160 ;$Ch = 215; $Il = 100; $Ih=150;
        }elseif($O3i >= 215 && $O3i < 265){
            $Cl = 215 ;$Ch = 265; $Il = 150; $Ih=200;
        }elseif($O3i >= 265 && $O3i < 800){
            $Cl = 265 ;$Ch = 800; $Il = 200; $Ih=300;
        }elseif($O3i >= 800 && $O3i < 1000){
            $Cl = 800 ;$Ch = 1000; $Il = 300; $Ih=400;
        }else{
            $Cl = 1000 ;$Ch = 1200; $Il = 400; $Ih=500;
        }
        $O3aqi = round((($Ih-$Il)/($Ch-$Cl)*($O3i-$Cl))+$Il);
        return $O3aqi;
    }
    public function PM10aqi($PM10i){
        if($PM10i >= 0 && $PM10i < 50){
            $Cl = 0 ;$Ch = 50; $Il = 0; $Ih=50;
        }elseif($PM10i >= 50 && $PM10i < 150){
            $Cl = 50 ;$Ch = 150; $Il = 50; $Ih=100;
        }elseif($PM10i >= 150 && $PM10i < 250){
            $Cl = 150 ;$Ch = 250; $Il = 100; $Ih=150;
        }elseif($PM10i >= 250 && $PM10i < 350){
            $Cl = 250 ;$Ch = 350; $Il = 150; $Ih=200;
        }elseif($PM10i >= 350 && $PM10i < 420){
            $Cl = 350 ;$Ch = 420; $Il = 200; $Ih=300;
        }elseif($PM10i >= 420 && $PM10i < 500){
            $Cl = 420 ;$Ch = 500; $Il = 300; $Ih=400;
        }else{
            $Cl = 500 ;$Ch = 600; $Il = 400; $Ih=500;
        }
        $PM10aqi = round((($Ih-$Il)/($Ch-$Cl)*($PM10i-$Cl))+$Il);
        return $PM10aqi;
    }
    public function PM2_5aqi($PM2_5i){
        if($PM2_5i >= 0 && $PM2_5i < 35){
            $Cl = 0 ;$Ch = 35; $Il = 0; $Ih=50;
        }elseif($PM2_5i >= 35 && $PM2_5i < 75){
            $Cl = 35 ;$Ch = 75; $Il = 50; $Ih=100;
        }elseif($PM2_5i >= 75 && $PM2_5i < 115){
            $Cl = 75 ;$Ch = 115; $Il = 100; $Ih=150;
        }elseif($PM2_5i >= 115 && $PM2_5i < 150){
            $Cl = 115 ;$Ch = 150; $Il = 150; $Ih=200;
        }elseif($PM2_5i >= 150 && $PM2_5i < 250){
            $Cl = 150 ;$Ch = 250; $Il = 200; $Ih=300;
        }elseif($PM2_5i >= 250 && $PM2_5i < 350){
            $Cl = 250 ;$Ch = 350; $Il = 300; $Ih=400;
        }else{
            $Cl = 350 ;$Ch = 500; $Il = 400; $Ih=500;
        }
        $PM2_5aqi = round((($Ih-$Il)/($Ch-$Cl)*($PM2_5i-$Cl))+$Il);
        return $PM2_5aqi;
    }
    /*每次获取一条新数据*/
    public function airOne()
    {
        $where = date('Y-m-d');
        $airWhere = array(
            'recDAY' => $where,
            'uPM2_5 < ' => 500,
            'uPM10 < ' => 500,
            'uSO2 < ' => 500,
            'uCO < ' => 500,
            'uO3 < ' => 500,
            'uNO2 < ' => 500,
        );
        $air = $this->db->from($this->airDataPack)->where($airWhere)->order_by('recTime', 'DESC')->limit(1)->get()->result_array();//首页所需气体包信息
        $last_names = array_column($air,'recTime');
        array_multisort($last_names,SORT_ASC,$air);
        foreach ($air as $v){
            $Time[] = $v['recTime'];
        }
        $data['air'] = $air;
        $data['Time'] = $Time;
        return $data;
    }
    /*视频源*/
    public function video_url(){
        $video = [];
        $plane = $this->planeOnSelect();//正在飞行中无人机信息
        if($plane){
            foreach ($plane as $kp => $vp){
                $planeStock[] = $this->db->select('productId,video')->from($this->productStock)->where('productId',$vp['productID'])->get()->row_array();//无人机库存信息
            }
            foreach ($planeStock as $sk => $sv){
                $sv['video'] = explode(',',$sv['video']);
                $video[] = $sv;
            }
        }

        return $video;
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
        $data = $this->db->query('select p.* from  (select a.*,l.productType from airdectectpack as a INNER JOIN plane as l ON a.productID = l.productId where `recDAY` = ' . '"' . $where . '"' . ' and uPM2_5 < 500   ORDER BY recTime DESC LIMIT 999999 ) as p group by p.productID ')->result_array();//正在飞行中无人机信息
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
        $plane = $this->db->where('productID',$id)->order_by('recTime', 'DESC')->get($this->airDataPack)->row_array();
        $planeStock = $this->db->select('video')->from($this->productStock)->where('productID',$id)->get()->row_array();
        $video_url = explode(',',$planeStock['video']);
//        $json_info = $this->get_json();
//        foreach ($video_url as $vvK => $vvV){
//            $json_info['source']['src'][$vvK]['strUrl'] = $vvV;
//            $json_info['source']['src'][$vvK]['strToken'] = 'token'.$vvK;
//        }
//        $info = json_encode($json_info);
//        $edit = file_put_contents("F:/h5s-r10.6.0229.20-win64-release/h5s-r10.6.0229.20-win64-release/conf/h5ss.conf",$info);
        $data['video'] = $video_url;
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
        $plane = $this->db->select('DATE_FORMAT( recTime, "%H" ) as time,lGPS_lat,lGPS_lon,recDAY,recTime')->where($where)->group_by('time')->order_by('recTime', 'DESC')->get($this->airDataPack)->result_array();
        $alt = $this->db->select('DATE_FORMAT( recTime, "%H" ) as time,AVG(nGPS_alt) as nGPS_alt')->where($where)->order_by('recTime', 'DESC')->get($this->airDataPack)->row_array();
        if ($plane) {
            foreach ($plane as $k => $v) {
                $data['point'][$k]['BLng'] = $v['lGPS_lon'];
                $data['point'][$k]['BLat'] = $v['lGPS_lat'];
                $data['point'][$k]['time'] = $v['recDAY'].' '.$v['recTime'];
            }
            $data['speed'] = sprintf("%01.2f", 0);
            $data['alt'] = sprintf("%01.2f", $alt['nGPS_alt']);
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
        $air = $this->db->query('select ' . $joinField . ',`recDAY` from ' . $this->airDataPack . ' where recDAY >=' . '"' . $where['startTime'] . '"' . ' and recDAY <= ' . '"' . $where['endTime'] . '"' . ' and uSO2 < 500 order by recTime DESC')->result_array();
        if ($air) {
            foreach ($air as $k => $v) {
                $time[$k] = $v['recDAY'];
            }
            $time1 = array_flip($time);
            $time = array_keys($time1);
            foreach ($time as $key => $val) {
                $data[$key]['time'] = $val;
//                $air1 = $this->db->query('select ' . $joinField . ',recTime from ' . $this->airDataPack . '  where recDAY = ' . '"' . $val . '"' . ' and uSO2 < 500 order by serialNum DESC')->result_array();
                $airHour = $this->db->query('select DATE_FORMAT( recTime, "%H" ) as time,
	AVG(uSO2) as SO2,AVG(uNO2) as NO2,AVG(uCO) AS CO,AVG(uO3) AS O3,AVG(uPM10) AS PM10,AVG(uPM2_5) AS `PM2.5`,recTime from ' . $this->airDataPack . '  where recDAY =  ' . '"' . $val . '"' . ' and uSO2 <500   GROUP BY time order by time DESC ')->result_array();
                if (!empty($airHour)) {
                    foreach ($airHour as $kk => $vv) {
                        $Time[$kk] = $vv['time'].':00';
                        $air2[] = $vv;
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
        $airWhere = array(
            'recDAY' => $where,
            'uPM2_5 < ' => 500,
            'uPM10 < ' => 500,
            'uSO2 < ' => 500,
            'uCO < ' => 500,
            'uO3 < ' => 500,
            'uNO2 < ' => 500,
        );
        $air = $this->db->from($this->airDataPack)->where($airWhere)->order_by('recTime', 'DESC')->get()->result_array();//气体信息
        $airlist = $this->airList();//所有气体名称列表
        if (!empty($air)) {
            foreach ($airlist as $key => $val) {
                if($val['field'] == 'PM2.5'){
                    $val['field'] = 'PM2_5';
                    $airdataList[$val['field']] = $val['threshold'];
                }
                $airdataList[$val['field']] = $val['threshold'];
            }
            $i = 0;
            foreach ($airdataList as $kk => $vv) {
                foreach ($air as $kkk => $vvv) {
                    if (!empty($airdataList[$kk])) {
                        if ($vvv['u'.$kk] >= $airdataList[$kk]) {
                            $i++;
                            $data[$i]['productID'] = $vvv['productID'];
                            $data[$i]['airName'] = $kk;
                            $data[$i]['airNum'] = $vvv['u'.$kk];
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
        $field = '`uSO2`,`uNO2`,`uPM10`,`uPM2_5`,`uCO`,`uO3`';
        $planeStock = $this->db->select('*')->from($this->airDataPack)->where($data)->get()->row_array();
        $air = $this->db->query('select ' . $field . ' from ' . $this->airDataPack.' where id =' . '"' . $planeStock['id'] . '"' )->row_array();
        foreach ($air as $k => $v){
            $air1[] = $v;
            $pos = strpos($k, 'u');
            if($pos === 0){
                $str = substr_replace($k,'',0,1);
                $k = $str;
                if($k == 'PM2_5'){
                    $k = 'PM2.5';
                }
            }else{
                $k = $k;
            }
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