$(function () {
	"use strict";

	$.getJSON("../samples.json", function (data) {
		$("#id1").text(data.key1);

		$.each(data.list, function () {
			var text = this.Sample.modified + ":" + this.Sample.text1;
			var $item = $("<li>");

			$("<a>").attr("href", "input.html?" + $.param({
						id : this.Sample.id
					}))
					.text(text)
					.appendTo($item);
			$item.appendTo($("#list1"));
		});
	});
});
