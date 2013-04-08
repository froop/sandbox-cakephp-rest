$(function () {
	"use strict";

	$.getJSON("../samples.json", function (data) {
		$("#id1").text(data.key1);

		$.each(data.list, function () {
			var url = "input.html?" + $.param({ id : this.Sample.id });
			var text = this.Sample.modified + ":" + this.Sample.text1;
			var $item = $("<li>");

			$("<a>").attr("href", url)
					.text(text)
					.appendTo($item);
			$item.appendTo($("#list1"));
		});
	});
});
