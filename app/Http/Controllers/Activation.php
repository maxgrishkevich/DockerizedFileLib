<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FileUpload;

class Activation extends FileUpload
{
    //DBCDEBCCD8DE
    private $key = "key";
    private $khex = array ('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
    private $kdec = array (0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);

    function getTable()
    {
        $t0 = array ('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
        $t1 = array ('1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','0');
        $t2 = array ('2','3','4','5','6','7','8','9','A','B','C','D','E','F','0','1');
        $t3 = array ('3','4','5','6','7','8','9','A','B','C','D','E','F','0','1','2');
        $t4 = array ('4','5','6','7','8','9','A','B','C','D','E','F','0','1','2','3');
        $t5 = array ('5','6','7','8','9','A','B','C','D','E','F','0','1','2','3','4');
        $t6 = array ('6','7','8','9','A','B','C','D','E','F','0','1','2','3','4','5');
        $t7 = array ('7','8','9','A','B','C','D','E','F','0','1','2','3','4','5','6');
        $t8 = array ('8','9','A','B','C','D','E','F','0','1','2','3','4','5','6','7');
        $t9 = array ('9','A','B','C','D','E','F','0','1','2','3','4','5','6','7','8');
        $tA = array ('A','B','C','D','E','F','0','1','2','3','4','5','6','7','8','9');
        $tB = array ('B','C','D','E','F','0','1','2','3','4','5','6','7','8','9','A');
        $tC = array ('C','D','E','F','0','1','2','3','4','5','6','7','8','9','A','B');
        $tD = array ('D','E','F','0','1','2','3','4','5','6','7','8','9','A','B','C');
        $tE = array ('E','F','0','1','2','3','4','5','6','7','8','9','A','B','C','D');
        $tF = array ('F','0','1','2','3','4','5','6','7','8','9','A','B','C','D','E');

        return array ('0' => $t0, '1' => $t1, '2' => $t2, '3' => $t3, '4' => $t4, '5' => $t5,
            '6' => $t6, '7' => $t7, '8' => $t8, '9' => $t9, 'A' => $tA, 'B' => $tB,
            'C' => $tC, 'D' => $tD, 'E' => $tE, 'F' => $tF);
    }

    function crypt($text): string
    {
        $text = strtoupper(bin2hex($text));
        $key = strtoupper(bin2hex($this->key));
        $kdec = $this->kdec;
        $khex = $this->khex;
        $table = $this->getTable();

        $keylen = strlen($key);
        $y = -1;
        $result='';

        for ($x = 0, $xMax = strlen($text); $x < $xMax; $x++) {
            $y++;
            if ($y < $keylen) $ksimb = $key[$y]; else {
                $y = 0;
                $ksimb = $key[0];
            }

            $simb = $text[$x];
    //        print $simb;
            $ksimb = $kdec[array_search($ksimb, $khex, true)];
            $result .= $table[$simb][$ksimb];
        }
        return $result;
    }

    function decrypt($enc_text)
    {
        $dresult='';
        $y = -1;
        $key = strtoupper(bin2hex($this->key));
        $table = $this->getTable();
        $keylen = strlen($key);

        for ($x = 0, $xMax = strlen($enc_text); $x < $xMax; $x += 2) {

            $tmp = substr($enc_text, $x, 2);
            $simb1 = substr($enc_text, $x, 1);
            $simb2 = substr($enc_text, $x+1, 1);

            $y++;
            if ($y < $keylen) $ksimb = $key[$y]; else {
                $y = 0;
                $ksimb = $key[0];
            }

            $ssimb1 = array_search($simb1, $table[$ksimb], true);

            $y++;
            if ($y < $keylen) $ksimb = $key[$y]; else {
                $y = 0;
                $ksimb = $key[0];
            }

            $ssimb2 = array_search($simb2, $table[$ksimb], true);

            $dresult .= chr($ssimb1 * 16 + $ssimb2);
        }
        return $dresult;
    }

    function checkActivation()
    {
        if ($this->decrypt($_POST['key']) === 'phrase'){
            return back()
                ->with('success','WebApp is activated');
        }
        return back()->with('fail', 'Wrong code');
    }

    function createForm()
    {
        return view('activation');
    }
}
