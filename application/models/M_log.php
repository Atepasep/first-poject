<?php
	class M_log extends CI_Model{
		function isidata($a,$b,$c){
			$query = "Insert into logactivity2 values('$a',now(),'$b','$c')";
			$this->db->query($query);
		}
	}
?>