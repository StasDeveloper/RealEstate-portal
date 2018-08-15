                            <div class="col-sm-12">
                                <dl>
                                    <dt>Description:</dt>
                                    <dd><?php echo $details->description != '' ? $details->description : ''; ?><dd>
                                                <?php
                                                echo !empty($details->propertyInfoDetails->interior_features)? '<dt>Interior Description:</dt><dd>' . $details->propertyInfoDetails->interior_features . '</dd>' : '';
                                                echo !empty($details->propertyInfoDetails->exterior_features)? '<dt>Exterior Description:</dt><dd>' . $details->propertyInfoDetails->exterior_features . '</dd>' : '';
                                                if (($details->description == '') && empty($details->propertyInfoDetails->interior_features) && !empty($details->propertyInfoDetails->exterior_features)) {
                                                    echo 'N/a';
                                                }
                                                ?>
                                    </dd>
                                    <br>
<?php
if ((!empty($details->propertyInfoAdditionalDetails->roof)) ||
        (!empty($details->propertyInfoAdditionalDetails->ac_system)) ||
        (!empty($details->propertyInfoAdditionalDetails->electrical_system)) ||
        (!empty($details->propertyInfoAdditionalBrokerageDetails->fireplace_features)) ||
        (!empty($details->propertyInfoAdditionalBrokerageDetails->heating_features))):
    ?>
                                        <dt>Amenities:</dt>
                                        <?php endif; ?>
                                        <?php
                                        if ((!empty($details->propertyInfoAdditionalDetails->roof))
                                                && (!preg_match('/^\d+$/', $details->propertyInfoAdditionalDetails->roof))
                                                ) {
                                            echo '<dd class="amenities-list">Roof Type: ' . $details->propertyInfoAdditionalDetails->roof . '</dd>';
                                        }
                                        ?>

                                    <?php
                                    if ((!empty($details->propertyInfoAdditionalDetails->ac_system))
                                            && (!preg_match('/^\d+$/', $details->propertyInfoAdditionalDetails->ac_system))
                                            ) {
                                        echo '<dd class="amenities-list">Ac system Type: ' . $details->propertyInfoAdditionalDetails->ac_system . '</dd>';
                                    }
                                    ?>                       

                                    <?php
                                    if ((!empty($details->propertyInfoAdditionalDetails->electrical_system)) 
                                            && (!preg_match('/^\d+$/', $details->propertyInfoAdditionalDetails->electrical_system))
                                            ) {
                                        echo '<dd class="amenities-list">Electricity: ' . $details->propertyInfoAdditionalDetails->electrical_system . '</dd>';
                                    }
                                    ?> 

                                    <?php
                                    if ((!empty($details->propertyInfoAdditionalBrokerageDetails->fireplace_features)) 
                                            && (!preg_match('/^\d+$/', $details->propertyInfoAdditionalBrokerageDetails->fireplace_features))
                                            ) {
                                        echo '<dd class="amenities-list">Fireplace Features: ' . $details->propertyInfoAdditionalBrokerageDetails->fireplace_features . '</dd>';
                                    }
                                    ?> 

                                    <?php
                                    if ((!empty($details->propertyInfoAdditionalBrokerageDetails->heating_features)) 
                                            && (!preg_match('/^\d+$/', $details->propertyInfoAdditionalBrokerageDetails->heating_features))
                                            ) {
                                        echo '<dd class="amenities-list">Heating Features: ' . $details->propertyInfoAdditionalBrokerageDetails->heating_features . '</dd>';
                                    }
                                    ?> 

                                </dl>
                            </div>

                            <div class="col-sm-12">

                                <table class="table table-bordered table-striped table-condensed">

                                    <tbody>
                                        
                                        <tr>
                                            <th>MLS ID:</th>
<?php echo $details->mls_sysid != 0 ? '<td>' . $details->mls_sysid . '</td>' : '<td class="text-muted">N/A</td>'; ?>
                                            <th>RadiID:</th>
                                            <td><?php echo $details->property_id; ?></td>
                                        </tr>
                                        <tr>
                                            <?php echo Yii::app()->user->isGuest ? '<th class="text-muted">Ownership/ Sale Type:</th>' : '<th>Ownership/ Sale Type:</th>'; ?>
                                            <td><?php
                                            if (Yii::app()->user->isGuest) {
                                                echo '<a rel="popover-hover" data-placement="top" data-original-title="Upgrade your Membership" data-content="Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.">Members Only</a></td>';
                                            } else {

                                                if (!empty($details->propertyInfoAdditionalBrokerageDetails->foreclosure)) {
                                                    echo $details->propertyInfoAdditionalBrokerageDetails->foreclosure == 'Yes' ? '/ ' . $foreclosure. ',&nbsp;' : '';
                                                }
                                                if (!empty($details->propertyInfoAdditionalBrokerageDetails->short_sale)) {
                                                    echo $details->propertyInfoAdditionalBrokerageDetails->short_sale == 'Yes' ? $shortsale : '';
                                                }
                                            }
                                            ?>
                                                <?php echo Yii::app()->user->isGuest ? '<th class="text-muted">History:</th>' : '<th>History:</th>'; ?>
                                            <td><?php
                                                if (Yii::app()->user->isGuest) {
                                                    echo '<a rel="popover-hover" data-placement="top" data-original-title="Upgrade your Membership" data-content="Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.">Members Only</a>';
                                                } else {
                                                    echo (!empty($details->propertyInfoAdditionalBrokerageDetails->sales_history)) ? 'Sales History: $' . number_format((float)$details->propertyInfoAdditionalBrokerageDetails->sales_history) . '<br>' : '';
                                                    echo (!empty($details->propertyInfoAdditionalBrokerageDetails->tax_history)) ? 'Tax History: $' . number_format((float)$details->propertyInfoAdditionalBrokerageDetails->tax_history) . '/ Yr' : '';
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
<?php echo Yii::app()->user->isGuest ? '<th class="text-muted">Condition:</th>' : '<th>Condition:</th>'; ?>
<?php
if (Yii::app()->user->isGuest) {
    echo '<td><a rel="popover-hover" data-placement="top" data-original-title="Upgrade your Membership" data-content="Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.">Members Only</a></td>';
} else {
    echo (!empty($details->propertyInfoAdditionalDetails->over_all_property) && $details->propertyInfoAdditionalDetails->over_all_property > 0) ? '<td>' . $over_all_property_array[$details->propertyInfoAdditionalDetails->over_all_property] . '</td>' : '<td class="text-muted">N/A</td>';
}
?>
                                                <?php echo Yii::app()->user->isGuest ? '<th class="text-muted">Financing:</th>' : '<th>Financing:</th>'; ?>
                                            <td><?php
                                                if (Yii::app()->user->isGuest) {
                                                    echo '<a rel="popover-hover" data-placement="top" data-original-title="Upgrade your Membership" data-content="Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.">Members Only</a>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

