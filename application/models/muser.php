<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muser extends CI_Model
{

	/* Contructor */
	public function __construct()
    {
        parent::__construct();
    }

	public function verifyUser($u,$pw,$iddb)
	{
        $data = array();
        $Q = $this->db->query('SELECT * FROM tblusers WHERE loginname = "'.$u.'" limit 1');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}

        $Qdb = $this->db->query('SELECT * FROM tblassigndb WHERE idusers = "'.$row['idusers'] .'" AND iddb = "'.$iddb.'" AND status = "signed" '  );
        
        if($Qdb->num_rows < 1) {
            $this->session->set_flashdata('error', 'Maaf, Anda tidak punya akses terhadap database yang Anda pilih!');
            redirect('maincontroller/index','refresh');
        }
        else {
            /* check if array is empty */
            $verify = array_filter($data);
            if (!empty($verify))
            {
                $hashedPassword = $data[0]['password'];
                if (crypt($pw,$hashedPassword ) == $hashedPassword)
                {
                    //echo "Password verified!";
                    $_SESSION['logon'] = 'logged';
                    $_SESSION['iduserlogged'] = $row['idusers'];
                    $_SESSION['dbuserlogged'] = $iddb;
                    $_SESSION['userlevel'] = $row['level'];
										$_SESSION['usernamelog'] = $row['name'];
										$_SESSION['accesssetup'] = 'signed';

					$Qx = $this->db->query('SELECT * FROM tblassigndb WHERE idusers = "'.$_SESSION['iduserlogged'].'" limit 1');
					 
					//if($Qx->num_rows() > 0){foreach($Qx->result_array() as $rowsx){
						//$data[] = $rows;
						// ini masih salah.... data $rows['accesssetup'] tidak terbaca, padahal di database udah dibuat signed
						//$_SESSION['accesssetup'] = $rowsx['accesssetup'];
					///}}
					
					
					
                    /* set aktif pada database yang dipilih */
                    //~ set nonaktif terlebih dahulu
                    $Qnonaktif = $this->db->query('UPDATE tblassigndb SET active = 0 WHERE idusers = '.$row['idusers'].' AND iddb = '.$iddb); 
                    //~ set aktif jika telah login
                    $Qaktif = $this->db->query('UPDATE tblassigndb SET active = 1 WHERE idusers = '.$row['idusers'].' AND iddb = '.$iddb); 
                }
                else
                {
                    //echo "Not verified!";
                    $this->session->set_flashdata('error', 'Maaf, username atau password Anda salah!');
                    redirect('maincontroller/index','refresh');
                }
            }
            else
            {
               // echo "empty";
                $this->session->set_flashdata('error', 'Maaf, username atau password Anda salah!');
                redirect('maincontroller/index','refresh');
            }    
        }
    }
	
	public function companyprofile()
	{
		$data = array(
			'idcompany' => rand(111111,999999),
			'namecompany' => htmlentities(mysql_real_escape_string($this->input->post('companyname')), ENT_QUOTES),
			'addresscompany' => htmlentities(mysql_real_escape_string($this->input->post('companyaddress')), ENT_QUOTES),
			'telpcompany' => htmlentities(mysql_real_escape_string($this->input->post('companytelp')), ENT_QUOTES),
			'faxcompany' => htmlentities(mysql_real_escape_string($this->input->post('companyfax')), ENT_QUOTES),
			'emailcompany' => htmlentities(mysql_real_escape_string($this->input->post('companyemail')), ENT_QUOTES),
			'homepagecompany' => htmlentities(mysql_real_escape_string($this->input->post('companyhomepage')), ENT_QUOTES)
		);
		
		$Q = $this->db->get('tblprofile');
        if($Q->num_rows() > 0){
			//$this->db->where('idmeasure',$idmeasure);
			$dataU = array(
				'namecompany' => htmlentities(mysql_real_escape_string($this->input->post('companyname')), ENT_QUOTES),
				'addresscompany' => htmlentities(mysql_real_escape_string($this->input->post('companyaddress')), ENT_QUOTES),
				'telpcompany' => htmlentities(mysql_real_escape_string($this->input->post('companytelp')), ENT_QUOTES),
				'faxcompany' => htmlentities(mysql_real_escape_string($this->input->post('companyfax')), ENT_QUOTES),
				'emailcompany' => htmlentities(mysql_real_escape_string($this->input->post('companyemail')), ENT_QUOTES),
				'homepagecompany' => htmlentities(mysql_real_escape_string($this->input->post('companyhomepage')), ENT_QUOTES)
			);
			$this->db->update('tblprofile', $dataU);
		}
		else
		{
			$this->db->insert( 'tblprofile', $data );
		}
		
		redirect( 'maincontroller/profile' , 'refresh' );
	}
	
	public function getprofile()
	{
		$data = array();
        $Q = $this->db->get('tblprofile');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getAllUser()
	{
		$data = array();
		//$this->db->where('level', "!='admin'");
        //$Q = $this->db->get('tblusers');
		$Q = $this->db->query('SELECT * FROM tblusers WHERE level <> "admin"');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getUserNotSelected( $iddb , $idmeasure )
	{
		$Q = $this->db->query('SELECT tblusers.`idusers`, tblusers.`name` FROM tblusers WHERE tblusers.`idusers` NOT IN ( SELECT tblsecuritymeasure.`idusers` FROM tblsecuritymeasure WHERE tblsecuritymeasure.`iddb` = "'.$iddb.'" AND tblsecuritymeasure.`idmeasure` = "'.$idmeasure.'" ) AND tblusers.`level` <> "admin" ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
}


