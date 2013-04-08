$(function () {
	"use strict";

	$.getJSON("../samples.json", function (data) {
		$("#id1").text(data.key1);

		$.each(data.list, function () {
			var text = this.Sample.id + ":" + this.Sample.text1
					+ ":" + this.Sample.modified;
			var $item = $("<li>");

			$("<a>").appendTo($item)
					.attr("href", "input.html?" + $.param({
						id : this.Sample.id
					}))
					.text(text);
			$item.appendTo($("#list1"));
		});
	});
});
