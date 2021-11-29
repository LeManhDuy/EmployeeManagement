<?php
include_once("E_Student.php");
class Model_Student
{
    public function __construct()
    {
    }
    public function checkLogin($username, $password)
    {
        try {
            $bienketnoi = mysqli_connect("localhost", "root", "") or die("ko the ket noi");
            $db_selected = mysqli_select_db($bienketnoi, "dulieu");
            $rs = mysqli_query($bienketnoi, "select * from admin where username='$username' and password='$password'");
            if (mysqli_num_rows($rs) > 0) {
                return true;
            } else {
                return false;
            }
            mysqli_close($bienketnoi);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function getAllStudent()
    {
        $link = mysqli_connect("localhost", "root", "") or die("ko the ket noi");
        mysqli_select_db($link, "dulieu");
        $sql = "select nhanvien.IDNV, nhanvien.Hoten, phongban.Tenpb, nhanvien.Diachi, phongban.IDPB 
        from nhanvien INNER JOIN phongban ON nhanvien.IDPB=phongban.IDPB";
        $rs = mysqli_query($link, $sql);
        $i = 0;
        $students = array();
        if ($rs) {
            while ($row = mysqli_fetch_array($rs)) {
                $IDNV = $row['IDNV'];
                $Hoten = $row['Hoten'];
                $Tenpb = $row['Tenpb'];
                $Diachi = $row['Diachi'];
                array_push($students, new Entity_Student($IDNV, $Hoten, $Tenpb, $Diachi));
            }
        }
        return $students;
        mysqli_close($link);
    }
    public function getStudentDetail($stid)
    {
        $link = mysqli_connect("localhost", "root", "") or die("ko the ket noi");
        mysqli_select_db($link, "dulieu");
        // $sql = "select * from nhanvien WHERE IDPB = '$stid'";
        $sql = "select nhanvien.IDNV, nhanvien.Hoten, phongban.Tenpb, nhanvien.Diachi 
        from nhanvien INNER JOIN phongban ON nhanvien.IDPB=phongban.IDPB 
        where phongban.IDPB = '$stid'";
        $rs = mysqli_query($link, $sql);
        $i = 0;
        $students = array();
        if ($rs) {
            while ($row = mysqli_fetch_array($rs)) {
                $IDNV = $row['IDNV'];
                $Hoten = $row['Hoten'];
                $Tenpb = $row['Tenpb'];
                $Diachi = $row['Diachi'];
                array_push($students, new Entity_Student($IDNV, $Hoten, $Tenpb, $Diachi));
            }
        }
        return $students;
        mysqli_close($link);
    }
    public function Find($key, $infotype)
    {
        try {
            $link = mysqli_connect("localhost", "root", "") or die("Couldn't connect to mysql");
            mysqli_select_db($link, "dulieu");
            // $sql = "SELECT * FROM nhanvien WHERE " . "$infotype" . " LIKE  '%$key%' ";
            if ($infotype == "Tenpb") {
                $sql = "SELECT * FROM nhanvien INNER JOIN phongban ON nhanvien.IDPB=phongban.IDPB WHERE Tenpb LIKE '%$key%'";
            } else {
                $sql = "SELECT * FROM nhanvien WHERE " . "$infotype" . " LIKE  '%$key%' ";
            }
            $result = mysqli_query($link, $sql);
            $i = 0;
            $students = array();
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $IDNV = $row['IDNV'];
                    $Hoten = $row['Hoten'];
                    $IDPB = $row['IDPB'];
                    $Diachi = $row['Diachi'];
                    array_push($students, new Entity_Student($IDNV, $Hoten, $IDPB, $Diachi));
                }
            }
            return $students;
            mysqli_close($link);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function Delete($value)
    {
        try {
            $link = mysqli_connect("localhost", "root", "") or die("ko the ket noi");
            mysqli_select_db($link, "dulieu");
            $sql = "delete from nhanvien where IDNV='$value'";
            $rs = mysqli_query($link, $sql);
            mysqli_close($link);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function DeleteMulti($listIDNV)
    {
        try {
            $bienketnoi = mysqli_connect("localhost", "root", "") or die("ko the ket noi");
            mysqli_select_db($bienketnoi, "dulieu");
            foreach ($listIDNV as $IDNV) {
                $sql = "Delete from nhanvien where IDNV='$IDNV'";
                mysqli_query($bienketnoi, $sql);
            }
            mysqli_close($bienketnoi);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function Add_Student($IDNV, $Hoten, $IDPB, $Diachi)
    {
        try {
            $bienketnoi = mysqli_connect("localhost", "root", "") or die("ko the ket noi");
            $db_selected = mysqli_select_db($bienketnoi, "dulieu");
            $rs = mysqli_query($bienketnoi, "insert into nhanvien(IDNV,Hoten,IDPB,Diachi) VALUES ('$IDNV','$Hoten','$IDPB','$Diachi')");
            mysqli_close($bienketnoi);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
