<?php

/**
 * get all prime no. upto $max_value function.
 *
 * @param interger $max_value
 *
 * @return array
 */
function findAllPrimeNumbers($max_value)
{
    $primes = array();
    $check = 0;
    for ($i = 2; $i < $max_value; ++$i) {
        for ($j = 2; $j < $i; ++$j) {
            if ($i % $j == 0) {
                $check = 1;
            }
        }
        if ($check == 0) {
            array_push($primes, $i);
        }
        $check = 0;
    }

    return $primes;
}

/**
 * Find nearest prime no. in array.
 *
 * @param array   $primes
 * @param Numeric $value
 *
 * @return Numeric $nearestValue
 */
function nearestValue($primes, $value)
{
    $nearestValue = $primes[0];
    foreach ($primes as $primeNo) {
        if ($value > $primeNo) {
            $nearestValue = $primeNo;
        }
    }

    return $nearestValue;
}

/**
 * get largetst consective prime no.
 */
function getConsectivePrimeNo(array $primes, $n)
{
    $sum = 0;
    $largestConsectiveNo = 0;

    foreach ($primes as $primeNo) {
        $sum += $primeNo;

        $nearestValue = nearestValue($primes, $sum);

        if (($sum < $n) && in_array($sum, $primes)) {
            $largestConsectiveNo = $sum;
        } elseif ($sum > $nearestValue && $sum < $n) {
            $diff = $sum - $nearestValue;
            $initialSum = 0;

            foreach ($primes as $prime) {
                $initialSum += $prime;

                if ($initialSum == $diff) {
                    $largestConsectiveNo = $nearestValue;
                }
            }
        }
    }

    return $largestConsectiveNo;
}

$max_value = readline('Enter a number: ');

if (!is_numeric($max_value)) {
    echo 'Invalid Number';
}

echo 'The longest sum of consective prime no. below '.$max_value.' :- ';
$primes = findAllPrimeNumbers($max_value);

echo getConsectivePrimeNo($primes, $max_value);
