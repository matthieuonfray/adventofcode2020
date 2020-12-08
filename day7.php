<?php

 function countBag( $bag,  $cargo)
    {
        if (count($cargo[$bag])===0)
        {
            return 0;
        }

        $value = 0;
        foreach($cargo[$bag] as $newBag => $number) {
            $value+= $number + ($number*(countBag($newBag, $cargo)));
        }
        return $value;

    }



   function day7part2(OutputInterface $output=null)
    {
$lines = file('input7',FILE_IGNORE_NEW_LINES);

        $value = 0;
        $cargo = [];

        foreach($lines as $line)
        {
            preg_match('/(\w+\s\w+)\sbags\scontain\s(.*)/', $line, $bag);
            preg_match_all('/((?P<number>\d+)\s(?P<bag>\w+\s\w+))\sbag/', $bag[2], $bags);
            $cargo[$bag[1]] = array_combine($bags['bag'], $bags['number']);
        }

        foreach ($cargo['shiny gold'] as $bag => $number)
        {
            $value+= $number + ($number*(countBag($bag, $cargo)));
        }

        echo $value;
    }



function day7part1(OutputInterface $output=null)
    {
        $lines = file('input7',FILE_IGNORE_NEW_LINES);


        preg_match_all('/([a-z]+\s[a-z]+)\sbags\scontain\s.+(shiny\sgold+)\sbags/m', implode("\n", $lines), $matches);

        $goodBags = $matches[1];
        $value = 0;

        foreach($lines as $line)
        {
            preg_match('/([a-z]+\s[a-z]+)\sbags\scontain\s(.*)/', $line, $bag);
            preg_match_all('/([a-z]+\s[a-z]+)\sbag/', $bag[2], $bags);
            $cargo[$bag[1]] = $bags[1];
        }

        foreach ($cargo as $bag => $bags)
        {
            if (in_array($bag, $goodBags, true))
            {
                $value++;
            } else {
                $value = validBag($bag, $cargo, $goodBags) ? $value+1 : $value;
            }
        }
echo $value;
        //$output->writeln($value);
        //return $value> 0 ? Command::SUCCESS: Command::FAILURE;
    }

    /**
     * @param string $bag
     * @param array  $cargo
     * @param array  $goodBags
     *
     * @return bool
     */
     function validBag($bag, $cargo, $goodBags)
    {
        if (in_array($bag, $goodBags, true)) {
            return true;
        }

        if (isset($cargo[$bag])) {
            foreach($cargo[$bag] as $newBag) {
                if(validBag($newBag, $cargo, $goodBags))
                {
                    return true;
                }
            }
        }

        return false;
    }
day7part2();

?>