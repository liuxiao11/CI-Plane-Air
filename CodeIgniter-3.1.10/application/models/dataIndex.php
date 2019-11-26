<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/11/21
 * Time: 15:37
 */
class dataIndex extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    /**
     * 首页数据查询
     * @param bool $slug
     * @return mixed
     */
    public function indexPage($slug = FALSE){

        $query = $this->db->get('plane');
        return $query->result_array();

//        return $query->row_array();
    }

    /**
     * 无人机数据添加
     * @param $data
     * @return bool
     */
    public function planeSet($data){
        if($this->db->insert('plane', $data)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 操作人员数据添加
     * @param $data
     * @return bool
     */
    public function personSet($data){
        if($this->db->insert('person', $data)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 历史无人机数据查询
     * @param $where
     * @return string
     */
    public function hisPlane($where){
        $query = $this->db->get_where('plane', $where);
//        return $this->db->last_query();
        return $query->result_array();
//        if($query){
//            return $query->result_array();
//        }else{
//            return false;
//        }

    }
}