$(function () {
	"use strict";

	$.getJSON("../samples.json", function (data) {
		$("#id1").text(data.key1);

		$.each(data.list, function () {
			var url = "input.html?" + $.param({ id : this.Sample.id });
			var text = this.Sample.modified + ":" + this.Sample.text1;
			var $link = $("<a>")
					.attr("href", url)
					.text(text);
			$("#list1").append($("<li>").append($link));
		});
	});
});
