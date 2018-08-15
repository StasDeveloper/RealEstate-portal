<?php
(isset($result['totalCount']))? $totalCount = $result['totalCount'] : $totalCount = 0 ;
(isset($result['pagesCount']))? $pagesCount = $result['pagesCount'] : $pagesCount = 0 ;
(isset($result['currentPage']))? $currentPage = $result['currentPage'] : $currentPage = 1;
(isset($result['limit']))? $limit = $result['limit'] : $limit = 10;

if(is_array($previewsSearchParams))
    extract($previewsSearchParams, EXTR_PREFIX_ALL, 'prev');
else
    $prev_id = $prev_name = $prev_membershipType = $prev_expireDateFrom = $prev_expireDateTo = '';
?>
<form method="post" class="smart-form" action="<?php echo $this->createUrl('searchMembership') ?>">
<!--    <fieldset>-->
        <div class="row">
            <section class="col col-md-1 col-sm-12">
                <label class="input">
                    User ID
                    <input type="text" name="id" value="<?php echo $prev_id ?>"  placeholder="User ID">
                </label>
            </section>

            <section class="col col-md-2 col-sm-12">
                <label class="input">
                    User Email
                    <input type="text" name="name" value="<?php echo $prev_name ?>" placeholder="User Email">
                </label>
            </section>

            <section class="col col-md-2 col-sm-12">
                <label class="input">
                    Membership Status
                    <select name="membershipType" class="form-control" style="height: 30px">
                        <option value="" <?php echo ($prev_membershipType == '')? 'selected' : '' ?> >Not Defined</option>
                        <option value="1" <?php echo ($prev_membershipType == '1')? 'selected' : '' ?> >Yes</option>
                        <option value='0' <?php echo ($prev_membershipType == '0')? 'selected' : '' ?> >No</option>
                    </select>
                </label>
            </section>

            <section class="col col-md-2 col-sm-12">
                <label class="input">
                    Expiration Date From
                    <input type="text" class="datepicker" placeholder="Click for selecting date" value="<?php echo $prev_expireDateFrom ?>" name="expireDateFrom">
                </label>
            </section>

            <section class="col col-md-2 col-sm-12">
                <label class="input">
                    Expiration Date To
                    <input type="text" class="datepicker" placeholder="Click for selecting date" value="<?php echo $prev_expireDateTo ?>" name="expireDateTo">
                </label>
            </section>

            <section class="col col-md-1 col-sm-12">
                <label class="input">
                    per Page
                    <select name="limit" class="form-control" style="height: 30px">
                        <option <?php if(isset($result['limit']) && $result['limit']==10){echo 'selected';} ?> value="10">10</option>
                        <option <?php if(isset($result['limit']) && $result['limit']==25){echo 'selected';} ?> value="25">25</option>
                        <option <?php if(isset($result['limit']) && $result['limit']==50){echo 'selected';} ?> value="50">50</option>
                        <option <?php if(isset($result['limit']) && $result['limit']==100){echo 'selected';} ?> value="100">100</option>
                    </select>
                </label>
            </section>

            <section class="col col-md-2 col-sm-12">
                <label class="input">
                    <button type="submit" name="sbmtBtn" class="btn btn-primary member-search-btn" style=" height: 31px; margin: 1.2em 0 0 5px; padding: 0 22px; font: 300 15px/29px 'Open Sans',Helvetica,Arial,sans-serif; cursor: pointer;"><i class="fa fa-search"></i> Search</button>
                </label>
            </section>
        </div>
<!--    </fieldset>-->
</form>


<div class="">
    <?php if(isset($_POST['sbmtBtn']) || $totalCount > 0) {?>
    <div class="pull-left">
        <p>Total number of records: <?php echo $totalCount ?></p>
    </div>
    <?php } ?>
    <?php if($totalCount > 0 && $pagesCount > 1){ ?>
    <div class="pull-right">
        <ul class="pagination" style="margin-top: 0">
            <li class="<?= (($currentPage - 1) > 0) ? '' : 'disabled'; ?>"><a href="#" onclick="navigateToPage(<?php echo $currentPage - 1 ?>)" page="<?= $currentPage - 1; ?>"><<</a></li>
            <?php if($currentPage > 5){ ?>
                <li><a href="#" data-page="1" onclick="navigateToPage(1)">1</a></li>
                <li class="disabled previous"><a>...</a></li>
            <?php } ?>
            <?php for($i = $currentPage-3; $i <= $currentPage+3; $i++){ ?>
                <?php if($i > 0 && ($currentPage <= $pagesCount && $i <= $pagesCount)){ ?>
                    <li class="<?php echo ($currentPage == $i) ? 'active' : ''; ?>"><a href="#" onclick="navigateToPage(<?php echo $i ?>)" page="<?php echo $i; ?>"><?php echo $i ?></a></li>
                <?php } ?>
            <?php } ?>
            <?php if($currentPage < $pagesCount-4){ ?>
                <li class="disabled previous"><a>...</a></li>
                <li><a href="#" onclick="navigateToPage(<?php echo $pagesCount ?>)" page="<?=$pagesCount?>"><?php echo $pagesCount?></a></li>
            <?php } ?>
            <li class="<?php echo (($currentPage + 1) > $pagesCount) ? 'disabled' : ''; ?>"><a href="#" onclick="navigateToPage(<?php echo $currentPage + 1 ?>)" page="<?php echo $currentPage + 1; ?>">>></a></li>
        </ul>
    </div>
    <?php } ?>
</div>
