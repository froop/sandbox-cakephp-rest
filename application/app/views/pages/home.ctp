<div id="id1"></div>
<ol id="list1"></ol>
<ol id="list2"></ol>

<script src="js/lib/jquery.js"></script>
<script>
$(function () {
	$.getJSON("samples.json", function (data) {
		$("#id1").text(data.key1);

		$.each(data.key2, function () {
			$("<li>")
				.text(this.key22 + ":" + this.key21)
				.appendTo($("#list1"));
		});

		$.each(data.key3, function () {
			var text = this.Sample.id + ":" + this.Sample.text1 +
					":" + this.Sample.modified;
			var $item = $("<li>");

			$("<a>").appendTo($item)
					.attr("href", "samples/" + this.Sample.id)
					.text(text);
			$item.appendTo($("#list2"));
		});
	});
});
</script>
