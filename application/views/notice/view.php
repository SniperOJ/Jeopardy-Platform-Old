<script type="text/javascript">
	function check() {
		  notie.alert({
		  type: <?php echo '"'.$type.'"'; ?>, // optional, default = 4, enum: [1, 2, 3, 4, 5, 'success', 'warning', 'error', 'info', 'neutral']
		  text: <?php echo '"'.$message.'"'; ?>,
		  stay: false, // optional, default = false
		  time: 3, // optional, default = 3, minimum = 1,
		  position: "top" // optional, default = 'top', enum: ['top', 'bottom']
		})
	}
</script>