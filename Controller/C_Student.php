<?php
include_once("../Model/M_Student.php");
include_once("../Model/M_Faculty.php");
class Ctrl_Student
{
    public function invoke()
    {
        ////////////Đây là Thêm sinh viên/////////////
        if (isset($_GET['mod9'])) {
            $modelFaculty = new Model_Faculty();
            $facultyList =  $modelFaculty->getAllFalcuty();
            include_once("../View/addStudent.html");
        } else if (isset($_GET['mod10'])) {
            $modelStudent = new Model_Student();
            $IDNV = $_POST["IDNV"];
            $Hoten = $_POST["Hoten"];
            $IDPB = $_POST["IDPB"];
            $Diachi = $_POST["Diachi"];
            $add = $modelStudent->Add_Student($IDNV, $Hoten, $IDPB, $Diachi);
            $viewStudent = new Model_Student();
            $studentList =  $viewStudent->getAllStudent();
            include_once("../View/StudentList.html");
        }
        ////////////Đây là Xoá  nhiều sinh viên/////////////
        elseif (isset($_GET['mod7'])) {
            $modelStudent = new Model_Student();
            $staffList = $modelStudent->getAllStudent();
            $modelFaculty = new Model_Faculty();
            $facultyList =  $modelFaculty->getAllFalcuty();
            include_once("../View/deleteMultiStudent.html");
        } elseif (isset($_POST['delete'])) {
            $modelStudent = new Model_Student();
            $listIDNV = $_REQUEST['list_id'];
            $modelStudent->DeleteMulti($listIDNV);

            $viewStudent = new Model_Student();
            $studentList =  $viewStudent->getAllStudent();
            include_once("../View/StudentList.html");
        }
        ////////////Đây là Xoá sinh viên/////////////
        elseif (isset($_GET['mod5'])) {
            $modelStudent = new Model_Student();
            $studentList =  $modelStudent->getAllStudent();
            include_once("../View/deleteStudent.html");
        } else if (isset($_GET['delID'])) {
            $modelStudent = new Model_Student();
            $modelStudent->Delete($_GET['delID']);

            $viewStudent = new Model_Student();
            $studentList =  $viewStudent->getAllStudent();
            include_once("../View/StudentList.html");
        }
        ////////////Đây là Cập nhật sinh viên/////////////
        elseif (isset($_GET['mod4'])) {
            $modelFaculty = new Model_Faculty();
            $facultyList =  $modelFaculty->getAllFalcuty();
            include_once("../View/updateFacultyList.html");
        } elseif (isset($_GET['updateId'])) {
            $modelFaculty = new Model_Faculty();
            $faculty =  $modelFaculty->getFacultyDetail($_GET['updateId']);
            include_once("../View/updateFacultyForm.html");
        } else if (isset($_GET['mod6'])) {
            $modelFaculty = new Model_Faculty();
            $IDPB = $_POST["IDPB"];
            $Tenpb = $_POST["Tenpb"];
            $Mota = $_POST["Mota"];
            $update = $modelFaculty->Update_Faculty($IDPB, $Tenpb, $Mota);

            $modelFaculty = new Model_Faculty();
            $facultyList =  $modelFaculty->getAllFalcuty();
            include_once("../View/updateFacultyList.html");
        }
        ////////////Day la tim kiem/////////////
        elseif (isset($_GET['mod3'])) {
            include_once("../View/timKiem.html");
        } else if (isset($_GET['mod8'])) {
            $modelStudent = new Model_Student();
            $key = $_REQUEST['search'];
            $infotype = $_REQUEST['infoType'];
            $studentList = $modelStudent->Find($key, $infotype);
            include_once("../View/timKiemList.html");
        }
        ////////////Xem thong tin phong ban/////////////
        elseif (isset($_GET['mod2'])) {
            $modelFaculty = new Model_Faculty();
            $facultyList =  $modelFaculty->getAllFalcuty();
            include_once("../View/FacultyList.html");
        }
        ////////////Xem thong tin nhan vien/////////////
        elseif (isset($_GET['stid'])) {
            $modelStudent = new Model_Student();
            $studentList =  $modelStudent->getStudentDetail($_GET['stid']);
            include_once("../View/StudentList.html");
        } elseif (isset($_GET['mod1'])) {
            $modelStudent = new Model_Student();
            $studentList =  $modelStudent->getAllStudent();
            include_once("../View/StudentList.html");
        }

        ////////////Chuc nang dang nhap/////////////
        else {
            $username = $_REQUEST['txtUserName'];
            $password = $_REQUEST['txtPassWord'];
            if ($_REQUEST['btnDangNhapVangLai'] == 1) {
                header("Location:../View/pageUser.html");
            } else if ($username == "" || $password == "") {
                header("Location:../View/login.html");
            } else {
                $modelStudent = new Model_Student();
                $bool = $modelStudent->checkLogin($username, $password);
                if ($bool) {
                    header("Location:../View/pageAdmin.html");
                } else {
                    header("Location:../View/login.html");
                }
            }
        }
    }
};
$C_Student = new Ctrl_Student();
$C_Student->invoke();
