<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

trait AlertMessages{
    public function invalidMessage($param){
        if(!empty($param)){
            $message    =   "Invalid ".$param;
        }
        else{
            $message    =   "Invalid Data";
        }

        return $message;
    }

    public function pageAccessDenied(){
        $message    =   "Your access to this page is restricted. Please contact administrator.";
        return $message;
    }

    public function saveSuccessMessage($param){
        if(!empty($param)){
            $msg    =   ["success"=>$param." saved successfully."];
        }
        else{
            $msg    =   ["success"=>"Data saved successfully."];
        }

        return $msg;
    }
    public function saveFailMessage($param){
        if(!empty($param)){
            $msg    =   ["error"=>"Failed to save ".$param];
        }
        else{
            $msg    =   ["error"=>"Failed to save data."];
        }

        return $msg;
    }

    public function updateSuccessMessage($param){
        if(!empty($param)){
            $msg    =   ["success"=>$param." updated successfully."];
        }
        else{
            $msg    =   ["success"=>"Data updated successfully."];
        }

        return $msg;
    }

    public function ajaxUpdateSuccessMessage($param){
        if(!empty($param)){
            $msg    =   $param." updated successfully.";
        }
        else{
            $msg    =   "Data updated successfully.";
        }

        return $msg;
    }
    public function updateFailMessage($param){
        if(!empty($param)){
            $msg    =   ["error"=>"Failed to update ".$param];
        }
        else{
            $msg    =   ["error"=>"Failed to update data"];
        }

        return $msg;
    }
    public function ajaxUpdateFailMessage($param){
        if(!empty($param)){
            $msg    =   "Failed to update ".$param;
        }
        else{
            $msg    =   "Failed to update data";
        }

        return $msg;
    }

    public function ajaxDeleteSuccessMessage($param){
        if(!empty($param)){
            $msg    =   $param." deleted successfully.";
        }
        else{
            $msg    =   "Data deleted successfully.";
        }

        return $msg;
    }
    public function ajaxDeleteFailedMessage($param){
        if(!empty($param)){
            $msg    =   "Failed to update ".$param;
        }
        else{
            $msg    =   "Failed to update data";
        }

        return $msg;
    }

    public function selectMessage($param){
        if(!empty($param)){
            $msg    =   "Please select ".$param;
        }
        else{
            $msg    =   "Please select data";
        }

        return $msg;
    }

    public function insufficientData(){
        $msg = "Insufficient data. Please check.";
        return $msg;
    }

    public function deleteSuccessMessage($param){
        if(!empty($param)){
            $msg    =   $param." deleted successfully";
        }
        else{
            $msg    =   "Data deleted successfully.";
        }

        return $msg;
    }

    public function createdSuccessMessage($data){
        if(!empty($data)){
            $msg    =   ["success"=>$data." created successfully."];
        }
        else{
            $msg    =   ["success"=>"Data created successfully."];
        }

        return $data;

    }

    public function notMatchMessage($param){
        if(!empty($param)){
            $msg    =   $param." does not matches.";
        }
        else{
            $msg    =   "Data does not matches.";
        }

        return $msg;
    }

    public function markedSuccessfullyMessage($param){
        if(!empty($param)){
            $msg    =   ["success"=>$param." has been marked successfully."];
        }
        else{
            $msg    =   ["success"=>"Data has been marked successfully."];
        }

        return $msg;
    }
    public function somethingWrongErrorMessage(){
        $msg    =   ["error"=>"Something went wrong. Please try again."];
        return $msg;
    }

    public function clockInMessage(){
        $msg    =   ["warning"=>"You are already Clocked-Out. Please Clock-In."];
        return $msg;
    }
    public function clockOutMessage(){
        $msg    =   ["warning"=>"You are already Clocked-In. Please Clock-Out."];
        return $msg;
    }

    public function ajaxMarkedSuccessfullyMessage($param){
        if(!empty($param)){
            $msg    =   $param." has been marked successfully.";
        }
        else{
            $msg    =   "Data has been marked successfully.";
        }

        return $msg;
    }
    public function ajaxAlreadyClockedOutMessage(){
        $msg    =   "You are already Clocked-Out. Please Clock-In.";
        return $msg;
    }
    public function ajaxAlreadyClockInMessage(){
        $msg    =   "You are already Clocked-In. Please Clock-Out.";
        return $msg;
    }
    public function ajaxAlreadyClockOutMessage(){
        $msg    =   "You are already Clocked-Out. Please Clock-In.";
        return $msg;
    }
    public function ajaxBreakStartSuccessMessage(){
        $msg    =   "Break Time has been started.";
        return $msg;
    }
    public function ajaxBreakStopSuccessMessage(){
        $msg    =   "Break Time has been stopped.";
        return $msg;
    }
    public function ajaxBreakStartFailMessage(){
        $msg    =   "Failed to start Break Time.";
        return $msg;
    }
    public function ajaxBreakStopFailMessage(){
        $msg    =   "Failed to stop Break Time.";
        return $msg;
    }

}
