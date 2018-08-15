<table class="table table-bordered table-striped table-responsive">
    <tbody>
        <tr>
<?php 
$column = 0;
$maxColumn = 3;
foreach ($array as $key=>$value) {
    if(!empty($value)) {
        $column++;
?>
    <th>
        <?php echo $key ?>
    </th>
    <td>
        <?php
        if($key == 'Page Link'){
            echo "<a href='$value'>Page Link</a>";
        }
        else{
            echo $value;
        }
        ?>
    </td>
<?php
        if($column>=$maxColumn) { ?>
             </tr><tr>
<?php
            $column = 0;
        }
    }
}
if($column > 0 && $column<=$maxColumn) {
    for($i=$maxColumn-$column;$i>0;$i--) { ?>
                 <th>&nbsp;</th>
                 <td>&nbsp;</td>
<?php
    } 
}
?>
        </tr>
    </tbody>
</table>

