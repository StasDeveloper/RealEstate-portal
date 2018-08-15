<div class="search-results1">
    <h4><?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?></h4>
    <div>
<?php /*/ ?>
        <p class="note">
		posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
        </p>
<?php /*/ ?>
        <p class="description">
		<?php
//			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
//			$this->endWidget();
		?>
        </p>
	<div class="nav url text-success">
		<b>Tags:</b>
		<?php echo implode(', ', $data->tagLinks); ?>
		<br/>
		<?php echo CHtml::link('Permalink', $data->url); ?> |
		<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
		Last updated on <?php echo date('F j, Y',$data->update_time); ?>
	</div>
    </div>
</div>
