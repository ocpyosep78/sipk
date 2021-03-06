<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
	sipk_organisasi  CREATE TABLE `sipk_organisasi` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`member_id` int(11) DEFAULT NULL,
		`ordering` int(11) DEFAULT NULL,
		`nama` varchar(50) DEFAULT NULL,
		`tahun_dari` int(4) DEFAULT NULL,
		`tahun_sampai` int(4) DEFAULT NULL,
		`peran` varchar(50) DEFAULT NULL,
		PRIMARY KEY (`id`),
		KEY `member_id` (`member_id`),
		KEY `ordering` (`ordering`)
	) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8
*/

class Member_Organisasi_Model extends CI_Model
{

	protected $table_def = "organisasi";
    
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_def);
        if ($query->num_rows() > 0) {
			return $query->row();
        }
		else
		{
			return FALSE;
		}
    }
	
	public function getAllByMemberId($member_id, $order = 'ordering', $direction = 'asc')
	{
		$data = array();
		$this->db->where('member_id', $member_id);
		$this->db->order_by($order, $direction);
		$query = $this->db->get($this->table_def);
		$data['data'] = $query->result();
		$data['numrows'] = $this->db->count_all_results($this->table_def);
		return $data;
	}

    public function create($organisasi)
    {
        $data = array(
            'member_id'		=> $organisasi->member_id,
            'ordering'		=> $organisasi->ordering,
            'nama'			=> $organisasi->nama,
            'tahun_dari'	=> $organisasi->tahun_dari,
			'tahun_sampai'	=> $organisasi->tahun_sampai,
            'jenis'         => $organisasi->jenis,
			'jabatan'		=> $organisasi->jabatan
        );
        $this->db->insert($this->table_def, $data);
        return $this->db->insert_id();
    }
    
    public function update($organisasi)
    {
        $data = array(
            'member_id'		=> $organisasi->member_id,
            'ordering'		=> $organisasi->ordering,
            'nama'			=> $organisasi->nama,
            'tahun_dari'	=> $organisasi->tahun_dari,
			'tahun_sampai'	=> $organisasi->tahun_sampai,
            'jenis'         => $organisasi->jenis,
			'jabatan'		=> $organisasi->jabatan
        );
        $this->db->where('id', $organisasi->id);
        $this->db->update($this->table_def, $data);
    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table_def); 
    }
    
}

?>