<?php 
class Modelmahasiswa extends CI_Model{
    
    function getDataMahasiswa(){
        return $this->db->get('mahasiswa')->result();
    }
    
    function insertDataMahasiswa($data){
        $this->db->insert('mahasiswa',$data);    
    }
    
    function DataMahasiswa($id_mhs){
        return $this->db->get_where('mahasiswa',array('nim'=>$id_mhs))->result();        
    }
    
    function updateMahasiswa($data = array()){
        $this->db->where('nim',$data['nim'])->update('mahasiswa',$data);
    }
    
    function deleteMahasiswa($id_mhs) {
        $this->db->where('id_mhs',$id_mhs)->delete('mahasiswa');    
    }
}
?>