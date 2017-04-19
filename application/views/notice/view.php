<script type="text/javascript">
    $(function(){
    	PNotify.prototype.options.styling = "bootstrap3";
        new PNotify({
            type: <?php echo '"'.$type.'"'; ?>,
            text: <?php echo '"'.$message.'"'; ?>,
            icon: false,
            delay: 1000,
            buttons: {
            	closer: false,
            },
        });
    });
</script>