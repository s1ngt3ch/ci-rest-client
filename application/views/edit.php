<?php echo form_open('test_client/edit');?>
<?php echo form_hidden('id',$items[0]->id);?>

<table>
    <tr><td>ID</td><td><?php echo form_input('id',$items[0]->id,"disabled");?></td></tr>
    <tr><td>TITLE</td><td><?php echo form_input('title',$items[0]->title);?></td></tr>
    <tr><td>DESCRIPTION</td><td><?php echo form_input('description',$items[0]->description);?></td></tr>
    <tr><td colspan="2">
        <?php echo form_submit('submit','Save');?>
        <?php echo anchor('test_client','Back');?></td></tr>
</table>
<?php
echo form_close();
?>