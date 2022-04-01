<?php

namespace App\Http\Controllers;

use App\Mail\MailClass;
use App\Mail\welcomeMessage;
use Illuminate\Http\Request;
use App\Rules\CheckWordsCount;
use Illuminate\Support\Facades\Mail;
use mysqli;

class FormsController extends Controller
{
    protected function getSum($FirstNumber, $SecondNumber)
    {
        return $FirstNumber + $SecondNumber;
    }
    public function formsHandle()
    {
        return view('forms.myFirstForm');
    }

    public function uploadImage(Request $imageInfo)
    {
        $orgFullName = $imageInfo->file('imageFile')->getClientOriginalName();
        $orgExten = $imageInfo->file('imageFile')->getClientOriginalExtension();
        $imageSize = $imageInfo->file('imageFile')->getSize();
        $newIamgeName = 'sdm_' . rand() . '_' . time() . '_' . rand() . '.' . $orgExten;
        $letters = range('aA', 'zZ');

        print_r($letters);
        foreach ($letters as $letter) {
            echo 'Letters: ' . $letter . '<br />';
        }
        echo 'My Letter Is: ' . $letters[rand(0, count($letters) - 1)] . '<br />';
        echo 'Image Name: ' . $orgFullName . ' Extention: ' . $orgExten . ' Image Size: ' . $imageSize;
        $imageInfo->file('imageFile')->move(public_path('iamges'), $newIamgeName);
        dd($imageInfo->all());
        //dd($imageInfo->all());
        //return 'Image Page';
    }

    public function formsHandleImage()
    {
        return view('Forms.iamge_form');
        $theSum = $this->getSum(2, 3);
        $this->getSum(3, 3);
    }

    public function form1Submit(Request $req)
    {
        // $nameValue = $req->input('txtName');
        // $ageValue = $req->input('txtAge');
        $nameValue = $req->txtName;
        $ageValue = $req->txtAge;
        $agreeValue = $req->input('rdoAgree', 'Disagree');
        $flag = $req->has('txtName');

        // echo 'Name Is: ' . $nameValue . ' Age Is: ' . $ageValue . ' Option: ' . $agreeValue;
        // dd($req->all());
        return view('Forms.form1_data', compact('nameValue', 'ageValue'));
    }

    public function mailform()
    {
        return view('forms.mailform');
    }


    public function formInfo_Submit(Request $req)
    {
        $req->validate(
            [
                'txtFullName' => 'required|min:3|max:40',
                'txtEmail' => 'required|email',
                'txtPassword' => 'required|min:6|confirmed',
                'txtBiography' => ['nullable', new CheckWordsCount(5)]
            ]
        );
        dd($req->all());
        // return view('forms.formInfo_Submit');
    }

    public function sendemail()
    {
        return view('forms.emailForm');
    }


    public function sendemail_submit(Request $req)
    {
        $req->validate(
            [
                'txtFullName' => 'required|min:3',
                'txtAge' => 'required|min:2',
                'fileImage' => 'required|image|mimes:png,jpg|max:2048'
            ]
        );
        $imageName = rand() . '_' . rand() . '_Image.' . $req->file('fileImage')->getClientOriginalExtension();
        $name = $req->txtFullName;
        $age = $req->txtAge;
        $myMessage = "Hello World!";
        $req->file('fileImage')->move(public_path('upload/images'), $imageName);
        Mail::to('sdm.hilles@gmail.com')->send(new MailClass($name, $age, $imageName, $myMessage));
    }

    public function testemail()
    {
        return new welcomeMessage();
    }
}
