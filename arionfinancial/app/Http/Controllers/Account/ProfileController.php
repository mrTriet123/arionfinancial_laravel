<?php

namespace App\Http\Controllers\Account;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Architecture\Enum\Role\RoleEnum;
use App\Http\Requests\UserManagement\Account\Profile\ProfileRequest;
use App\Models\User\UserModel as Users;
use Session;
use Hash;
use DB;

class ProfileController extends Controller
{
    
    public function __construct() {
      $ID = Session::get('UserID');
      $data = DB::table('tbluser')->where('UserID', $ID)->first();
      View::share('User', $data);
    }
    
    public function ViewProfile() {
        $ID = Session::get('UserID');
        $data = DB::table('tbluser')->where('UserID', $ID)->first();
        return View("Account.Profile", ['User' => $data]);
    }
    
    public function postlogin()
    {
      if(isset($_POST['EmailAddress']))
       {
          $username = $_POST['EmailAddress'];
          $pass = $_POST['Password'];
          $results = Users::where('EmailAddress','=',$username)->first();
          if($results)
          {
          $HashPaswword = $results->Password;
          if (Hash::check($pass, $HashPaswword))
             {
                  if($status = Users::where('EmailAddress','=',$username)->where('IsActive','=',1)->first())
                  {
                    if($status)
                    { 
                      Session::Set('RoleID',$results->RoleID);   
                      Session::Set('adminController', '1');
                      Session::Set('UserID',$results->UserID);
                      Session::Set('UserName',$results->UserName);
                      Session::Set('profile',$results->Profile);
                      Session::Set('Name',$results->FirstName);
                      Session::Set('UserEmail',$results->EmailAddress);
                      if(session::get('RoleID') == '3'){
                        return Redirect('view-accounts');
                      }else{
                        return Redirect('Profile');
                      }
                          
                    }
                    else
                    {
                         return Redirect('login')->with('errors' , 'Account not Activated, <a href = "'.url('resend/').'/'.$username.'" style = "color:black; text-decoration:none;"> <strong>Click Here</strong> </a> to Resend Activation Link');
                    }
                }
                else
                {
                     return Redirect('login')->with('errors' , 'Account not Activated, <a href = "'.url('resend/').'/'.$username.'" style = "color:black; text-decoration:none;"> <strong>Click Here</strong> </a> to Resend Activation Link');
                }
                 
             }
            else
            {
               return Redirect('login')->with('errors' , 'Invalid Password');   
            }
          }
          else
          {
              return Redirect('login')->with('errors' , 'Invalid Username');    
          } 
      }
      else
      {
         return Redirect('login');
      }
    }

    public function UpdateProfile(ProfileRequest $request) {

        $user = \App\Models\User\UserModel::where("UserID", Session::get('UserID'))->first();
        $count = 1;
        if(isset($request['profile']))
        {
          if($_FILES['profile']['type'] == "image/jpeg" || $_FILES['profile']['type'] == "image/jpg" || $_FILES['profile']['type'] == "image/gif" || $_FILES['profile']['type'] == "image/png"){
            if($_FILES['profile']['size'] > 6500){
              $getFile = $request->file('profile');
              $name = $getFile->getClientOriginalName();
              $profile = str_random(5)."_".$name;
              while (file_exists("public/upload/".$profile))
              {
                  $profile = str_random(5)."_".$name;
              }
              $small_profile = "small_".$profile;
              $normal_profile = "normal_".$profile;
              $file_upload = [$profile,$small_profile,$normal_profile];
              $getFile->move("public/upload/",$profile);
              $file = "public/upload/" . $profile; //This is the original file

              $imagepath = $small_profile;
              $save = "public/upload/" . $imagepath; //This is the new file you saving
              
              list($width, $height) = getimagesize($file) ;

              $modwidth = 50;

              $diff = $width / $modwidth;

              $modheight = $height / $diff;
              $tn = imagecreatetruecolor($modwidth, $modheight) ;

              switch($_FILES['profile']['type']){
                case "image/jpeg" :
                  $image = imagecreatefromjpeg($file) ;
                  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                  imagejpeg($tn, $save, 100) ;
                  break;
                case "image/png" :
                  $image = imagecreatefrompng($file) ;
                  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                  imagejpeg($tn, $save, 100) ;
                  break;
                case "image/gif" :
                  $image = imagecreatefromgif($file) ;
                  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                  imagejpeg($tn, $save, 100) ;
                  break;
              }
              
              $imagepath = $normal_profile;
              $save = "public/upload/" . $imagepath; //This is the new file you saving
              
              list($width, $height) = getimagesize($file) ;

              $modwidth = 90;

              $diff = $width / $modwidth;

              $modheight = $height / $diff;
              $tn = imagecreatetruecolor($modwidth, $modheight) ;

              switch($_FILES['profile']['type']){
                case "image/jpeg" :
                  $image = imagecreatefromjpeg($file) ;
                  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                  imagejpeg($tn, $save, 100) ;
                  break;
                case "image/png" :
                  $image = imagecreatefrompng($file) ;
                  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                  imagejpeg($tn, $save, 100) ;
                  break;
                case "image/gif" :
                  $image = imagecreatefromgif($file) ;
                  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                  imagejpeg($tn, $save, 100) ;
                  break;
              }
              
              $user->Profile = $profile;
            }else{
              return Redirect('Profile')->with('errors' , 'File size must be greater than!');
            }
          }else{
            return Redirect('Profile')->with('errors' , 'Invalid file type!');
          }
        }
        if($user != null) {
            // $user->Profile = 'user.png';
            $user->UserName     = $request["UserName"];
            $user->EmailAddress = $request["EmailAddress"];
            $user->FirstName    = $request["FirstName"];
            $user->LastName     = $request["LastName"];
            $user->Address      = $request["Address"];
            $user->City         = $request["City"];
            $user->account      = $request["account"];
            $user->State        = $request["State"];
            $user->Zip          = $request["Zip"];
            $user->Fax          = $request["Fax"];
            $user->Phone        = $request["Phone"];
            $user->CompanyName  = $request["CompanyName"];
            if($request["Password"] != null) {
                $user->Password = $request["Password"];
            }
            $user->save();
            return redirect()->route("ViewProfile");
        }
    }
 
}

