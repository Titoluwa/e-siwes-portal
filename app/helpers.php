<?php
function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}
function saveImagePath($image)
{

}
function numberToWords($number) 
{
    if ($number == null) {
        return '-';
    }else{

        $ones = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen'
        );

        $tens = array(
            0 => 'Zero',
            1 => 'Ten',
            2 => 'Twenty',
            3 => 'Thirty',
            4 => 'Forty',
            5 => 'Fifty',
            6 => 'Sixty',
            7 => 'Seventy',
            8 => 'Eighty',
            9 => 'Ninety'
        );
        
        if ($number < 20) {
            return $ones[$number];
        } elseif ($number < 100) {
            return $tens[floor($number / 10)] . (($number % 10 > 0) ? ' ' . $ones[$number % 10] : '');
        } elseif ($number < 1000) {
            return $ones[floor($number / 100)] . ' Hundred' . (($number % 100 > 0) ? ' and ' . numberToWords($number % 100) : '');
        } elseif ($number < 1000000) {
            return numberToWords(floor($number / 1000)) . ' Thousand' . (($number % 1000 > 0) ? ' ' . numberToWords($number % 1000) : '');
        } elseif ($number < 1000000000) {
            return numberToWords(floor($number / 1000000)) . ' Million' . (($number % 1000000 > 0) ? ' ' . numberToWords($number % 1000000) : '');
        } else {
            return 'Number out of range';
        }
    }
}