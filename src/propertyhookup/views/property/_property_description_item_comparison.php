<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th style="width: 20%">Info</th>
            <th style="width: 40%">History</th>
            <th style="width: 40%" >Actual</th>
        </tr>
    </thead>
    <tbody>

    <?php
    SiteHelper::buildRows($array1, $array2);
    ?>

    </tbody>
</table>

