$(function () {
	"use strict";

	$.getJSON("../samples.json", function (data) {
		$("#id1").text(data.key1);

		$.each(data.list, function () {
			var $link = $("<a>")
					.attr("href", "input.html?" + $.param({ id : this.Sample.id }))
					.text(this.Sample.modified + ":" + this.Sample.text1);
			$("#list1").append($("<li>").append($link));
		});
	});
});
