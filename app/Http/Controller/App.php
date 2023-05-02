<?php
namespace App\Http\Controller;

use System\View;
use System\File;
use RegexIterator;

class App
{
    public static function index ()
    {
        $files = new \FilesystemIterator(BASEPATH . 'transactions');
        $files = new RegexIterator($files, '/.*(\.csv)/');

        $items = [];
        foreach($files as $file) {
            $file = new File($file, 'r');
            $file->fgetcsv();
            while(!$file->eof()) {
                $items[] = $file->fgetcsv();
            }
        }

        $total_income = array_reduce($items, function ($itn, $item){
            $val = 0.00;
            if(!str_starts_with($item[3], '-')) {
                $val = str_replace(',', '', $item[3]);
                $val = (float) substr($val, 1);
            };
            return $itn + $val;
        }, 0.00);

        $total_expense = array_reduce($items, function ($itn, $item){
            $val = 0.00;
            if(str_starts_with($item[3], '-')) {
                $val = str_replace(',', '', $item[3]);
                $val = (float) substr($val, 2);
            };
            return $itn + $val;
        }, 0.00);

        $net_total = $total_income - $total_expense;

        $subhtml = '';
        foreach ($items as $item) {
            $neg = (str_starts_with($item[3], '-')) ? 'negative' : 'positive';
            $subhtml .= <<<"EOF"
            <tr>
                <td>$item[0]</td>
                <td>$item[1]</td>
                <td>$item[2]</td>
                <td class="$neg" >$item[3]</td>
            </tr>
            EOF;
        }
        
        echo View::send('index', ['data' => $subhtml, 'total_income' => $total_income, 'total_expense' => $total_expense, 'net_total' => $net_total]);


    }

    public static function view() {
        echo "Welcome to test!";
    }
}