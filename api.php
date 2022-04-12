<?php $endpoint = 'latest';
$access_key = '92c05c6deea28c99e532cfb424bd1c6b';

// Initialize CURL:
$ch = curl_init('http://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'&base=EUR&symbols=USD,RON');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);
// Decode JSON response:
$exchangeRates = json_decode($json, true);
echo '<pre>';
print_r($exchangeRates);
echo '</pre>';

// Access the exchange rate values, e.g. GBP:
//echo $exchangeRates['rates']['GBP'];


//&from=USD&to=EUR&amount=25