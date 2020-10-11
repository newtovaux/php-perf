<?php

    test1(10);

    function test1($times)
    {

        $t = $times;
        $sum = 0;

        while ($t--)
        {

            // record start time
            $start = hrtime();

            $file = tempnam('/tmp', 'performance');

            $temp = fopen($file, 'w');

            fseek($temp, 0);

            for ($i = 0; $i < 1000000; $i++)
            {
                fwrite($temp, random_bytes (256));
                fflush($temp);
            }

            fclose($temp); 

            unlink($file);

            // record stop time
            $stop = hrtime();

            $taken = (floatval($stop[0]) + (($stop[1])/1000000000)) - (floatval($start[0]) + (($start[1])/1000000000));

            printf(
                "File: %s Seconds: %0.2f\n",
                $file, 
                $taken
            );

            $sum += $taken;

        }

        printf(
            "PHP %s Average: %0.2f\n",
            phpversion(),
            $sum / $times
        );

    }
