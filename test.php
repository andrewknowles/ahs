<?php
$filein     = fopen("c:/tmp/test.txt", "r");
$fileout     = fopen("c:/tmp/out.txt", "w");
$lastline = '';
$line     = fgets($filein);

	do
  {
    

        
        
        switch (substr($line, 0, 1))
        {
            case 1:
                $outline = substr($line, 0, 1) . '|' . substr($line, 1, 3) . '|' . trim(substr($line, 4, 7)) . '|' . trim(substr($line, 11, 12));
                break;
            case 2:
                $outline2 = '|' . trim(substr($line, 1, 6)) . '|' . trim(substr($line, 7, 6));
                $outflag2 = 1;
                break;
            case 3:
                $outline3 = '|' . substr($line, 1, 3) . '|' . trim(substr($line, 4, 7)) . '|' . trim(substr($line, 11, 14));
                $outflag3 = 1;
                break;
        }

    
//store current line type    
    $lastlinetype = substr($line, 0, 1);
//read next line in file
    $line     = fgets($filein);
    $nextlinetype = substr($line, 0, 1);
    
//if the next line in the file is type 1 output the data to file    
    if ($nextlinetype == 1 || feof($filein))
      {
        if ($outflag2 == 0)
          {
            $outline2 = '||';
          }
        
        if ($outflag3 == 0)
          {
            $outline3 = '||';
          }
        $outlinet = $outline . $outline2 . $outline3;
        echo $outlinet . '</BR>';
        $outlinet = $outlinet."\r\n";
        fwrite($fileout, $outlinet);

		$outline = '';
        $outline2 = '';
        $outline3 = '';
        $outflag2 = 0;
        $outflag3 = 0;
      }      

  } while (!feof($filein));
  
fclose($filein);
fclose($fileout);

?>