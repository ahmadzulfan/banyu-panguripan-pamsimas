<?php 
    $months = array (1=>'JAN',2=>'FEB',3=>'MAR',4=>'APR',5=>'MEI',6=>'JUN',7=>'JUL',8=>'AGUS',9=>'SEP',10=>'OKT',11=>'NOV',12=>'DES');
?>

<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>PAMSIMAS - BANYU PANGURIPAN</title>  

    <style>
        body {
            font-size: 12px;
        }

        table,tr,td{
            border-color: #000;
        }
    </style>
</head>  

<body>
    <x-header style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:292pt;">
            <span style="font-size: large; font-weight:bold;">LEMBAR CATAT METER BULANAN</span><br>
            <span style="font-size: large; font-weight:bold;">PAMSIMAS - BANYU PANGURIPAN</span>
        </div>
        <div align=right style="font-size: large; font-weight:bold;">
            TAHUN 2024
        </div>
    </x-header>
    <table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 2.5rem; text-align:center;">  
        <thead>    
            <tr align=center>  
                <td width="2%">NO</td>  
                <td width="5%">NOPEL</td>  
                <td width="15%">NAMA</td>  
                <td width="15%">ALAMAT</td>
                <?php foreach ($months as $key => $month) : ?>
                    <td width="5%"><?= $month ?></td>
                <?php endforeach; ?>
            </tr>    
        </thead>    
        <tbody>    
            <tr>        
                <td>1</td>  
                <td>012</td>  
                <td>Resita</td>  
                <td>SembungJambu RT 09/02</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
                <td>85</td> 
            </tr>  
        </tbody>
    </table>  
</body>  

</html>