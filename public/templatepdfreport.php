<page style="font-family: freeserif" backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">

<style type="text/css">
<!--
table
{
    width:  100%;
    border: solid 1px #5544DD;
}

th
{
    text-align: center;
    border: solid 1px #113300;
    background: #EEFFEE;
}

td
{
    text-align: left;
    border: solid 1px #55DD44;
}

td.col1
{
    border: solid 1px red;
    text-align: right;
}

-->
</style>
<span style="font-size: 20px; font-weight: bold">
<span style="font-size: 20px; font-weight: bold"><img height="130px;" src="image001.png" alt="Logo"></span><br>
<?php echo $data[0]['0']; ?></span> (From 1/2/2015 - 1/3/2015) 
<br><br>
<br>
<table>
    <col style="width: 5%" class="col1">
    <col style="width: 25%">
    <col style="width: 30%">
    <col style="width: 40%">
    <thead>
         
        <tr>
             
            <th>Colonne 1</th>
            <th>Colonne 2</th>
            <th>Colonne 3</th>
        </tr>
    </thead>
<?php
    $count_element = count($data[2]);
    for ($k=1; $k < $count_element ; $k++) {
        $row = $data[2][$k];
        print_r($row);
?>
    <tr>
         
        <td><?php echo $row[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[2]; ?></td>
    </tr>
<?php
    }
?>
    <tfoot>
        <tr>
            <th colspan="4" style="font-size: 16px;">
                Tổng cộng
            </th>
        </tr>
    </tfoot>
</table>
=========================================<br>
<table>
    <col style="width: 5%" class="col1">
    <col style="width: 25%">
    <col style="width: 30%">
    <col style="width: 40%">
    <thead>
        <tr>
            <th rowspan="2">n°</th>
            <th colspan="3" style="font-size: 16px;">
                Titre du tableau
            </th>
        </tr>
        <tr>
            <th>Colonne 1</th>
            <th>Colonne 2</th>
            <th>Colonne 3</th>
        </tr>
    </thead>
<?php
    for ($k=0; $k<6; $k++) {
?>
    <tr>
        <td><?php echo $k; ?></td>
        <td>test de texte assez long pour engendrer des retours à la ligne automatique...</td>
        <td>test de texte assez long pour engendrer des retours à la ligne automatique...</td>
        <td>test de texte assez long pour engendrer des retours à la ligne automatique...</td>
    </tr>
<?php
    }
?>
    <tfoot>
        <tr>
            <th colspan="4" style="font-size: 16px;">
                bas du tableau
            </th>
        </tr>
    </tfoot>
</table>
</page>