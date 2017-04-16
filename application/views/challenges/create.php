<?php echo validation_errors(); ?>

<?php echo form_open('challenges/create'); ?>

    <label for="name">Name</label>
    <input type="input" name="name" value="<?php echo set_value('name'); ?>" /><br />

    <label for="text">Description</label>
    <textarea name="description" value="<?php echo set_value('description'); ?>"></textarea><br />

    <label for="score">Score</label>
    <input type="input" name="score" value="<?php echo set_value('score'); ?>" /><br />

    <label for="type">Type</label>
    <input type="input" name="type" value="<?php echo set_value('type'); ?>" /><br />

    <label for="flag">Flag</label>
    <input type="input" name="flag"  value="<?php echo set_value('flag'); ?>"/><br />

        <label for="resource">Resource</label>
    <input type="input" name="resource"  value="<?php echo set_value('resource'); ?>"/><br />

        <label for="document">Document</label>
    <input type="input" name="document"  value="<?php echo set_value('document'); ?>"/><br />

    <input type="submit" name="submit" value="Add challenge" />

</form>
