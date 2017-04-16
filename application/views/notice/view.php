<script type="text/javascript">
    $(function(){
    	PNotify.prototype.options.styling = "jqueryui";
        new PNotify({
            type: <?php echo '"'.$type.'"'; ?>,
            text: <?php echo '"'.$message.'"'; ?>,
            icon: false
        });
    });
</script>