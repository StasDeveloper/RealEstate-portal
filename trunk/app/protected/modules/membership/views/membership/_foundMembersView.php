<?php
//var_dump($members);
?>

<p id="output"></p>

<table id="found-memberships" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>User Id</th>
            <th>User Email</th>
            <th>Membership Status</th>
            <th>Expiration Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
//    echo "<pre>";
//    print_r($members);die;
    foreach($members as $member){
    ?>
        <tr>
            <td><?php echo $member['id'] ?></td>
            <td><?php echo $member['username'] ?></td>
            <td>

                <select style="width: 50%" name="membershipType" class="usr_<?php echo $member['user_profile_id']?> form-control">
                    <?php
                    $memberActive = $memberInactive = '';
                    ($member['payment_type'] == true)? $memberActive = 'selected' : $memberInactive = 'selected'; ?>
                    <option value="1" <?php echo $memberActive ?>>Yes</option>
                    <option value="0" <?php echo $memberInactive ?>>No</option>
                </select>
            </td>
            <td class="smart-form">
                <section class="col col-12" style="margin-bottom: 0; padding-left: 0">
                    <label class="input">
                        <input data-dateformat="yyyy-mm-dd" class="datepicker usr_<?php echo $member['user_profile_id']?>" user_id="<?php echo $member['id'] ?>" type="text" value="<?php echo $member['membership_expire_date'] ?>">
                    </label>
                </section>
            </td>
            <td>
                <button onclick="saveChanges(<?php echo $member['user_profile_id']?>)" class="btn btn-primary btn-xs" title="Save Changes"><i class="fa fa-save"></i></button>
                <a href="<?php echo Yii::app()->createUrl('user/profile', array('id'=>$member['id']))?>" class="btn btn-primary btn-xs" title="Edit User Profile"><i class="fa fa-pencil"></i></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>




