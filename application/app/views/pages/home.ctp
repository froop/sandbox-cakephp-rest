<div id="id1"></div>
<ol id="id2"></ol>

<script src="js/lib/jquery.js"></script>
<script>
$(function () {
	$.getJSON("samples.json", function (data) {
		$("#id1").text(data.key1);
		$.each(data.key2, function () {
			$("<li></li>")
				.text(this.key22 + ":" + this.key21)
				.appendTo($("#id2"));
		});
	});
});
</script>
