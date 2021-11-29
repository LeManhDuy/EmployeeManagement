<?php
include_once("E_Faculty.php");
class Model_Faculty
{
    public function getAllFalcuty()
    {
        $link = mysqli_connect("localhost", "root", "") or die("ko the ket noi");
        mysqli_select_db($link, "dulieu");
        $sql = "select * from phongban";
        $rs = mysqli_query($link, $sql);
        $i = 0;
        $faculty = array();
        if ($rs) {
            while ($row = mysqli_fetch_array($rs)) {
                $IDPB = $row['IDPB'];
                $Tenpb = $row['Tenpb'];
                $mota = $row['Mota'];
                array_push($faculty, new Entity_Faculty($IDPB, $Tenpb, $mota));
            }
        }
        return $faculty;
        mysqli_close($link);
    }
    public function getFacultyDetail($updateId)
    {
        $allFaculty = $this->getAllFalcuty();
        for ($i = 0; $i < sizeof($allFaculty); $i++) {
            if ($allFaculty[$i]->IDPB == $updateId)
                return $allFaculty[$i];
        }
    }
    public function Update_Faculty($IDPB, $Tenpb, $Mota)
    {
        try {
            $bienketnoi = mysqli_connect("localhost", "root", "") or die("ko the ket noi");
            $db_selected = mysqli_select_db($bienketnoi, "dulieu");
            $sql = "update phongban set Tenpb='$Tenpb',Mota='$Mota' where IDPB='$IDPB'";
            $rs = mysqli_query($bienketnoi, $sql);
            mysqli_close($bienketnoi);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
